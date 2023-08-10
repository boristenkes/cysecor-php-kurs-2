<?php

require_once '../app/config/config.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Product.php';

$user = new User();
if (!$user->is_logged_in() && !$user->is_admin()) {
  header('Location: ../login.php');
  exit();
}

$products = new Product();
$products = $products->get_all();

require_once './inc/head.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <h2 class="mt-5 mb-3 font-weight-bold">Products</h2>
  <table class="table table-striped shadow">
    <thead class="font-weight-bold">
      <tr>
        <td scope="col">Product ID</td>
        <td scope="col">Name</td>
        <td scope="col">Price</td>
        <td scope="col">Size</td>
        <td scope="col">Image</td>
        <td scope="col">Created At</td>
        <td scope="col">Actions</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product): ?>
        <tr>
          <th scope="row">
            <?= $product['product_id'] ?>
          </th>
          <td>
            <?= $product['name'] ?>
          </td>
          <td>
            <?= '$' . $product['price'] ?>
          </td>
          <td>
            <?= $product['size'] ?>
          </td>
          <td><img src="../public/product_images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="50" />
          </td>
          <td>
            <?= date("F, jS Y", strtotime($product['created_at'])) ?>
          </td>
          <td>
            <a class="text-info" href="./edit_product.php?id=<?= $product['product_id'] ?>">
              <i class="fa-solid fa-pen-to-square"></i>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a class="text-danger" href="./delete_product.php?id=<?= $product['product_id'] ?>">
              <i class="fa-solid fa-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php if (!count($products))
    echo "<p style='text-align:center;margin-block:2rem;'>No products to display</p>" ?>
    <a href="./add_product.php" class="btn btn-primary ml-auto d-block">
      Add Product
    </a>
  </main>

<?php require_once './inc/footer.php';