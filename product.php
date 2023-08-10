<?php

require_once './app/config/config.php';
require_once './app/classes/Product.php';
require_once './app/classes/Cart.php';

$product = new Product();
$product = $product->get($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $quantity = $_POST['quantity'];

  $cart = new Cart();
  $cart->add($product['product_id'], $quantity);

  header('Location: ./cart.php');
  exit();
}

require_once './inc/head.php';
?>

<div class="row">
  <div class="col-lg-6">
    <img src="./public/product_images/<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>"
      class="img-fluid" />
  </div>
  <div class="col-lg-6">
    <h1>
      <?php echo $product['name'] ?>
    </h1>
    <p>Size:
      <?php echo $product['size'] ?>
    </p>
    <p>Price:
      <?php echo '$' . $product['price'] ?>
    </p>
    <form action="" method="POST">
      <input type="number" name="quantity" min="1" value="1" required />
      <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>
  </div>
</div>

<?php require_once './inc/footer.php'; ?>