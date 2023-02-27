<?php
class Orders extends Controller
{
    public $productModel;
    public $categoryModel;
    public $orderModel;
    public $orderProductModel;
    public $adminModel;
    public $clientModel;
    public function __construct()
    {
        if (!$this->isLoggedIn()) {
            //Set Data
            $data = [];
            // Load products/index view
            $this->view('pages/index', $data);
            return;
        }
        //Load Models
        $this->productModel = $this->model('Product');
        $this->orderModel = $this->model('Order');
        $this->orderProductModel = $this->model('orderproduct');
        // die("die");
        $this->adminModel = $this->model('Admin');
        $this->clientModel = $this->model('Client');
        $this->categoryModel = $this->model('Category');
    }

    // Helper function
    public function generateRandomString()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    // Load Homepage
    public function index()
    {
        if ($this->isAdmin()) {
            // Set Data
            $orderModel = $this->orderModel->getOrders();
            $data = [
                'orders' => $orderModel
            ];
            $this->view('orders/index', $data);
            return;
        } elseif ($this->isClient()) {
            $clientId = $_SESSION['user_id'];
            $activeOrder = [];
            // echo "<pre>";
            // var_dump($this->orderModel->getActiveOrder($clientId));
            // echo "</pre>";
            // die("diee");
            // Check if we have any active Order for the actual Client
            if ($this->orderModel->getActiveOrder($clientId)) {
                $activeOrder = $this->orderModel->getActiveOrder($clientId)[0];
            } else {
                //Set Data
                $data = [
                    'products' => array(),
                    'total' => 0,
                ];
                // Load Orders/index view
                $this->view('orders/index', $data);  
            }
            // Get the orderProduct rows
            $orderProduct = $this->orderProductModel->getOrderProductByOrderId($activeOrder->id);

            $total = 0;
            // Go trought all the orderProduct table rows and based on the idProd column 
            $products = array();
            foreach ($orderProduct as $row) {
                // Get the product data
                $product = $this->productModel->getProductById($row->idProd);
                $tempArray = array();
                $tempArray['product'] = $product;
                $tempArray['quantity'] = $row->quantity;
                array_push($products, $tempArray);

                // Calc the total price for the order
                $total += $product->finalPrice;
            }


            // Set Data
            $data = [
                'products' => $products,
                'total' => $total,
                'orderId' => $activeOrder->id,
                'clientId' => $clientId
            ];
            // $products = $data['products'];
            // echo "<pre>";
            // foreach ($products as $product) {
            //     echo($product['quantity']);
            // }
            // echo "<pre><hr>";
            // die("Die");
            // echo($data['products'][0]['product']);
            $this->view('orders/index', $data);
            return;
        } else {
            //Set Data
            $data = [];
            // Load homepage/index view
            $this->view('pages/index', $data);
        }
    }


    public function add()
    {
        // Check for authentication
        if (!$this->isLoggedIn()) {
            //Set Data
            $data = [];
            // Load homepage/index view
            $this->view('pages/products', $data);
            return;
        }

        // The real work
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $product = $this->productModel->getProductById($_POST['id']);

            // Explination
            /*
                // $today = date('Y-m-d');
                // $oneDayLater = date('Y-m-d', strtotime($today . ' +1 day'));
                // $TwoDaysLater = date('Y-m-d', strtotime($oneDayLater . ' +1 day'));

                // Before add prodct to the order let's check if the client alredy have started another order
                // if so,
                // we can create a new order just when the last order status is Created
                
                if we have an order in the _order table for the client and it's status is 'notValid'
                => we will add the product to the same product
                else {
                    create another order and add this product to it
                }


                >>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                if((select * from _order o, client c where c.id = o.idClient and o.status = 'notValid'))
                {
                    means that the client want to add this product to the card in the existing order
                    So.. 
                    =>Don't create a new _order row,but 
                    add the product to orderProduct table with the existing _order id reference
                }else {
                    means that the client have not add any product to the card yet 
                    So
                    => Create a new _order row and add the product to orderProdcut
                        table with the id of the new created _order row and the product
                        that the user want to add to the card
                }
                
            */

            $clientId = $_SESSION['user_id'];
            $activeOrder = [];
            // Check if we have any active Order for the actual Client
            if ($this->orderModel->getActiveOrder($clientId)) {
                $activeOrder = $this->orderModel->getActiveOrder($clientId)[0];
            }
            $quantity = $_POST['quantity'] ?? 1;
            if (empty($activeOrder)) {
                // Create it  => status = notValid
                $data = [
                    //Data to create a new _order
                    'idAdmin' => $product->idAdmin,
                    'idClient' => $_SESSION['user_id'],
                    'reference' => $this->generateRandomString(),
                ];
                //Execute
                try {
                    // Create a new Order
                    $this->orderModel->addOrder($data);

                    // Get the order after create it => Just to take the new order row id [idOrder]
                    $activeOrder = $this->orderModel->getActiveOrder($clientId)[0];
                    $data = [
                        //Data to add a product to an existing order
                        'idProd' => $product->id,
                        'idOrder' => $activeOrder->id,
                        'unitPrice' => $product->finalPrice,
                        'quantity' => $quantity,
                        'prodTotalPrice' => ($quantity * $product->finalPrice),
                    ];
                    // Check if it already exist in orderProduct table
                    if ($this->orderProductModel->getOrderProductByIds($data['idOrder'], $data['idProd'])) {
                        // If So  => Update the Quantity
                        $this->orderModel->updateOrderProduct($data['idOrder'], $data['idProd'], $data['quantity']);
                    } else {
                        // If not => Add the product to the new Order
                        $this->orderProductModel->addOrderProduct($data);
                    }

                    // Redirect to Products
                    flash('order_added', 'Order Added');
                    redirect('pages/products');
                } catch (\Throwable $th) {
                    $products = $this->productModel->getVisibleProducts();
                    $categories = $this->categoryModel->getCategories();
                    $data = [
                        'products' => $products,
                        'categories' => $categories
                    ];

                    // Load products out view
                    $this->view('pages/products', $data);
                }

                // Add the product to the orderproduct
            } else if ($activeOrder->status == 'notValid') {
                $data = [
                    //Data to add a product to an existing order
                    'idProd' => $product->id,
                    'idOrder' => $activeOrder->id,
                    'unitPrice' => $product->finalPrice,
                    'quantity' => $quantity,
                    'prodTotalPrice' => ($quantity * $product->finalPrice),
                ];
                //Execute
                try {

                    // Check if it already exist in orderProduct table
                    if ($this->orderProductModel->getOrderProductByIds($data['idOrder'], $data['idProd'])) {
                        // If So  => Update the Quantity
                        $this->orderProductModel->updateOrderProduct($data['idOrder'], $data['idProd'], $data['quantity']);
                        // die("True");
                    } else {
                        // If not => Add the product to the new Order
                        $this->orderProductModel->addOrderProduct($data);
                    }
                    // Redirect to Products
                    flash('order_added', 'Order Added');
                    redirect('pages/products');
                } catch (\Throwable $th) {
                    $products = $this->productModel->getVisibleProducts();
                    $categories = $this->categoryModel->getCategories();
                    $data = [
                        'products' => $products,
                        'categories' => $categories
                    ];

                    // Load products view
                    $this->view('pages/products', $data);
                }
            }
        } else {
            $data = [];
            $this->view('pages/orders', $data);
        }
    }

    // Edit Product
    public function edit()
    {
        if (!$this->isAdmin()) {
            //Set Data
            $data = [];
            // Load homepage/index view
            $this->view('pages/index', $data);
            return;
        }


        // ////////////////////////////////////////
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $id = trim($_POST['id']);
            // $photo = empty($_FILES['photo']['name']) ? trim($_POST['oldPhoto']) : $_FILES['photo']['tmp_name'];
            $photo = $_FILES['photo'];
            $data = [
                'id' => trim($_POST['id']),
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'idCat' => trim($_POST['idCat']),
                'reference' => trim($_POST['reference']),
                'description' => trim($_POST['description']),
                'barCode' => trim($_POST['barCode']),
                'photo' => $_FILES['photo']['name'],
                'oldPhoto' => trim($_POST['oldPhoto']),
                'purchasePrice' => trim($_POST['purchasePrice']),
                'finalPrice' => trim($_POST['finalPrice']),
                'offerPrice' => trim($_POST['offerPrice']),

                'user_id_err' => '',
                'title_err' => '',
                'categories_err' => '',
                'reference_err' => '',
                'description_err' => '',
                'barCode_err' => '',
                'photo_err' => '',
                'purchasePrice_err' => '',
                'finalPrice_err' => '',
                'offerPrice_err' => ''
            ];

            // Validate title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            // Validate categories
            if (empty($data['idCat'])) {
                $data['categories_err'] = 'Please enter categories';
            }
            // Validate reference
            if (empty($data['reference'])) {
                $data['reference_err'] = 'Please enter reference';
            }
            // Validate description
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter description';
            }
            // Validate barCode
            if (empty($data['barCode'])) {
                $data['barCode_err'] = 'Please enter barCode';
            }
            // Validate photo
            if (empty($data['photo'])) {
                // $data['photo_err'] = 'Please enter photo';
                $data['photo'] = $data['oldPhoto'];
            } else {
                $productImagePath = "productsImgs/" . $photo["name"];
                move_uploaded_file($photo["tmp_name"], $productImagePath);
                $data['photo'] = $productImagePath;
            }
            // Validate purchasePrice
            if (empty($data['purchasePrice'])) {
                $data['purchasePrice_err'] = 'Please enter purchasePrice';
            }
            // Validate finalPrice
            if (empty($data['finalPrice'])) {
                $data['finalPrice_err'] = 'Please enter finalPrice';
            }
            // Validate offerPrice
            if (empty($data['offerPrice'])) {
                $data['offerPrice_err'] = 'Please enter offerPrice';
            }

            // Make sure there are no errors
            if (
                empty($data['title_err']) &&
                empty($data['categories_err']) &&
                empty($data['reference_err']) &&
                empty($data['description_err']) &&
                empty($data['barCode_err']) &&
                empty($data['photo_err']) &&
                empty($data['purchasePrice_err']) &&
                empty($data['finalPrice_err']) &&
                empty($data['offerPrice_err'])
            ) {
                //Execute
                if ($this->productModel->updateProduct($data)) {
                    // Redirect to amdin products section
                    flash('product_Updated', 'Product Updated');
                    redirect('products'); //products/index
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $product = $this->productModel->getProductById($id);
                $data['product'] = $product;
                $this->view('products/edit', $data);
            }
        } else {
            // echo "<pre>";
            // var_dump($_GET);
            // echo "<pre>";
            $id = trim($_GET['id']);
            // die($id);
            // Get products from model
            $product = $this->productModel->getProductById($id);
            $categoriesTable = $this->categoryModel->getCategories();
            // Check for owner
            if ($product->idAdmin != $_SESSION['user_id']) {
                redirect('pages/products');
            }
            $data = [
                'categories' => $categoriesTable,
                'products' => $product,
                'user_id' => $_SESSION['user_id'],
            ];
            $this->view('products/edit', $data);
        }
    }

    public function delete()
    {
        if ($this->isAdmin()) {
            $id = trim($_GET['id']);
            $this->productModel->deleteProduct($id);

            // Set Data
            $productModel = $this->productModel->getProducts();

            $data = [
                'products' => $productModel,
            ];
            $this->view('products/index', $data);
            return;
        }
    }



    // public function isAdmin()
    // {
    //   // If logged in, redirect to posts
    //   if (isset($_SESSION['user_id'])) {
    //     if ($_SESSION['user_type'] === 'Admin') {
    //       return true;
    //     }
    //   }
    //   return false;
    // }

}
