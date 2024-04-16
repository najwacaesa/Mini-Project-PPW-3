<?php
require '../../../koneksi/koneksi.php';
require '../../../flash.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaDepan = $_POST["namaDepan"];
    $namaBelakang = $_POST["namaBelakang"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];
    $peran = $_POST["peran"];
    $gambar = '';

    if (isset($_FILES["gambar"]["tmp_name"]) && !empty($_FILES["gambar"]["tmp_name"])) {
        $gambar = file_get_contents($_FILES["gambar"]["tmp_name"]);
    }

    $sql = "INSERT INTO user VALUES ('',?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $namaDepan, $namaBelakang, $username, $email, $gender, $password, $gambar, $peran);
    if ($stmt->execute()) {
        Flasher::setFlash('Berhasil', 'Menambahkan Akun', 'success');
    } else {
        Flasher::setFlash('Gagal', 'Menambahkan Akun', 'error');
    }
}
header('Location: ../account.php');
