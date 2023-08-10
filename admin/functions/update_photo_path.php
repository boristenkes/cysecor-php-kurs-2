<?php

require_once './../app/config/config.php';

function update_photo_path($old_path, $product_id)
{
  global $conn;
  $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
  $ds = DIRECTORY_SEPARATOR;

  // var_dump(__DIR__);
  // die();

  $basename = pathinfo($old_path, PATHINFO_BASENAME);
  // var_dump($basename);
  // die();
  $ext = pathinfo($old_path, PATHINFO_EXTENSION);

  if (!in_array($ext, $allowed_ext)) {
    echo "Only jpg, jpeg, png and webp files allowed.";
    die();
  }

  $new_name = $product_id . ".$ext";

  $query = "UPDATE products SET image = ? WHERE product_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('si', $new_name, $product_id);
  $stmt->execute();

  $old = implode(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'public', 'product_images', $basename]);
  $new = implode(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'public', 'product_images', $new_name]);

  if (file_exists($old)) {
    rename($old, $new);
  } else {
    echo "Failed to rename image.";
    var_dump($old);
    var_dump($new);
    die();
  }
}

?>