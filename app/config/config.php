<?php

session_start();

$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "shop";

$conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

if (!$conn) {
  die("Neuspesna konekcija");
}
?>