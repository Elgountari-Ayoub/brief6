<?php

// Users controller
class Users extends Controller
{
  private $adminModel;
  private $clientModel;
  public function __construct()
  {
    $this->adminModel = $this->model('Admin');
    $this->clientModel = $this->model('Client');
  }

  public function index()
  {
    redirect('pages/index');
  }

  public function register()
  {
    // // Check if logged in
    // if ($this->isLoggedIn()) {
    //   redirect('pages/index');
    // }

    // Check if POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'fullName' => trim($_POST['fullName']),
        'phoneNumber' => trim($_POST['phoneNumber']),
        'adress' => trim($_POST['adress']),
        'city' => trim($_POST['city']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['passwordConfirmation']),

        'fullName_err' => '',
        'phoneNumber_err' => '',
        'adress_err' => '',
        'city_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];
      // Validate fullName
      if (empty($data['fullName'])) {
        $data['fullName_err'] = 'Please enter a full name';
      }
      // Validate phoneNumber
      if (empty($data['phoneNumber'])) {
        $data['phoneNumber_err'] = 'Please enter a phone number';
      }
      // Validate adress
      if (empty($data['adress'])) {
        $data['adress_err'] = 'Please enter a adress';
      }
      // Validate city
      if (empty($data['city'])) {
        $data['city_err'] = 'Please enter a city';
      }
      // Validate password
      if (empty($data['password'])) {
        $password_err = 'Please enter a password.';
      } elseif (strlen($data['password']) < 6) {
        $data['password_err'] = 'Password must have atleast 6 characters.';
      }
      // Validate confirm password
      if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Please confirm password.';
      } else {
        if ($data['password'] != $data['confirm_password']) {
          $data['confirm_password_err'] = 'Password do not match.';
        }
      }

      // Validate email
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter an email';
      } else {
        // Check Email
        if ($this->clientModel->findUserByEmail($data['email'])) {
          $data['email_err'] = 'Email is already taken.';
        }
        if ($this->adminModel->findUserByEmail($data['email'])) {
          $data['email_err'] = 'Email is already taken.';
        }
      }

      // echo ($data['password_err']);
      // die($data['confirm_password_err']);
      // Make sure errors are empty
      if (
        empty($data['fullName_err']) &&
        empty($data['phoneNumber_err']) &&
        empty($data['adress_err']) &&
        empty($data['city_err']) &&
        empty($data['email_err']) &&
        empty($data['password_err']) &&
        empty($data['confirm_password_err'])
      ) {
        // SUCCESS - Proceed to insert

        // Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        //Execute
        if ($this->clientModel->register($data)) {
          // Redirect to login
          flash('register_success', 'You are now registered and can log in');
          redirect('users/login');
        } else {

          die('Something went wrong');
        }
      } else {
        // Load View
        $this->view('users/register', $data);
      }
    } else {
      // IF NOT A POST REQUEST

      // Init data
      $data = [
        'fullName' => '',
        'phoneNumber' => '',
        'adress' => '',
        'city' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',

        'fullName_err' => '',
        'phoneNumber_err' => '',
        'adress_err' => '',
        'city_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      // Load View
      $this->view('users/register', $data);
    }
  }

  public function login()
  {
    // Check if logged in

    if ($this->isLoggedIn()) {
      redirect('pages/index');
    }

    // Check if POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize POST
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',
      ];

      // Check for email
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email.';
      }


      // Check for user
      if ($this->adminModel->findUserByEmail($data['email'])) {
        // Admin Found
        // Make sure errors are empty
        if (empty($data['email_err']) && empty($data['password_err'])) {
          // Check and set logged in user
          $loggedInAdmin = $this->adminModel->login($data['email'], $data['password']);
          $userType = $this->adminModel->getUserType();
          if ($loggedInAdmin) {
            // User Authenticated!
            $this->createUserSession($loggedInAdmin, $userType);
          } else {
            $data['password_err'] = 'Password incorrect.';
            // Load View
            $this->view('users/login', $data);
          }
        } else {
          // Load View
          $this->view('users/login', $data);
        }
      } elseif ($this->clientModel->findUserByEmail($data['email'])) {
        // Client Found
        // Make sure errors are empty
        if (empty($data['email_err']) && empty($data['password_err'])) {
          // Check and set logged in user
          $loggedInClient = $this->clientModel->login($data['email'], $data['password']);
          $userType = $this->clientModel->getUserType();
          if ($loggedInClient) {
            // User Authenticated!
            $this->createUserSession($loggedInClient, $userType);
          } else {
            $data['password_err'] = 'Password incorrect.';
            // Load View
            $this->view('users/login', $data);
          }
        } else {
          // Load View
          $this->view('users/login', $data);
        }
      } else {
        // No User
        die("not registered");
        $data['email_err'] = 'This email is not registered.';
      }
    } else {
      // If NOT a POST

      // Init data
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',
      ];

      // Load View
      $this->view('users/login', $data);
    }
  }

  // Create Session With User Info
  public function createUserSession($user, $userType)
  {
    // echo "<pre>";
    // var_dump($user);
    // echo "<pre>";
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_type'] = $userType;
    if ($userType === 'Client') {

      redirect('pages/products');
    }
    redirect('products/index');
  }

  // Logout & Destroy Session
  public function logout()
  {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_type']);
    session_destroy();
    redirect('users/login');
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
}