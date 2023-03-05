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
        // SELECT SUM(op.prodtotalprice) FROM orderproduct op, _order o WHERE op.idOrder = o.id and o.id = 2

        // $data = [
        //     'clientNames' => array()
        // ];
        // $orders = $this->orderModel->getOrders();
        // $orderProducts = $this->orderProductModel->getOrderProduct();
        // for ($i = 0; $i < count($orders); $i++) {
        //     // $orders[$i]->status = 'notValid';
        //     $orderId = $orders[$i]->id;
        //     $total = 0;
        //     $clientName = $this->clientModel->getClienyById($orders[$i]->idClient)->fullName ?? 'No user name';
        //     array_push($data['clientNames'], $clientName);
        //     foreach ($orderProducts as $orderProduct) {
        //         if ($orderProduct->idOrder == $orderId) {
        //             $total += $orderProduct->prodTotalPrice;
        //         }
        //     }
        // }
        // var_dump($data['clientNames']) . "<br>";
        // die("ddd");
        if ($this->isAdmin()) {
            // Set Data
            $orders = $this->orderModel->getOrders();
            $orderProducts = $this->orderProductModel->getOrderProduct();
            $data = [
                'clientNames' => array(),
                'id' => array(),
                'orderTotalPrice' => array(),
                'creationDate' => array(),
                'dispatchDate' => array(),
                'deliveryDate' => array(),
                'status' => array(),
                'orders' => array(),
            ];
            for ($i = 0; $i < count($orders); $i++) {
                // $orders[$i]->status = 'notValid';
                $orderId = $orders[$i]->id;
                $total = 0;
                $clientName = $this->clientModel->getClienyById($orders[$i]->idClient)->fullName ?? 'No user name';
                $data['clientNames'][] =  $clientName;

                // echo count($data['clientNames']);
                foreach ($orderProducts as $orderProduct) {
                    if ($orderProduct->idOrder == $orderId) {
                        $total += $orderProduct->prodTotalPrice;
                    }
                }
                $orders[$i]->orderTotalPrice = $total;
                $orders[$i]->CreationDate = date("Y-m-d");
                $orders[$i]->dispatchDate = date("Y-m-d", strtotime("+1 day"));
                $orders[$i]->diliveryDate = date("Y-m-d", strtotime("+2 day"));

                $data = [
                    'id' => $orderId,
                    'orderTotalPrice' => $orders[$i]->orderTotalPrice,
                    'creationDate' => $orders[$i]->CreationDate,
                    'dispatchDate' => $orders[$i]->dispatchDate,
                    'deliveryDate' => $orders[$i]->diliveryDate,
                    'status' => $orders[$i]->status,

                ];
                // echo "<pre>";
                // // var_dump($this->clientModel->getClienyById($orders[$i]->idClient)->fullName);
                // var_dump($data['clientName']);
                // echo "</pre>";
                // die("diee");

                $data['orders'] = $orders;
                echo "<pre>";
                print_r($data);
                echo "<pre>";
                die("fgh");
                $this->orderModel->updateOrder($data);
            }

            $this->view('orders/index_admin', $data);
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
            // echo ($data['productTotalPrice']);

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
                $total += $product->finalPrice * $row->quantity;
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
            
            $clientId = $_SESSION['user_id'];
            $activeOrder = [];
            
            // Active order means status = 'Not valid'
            // Check if we have any active Order for the actual Client
            if ($this->orderModel->getActiveOrder($clientId)) {
                $activeOrder = $this->orderModel->getActiveOrder($clientId)[0];
            }
            
            $quantity = $_POST['quantity'] ?? 1;
            
            if (empty($activeOrder)) {
                // die("empty");
                // Create it  => status = notValid
                $data = [
                    //Data to create a new _order
                    'idAdmin' => $product->idAdmin,
                    'idClient' => $_SESSION['user_id'],
                    'reference' => $this->generateRandomString(),
                    'orderTotalPrice' => 0,
                    'status' => 'notValid',
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
                        die ("already exist");
                        $this->orderModel->updateOrderProduct($data['idOrder'], $data['idProd'], $data['quantity']);
                        $this->orderModel->addToOrderTotalPrice($data);
                    } else {
                        // If not => Add the product to the new Order
                        $this->orderProductModel->addOrderProduct($data);
                        $this->orderModel->addToOrderTotalPrice($data);
                        die ("new order");
                    }
                    // die("Order added");
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
                // die("not empty");

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
                        $this->orderProductModel->updateOrderProduct($data);
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
            redirect('orders/index');
        } else {
            redirect('orders/index');
        }
    }
    public function editOrderProductQuantity()
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
            $this->orderProductModel->editOrderProduct($data);
            redirect('orders/index');
        } else {
            redirect('orders/index');
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
        } else {
            $data = [];
            redirect('orders/index', $data);
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
