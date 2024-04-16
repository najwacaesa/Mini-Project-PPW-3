<?php
require '../../../koneksi/koneksi.php';
require '../../../flash.php';


$id = $_GET['id'];
$sql = "DELETE FROM user WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    Flasher::setFlash('Berhasil','Menghapus akun', 'success');

} else {
    Flasher::setFlash('Gagal','Menghapus akun', 'error');
}
header('Location: ../account.php');