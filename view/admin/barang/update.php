<?php
require '../../../koneksi/koneksi.php';
require '../../../flash.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $nama = $_POST["namaBaru"];
    $harga = $_POST["hargaBaru"];
    $gambar = '';

    if (isset($_FILES["gambarBaru"]["tmp_name"]) && !empty($_FILES["gambarBaru"]["tmp_name"])) {
        $gambar = file_get_contents($_FILES["gambarBaru"]["tmp_name"]);
    }


    $sql = "UPDATE product SET nama = ?, harga = ?, image = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nama, $harga, $gambar, $id);
    if ($stmt->execute()) {
        Flasher::setFlash('Berhasil', 'Mengubah barang', 'success');
    } else {
        Flasher::setFlash('Gagal', 'Mengubah barang', 'error');
    }
}
header('Location: ../barang.php');