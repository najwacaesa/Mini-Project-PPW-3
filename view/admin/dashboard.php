<?php
session_start();
require '../../../Glowy/koneksi/koneksi.php';

if (isset($_SESSION['flash'])) {
    $flashdata = $_SESSION['flash'];
    unset($_SESSION['flash']);
} else {
    $flashdata = null;
}

if (!($_SESSION['user']['peran'] == 'Admin' or $_SESSION['user']['peran'] == 'Super')) {
    header('Location: ./');
}
$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
require 'layouts/header.php';
require 'layouts/sidebar.php';
?>

<div class="flash-data" data-flashdata="<?= htmlspecialchars(json_encode($flashdata)); ?>"></div>

<div class="d-flex flex-column w-100">
    <div class="container my-3">
        <div class="p-5 text-center bg-dark-subtle rounded-4">
            <h1 class="text-body-emphasis">Selamat Datang <?= ($_SESSION['user']['peran'] === 'Admin') ? "Admin" : ($_SESSION['user']['peran'] === 'Super' ? "Super Admin" : "");; ?> <?= $_SESSION['user']['username']; ?></h1>
            <p class="lead">
                haihaihaihaihaihaihai
            </p>
        </div>
    </div>
    <div class="card ms-3">
        <div class="text">
            <span>Stok Barang</span>
            <p class="subtitle"><?= count($rows); ?></p>
        </div>
    </div>
</div>



<?php require 'layouts/footer.php' ?>