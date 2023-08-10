<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  <title>Admin Dashboard</title>
</head>

<body>

  <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
      <?php
      echo $_SESSION['message']['text'];
      unset($_SESSION['message']);
      ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <div class="container-fluid">
    <div class="row" style="min-height:100vh;background:whitesmoke">
      <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar shadow">
        <a href="../index.php"
          style="margin-block: 2rem 2rem;display:block;color:inherit;font-size:1.25rem;text-decoration:none">
          <span style="font-size:1.5rem">&#8592;</span> Back </a>
        <h1 style="font-size: 2rem" class="mb-5 text-center">Admin Dashboard</h1>
        <div class="position-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="./">
                <i class="fa-solid fa-users"></i> Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./products.php">
                <i class="fa-solid fa-bag-shopping"></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./orders.php">
                <i class="fa-solid fa-truck"></i> Orders
              </a>
            </li>
          </ul>
        </div>
      </nav>