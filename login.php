<?php

require_once './app/config/config.php';
require_once './app/classes/User.php';

$user = new User();

if ($user->is_logged_in()) {
  header('Location: ./index.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $successfully_logged_in = $user->login($username, $password);

  if ($successfully_logged_in) {
    $_SESSION['message']['type'] = "success";
    $_SESSION['message']['text'] = "Login successful";

    header('Location: ./index.php');
    exit();
  } else {
    $_SESSION['message']['type'] = "danger";
    $_SESSION['message']['text'] = "Wrong username or password";

    header('Location: ./login.php');
    exit();
  }
}
require_once "./inc/head.php";
?>

<div class="row justify-content-center">
  <div class="col-lg-5">
    <h1 class="text-center py-5">Login</h1>
    <form action="" method="POST">
      <div class="mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username" />
      </div>
      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" />
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p>Don't have an account?
      <a href="./register.php">Create one</a>
    </p>
  </div>
</div>


<?php require_once "./inc/footer.php"; ?>