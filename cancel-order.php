<?php

require_once './app/config/config.php';
require_once './app/classes/User.php';
require_once './app/classes/Cart.php';
require_once './app/classes/Order.php';

$user = new User();

if (!$user->is_logged_in()) {
  header('Location: ./index.php');
  exit();
}

$order = new Order();
$order_id = $_GET['id'];

$successfully_canceled = $order->cancel($order_id);

if ($successfully_canceled) {
  $_SESSION['message']['type'] = 'success';
  $_SESSION['message']['text'] = 'Order successfully canceled';
} else {
  $_SESSION['message']['type'] = 'danger';
  $_SESSION['message']['text'] = 'Failed to cancel the order';
}

header('Location: ./orders.php');
exit();

?>