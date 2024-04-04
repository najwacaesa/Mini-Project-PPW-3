<?php
// Lakukan koneksi ke database
require '../Beauty_E-Commerce/koneksi/koneksi.php';

// Pastikan variabel $conn sudah terdefinisi dan merupakan objek koneksi MySQLi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil riwayat pemesanan terakhir
$query = "SELECT * FROM `order` ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Periksa apakah ada riwayat pemesanan
if (mysqli_num_rows($result) > 0) {
    // Ambil data riwayat pemesanan terakhir
    $order = mysqli_fetch_assoc($result);


} else {
    echo "Tidak ada riwayat pemesanan.";
}

// Tutup koneksi database
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan Terakhir</title>
    <link type="text/css" rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../assets/css/style.css" />
    <style>
        h2 {
            margin-top: 2rem;
            text-align: center;
            font-weight: 600;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 2rem;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Riwayat Pemesanan Terakhir</h2>
        <table>
            <tr>
                <th>No. Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>No Hp</th>
                <th>Email</th>
                <th>Metode Pembayaran</th>
                <th>Alamat</th>
                <th>Total Produk</th>
                <th>Total Harga</th>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['nama']; ?></td>
                <td><?php echo $order['nomor']; ?></td>
                <td><?php echo $order['email']; ?></td>
                <td><?php echo $order['metode']; ?></td>
                <td><?php echo $order['jalan'] . ", " . $order['kota'] . ", " . $order['provinsi'] . ", " . $order['negara'] . " - " . $order['kode_pin']; ?></td>
                <td><?php echo $order['jumlah_produk']; ?></td>
                <td>Rp <?php echo $order['total_harga']; ?></td> <!-- Mengganti "$" dengan "Tp" -->
                <!-- Tambahkan sel lain sesuai kebutuhan -->
            </tr>
            
        </table>


        <!-- Tambahkan informasi lain atau tombol untuk kembali ke halaman sebelumnya -->
    </div>
</body>
</html>
