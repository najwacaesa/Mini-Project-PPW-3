<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "glowyy";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// // Menutup koneksi
// mysqli_close($conn);
?>