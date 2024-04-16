<?php
require '../../../koneksi/koneksi.php';
require '../../../flash.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $gambar = '';

    if (isset($_FILES["gambar"]["tmp_name"]) && !empty($_FILES["gambar"]["tmp_name"])) {
        $gambar = file_get_contents($_FILES["gambar"]["tmp_name"]);
    }

    $sql = "INSERT INTO product (id, nama, harga, image) VALUES ('',?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nama, $harga, $gambar);
    if ($stmt->execute()) {
        Flasher::setFlash('Berhasil', 'Menambahkan barang', 'success');
    } else {
        Flasher::setFlash('Gagal', 'Menambahkan barang', 'error');
    }
}
header('Location: ../barang.php');
