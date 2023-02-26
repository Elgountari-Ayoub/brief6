<?php
class Order
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // _order table columns
  // 	id	idAdmin	idClient	reference	orderTotalPrice	creationDate	dispatchDate	deliveryDate	

  // Get All Orders
  public function getOrders()
  {
    $this->db->query("SELECT * FROM _order ");

    $results = $this->db->resultset();

    return $results;
  }

  // Get Order By ID
  public function getOrderById($id)
  {
    $this->db->query("SELECT * FROM _order WHERE id = :id");

    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }
  // Get Order By ID
  public function getActiveOrder($clientId)
  {
    $this->db->query("
    select * from _order o, client c where c.id = o.idClient and o.idClient = :id and STATUS = 'notValid'
    ");

    $this->db->bind(':id', $clientId);
    $results = $this->db->resultset();

    return $results;
  }

  // new Order
  public function newOrder($data)
  {
    // Prepare Query
    $this->db->query("INSERT INTO _order
        (idAdmin, 
        idClient, 
        reference, 
        status) 
        VALUES (
          :idAdmin ,
          :idClient ,
          :reference ,
          :orderTotalPrice ,
          :status)");
    // Bind Values
    $this->db->bind(':idAdmin',         $data['idAdmin']);
    $this->db->bind(':idClient',        $data['idClient']);
    $this->db->bind(':reference',       $data['reference']);
    $this->db->bind(':status',          'notValid');

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // Add Order => we call this methos when the last order was not valid
  public function addOrder($data)
  {
    // Prepare Query
    $this->db->query
      ("INSERT into orderproduct (idProd,	idOrder,	unitPrice,	quantity)
        VALUES (:idProd, :idOrder, :unitPrice, :quantity);
      ");
    // Bind Values
    $this->db->bind(':idProd',        $data['idProd']);
    $this->db->bind(':idOrder',       $data['idOrder']);
    $this->db->bind(':unitPrice',     $data['unitPrice']);
    $this->db->bind(':quantity',      $data['quantity']);
    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // CkeckOut

  // Update Order
  public function updateOrder($data)
  {
    // Prepare Query
    $this->db->query('UPDATE Orders SET title = :title, body = :body WHERE id = :id');

    // Bind Values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':title', $data['title']);
    $this->db->bind(':body', $data['body']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Delete Order
  public function deleteOrder($id)
  {
    // Prepare Query
    $this->db->query('DELETE FROM _order WHERE id = :id');

    // Bind Values
    $this->db->bind(':id', $id);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
