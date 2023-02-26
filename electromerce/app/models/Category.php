<?php
class Category
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Get All  Categories
  public function getCategories()
  {
    $this->db->query("SELECT * FROM category");
    $results = $this->db->resultset();
    return $results;
  }

  // Get Post By ID
  public function getCategoryById($id)
  {
    $this->db->query("SELECT * FROM category WHERE id = :id");
    $this->db->bind(':id', $id);
    $row = $this->db->single();
    return $row;
  }
  // Get Post By ID
  public function getCategoryByProduct($id)
  {
    $this->db->query("SELECT * FROM category c, product p WHERE p.idCat = c.id");
    // $this->db->bind(':idCat', $id);
    // die('gg');
    $row = $this->db->single();
    return $row;
  }

  // Add Post
  public function addCategory($data)
  {
    // Prepare Query
    $this->db->query('INSERT INTO category (idAdmin, name, description) 
      VALUES (:idAdmin, :name, :description)');

    // Bind Values
    $this->db->bind(':idAdmin', $data['user_id']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':description', $data['description']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Update Post
  public function updateCategory($data)
  {
    // Prepare Query
    $this->db->query('UPDATE category SET
    idAdmin = :idAdmin,
    name = :name,
    description = :description
    WHERE id = :id');

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

  // Delete Post
  public function deleteCategory($id)
  {
    // Prepare Query
    $this->db->query('DELETE FROM posts WHERE id = :id');

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