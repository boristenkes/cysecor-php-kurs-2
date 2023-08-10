<?php

require_once '../app/config/config.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Product.php';

$user = new User();

if (!$user->is_logged_in() && !$user->is_admin()) {
  header('Location: ../login.php');
  exit();
}

$product = new Product();
$product_deleted_successfully = $product->delete($_GET['id']);

if ($product_deleted_successfully) {
  $_SESSION['message']['type'] = 'success';
  $_SESSION['message']['text'] = 'Product deleted successfully';
} else {
  $_SESSION['message']['type'] = 'danger';
  $_SESSION['message']['text'] = 'Failed to delete product';
}

header('Location: ./products.php');
exit();

?>