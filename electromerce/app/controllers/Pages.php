<?php
class Pages extends Controller
{
  public function __construct()
  {
  }

  // Load Homepage
  public function index()
  {
    // If logged in, redirect to posts
    // if (isset($_SESSION['user_id'])) {
    //   redirect('posts');
    // }

    //Set Data
    $data = [
      'title' => 'Welcome To ElectroMerce',
      'description' => 'Simple social network built on the TraversyMVC PHP framework'
    ];

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
  public function products()
  {
    //Set Data
    $data = [
      'version' => '1.0.0'
    ];

    // Load about view
    $this->view('pages/products', $data);
  }
}