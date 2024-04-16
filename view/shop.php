<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Beauty_E-Commerce/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Beauty_E-Commerce/assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
    <?php

    require '../Beauty_E-Commerce/koneksi/koneksi.php';

    if (isset($_POST['add_to_cart'])) {

        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_id = $_POST['product_id'];
        $product_quantity = 1;

        // Mendapatkan gambar produk jika diperlukan
        $fetch_product = mysqli_query($conn, "SELECT image FROM product WHERE id = '$product_id'");
        $product_image = mysqli_fetch_assoc($fetch_product)['image'];

        // echo '<img src="data:image/jpeg;base64,'.base64_encode($product_image).'" alt="Product Image">';

        // Menggunakan parameterized queries untuk mencegah SQL Injection
        $select_cart = mysqli_prepare($conn, "SELECT * FROM cart WHERE nama = ?");
        mysqli_stmt_bind_param($select_cart, "s", $product_name);
        mysqli_stmt_execute($select_cart);
        mysqli_stmt_store_result($select_cart);

        if (mysqli_stmt_num_rows($select_cart) > 0) {
            $message[] = 'product already added to cart';
        } else {
            // Menggunakan parameterized queries untuk mencegah SQL Injection
            $insert_product = mysqli_prepare($conn, "INSERT INTO cart(nama, harga, jumlah, image) VALUES(?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert_product, "sids", $product_name, $product_price, $product_quantity, $product_image);
            mysqli_stmt_execute($insert_product);

            $message[] = 'product added to cart succesfully';
        }
    }

    ?>
    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>products</span>
                </h2>
            </div>
            <div class="row">
                <?php

                $select_products = mysqli_query($conn, "SELECT id, nama, harga, image FROM product");

                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="box">
                                <div class="option_container">
                                    <div class="options">
                                        <form action="" method="post">
                                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['nama']; ?>">
                                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['harga']; ?>">
                                            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                                            <input type="submit" class="btn mb-2" value="add to cart" name="add_to_cart">
                                        </form>
                                        <form action="index.php" method="get">
                                            <input type="hidden" name="page" value="Detail">
                                            <input type="hidden" name="id" value="<?php echo $fetch_product['id']; ?>">
                                            <a type="submit" class="btn mb-2" href="http://localhost/Glowy/view/detail.php?id=<?= $fetch_product['id']; ?>" class="btn mb-2">Detail</a>
                                        </form>
                                    </div>
                                </div>
                                <div class="img-box">
                                    <?php
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($fetch_product['image']) . '" alt="Product Image">';
                                    ?>
                                </div>
                                <div class="detail-box">
                                    <h5><?php echo $fetch_product['nama']; ?></h5>
                                    <div class="price">Rp<?php echo $fetch_product['harga']; ?></div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <script src="../assets/js/apps.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>