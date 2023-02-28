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
            redirect('orders/index', $data);
        }
    }


    public function updateOrderProductQuantity()
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
            
            $data = [
                //Data to add a product to an existing order
                'idProd' =>  trim($_POST['prodId']), // $product->id,
                'idOrder' => trim($_POST['orderId']), // $activeOrder->id,
                'quantity' =>  intval(trim($_POST['quantity'])), //$product->finalPrice,
                'prodTotalPrice' => intval((trim($_POST['quantity'])) * intval(trim($_POST['unitPrice']))),
            ];
            // die("D");
             $this->orderProductModel->updateOrderProduct($data);
             $data = [];
            redirect('orders/index', $data);

        }else {
            $data = [];
            redirect('orders/index', $data);
        }
    }
    public function deleteOrderProduct()
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
            
            $data = [
                //Data to add a product to an existing order
                'orderId' => trim($_POST['orderId']), 
                'prodId' =>  trim($_POST['prodId']),
            ];
             $this->orderProductModel->deleteOrderProduct($data);
             $data = [];
            redirect('orders/index', $data);

        }else {
            $data = [];
            redirect('orders/index', $data);
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
