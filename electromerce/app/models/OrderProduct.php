<?php
class OrderProduct
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // _order table columns
  // 	id	idAdmin	idClient	reference	orderTotalPrice	creationDate	dispatchDate	deliveryDate	

  // Get All OrderProduct data
  public function getOrderProduct()
  {
    $this->db->query("SELECT * FROM orderproduct ");

    $results = $this->db->resultset();

    return $results;
  }

  // Get Order By Order, Product ID
  public function getOrderProductByIds($orderId, $productId)
  {
    $this->db->query("SELECT * FROM orderproduct WHERE idProd = :idProd and idOrder = :idOrder");

    $this->db->bind(':idProd', $productId);
    $this->db->bind(':idOrder', $orderId);

    $row = $this->db->single();

    return $row;
  }

  public function getOrderProductByOrderId($orderId)
  {
    $this->db->query("SELECT * from orderproduct WHERE idOrder = :orderId");
    $this->db->bind(":orderId", $orderId);

    $results = $this->db->resultset();

    return $results;
  }

  // Add Order => we call this methos when the last order was not valid
  public function addOrderProduct($data)
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

  // Update OrderProduct
  public function updateOrderProduct($data)
  {
    // Prepare Query
    $this->db->query('UPDATE orderproduct SET quantity =  quantity + :quantity , prodTotalPrice = :prodTotalPrice WHERE idOrder = :idOrder and idProd = :idProd');

    // Bind Values
    $this->db->bind(':idOrder', $data['idOrder']);
    $this->db->bind(':idProd', $data['idProd']);
    $this->db->bind(':quantity', $data['quantity']);
    $this->db->bind(':prodTotalPrice', $data['prodTotalPrice']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function editOrderProduct($data)
  {
    // Prepare Query
    $this->db->query('UPDATE orderproduct SET quantity =  :quantity , prodTotalPrice = :prodTotalPrice WHERE idOrder = :idOrder and idProd = :idProd');

    // Bind Values
    $this->db->bind(':idOrder', $data['idOrder']);
    $this->db->bind(':idProd', $data['idProd']);
    $this->db->bind(':quantity', $data['quantity']);
    $this->db->bind(':prodTotalPrice', $data['prodTotalPrice']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Delete Order
  public function deleteOrderProduct($data)
  {
    // Prepare Query
    $this->db->query('DELETE FROM orderproduct WHERE idProd = :idProd and idOrder = :idOrder');

    // Bind Values
    $this->db->bind(':idOrder', $data['orderId']);
    $this->db->bind(':idProd', $data['prodId']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
