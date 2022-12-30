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
    // Load Models
    $this->productModel = $this->model('Product');
    // die("die");
    $this->adminModel = $this->model('Admin');
    $this->clientModel = $this->model('Client');
    $this->categoryModel = $this->model('Category');
  }

  // Load Homepage
  public function index()
  {
    if (!$this->isAdmin()) {
      //Set Data
      $data = [];
      // Load homepage/index view
      $this->view('pages/index', $data);
      return;
    }
    //Set Data
    $data = [];
    // Load homepage/index view
    $this->view('products/index', $data);
  }

  public function add()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!$this->isAdmin()) {
        echo "<pre>";
        var_dump($_POST);
        echo "<pre>";
        exit;
      }
      //Set Data
      $data = [];
      // Load homepage/index view
      $this->view('pages/index', $data);
      return;
    }
    // ////////////////////////////
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize POST
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'user_id' => $_SESSION['user_id'],
        'categories' => trim($_POST['categories']),
        'reference' => trim($_POST['reference']),
        'description' => trim($_POST['description']),
        'barCode' => trim($_POST['barCode']),
        'photo' => trim($_POST['photo']),
        'purchasePrice' => trim($_POST['purchasePrice']),
        'finalPrice' => trim($_POST['finalPrice']),
        'offerPrice' => trim($_POST['offerPrice']),

        'user_id_err' => '',
        'categories_err' => '',
        'reference_err' => '',
        'description_err' => '',
        'barCode_err' => '',
        'photo_err' => '',
        'purchasePrice_err' => '',
        'finalPrice_err' => '',
        'offerPrice_err' => ''
      ];

      // Validate categories
      if (empty($data['categories'])) {
        $data['title_err'] = 'Please enter categories';
      }
      // Validate reference
      if (empty($data['reference'])) {
        $data['title_err'] = 'Please enter reference';
      }
      // Validate description
      if (empty($data['description'])) {
        $data['title_err'] = 'Please enter description';
      }
      // Validate barCode
      if (empty($data['barCode'])) {
        $data['title_err'] = 'Please enter barCode';
      }
      // Validate photo
      if (empty($data['photo'])) {
        $data['title_err'] = 'Please enter photo';
      }
      // Validate purchasePrice
      if (empty($data['purchasePrice'])) {
        $data['title_err'] = 'Please enter purchasePrice';
      }
      // Validate finalPrice
      if (empty($data['finalPrice'])) {
        $data['title_err'] = 'Please enter finalPrice';
      }
      // Validate offerPrice
      if (empty($data['offerPrice'])) {
        $data['title_err'] = 'Please enter offerPrice';
      }

      // Make sure there are no errors
      if (
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
        // Load view with errors
        $this->view('products/add', $data);
      }
    } else {
      $categoriesTable = $this->categoryModel->getCategories();
      $data = [
        'categories' => $categoriesTable,
        'user_id_err' => '',
        'categories_err' => '',
        'reference_err' => '',
        'description_err' => '',
        'barCode_err' => '',
        'photo_err' => '',
        'purchasePrice_err' => '',
        'finalPrice_err' => '',
        'offerPrice_err' => ''
      ];
      $this->view('products/add', $data);
    }
  }

  // Edit Post
  public function edit($id)
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
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'id' => $id,
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'body_err' => ''
      ];

      // Validate email
      if (empty($data['title'])) {
        $data['title_err'] = 'Please enter name';
        // Validate name
        if (empty($data['body'])) {
          $data['body_err'] = 'Please enter the post body';
        }
      }

      // Make sure there are no errors
      if (empty($data['title_err']) && empty($data['body_err'])) {
        // Validation passed
        //Execute
        if ($this->postModel->updatePost($data)) {
          // Redirect to login
          flash('post_message', 'Post Updated');
          redirect('products');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('products/edit', $data);
      }
    } else {
      // Get post from model
      $post = $this->postModel->getPostById($id);

      // Check for owner
      if ($post->user_id != $_SESSION['user_id']) {
        redirect('posts');
      }

      $data = [
        'id' => $id,
        'title' => $post->title,
        'body' => $post->body,
      ];

      $this->view('posts/edit', $data);
    }
  }


  public function isAdmin()
  {
    // If logged in, redirect to posts
    if (isset($_SESSION['user_id'])) {
      if ($_SESSION['user_type'] === 'Admin') {
        return true;
      }
    }
    return false;
  }
}