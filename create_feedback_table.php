<?php
// create_feedback_table.php
// Run from CLI or web to create `feedback` table in database `study` using config/config.php

// If run from web, require auth
if (php_sapi_name() !== 'cli') {
    require_once 'auth/check.php';
}

require_once 'config/config.php';

$sql = "CREATE TABLE IF NOT EXISTS `feedback` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) DEFAULT NULL,
  `value1` TEXT NOT NULL,
  `value2` TEXT NOT NULL,
  `value3` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

if (mysqli_query($con, $sql)) {
    echo "Table `feedback` created or already exists in database `study`.\n";
} else {
    echo "Error creating table: " . mysqli_error($con) . "\n";
}

?>
