<?php

// User Model
class User
{
  protected $db;
  protected $user;

  public function __construct($user)
  {
    $this->db = new Database;
    $this->user = $user;
  }

  public function getUserType()
  {
    return $this->user;
  }

  public function index()
  {
    redirect('pages/index');
  }
  // Find USer BY Email
  public function findUserByEmail($email)
  {
    $user = $this->user;
    $this->db->query("SELECT * FROM $user WHERE email = :email");
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    //Check Rows
    if ($this->db->rowCount() > 0) {
      // echo $user;
      return true;
    } else {
      return false;
    }
  }

  // Login / Authenticate User
  public function login($email, $password)
  {
    $user = $this->user;
    $this->db->query("SELECT * FROM $user WHERE email = :email");
    $this->db->bind(':email', $email);

    $row = $this->db->single();



    $hashed_password = $row->password;
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }

  // Find User By ID
  public function getUserById($id)
  {
    $user = $this->user;
    $this->db->query("SELECT * FROM $user WHERE id = :id");
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }
}