<?php
class Categories extends Controller
{
  protected $categoryModel;
  protected $adminModel;
  public function __construct()
  {
    if (!$this->isAdmin()) {
      //Set Data
      $data = [];
      // Load products/index view
      $this->view('pages/index', $data);
      return;
    }
    // Don't delete this code before you read it./!\
    {

      // // If logged in, redirect to posts
      // if (isset($_SESSION['user_id'])) {
      //   if ($_SESSION['user_type'] === 'Admin') {
      //     //Set Data
      //     $data = [
      //       'title' => 'Welcome To ElectroMerce',
      //       'description' => 'Simple social network built on the TraversyMVC PHP framework'
      //     ];
      //     // Load homepage/index view
      //     $this->view('products/index', $data);
      //   }
      // }
    }
    //Set Data
    $data = [
      'title' => 'Welcome To ElectroMerce',
      'description' => 'Simple social network built on the TraversyMVC PHP framework'
    ];
    // Load homepage/index view
    // $this->view('categories/index', $data);
    // Load Models
    $this->categoryModel = $this->model('Category');
    $this->adminModel = $this->model('Admin');
  }

  // Load All Posts
  public function index()
  {
    $categories = $this->categoryModel->getCategories();
    $data = [
      'categories' => $categories
    ];

    $this->view('categories/index', $data);
  }

  // Show Single Post
  public function show($id)
  {
    $post = $this->categoryModel->getPostById($id);
    $user = $this->adminModel->getUserById($post->user_id);

    $data = [
      'post' => $post,
      'user' => $user
    ];

    $this->view('posts/show', $data);
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
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'user_id' => $_SESSION['user_id'],
        'name' => trim($_POST['name']),
        'description' => trim($_POST['description']),

        'user_id_err' => '',
        'name_err' => '',
        'description_err' => '',
      ];

      // Validate name
      if (empty($data['name'])) {
        $data['name_err'] = 'Please enter name';
      }
      // Validate description
      if (empty($data['description'])) {
        $data['description_err'] = 'Please enter description';
      }

      // Make sure there are no errors
      if (
        empty($data['name_err']) &&
        empty($data['description_err'])
      ) {
        //Execute
        if ($this->categoryModel->addCategory($data)) {
          // Redirect to login
          flash('cate_added', 'Category Added');
          redirect('categories/index');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('categories/add', $data);
      }
    } else {
      // Not Post
      $data = [
        'user_id_err' => '',
        'name_err' => '',
        'description_err' => '',
      ];
      $this->view('categories/add', $data);
    }
  }

  // Edit Post
  public function edit($id)
  {
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
        if ($this->categoryModel->updatePost($data)) {
          // Redirect to login
          flash('post_message', 'Post Updated');
          redirect('posts');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('posts/edit', $data);
      }
    } else {
      // Get post from model
      $post = $this->categoryModel->getPostById($id);

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

  // Delete Post
  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //Execute
      if ($this->categoryModel->deletePost($id)) {
        // Redirect to login
        flash('post_message', 'Post Removed');
        redirect('posts');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('products');
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