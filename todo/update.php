<?php
require_once '../auth/check.php';
include "../config/config.php";

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$list = trim($_POST['list'] ?? '');
$returnTo = isset($_POST['return_to']) ? $_POST['return_to'] : 'index.php#todolist';

if ($id > 0 && $list !== '') {
    $safeList = mysqli_real_escape_string($con, $list);
    mysqli_query($con, "UPDATE todo SET list='$safeList' WHERE id='$id'");
}

header("Location: ../" . ltrim($returnTo, '/'));
exit;