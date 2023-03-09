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
  public function getVisibleProducts($sort)
  {
    $this->db->query("SELECT p.*, c.name as 'categorey' FROM product p, category c where p.idCat = c.id and visibility = 1 ORDER BY p.finalPrice $sort");

    $results = $this->db->resultset();

    return $results;
  }

  public function getProductsByPage($page, $per_page)
  {
    // Calculate the offset for the SQL query
    $offset = ($page - 1) * $per_page;

    // Retrieve the products for the current page
    //SELECT * FROM products
    //ORDER BY p.finalPrice $sort
    $products = $this->db->query(" SELECT p.*, c.name as 'categorey' 
                                  FROM product p, category c
                                  where p.idCat = c.id and visibility = 1 
                                  LIMIT $per_page OFFSET $offset");
    $products = $this->db->resultset();

    // Retrieve the total number of products
    $total_products = $this->db->query("SELECT COUNT(*) as total_products FROM product p, category c
                                        where p.idCat = c.id");
    $total_products = $this->db->single();

    // Return the products and total number of products
    $result =  [
      'products' => $products,
      'total_products' => $total_products
    ];
    // echo "<pre>";
    // print_r($result);
    // echo "<pre>";
    // die("Product Model");

    return [
      'products' => $products,
      'total_products' => $total_products
    ];
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
  public function getCategoryNameByProductId($id)
  {
    $this->db->query("SELECT c.name FROM category c, product p WHERE c.id = p.idCat AND p.id = :id");

    $this->db->bind(':id', $id);

    $row = $this->db->single();
    return $row;
  }

  public function getProductsByCategoryId($id)
  {
    $this->db->query("SELECT p.* FROM product p, category c WHERE p.idCat = c.id and c.id = :id");

    $this->db->bind(':id', $id);

    $result = $this->db->resultset();
    return $result;
  }
  public function getVisibleProductsByCategoryId($id, $sort)
  {
    $this->db->query("SELECT p.* FROM product p, category c WHERE p.idCat = c.id and c.id = :id  and visibility = 1 ORDER BY p.finalPrice $sort");

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
