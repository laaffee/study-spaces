<?php
require_once '../auth/check.php';
include "../config/config.php";

$list = trim($_POST['list'] ?? '');
$returnTo = isset($_POST['return_to']) ? $_POST['return_to'] : 'index.php#todolist';

if ($list !== '') {
    $safeList = mysqli_real_escape_string($con, $list);
    mysqli_query($con, "INSERT INTO todo (list) VALUES ('$safeList')");
}

header("Location: ../" . ltrim($returnTo, '/'));
exit;