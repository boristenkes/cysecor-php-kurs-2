<?php

require_once './app/config/config.php';
require_once './app/classes/Cart.php';
require_once './app/classes/User.php';

$user = new User();

if (!$user->is_logged_in()) {
  header('Location: ./login.php');
  exit();
}

$cart = new Cart();
$cart_items = $cart->get();

require_once './inc/head.php';
?>

<table class="table tablet-striped">
  <thead>
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Size</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cart_items as $item): ?>
      <tr>
        <td>
          <?= $item['name'] ?>
        </td>
        <td>
          <?= $item['size'] ?>
        </td>
        <td>
          <?= '$' . $item['price'] ?>
        </td>
        <td>
          <?= $item['quantity'] ?>
        </td>
        <td><img src="./public/product_images/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" width="50" /></td>
        <td>
          <a href="./remove_from_cart.php?id=<?= $item['cart_id'] ?>" class="text-danger">Remove</a>
        </td>
      </tr>

    <?php endforeach; ?>
  </tbody>
</table>
<?php if (!count($cart_items)): ?>
  <p style='text-align:center;margin-block:2rem;'>Your cart is empty</p>
<?php else: ?>
  <a href="./checkout.php" class="btn btn-success d-block ml-auto" style="width:fit-content">Proceed to Checkout
    &#8594;</a>
  <?php
endif;
require_once './inc/footer.php'
  ?>