<?php

require_once '../app/config/config.php';
require_once './../app/classes/User.php';

$user = new User();

if (!$user->is_logged_in() && !$user->is_admin()) {
  header('Location: ../login.php');
  exit();
}

$users = $user->get_all();

require_once './inc/head.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <h2 class="mt-5 mb-3 font-weight-bold">Users</h2>
  <table class="table table-striped shadow">
    <thead class="font-weight-bold">
      <tr>
        <td scope="col">ID</td>
        <td scope="col">Name</td>
        <td scope="col">Username</td>
        <td scope="col">Email</td>
        <td scope="col">Created At</td>
        <td scope="col">Actions</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <th scope="row">
            <?= $user['user_id'] ?>
          </th>
          <td>
            <?= $user['name'] ?>
          </td>
          <td>
            <?= $user['username'] ?>
          </td>
          <td>
            <?= $user['email'] ?>
          </td>
          <td>
            <?= date("F, jS Y", strtotime($user['created_at'])) ?>
          </td>
          <td>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a class="text-danger" href="./delete_user.php?id=<?= $user['user_id'] ?>">
              <i class="fa-solid fa-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php if (!count($users))
    echo "<p style='text-align:center;margin-block:2rem;'>No users to display</p>"
      ?>
  </main>

  <?php
  require_once './inc/footer.php';
  ?>