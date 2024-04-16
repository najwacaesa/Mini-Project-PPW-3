<?php
// Lakukan koneksi ke database
require '../Glowy/koneksi/koneksi.php';

// Pastikan variabel $conn sudah terdefinisi dan merupakan objek koneksi MySQLi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mulai sesi untuk menggunakan variabel sesi
session_start();

// Periksa apakah ada nama pengguna yang tersimpan dalam sesi
if (!isset($_SESSION["user"])) {
    die("Sesi nama pengguna tidak ditemukan.");
}

// Ambil nama pengguna dari sesi
$user_first_name = $_SESSION["user"]["first_name"];
$user_last_name = $_SESSION["user"]["last_name"];

$user_nama = $user_first_name . " " . $user_last_name;

// Query untuk mengambil riwayat pemesanan berdasarkan nama pengguna
$query = "SELECT * FROM `order` WHERE nama = '$user_nama' ORDER BY id DESC";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan</title>
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
        <h2>Riwayat Pemesanan</h2>
        <table>
            <tr>
                <th>No</th>
                <th>First Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Method</th>
                <th>Address</th>
                <th>Total Price</th>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
            <?php
            // Periksa apakah ada riwayat pemesanan
            if (mysqli_num_rows($result) > 0) {
                while ($order = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['nama']; ?></td>
                <td><?php echo $order['nomor']; ?></td>
                <td><?php echo $order['email']; ?></td>
                <td><?php echo $order['metode']; ?></td>
                <td><?php echo $order['jalan'] . ", " . $order['kota'] . ", " . $order['provinsi'] . ", " . $order['negara'] . " - " . $order['kode_pin']; ?></td>
                <td>Rp <?php echo $order['total_harga']; ?></td> <!-- Mengganti "$" dengan "Rp" -->
                <!-- Tambahkan sel lain sesuai kebutuhan -->
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada riwayat pemesanan.</td></tr>";
            }
            ?>
        </table>
        <!-- Tambahkan informasi lain atau tombol untuk kembali ke halaman sebelumnya -->
    </div>
</body>
</html>
