<?php
// migrate_todo.php
// Usage (CLI): php migrate_todo.php
// This script copies `todo` from database `todolist` into database `study`.

// Protect web access; allow CLI execution
if (php_sapi_name() !== 'cli') {
    require_once 'auth/check.php';
}

$host = 'localhost';
$user = 'root';
$pass = '';
$old_db = 'todolist';
$new_db = 'study';

$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "\n");
}

// Create target DB if missing
if (!mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `" . $new_db . "`")) {
    die("Failed to create database: " . mysqli_error($conn) . "\n");
}

// Create table structure in target DB based on source table
$create = "CREATE TABLE IF NOT EXISTS `" . $new_db . "`.todo LIKE `" . $old_db . "`.todo";
if (!mysqli_query($conn, $create)) {
    die("Failed to create table: " . mysqli_error($conn) . "\n");
}

// Copy data using INSERT IGNORE to avoid duplicate PK errors
$insert = "INSERT IGNORE INTO `" . $new_db . "`.todo SELECT * FROM `" . $old_db . "`.todo";
if (!mysqli_query($conn, $insert)) {
    die("Failed to insert data: " . mysqli_error($conn) . "\n");
}

echo "Migration completed. Rows affected: " . mysqli_affected_rows($conn) . "\n";

mysqli_close($conn);

?>
