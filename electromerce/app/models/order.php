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

  // Update order total price
  public function updateOrderTotalPrice($data)
  {
    // Prepare Query
    $this->db->query('UPDATE _order SET orderTotalPrice = :orderTotalPrice WHERE idClient = :idClient');

    // Bind Values
    $this->db->bind(':idClient', $data['idClient']);
    $this->db->bind(':orderTotalPrice', $data['orderTotalPrice']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
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
    select o.* from _order o, client c where c.id = o.idClient and o.idClient = :id and STATUS = 'notValid'
    ");

    $this->db->bind(':id', $clientId);
    $results = $this->db->resultset();

    return $results;
  }

  // new Order
  public function addOrder($data)
  {
    // Prepare Query
    $this->db->query("INSERT INTO _order
        (idAdmin, 
        idClient, 
        reference, 
        orderTotalPrice,
        status) 
        VALUES (
          :idAdmin ,
          :idClient ,
          :reference ,
          :orderTotalPrice,
          :status)");
    // Bind Values
    $this->db->bind(':idAdmin',           $data['idAdmin']);
    $this->db->bind(':idClient',          $data['idClient']);
    $this->db->bind(':reference',         $data['reference']);
    $this->db->bind(':orderTotalPrice',  $data['orderTotalPrice']);
    $this->db->bind(':status',            $data['status']);
    
    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // Add Order => we call this methos when the last order was not valid
  public function ShitOrder($data)
  {
    // Prepare Query
    $this->db->query("INSERT into orderproduct (idProd,	idOrder,	unitPrice,	quantity, prodTotalPrice)
        VALUES (:idProd, :idOrder, :unitPrice, :quantity, :prodTotalPrice);
      ");
    // Bind Values
    $this->db->bind(':idProd',        $data['idProd']);
    $this->db->bind(':idOrder',       $data['idOrder']);
    $this->db->bind(':unitPrice',     $data['unitPrice']);
    $this->db->bind(':quantity',      $data['quantity']);
    $this->db->bind(':prodTotalPrice', $data['prodTotalPrice']);

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
    $this->db->query('UPDATE _order SET 
                    orderTotalPrice =  :orderTotalPrice,	
                        creationDate = :creationDate,	
                        dispatchDate = :dispatchDate,	
                        deliveryDate = :deliveryDate,	
                        status = :status
                      WHERE id = :id');

    // Bind Values
    $this->db->bind(':orderTotalPrice', $data['orderTotalPrice']);
    $this->db->bind(':creationDate', $data['creationDate']);
    $this->db->bind(':dispatchDate', $data['dispatchDate']);
    $this->db->bind(':deliveryDate', $data['deliveryDate']);
    $this->db->bind(':status', $data['status']);
    $this->db->bind(':id', $data['id']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // Update Order
  public function addToOrderTotalPrice($data)
  {
    print_r($data);
    // Prepare Query
    $this->db->query('UPDATE _order SET 
                    orderTotalPrice =  orderTotalPrice + :prodTotalPrice
                      WHERE id = :id');

// Bind Values
$this->db->bind(':orderTotalPrice', $data['prodTotalPrice']);
$this->db->bind(':id', $data['idOrder']);

//Execute
if ($this->db->execute()) {
      die("updated gg");
      return true;
    } else {
      die("not updated");
      return false;
    }
    die("updated");
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
