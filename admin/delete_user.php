<?php

require_once '../app/config/config.php';
require_once '../app/classes/User.php';

$user_id = $_GET['id'];

$user = new User();

if (!$user->is_logged_in() && !$user->is_admin()) {
  header('Location: ../login.php');
  exit();
}

$user_deleted_successfully = $user->delete($user_id);

if ($user_deleted_successfully) {
  $_SESSION['message']['type'] = 'success';
  $_SESSION['message']['text'] = 'User deleted successfully';
} else {
  $_SESSION['message']['type'] = 'danger';
  $_SESSION['message']['text'] = 'Failed to delete user';
}

header('Location: ./index.php');
exit();

?>