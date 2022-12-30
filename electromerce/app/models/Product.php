<?php
class Product
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Get All Posts
  public function getProducts()
  {
    $this->db->query("SELECT * FROM product");

    $results = $this->db->resultset();

    return $results;
  }

  // Get Post By ID
  public function getProductById($id)
  {
    $this->db->query("SELECT * FROM product WHERE id = :id");

    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  // Add Post
  public function addProduct($data)
  {
    // Prepare Query
    $this->db->query('INSERT INTO product (
      idAdmin,
      idCat ,
      reference ,
      description ,
      barCode ,
      photo ,
      purchasePrice ,
      finalPrice ,
      offerPrice 
    ) 
      VALUES (
      :idAdmin,
      :idCat ,
      :reference ,
      :description ,
      :barCode ,
      :photo ,
      :purchasePrice ,
      :finalPrice ,
      :offerPrice 
      )');

    // Bind Values
    $this->db->bind(':idAdmin', $data['user_id']);
    $this->db->bind(':idCat', $data['idCat']);
    $this->db->bind(':reference', $data['reference']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':barCode', $data['barCode']);
    $this->db->bind(':photo', $data['photo']);
    $this->db->bind(':purchasePrice', $data['purchasePrice']);
    $this->db->bind(':finalPrice', $data['finalPrice']);
    $this->db->bind(':offerPrice', $data['offerPrice']);
    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // Update Post
  public function updateProduct($data)
  {
    // Prepare Query
    $this->db->query(
      'UPDATE product SET 
      idCat = :idCat ,
      reference = :reference ,
      description = :description ,
      barCode = :barCode ,
      photo = :photo ,
      purchasePrice = :purchasePrice ,
      finalPrice = :finalPrice ,
      offerPrice = :offerPrice

      WHERE id = :id'
    );

    // Bind Values
    // product id
    $this->db->bind(':id', $data['id']);

    $this->db->bind(':idCat', $data['idCat']);
    $this->db->bind(':reference', $data['reference']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':barCode', $data['barCode']);
    $this->db->bind(':photo', $data['photo ,']);
    $this->db->bind(':purchasePrice', $data['purchasePrice']);
    $this->db->bind(':finalPrice', $data['finalPrice']);
    $this->db->bind(':offerPrice', $data['offerPrice ']);
    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Delete Post
  public function deleteProduct($id)
  {
    // Prepare Query
    $this->db->query('DELETE FROM product WHERE id = :id');

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
