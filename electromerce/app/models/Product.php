<?php
class Product
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Get All Products
  public function getProducts()
  {
    $this->db->query("SELECT p.*, c.name as 'categorey' FROM product p, category c where p.idCat = c.id");

    $results = $this->db->resultset();

    return $results;
  }
  // Get Visible Products
  public function getVisibleProducts()
  {
    $this->db->query("SELECT p.*, c.name as 'categorey' FROM product p, category c where p.idCat = c.id and visibility = 1");

    $results = $this->db->resultset();

    return $results;
  }

  // Get Category By ID
  public function getProductById($id)
  {
    $this->db->query("SELECT p.*, c.name as 'categorey' FROM product p, category c where p.idCat = c.id and p.id = :id");

    $this->db->bind(':id', $id);

    $row = $this->db->single();
    return $row;
  }
  // Get Category Name By ID
  public function getCategoryNameByProductId($id) {
    $this->db->query("SELECT c.name FROM category c, product p WHERE c.id = p.idCat AND p.id = :id");

    $this->db->bind(':id', $id);

    $row = $this->db->single();
    return $row;
  }

  public function getProductsByCategoryId($id) {
    $this->db->query("SELECT p.* FROM product p, category c WHERE p.idCat = c.id and c.id = :id");

    $this->db->bind(':id', $id);

    $result = $this->db->resultset();
    return $result;
  }
  public function getVisibleProductsByCategoryId($id) {
    $this->db->query("SELECT p.* FROM product p, category c WHERE p.idCat = c.id and c.id = :id  and visibility = 1");

    $this->db->bind(':id', $id);

    $result = $this->db->resultset();
    return $result;
  }

  // Add Post
  public function addProduct($data)
  {
    // Prepare Query
    $this->db->query('INSERT INTO product (
      idAdmin,
      idCat ,
      title ,
      reference ,
      description ,
      barCode ,
      photo ,
      purchasePrice ,
      finalPrice ,
      offerPrice,
      visibility
    ) 
      VALUES (
      :idAdmin,
      :idCat ,
      :title ,
      :reference ,
      :description ,
      :barCode ,
      :photo ,
      :purchasePrice ,
      :finalPrice ,
      :offerPrice ,
      1
      )');

    // Bind Values
    $this->db->bind(':idAdmin', $data['user_id']);
    $this->db->bind(':title', $data['title']);
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
  // Update Product
  public function updateProduct($data)
  {

    // Prepare Query
    $this->db->query(
      'UPDATE product SET 
      idCat = :idCat ,
      title = :title ,
      reference = :reference ,
      description = :description ,
      barCode = :barCode ,
      photo = :photo,
      purchasePrice = :purchasePrice ,
      finalPrice = :finalPrice ,
      offerPrice = :offerPrice

      WHERE id = :id'
    );

    // Bind Values    
    // product id
    $this->db->bind(':id', $data['id']);

    $this->db->bind(':idCat', $data['idCat']);
    $this->db->bind(':title', $data['title']);
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

  // Delete Product
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
  public function hideProduct($id)
  {
    // Prepare Query
    $this->db->query('Update product set visibility = 0 WHERE id = :id');

    // Bind Values
    $this->db->bind(':id', $id);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function showProduct($id)
  {
    // Prepare Query
    $this->db->query('Update product set visibility = 1 WHERE id = :id');

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