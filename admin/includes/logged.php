<?php
session_start();

if(!isset($_SESSION['logged']) || ! ($_SESSION['logged'] === true)) {
  var_dump($_SESSION);
    header('Location: - login.php');
  die();
}
?>