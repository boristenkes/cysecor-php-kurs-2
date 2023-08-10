<?php

require_once './app/config/config.php';
require_once './app/classes/User.php';
require_once './app/classes/Cart.php';
require_once './app/classes/Order.php';

$user = new User();

if (!$user->is_logged_in()) {
  header('Location: ./login.php');
  exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $delivery_adress = $_POST['country'] . ', ' . $_POST['city'] . ' - ' . $_POST['address'] . ' | ' . $_POST['zip'];

  $order = new Order();
  $order_created_successfully = $order->create($delivery_adress);

  if ($order_created_successfully) {
    $_SESSION['message']['type'] = 'success';
    $_SESSION['message']['text'] = 'Order received';
    header('Location: ./orders.php');
    exit();
  } else {
    $_SESSION['message']['type'] = 'danger';
    $_SESSION['message']['text'] = 'Failed to place order';
    header('Location: ./checkout.php');
    exit();
  }
}
require_once './inc/head.php';
?>

<form method="POST" action="">
  <div class="form-group mb-3">
    <label for="country">Country</label>
    <input type="text" class="form-control" id="country" name="country" required />
  </div>
  <div class="form-group mb-3">
    <label for="city">City</label>
    <input type="text" class="form-control" id="city" name="city" required />
  </div>
  <div class="form-group mb-3">
    <label for="zip">Zip</label>
    <input type="text" class="form-control" id="zip" name="zip" required />
  </div>
  <div class="form-group mb-3">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address" required />
  </div>
  <button type="submit" class="btn btn-primary">Place Order</button>
</form>

<?php require_once './inc/footer.php'; ?>