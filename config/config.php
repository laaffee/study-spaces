<?php
    $con = mysqli_connect('localhost', 'root', '', 'study');
    if (!$con) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }
?>