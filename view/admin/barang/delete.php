<?php
require '../../../koneksi/koneksi.php';
require '../../../flash.php';


$id = $_GET['id'];
$sql = "DELETE FROM product WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    Flasher::setFlash('Berhasil','Menghapus barang', 'success');

} else {
    Flasher::setFlash('Gagal','Menghapus barang', 'error');
}
header('Location: ../barang.php');