<?php
class Client extends User
{
  public function __construct()
  {
    parent::__construct('Client');
  }

  // Add User / Register
  public function register($data)
  {

    // Prepare Query
    $this->db->query('INSERT INTO client (fullName,	phoneNumber,	adress,	city,	email,	password	) 
      VALUES  (:fullName,	:phoneNumber,	:adress,	:city,	:email,	:password)');

    // Bind Values
    $this->db->bind(':fullName', $data['fullName']);
    $this->db->bind(':phoneNumber', $data['phoneNumber']);
    $this->db->bind(':adress', $data['adress']);
    $this->db->bind(':city', $data['city']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getClients(){
    $this->db->query("SELECT * from client");
    $clients = $this->db->resultset();
    return $clients;
  }
  public function getClienyById($id){
    $this->db->query("SELECT * from client where id = :id");

    $this->db->bind(":id", $id);
    
    $row = $this->db->single();
    return $row;
  }
}