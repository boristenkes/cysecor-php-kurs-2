<?php

require_once './app/config/config.php';
require_once './app/classes/User.php';

$user = new User();

if ($user->is_logged_in()) {
  header('Location: ./index.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $successfully_created = $user->create($name, $username, $email, $password);

  if ($successfully_created) {
    $_SESSION['message']['type'] = "success";
    $_SESSION['message']['text'] = "Account registered successfully";

    $user->login($username, $password);
    header('Location: ./index.php');
    exit();
  } else {
    $_SESSION['message']['type'] = "danger";
    $_SESSION['message']['text'] = "Failed to register account";

    header('Location: ./register.php');
    exit();
  }
}
require_once "./inc/head.php";
?>

<h1 class="mt-5 mb-3">Register</h1>

<form method="POST" action="">
  <div class="form-group mb-3">
    <label for="name">Full Name</label>
    <input type="text" class="form-control" id="name" name="name" required />
  </div>
  <div class="form-group mb-3">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" required />
  </div>
  <div class="form-group mb-3">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" required />
  </div>
  <div class="form-group mb-3">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" required />
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
  <p>Already have an account? <a href="./login.php">Log in</a></p>
</form>

<?php require_once "./inc/footer.php" ?>