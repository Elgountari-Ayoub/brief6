<?php
class Products extends Controller
{
  public function __construct()
  {
  }

  // Load Homepage
  public function index()
  {
    // If logged in, redirect to posts
    if (isset($_SESSION['user_id'])) {
      if ($_SESSION['user_type'] === 'Client') {
        //Set Data
        $data = [
          'title' => 'Welcome To ElectroMerce',
          'description' => 'Simple social network built on the TraversyMVC PHP framework'
        ];
        // Load homepage/index view
        $this->view('products/index', $data);

        // redirect('pages/index');
      } else {
        //Set Data
        $data = [
          'title' => 'Welcome To ElectroMerce',
          'description' => 'Simple social network built on the TraversyMVC PHP framework'
        ];

        // Load homepage/index view
        $this->view('products/index', $data);
        // redirect('products/index');
      }
    }
  }
}