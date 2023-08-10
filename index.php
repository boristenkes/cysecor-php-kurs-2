<?php

require_once "./app/config/config.php";
require_once "./app/classes/Product.php";

$products = new Product();
$products = $products->get_all();

require_once "./inc/head.php";
?>
<style>
  article {
    transition: scale 300ms ease;
  }

  article:hover {
    scale: 1.05;
  }
</style>


<div class="row d-grid gap-3">

  <?php foreach ($products as $product): ?>

    <article class="col-md-4 mb-4">
      <a style="text-decoration:none;color:inherit;" href="./product.php?id=<?= $product['product_id'] ?>" class="card">
        <img width="200" height="450" style="object-fit:cover" src="./public/product_images/<?= $product['image'] ?>"
          alt="<?= $product['name'] ?>" class="card-img-top">
        <div class="card-body d-flex justify-content-between">
          <h5 class="card-title">
            <?= $product['name'] ?>
          </h5>
          <div class="text-right">
            <p class="card-text">
              <?= $product['size'] ?>
            </p>
            <p class="card-text text-success font-weight-bold">
              <?= '$' . $product['price'] ?>
            </p>
          </div>
        </div>
      </a>
    </article>

  <?php endforeach; ?>

</div>

<?php require_once "./inc/footer.php"; ?>