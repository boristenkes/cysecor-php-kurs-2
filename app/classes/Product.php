<?php

class Product
{
  protected $conn;

  public function __construct()
  {
    global $conn;
    $this->conn = $conn;
  }

  public function get($id)
  {
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    return $product;
  }

  public function get_all()
  {
    $sql = "SELECT * FROM products";
    $result = $this->conn->query($sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);

    return $products;
  }

  public function create($name, $price, $size, $image)
  {
    $stmt = $this->conn->prepare("INSERT INTO products (name, price, size, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('siss', $name, $price, $size, $image);
    $stmt->execute();
    $new_product_id = $this->conn->insert_id;

    return $new_product_id;
  }

  public function edit($product_id, $name, $price, $size, $image)
  {
    $basename = pathinfo($image, PATHINFO_BASENAME);
    $stmt = $this->conn->prepare("UPDATE products SET name = ?, price = ?, size = ?, image = ? WHERE product_id = ?");
    $stmt->bind_param('sissi', $name, $price, $size, $basename, $product_id);
    $stmt->execute();
    $product_id = $this->conn->insert_id;

    return $product_id;
  }

  public function delete($product_id)
  {
    $ds = DIRECTORY_SEPARATOR;
    $product = $this->get($product_id);
    $image = $product['image'];
    $image_path = implode(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'public', 'product_images', $image]);
    unlink($image_path);

    $stmt = $this->conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    $is_deleted = $stmt->execute();

    return $is_deleted;
  }
}

?>