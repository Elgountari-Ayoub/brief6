<?php
class Products extends Controller
{
  public $productModel;
  public $categoryModel;
  public $adminModel;
  public $clientModel;
  public function __construct()
  {

    if (!$this->isAdmin()) {
      //Set Data
      $data = [];
      // Load products/index view
      $this->view('pages/index', $data);
      return;
    }
    //Load Models
    $this->productModel = $this->model('Product');
    // die("die");
    $this->adminModel = $this->model('Admin');
    $this->clientModel = $this->model('Client');
    $this->categoryModel = $this->model('Category');
  }

  // Load Homepage
  public function index()
  {
    if ($this->isAdmin()) {
      // Set Data
      $productModel = $this->productModel->getProducts();
      $data = [
        'products' => $productModel
      ];
      $this->view('products/index', $data);
      return;
    }
    //Set Data
    $data = [];
    // Load homepage/index view
    $this->view('pages/index', $data);
  }

  public function productDetails ($id){
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
      $this->view('products/productDetails', $data);
      return;
    }
    else {
      die("somthing wrong");
  }
    //Set Data
    $data = [];
    // Load homepage/index view
    $this->view('pages/index', $data);
  }

  public function add()
  {
    if (!$this->isAdmin()) {
      //Set Data
      $data = [];
      // Load homepage/index view
      $this->view('pages/index', $data);
      return;
    }
    // ////////////////////////////
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize POST
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $photo = $_FILES['photo'];
      $data = [
        'user_id' => $_SESSION['user_id'],
        'title' => trim($_POST['title']),
        'idCat' => trim($_POST['idCat']),
        'reference' => trim($_POST['reference']),
        'description' => trim($_POST['description']),
        'barCode' => trim($_POST['barCode']),
        'photo' => $_FILES['photo']['name'],
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
        'offerPrice_err' => '',
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
        $data['photo_err'] = 'Please enter photo';
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
        if ($this->productModel->addProduct($data)) {
          // Redirect to login
          flash('product_added', 'Product Added');
          redirect('products');
        } else {
          die('Something went wrong');
        }
      } else {
        $categoriesTable = $this->categoryModel->getCategories();
        $data['categories'] =  $categoriesTable;

        // echo "<pre>";
        // var_dump($data);
        // echo "<pre>";
        // die('dfgh');
        // Load view with errors
        $this->view('products/add', $data);
      }
    } else {
      $categoriesTable = $this->categoryModel->getCategories();
      $data = [
        'categories' => $categoriesTable,
        'user_id' => $_SESSION['user_id'],
        'title' => '',
        'idCat' => '',
        'reference' => '',
        'description' => '',
        'barCode' => '',
        'photo' => '',
        'purchasePrice' => '',
        'finalPrice' => '',
        'offerPrice' => '',


        'user_id_err' => '',
        'title_err' => '',
        'categories_err' => '',
        'reference_err' => '',
        'description_err' => '',
        'barCode_err' => '',
        'photo_err' => '',
        'purchasePrice_err' => '',
        'finalPrice_err' => '',
        'offerPrice_err' => '',
      ];
      $this->view('products/add', $data);
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
      //echo "<pre>";
      // var_dump($_POST);
      // echo "<pre>";
      // die("dump");
      // var_dump( $_FILES['photo']);
      // echo "-----------------------------";
      // echo 'Old Photo = >' . $_POST['oldPhoto'];
      // echo $_POST['photo'];
      // Sanitize POST
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $id = trim($_POST['id']);
      // $photo = empty($_FILES['photo']['name']) ? trim($_POST['oldPhoto']) : $_FILES['photo']['tmp_name'];
      $photo = $_FILES['photo'];
      // var_dump($_FILES['photo']);
      // echo"<br>";
      // die(trim($_POST['oldPhoto']));
      // die($_FILES['photo']['name']);
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

  public function delete(){

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

  public function hide(){

    if ($this->isAdmin()) {
      $id = trim($_GET['id']);
      $this->productModel->hideProduct($id);

      // Set Data
      $productModel = $this->productModel->getProducts();

      $data = [
        'products' => $productModel,
      ];
      $this->view('products/index', $data);
      return;
    }
  }
  public function show(){

    if ($this->isAdmin()) {
      $id = trim($_GET['id']);
      $this->productModel->showProduct($id);

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
