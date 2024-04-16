<?php
@include '../Glowy/koneksi/koneksi.php';

// Pastikan variabel $conn sudah terdefinisi dan merupakan objek koneksi MySQLi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Misalkan Anda sudah memiliki koneksi ke database di sini

if(isset($_POST['order_btn'])){

   // Melakukan pembersihan dan perlindungan terhadap input
   $nama = mysqli_real_escape_string($conn, $_POST['nama']);
   $nomor = mysqli_real_escape_string($conn, $_POST['nomor']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $metode = mysqli_real_escape_string($conn, $_POST['metode']);
   $jalan = mysqli_real_escape_string($conn, $_POST['jalan']);
   $kota = mysqli_real_escape_string($conn, $_POST['kota']);
   $provinsi = mysqli_real_escape_string($conn, $_POST['provinsi']);
   $negara = mysqli_real_escape_string($conn, $_POST['negara']);
   $kode_pin = mysqli_real_escape_string($conn, $_POST['kode_pin']);

   // Mengambil data dari tabel cart
   $cart_query = mysqli_query($conn, "SELECT * FROM cart");
   $price_total = 0;
   $product_name = [];

   $total_product = ''; // Inisialisasi variabel total_product

   if(mysqli_num_rows($cart_query) > 0){
       while($product_item = mysqli_fetch_assoc($cart_query)){
           // Format nama produk dengan jumlah
           $product_name[] = $product_item['nama'] .' ('. $product_item['jumlah'] .') ';
           $product_price = $product_item['harga'] * $product_item['jumlah'];
           $price_total += $product_price;
       }
   
       // Gabungkan semua nama produk menjadi satu string
       $total_product = implode(', ',$product_name);
   }
   // Menyiapkan query untuk memasukkan data ke dalam tabel pesanan
   $detail_query = mysqli_query($conn, "INSERT INTO `order` (nama, nomor, email, metode, jalan, kota, provinsi, negara, kode_pin, total_harga) VALUES('$nama','$nomor','$email','$metode','$jalan','$kota','$provinsi','$negara','$kode_pin','$price_total')");

   if($detail_query){
      // Mengosongkan tabel cart setelah berhasil checkout
      mysqli_query($conn, "DELETE FROM cart");

      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$nama."</span> </p>
            <p> your number : <span>".$nomor."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$jalan.", ".$kota.", ".$provinsi.", ".$negara." - ".$kode_pin."</span> </p>
            <p> your payment mode : <span>".$metode."</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='index.php?page=Shop' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   } else {
      echo "Order failed. Please try again later.";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM cart");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                $total_price = $fetch_cart['harga'] * $fetch_cart['jumlah'];
                $grand_total += $total_price;
      ?>
      <span><?= $fetch_cart['nama']; ?>(<?= $fetch_cart['jumlah']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : Rp<?= $grand_total; ?> </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>your full name</span>
            <input type="text" placeholder="enter your full name" name="nama" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="text" placeholder="enter your number" name="nomor" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="metode">
               <option value="cash on delivery" selected>cash on delivery</option>
               <option value="credit card">credit card</option>
            </select>
         </div>
         <div class="inputBox">
            <span>street/span>
            <input type="text" placeholder="e.g. street name" name="jalan" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <select name="metode">
               <option value="Samarinda" selected>Samarinda</option>
               <option value="Balikpapan">Balikpapan</option>
               <option value="Tenggarong">Tenggarong</option>
               <option value="Bandung">Bandung</option>
               <option value="Bontang">Bontang</option>
               <option value="Jakarta">Jakarta</option>
            </select>
         </div>
         <div class="inputBox">
            <span>state</span>
            <select name="metode">
               <option value="Kaltim" selected>Kaltim</option>
               <option value="Jaktim">Jaktim</option>
               <option value="Jabar">Jabar</option>
               <option value="Jakbar">Jakbar</option>
               <option value="Jaksel">Jaksel</option>
               <option value="Jakpus">Jakpus</option>
            </select>
         </div>
         <div class="inputBox">
            <span>country</span>
            <select name="metode">
               <option value="Indonesia" selected>Indonesia</option>
            </select>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="kode_pin" required>
         </div>

      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="../assets/js/apps.js"></script>
   
</body>
</html>
