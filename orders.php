<?php
require_once './app/config/config.php';
require_once './app/classes/Cart.php';
require_once './app/classes/Order.php';
require_once './app/classes/User.php';

$user = new User();

if (!$user->is_logged_in()) {
  header('Location: ./login.php');
  exit();
}

$orders = new Order();
$orders = $orders->get_all();
require_once './inc/head.php';
?>

<table class="table table-striped">
  <thead>
    <tr>
      <td scope="col">Product Name</td>
      <td scope="col">Quantity</td>
      <td scope="col">Price</td>
      <td scope="col">Size</td>
      <td scope="col">Image</td>
      <td scope="col">Delivery Address</td>
      <td scope="col">Order Date</td>
      <td scope="col">Actions</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $order): ?>
      <tr>

        <td>
          <?= $order['name'] ?>
        </td>
        <td>
          <?= $order['quantity'] ?>
        </td>
        <td>
          <?= $order['price'] ?>
        </td>
        <td>
          <?= $order['size'] ?>
        </td>
        <td>
          <img src="./public/product_images/<?= $order['image'] ?>" alt="<?= $order['name'] ?>" width="50" />
        </td>
        <td>
          <?= $order['delivery_address'] ?>
        </td>
        <td>
          <?= date("F, jS Y", strtotime($order['created_at'])) ?>
        </td>
        <td>
          <a href="./cancel-order.php?id=<?= $order['order_items_id'] ?>">Cancel</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if (!count($orders)): ?>
  <p style='text-align:center;margin-block:2rem;'>You have no orders</p>
<?php endif; ?>

<?php require_once './inc/footer.php' ?>