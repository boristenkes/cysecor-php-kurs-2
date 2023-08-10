<?php

require_once '../app/config/config.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Product.php';
require_once './functions/update_photo_path.php';

$user = new User();
$product_obj = new Product();
$product = $product_obj->get($_GET['id']);

if (!$user->is_logged_in() && !$user->is_admin()) {
  header('Location: ../login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $size = $_POST['size'];
  $image = $_POST['photo_path'];

  $new_product_id = $product_obj->edit($product['product_id'], $name, $price, $size, $image);

  update_photo_path($image, $product['product_id']);
  $_SESSION['message']['type'] = 'success';
  $_SESSION['message']['text'] = 'Product edited successfully';

  header('Location: ./products.php');
  exit();
}
require_once './inc/head.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <h1 class="text-center py-5">Edit Product</h1>
      <form action="" method="POST">

        <div class="form-group mb-3">
          <label for="name">Product Name</label>
          <input class="form-control" type="text" name="name" value="<?php echo $product['name'] ?>"
            placeholder="Black T-Shirt" />
        </div>

        <div class="form-group mb-3">
          <label for="price">Price ($)</label>
          <input class="form-control" type="number" name="price" value="<?php echo $product['price'] ?>"
            placeholder="29" />
        </div>

        <div class="form-group mb-3">
          <label for="size">Size</label>
          <input class="form-control" type="text" name="size" value="<?php echo $product['size'] ?>" placeholder="XL" />
        </div>

        <input type="hidden" name="photo_path" id="photoPathInput"
          value="../public/product_images/<?php echo $product['image'] ?>" />
        <div id="dropzone-upload" class="dropzone"></div>
        <input type="submit" class="btn btn-success ml-auto mt-3 d-block" value="Edit Product" />
      </form>
    </div>
  </div>
</main>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
  Dropzone.options.dropzoneUpload = {
    url: './upload_photo.php',
    paramName: 'photo',
    maxFilesize: 20, // MB
    acceptedFiles: 'image/*',
    init: function () {
      this.on('success', (file, response) => {
        console.log(response);
        const jsonResponse = JSON.parse(response);
        if (jsonResponse.success)
          document.getElementById('photoPathInput').value = jsonResponse.photo_path;
        else
          console.error(jsonResponse.error);
      });
    }
  };
</script>
<script src="https://kit.fontawesome.com/bfaacd69a6.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</body>

</html>