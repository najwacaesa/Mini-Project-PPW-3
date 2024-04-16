<?php
require '../../../koneksi/koneksi.php';
require '../../../flash.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $namaDepan = $_POST["namaDepanBaru"];
    $namaBelakang = $_POST["namaBelakangBaru"];
    $username = $_POST["usernameBaru"];
    $email = $_POST["emailBaru"];
    $gender = $_POST["genderBaru"];
    $peran = $_POST["peranBaru"];
    $gambar = '';

    if (isset($_FILES["gambarBaru"]["tmp_name"]) && !empty($_FILES["gambarBaru"]["tmp_name"])) {
        $gambar = file_get_contents($_FILES["gambarBaru"]["tmp_name"]);
    }


    $sql = "UPDATE user SET first_name = ?, last_name = ?, username = ?, email = ?, gender = ?, image = ?, peran = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $namaDepan, $namaBelakang, $username, $email, $gender, $gambar, $peran, $id);
    if ($stmt->execute()) {
        Flasher::setFlash('Berhasil', 'Mengubah barang', 'success');
    } else {
        Flasher::setFlash('Gagal', 'Mengubah barang', 'error');
    }
}
header('Location: ../account.php');
