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
    // echo $id."<hr>".$priceFilter;
    // die("!");
    $sort = '';
    if (!empty($priceFilter)) {
      if ($priceFilter == 'expensive') {
        $sort = 'DESC';
      } elseIF($priceFilter == 'cheapest'){
        $sort = 'ASC';
      }
    }
    die("$sort");

    if ($id != -1) {
      $products = $this->productModel->getVisibleProductsByCategoryId($id, $sort);
      $categories = $this->categoryModel->getCategories();
    } else {
      $products = $this->productModel->getVisibleProducts($sort);
      $categories = $this->categoryModel->getCategories();
    }
    $data = [
      'products' => $products,
      'categories' => $categories
    ];


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
