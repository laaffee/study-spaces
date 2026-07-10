<?php
// auth/check.php — reusable auth protection
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['username'])) {
  header('Location: auth/login.php');
  exit();
}

?>
