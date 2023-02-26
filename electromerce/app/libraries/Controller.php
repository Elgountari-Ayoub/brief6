<?php
/* 
   *  CORE CONTROLLER CLASS
   *  Loads Models & Views
   */
class Controller
{
  // Lets us load model from controllers
  public function model($model)
  {
    // Require model file
    require_once '../app/models/' . $model . '.php';
    // Instantiate model
    return new $model();
  }

  // Lets us load view from controllers
  public function view($url, $data = [])
  {
    // Check for view file
    if (file_exists('../app/views/' . $url . '.php')) {
      // Require view file
      require_once '../app/views/' . $url . '.php';
    } else {
      // No view exists
      die('View does not exist');
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

    // Check Logged In
    public function isLoggedIn()
    {
      if (isset($_SESSION['user_id'])) {
        return true;
      } else {
        return false;
      }
    }
    public function isClient()
    {
      if (isset($_SESSION['user_id'])) {
        if ($_SESSION['user_type'] === 'Client') {
          return true;
        }
      }
      return false;
    }
}
