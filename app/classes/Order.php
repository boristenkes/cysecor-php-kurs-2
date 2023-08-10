<?php

class Order extends Cart
{
  protected $conn;

  public function __construct()
  {
    global $conn;
    $this->conn = $conn;
  }

  public function create($delivery_adress)
  {

    $stmt = $this->conn->prepare("INSERT INTO orders (user_id, delivery_address) VALUES (?, ?)");
    $stmt->bind_param('is', $_SESSION['user_id'], $delivery_adress);
    $stmt->execute();

    $order_id = $this->conn->insert_id;
    $cart_items = $this->get();

    $stmt = $this->conn->prepare("INSERT INTO orderitems (order_id, product_id, quantity) VALUES (?, ?, ?)");

    foreach ($cart_items as $item) {
      $stmt->bind_param('iii', $order_id, $item['product_id'], $item['quantity']);

      if (!$stmt->execute()) {
        return false;
      }
    }

    $cart = $this;
    $cart->empty();

    return true;
  }

  public function deliver($order_id)
  {
    $stmt = $this->conn->prepare("
      DELETE orders, orderItems
      FROM orders
      JOIN orderitems ON orders.order_id = orderitems.order_id
      WHERE orders.order_id = ?;
    ");
    $stmt->bind_param('i', $order_id);
    return $stmt->execute();
  }

  public function cancel($order_id)
  {
    $stmt = $this->conn->prepare("DELETE FROM Orderitems WHERE order_items_id = ?");
    $stmt->bind_param('i', $order_id);
    return $stmt->execute();
  }

  public function get_all()
  {
    $sql = "
      SELECT
        orders.order_id,
        orders.delivery_address,
        orders.created_at,
        orderitems.quantity,
        orderitems.order_items_id AS order_items_id,
        products.name,
        products.size,
        products.image,
        products.price
      FROM orders
      INNER JOIN orderitems ON orders.order_id = orderitems.order_id
      INNER JOIN Products ON orderitems.product_id = Products.product_id
      WHERE orders.user_id = ?
      ORDER BY orders.created_at DESC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();

    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);

    return $orders;
  }

  public function get_orders_for_admin()
  {
    $sql = "
      SELECT
        orders.order_id,
        orders.user_id,
        orders.delivery_address,
        orders.created_at,
        orderitems.order_items_id,
        orderitems.product_id,
        orderitems.quantity,
        products.name AS product_name,
        products.size AS product_size,
        products.image AS product_image,
        products.price AS product_price
      FROM orders
      INNER JOIN orderitems ON orders.order_id = orderitems.order_id
      INNER JOIN products ON orderitems.product_id = products.product_id
      ORDER BY orders.created_at ASC;
    ";

    $result = $this->conn->query($sql);

    if (!$result) {
      return false;
    }

    $adminOrders = array();

    while ($row = $result->fetch_assoc()) {
      $order_id = $row['order_id'];

      if (!isset($adminOrders[$order_id])) {
        $adminOrders[$order_id] = array(
          'order_id' => $order_id,
          'user_id' => $row['user_id'],
          'delivery_address' => $row['delivery_address'],
          'created_at' => $row['created_at'],
          'order_items' => array()
        );
      }

      $adminOrders[$order_id]['order_items'][] = array(
        'order_items_id' => $row['order_items_id'],
        'product_id' => $row['product_id'],
        'quantity' => $row['quantity'],
        'product_name' => $row['product_name'],
        'product_size' => $row['product_size'],
        'product_image' => $row['product_image'],
        'product_price' => $row['product_price']
      );
    }

    return array_values($adminOrders);
  }
}

?>