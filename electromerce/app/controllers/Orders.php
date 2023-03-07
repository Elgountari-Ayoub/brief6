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
        /*
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
        */
        if ($this->isAdmin()) {
            // Set Data
            // $orders = $this->orderModel->getOrders();
            $orders = $this->orderModel->getClientValidOrders(); //Do it in the module
            $orderProducts = $this->orderProductModel->getOrderProduct();
            $data = [
                'clientNames' => array(),
                'orders' => $orders,
            ];
            for ($i = 0; $i < count($orders); $i++) {
                $orderId = $orders[$i]->id;
                $clientName = $this->clientModel->getClienyById($orders[$i]->idClient)->fullName ?? 'No user name';
                $data['clientNames'][] =  $clientName;
                /*
                    // $data = [
                    //     'id' => $orderId,
                    //     'orderTotalPrice' => $orders[$i]->orderTotalPrice,
                    //     'creationDate' => $orders[$i]->CreationDate,
                    //     'dispatchDate' => $orders[$i]->dispatchDate,
                    //     'deliveryDate' => $orders[$i]->diliveryDate,
                    //     'status' => $orders[$i]->status,

                    // ];
                    // echo "<pre>";
                    // // var_dump($this->clientModel->getClienyById($orders[$i]->idClient)->fullName);
                    // var_dump($data['clientName']);
                    // echo "</pre>";
                    // die("diee");
                    // $this->orderModel->updateOrder($data);
                */
            }

            $this->view('orders/index_admin', $data);
            return;
        } elseif ($this->isClient()) {
            $clientId = $_SESSION['user_id'];
            $activeOrder = [];
            // Check if we have any active Order for the actual Client
            if ($this->orderModel->getActiveOrder($clientId)) {
                $activeOrder = $this->orderModel->getActiveOrder($clientId);
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
                $activeOrder = $this->orderModel->getActiveOrder($clientId);
            }
            $quantity = $_POST['quantity'] ?? 1;

            if (empty($activeOrder)) {
                // Create it  => status = notValid
                $data = [
                    //Data to create a new _order
                    'idAdmin' => $product->idAdmin,
                    'idClient' => $_SESSION['user_id'],
                    'reference' => $this->generateRandomString(),
                    'orderTotalPrice' => 0,
                    'status' => 'notValid',
                ];

                // Try to Create a new add a new order and new orderProduct row
                try {
                    // Create a new Order
                    $this->orderModel->addOrder($data);
                    // Get the order after create it => Just to take the new order row id [idOrder]
                    $activeOrder = $this->orderModel->getActiveOrder($clientId);
                    $data = [
                        //Data to add a product to an existing order
                        'idProd' => $product->id,
                        'idOrder' => $activeOrder->id,
                        'unitPrice' => $product->finalPrice,
                        'quantity' => $quantity,
                        'prodTotalPrice' => ($quantity * $product->finalPrice),
                    ];

                    // Add the product to the new Order
                    $this->orderProductModel->addOrderProduct($data);
                    $this->orderModel->updateOrderTotalPrice($data);

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
            } else if ($activeOrder->status == 'notValid') { // Add the product to the orderproduct
                $data = [
                    //Data to add a product to an existing order
                    'idProd' => $product->id,
                    'idOrder' => $activeOrder->id,
                    'unitPrice' => $product->finalPrice,
                    'quantity' => $quantity,
                    'prodTotalPrice' => ($quantity * $product->finalPrice),
                ];
                //Try To add the product to an existing order
                try {
                    // Check if it already exist in orderProduct table
                    if ($this->orderProductModel->getOrderProductByIds($data['idOrder'], $data['idProd'])) {
                        // If So  => Update the Quantity
                        $this->orderProductModel->updateOrderProductQuantity($data);
                        $this->orderModel->updateOrderTotalPrice($data);
                    } else {
                        // If not => Add the product to the new Order
                        $this->orderProductModel->addOrderProduct($data);
                        $this->orderModel->updateOrderTotalPrice($data);
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
            $this->orderProductModel->updateOrderProductQuantity($data);
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
            $this->orderProductModel->editOrderProduct($data);
            $this->orderModel->updateOrderTotalPrice($data);
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
                'idOrder' => trim($_POST['orderId']),
                'idProd' =>  trim($_POST['prodId']),
            ];
            $this->orderProductModel->deleteOrderProduct($data);
            $this->orderModel->updateOrderTotalPrice($data);
            $data = [];
            redirect('orders/index', $data);
        } else {
            $data = [];
            redirect('orders/index', $data);
        }
    }

    public function updateOrderStatus()
    {

        // I'll change the status of the order 
        //based on the data that I'll recieve from the GET request [status, orderId]
        // Check for authentication
        if (!$this->isLoggedIn()) {
            //Set Data
            $data = [];
            // Load homepage/index view
            $this->view('pages/products', $data);
            return;
        }
        // The real work
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Sanitize POST
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
            $order = $this->orderModel->getOrderById($_GET['id']);
            $data = [
                //Data to add a product to an existing order
                'id' => trim($_GET['id']),
                'status' =>  trim($_GET['status']),

                'creationDate' => $order->creationDate,
                'dispatchDate' => $order->dispatchDate,
                'deliveryDate' => $order->deliveryDate,
            ];
            $status = trim($_GET['status']);
            if ($status == 'validByClient') {
                // print_r($_GET);
                // die("!empty");
                // set the creation date
                $data['creationDate'] =  date("Y/m/d");
            }
            elseif ($status == 'dispatched') {
                // set the dispatchDate date
                $data['dispatchDate'] =  date("Y/m/d");
            }elseif ($status == 'delivered') {
                // set the deliveryDate date
                $data['deliveryDate'] =  date("Y/m/d");
            }
            $this->orderModel->updateStatus($data);

            redirect('orders/index');
        } else {
            $data = [];
            redirect('orders/index', $data);
        }
    }
    public function checkOut()
    {
        /*
         * take the [clientId, orderId]
         * change the order status from complet to validByClient
         * fill the creationDate => today
         * add this order to the previews orders at the orders/index page (client)
         * 
         */
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
