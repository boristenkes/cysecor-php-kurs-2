<?php

require_once './app/classes/User.php';

$user = new User();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>Shop</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container">
      <a class="navbar-brand" href="./index.php">Shop</a>
      <button type="button" class="navbar-toggler" data-togge="collapse" data-target="navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a href="./index.php" class="nav-link">Home</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">

          <?php if (!$user->is_logged_in()): ?>
            <li class="nav-item">
              <a href="./register.php" class="nav-link">Register</a>
            </li>
            <li class="nav-item">
              <a href="./login.php" class="nav-link">Login</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a href="./cart.php" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                  viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                  <path
                    d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                </svg>
              </a>
            </li>
            <li class="nav-item">
              <a href="./orders.php" class="nav-link">My Orders</a>
            </li>
            <li class="nav-item">
              <a href="./logout.php" class="nav-link">Logout</a>
            </li>
            <?php if ($user->is_admin()) { ?>
              <li class="nav-item">
                <a href="./admin" class="nav-link ml-3">Dashboard</a>
              </li>
            <?php } ?>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">

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