<?php
include '../koneksi/koneksi.php';

// Cek apakah parameter id disertakan dalam URL
if(isset($_GET['id'])) {
    // Escape the ID parameter to prevent SQL injection
    $productId = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk mendapatkan data produk berdasarkan id
    $sql = "SELECT * FROM product WHERE id = $productId";
    $result = mysqli_query($conn, $sql);

    // Periksa apakah query dieksekusi dengan sukses
    if($result) {
        // Periksa apakah data ditemukan
        if(mysqli_num_rows($result) > 0) {
            // Ambil data produk
            $data = mysqli_fetch_assoc($result);
        } else {
            // Tampilkan pesan jika produk tidak ditemukan
            echo "Produk tidak ditemukan.";
            exit(); // Berhenti eksekusi skrip
        }
    } else {
        // Tampilkan pesan jika query gagal dieksekusi
        echo "Error: " . mysqli_error($conn);
        exit(); // Berhenti eksekusi skrip
    }
} else {
    // Tampilkan pesan jika parameter id tidak disertakan dalam URL
    echo "Parameter ID tidak ditemukan dalam URL.";
    exit(); // Berhenti eksekusi skrip
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Glowy/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Glowy/assets/css/style.css">
    
    <title>Detail</title>
    <style>
                body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
        }

        .product-image {
            width: 100%;
            max-width: 400px;
            display: block;
            margin: 0 auto 20px;
        }

        .product-details {
            text-align: center;
        }

        .product-details a{
            background-color: #FFA1F5;
            padding: 1rem;
            text-decoration: none;
            color: white;
            font-weight: bolder;
            border-radius: 2rem;
        }

        .product-details a:hover{
            background-color: #333;
        }

        .product-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 18px;
            color: yellowgreen;
            font-weight: bold;
            padding-bottom: 1rem
        }

    </style>
</head>
<body>
    <div class="container">
        <?php if(isset($data)): ?>
            <?= '<img class="product-image" src="data:image/jpeg;base64,' . base64_encode($data['image']) . '" alt="Product Image">'; ?>
            <div class="product-details">
                <p class="product-name"><?= $data['nama']; ?></p>
                <p class="product-price">Rp <?= $data['harga']; ?></p>
                <a href="../index.php?page=Shop" class="option-btn" style="margin-top: 0;">Continue Shopping</a>
            </div>
        <?php else: ?>
            <p>Produk tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>
