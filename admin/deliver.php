<?php

require_once '../app/config/config.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Cart.php';
require_once '../app/classes/Order.php';

$order_id = $_GET['id'];

$order = new Order();
$user = new User();

if (!$user->is_logged_in() && !$user->is_admin()) {
  header('Location: ../login.php');
  exit();
}

$delivery_successful = $order->deliver($order_id);

if ($delivery_successful) {
  $_SESSION['message']['type'] = 'success';
  $_SESSION['message']['text'] = 'Delivery successful';
} else {
  $_SESSION['message']['type'] = 'danger';
  $_SESSION['message']['text'] = 'Delivery unsuccessful';
}

header('Location: ./orders.php');
exit();

?>