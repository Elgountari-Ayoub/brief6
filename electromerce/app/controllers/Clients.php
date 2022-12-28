<?php
class Clients extends Users
{
  public function __construct()
  {

    $this->clientModel = $this->model('Client');
  }

  public function index()
  {
    redirect('pages/index');
  }
  // public function register()
  // {
  //   // Check if logged in
  //   if ($this->isLoggedIn()) {
  //     redirect('posts');
  //   }

  //   // Check if POST
  //   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //     // Sanitize POST
  //     $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  //     $data = [
  //       'name' => trim($_POST['name']),
  //       'email' => trim($_POST['email']),
  //       'password' => trim($_POST['password']),
  //       'confirm_password' => trim($_POST['confirm_password']),
  //       'name_err' => '',
  //       'email_err' => '',
  //       'password_err' => '',
  //       'confirm_password_err' => ''
  //     ];

  //     // Validate email
  //     if (empty($data['email'])) {
  //       $data['email_err'] = 'Please enter an email';
  //       // Validate name
  //       if (empty($data['name'])) {
  //         $data['name_err'] = 'Please enter a name';
  //       }
  //     } else {
  //       // Check Email
  //       if ($this->userModel->findUserByEmail($data['email'])) {
  //         $data['email_err'] = 'Email is already taken.';
  //       }
  //     }

  //     // Validate password
  //     if (empty($data['password'])) {
  //       $password_err = 'Please enter a password.';
  //     } elseif (strlen($data['password']) < 6) {
  //       $data['password_err'] = 'Password must have atleast 6 characters.';
  //     }

  //     // Validate confirm password
  //     if (empty($data['confirm_password'])) {
  //       $data['confirm_password_err'] = 'Please confirm password.';
  //     } else {
  //       if ($data['password'] != $data['confirm_password']) {
  //         $data['confirm_password_err'] = 'Password do not match.';
  //       }
  //     }

  //     // Make sure errors are empty
  //     if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
  //       // SUCCESS - Proceed to insert

  //       // Hash Password
  //       $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

  //       //Execute
  //       if ($this->userModel->register($data)) {
  //         // Redirect to login
  //         flash('register_success', 'You are now registered and can log in');
  //         redirect('users/login');
  //       } else {
  //         die('Something went wrong');
  //       }
  //     } else {
  //       // Load View
  //       $this->view('users/register', $data);
  //     }
  //   } else {
  //     // IF NOT A POST REQUEST

  //     // Init data
  //     $data = [
  //       'name' => '',
  //       'email' => '',
  //       'password' => '',
  //       'confirm_password' => '',
  //       'name_err' => '',
  //       'email_err' => '',
  //       'password_err' => '',
  //       'confirm_password_err' => ''
  //     ];

  //     // Load View
  //     $this->view('users/register', $data);
  //   }
  // }

  public function register()
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
        'fullName' => trim($_POST['fullName']),
        'phoneNumber' => trim($_POST['phoneNumber']),
        'adress' => trim($_POST['adress']),
        'city' => trim($_POST['city']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email' => trim($_POST['email']),
        'confirm_password' => trim($_POST['passwordConfirmation']),

        'fullName_err' => '',
        'phoneNumber_err' => '',
        'adress_err' => '',
        'city_err' => '',
        'email_err' => '',
        'password_err' => '',
        'email_err' => ''
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
      }




      // Make sure errors are empty
      if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
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
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      // Load View
      $this->view('users/register', $data);
    }
  }
}