<?php
require_once '../auth/check.php';
include "../config/config.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$returnTo = isset($_GET['return_to']) ? $_GET['return_to'] : 'index.php#todolist';

if ($id > 0) {
    mysqli_query($con, "DELETE FROM todo WHERE id=$id");
}

header("Location: ../" . ltrim($returnTo, '/'));
exit;