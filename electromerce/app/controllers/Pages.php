<?php
class Pages extends Controller
{
  public $productModel;
  public $categoryModel;
  public $adminModel;
  public $clientModel;
  public function __construct()
  {
    //Load Models
    $this->productModel = $this->model('Product');
    $this->adminModel = $this->model('Admin');
    $this->clientModel = $this->model('Client');
    $this->categoryModel = $this->model('Category');
  }

  // Load Homepage
  public function index()
  {
    //Set Data
    $data = [];

    // Load homepage/index view
    $this->view('pages/index', $data);
  }

  public function about()
  {
    //Set Data
    $data = [
      'version' => '1.0.0'
    ];

    // Load about view
    $this->view('pages/about', $data);
  }
  public function contact()
  {
    //Set Data
    $data = [
      'version' => '1.0.0'
    ];

    // Load about view
    $this->view('pages/contact', $data);
  }
  public function register()
  {
    //Set Data
    $data = [
      'version' => '1.0.0'
    ];

    // Load about view
    $this->view('pages/register', $data);
  }
  public function products($id = -1, $priceFilter = '')
  {
    //per_page
    //total_products
    // Retrieve the current page number from the URL parameter
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    // Set the number of products per page
    $per_page = 3;

    // Create a new instance of the product model
    $productModel = $this->productModel;

    // Retrieve the products for the current page
    $productsData = $productModel->getProductsByPage($page, $per_page);

    // Pass the data to the view
    $products = $productsData['products'];
    $total_products = $productsData['total_products'];


    // require_once('views/products.php');

    $sort = '';
    if (!empty($priceFilter)) {
      if ($priceFilter == 'expensive') {
        $sort = 'DESC';
      } elseif ($priceFilter == 'cheapest') {
        $sort = 'ASC';
      }
    }

    // Pass the data to the view
    $products = $productsData['products'];
    $total_products = $productsData['total_products'];
    if ($id != -1) {
      // Retrieve the products for the current page
      $productsData = $productModel->getProductsByPage($page, $per_page);
      // $products = $this->productModel->getVisibleProductsByCategoryId($id, $sort);
      $categories = $this->categoryModel->getCategories();
    } else {
      // Retrieve the products for the current page
      $productsData = $productModel->getProductsByPage($page, $per_page);
      // $products = $this->productModel->getVisibleProducts($sort);
      $categories = $this->categoryModel->getCategories();
    }
    $data = [
      'products' => $products,
      'categories' => $categories,
      'perPage' => $per_page,
      'total_products' => $total_products,
      'page' => $page
    ];

    // echo "<pre>";
    // print_r($data);
    // echo "<pre>";
    // die("product page");


    // Load about view
    $this->view('pages/products', $data);
    // die("");
  }

  public function orders()
  {
    //Set Data
    $data = [
      'version' => '1.0.0'
    ];

    // Load about view
    $this->view('pages/orders', $data);
  }
  public function checkOut()
  {
    //Set Data
    $data = [
      'version' => '1.0.0'
    ];

    // Load about view
    $this->view('pages/checkOut', $data);
  }


  public function productDetails($id)
  {
    // die("something");
    if ($this->isLoggedIn()) {
      $product = $this->productModel->getProductById($id);
      $data = [];
      $data['product'] = $product;
      $data['catName'] = $this->productModel->getCategoryNameByProductId($id);
      // echo "<pre>";
      // var_dump($data['catName']);
      // echo "<pre>";
      // die("die");
      $this->view('pages/productDetails', $data);
      return;
    } else {
      die("somthing wrong");
    }
    //Set Data
    $data = [];
    // Load homepage/index view
    $this->view('pages/index', $data);
  }

  public function clients()
  {
    if ($this->isAdmin()) {
      $clients = $this->clientModel->getClients();
      $data = [
        'clients' => $clients
      ];

      $this->view('pages/clients', $data);
    } else {
      $data = [];
      $this->view('pages/index', $data);
    }
  }
}
