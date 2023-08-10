<?php

class Cart
{
  protected $conn;

  public function __construct()
  {
    global $conn;
    $this->conn = $conn;
  }

  public function add($product_id, $quantity)
  {
    $sql = "INSERT INTO cart (product_id, user_id, quantity) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('iii', $product_id, $_SESSION['user_id'], $quantity);
    $stmt->execute();
  }

  public function get()
  {
    $sql = "SELECT p.product_id, p.name, p.price, p.size, p.image, c.quantity, c.cart_id
            FROM cart c
            INNER JOIN products p
            ON c.product_id = p.product_id
            WHERE c.user_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart_items = $result->fetch_all(MYSQLI_ASSOC);

    return $cart_items;
  }

  public function empty()
  {
    $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
  }

  public function remove($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM cart WHERE cart_id = ?");
    $stmt->bind_param('i', $id);
    return $stmt->execute();
  }
}

?>