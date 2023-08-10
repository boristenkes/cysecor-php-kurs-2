<?php

require_once './app/config/config.php';
require_once './app/classes/User.php';
require_once './app/classes/Cart.php';

$user = new User();

if (!$user->is_logged_in()) {
  header('Location: ./index.php');
  exit();
}

$cart = new Cart();
$item_removed = $cart->remove($_GET['id']);

if ($item_removed) {
  $_SESSION['message']['type'] = 'success';
  $_SESSION['message']['text'] = 'Item removed successfully';
} else {
  $_SESSION['message']['type'] = 'danger';
  $_SESSION['message']['text'] = 'Failed to remove item';
}

header('Location: ./cart.php');
exit();

?>