<?php

require_once '../app/config/config.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Cart.php';
require_once '../app/classes/Order.php';

$user = new User();
if (!$user->is_logged_in() && !$user->is_admin()) {
  header('Location: ../login.php');
  exit();
}

$order = new Order();
$orders = $order->get_orders_for_admin();

require_once './inc/head.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <h2 class="mt-5 mb-3 font-weight-bold">Orders</h2>

  <?php foreach ($orders as $order): ?>
    <?php $customer = $user->get($order['user_id']); ?>
    <div style="padding-bottom:2rem;margin-bottom:3rem">
      <div style="display:flex;justify-content:space-between;align-items:center">
        <h3>
          <?= $order['order_id'] ?> &nbsp;|&nbsp; <span>(
            <?= $customer['user_id'] ?>:
            <?= $customer['name'] ?>) &nbsp;-&nbsp;
            <?= $order['delivery_address'] ?>
            <small>
              <date>
                &nbsp;
                <?= date("F jS, Y", strtotime($order['created_at'])) ?>
              </date>
            </small>
          </span>
        </h3>
        <a class="btn btn-success" href="./deliver.php?id=<?= $order['order_id'] ?>">Deliver</a>
      </div>
      <table class="table table-striped shadow">
        <thead class="font-weight-bold">
          <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Name</th>
            <th scope="col">Size</th>
            <th scope="col">Image</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($order['order_items'] as $item): ?>
            <tr>
              <td>
                <?= $item['product_id'] ?>
              </td>
              <td>
                <?= $item['product_name'] ?>
              </td>
              <td>
                <?= $item['product_size'] ?>
              </td>
              <td>
                <img src="../public/product_images/<?= $item['product_image'] ?>" alt="<?= $item['product_name'] ?>"
                  width="50" height="50" style="object-fit:contain" />
              </td>
              <td>
                <?= $item['quantity'] ?>
              </td>
              <td>
                <?= $item['product_price'] ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endforeach; ?>

  <?php if (!count($orders)): ?>
    <p style="text-align:center;margin-block:2rem;">No pending orders</p>
  <?php endif; ?>
</main>

<?php require_once './inc/footer.php'; ?>