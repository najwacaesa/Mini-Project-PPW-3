<?php
include '../Beauty_E-Commerce/koneksi/koneksi.php';

$sql = "SELECT * FROM product WHERE id = {$_GET['id']}";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>

<body>
    <?= '<img src="data:image/jpeg;base64,' . base64_encode($data['image']) . '" alt="Product Image">'; ?>
    <p><?= $data['nama']; ?></p>
    <p><?= $data['harga']; ?></p>
</body>

</html>