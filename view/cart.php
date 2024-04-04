<?php
// Include your connection file
require 'C:/xampp/htdocs/Beauty_E-Commerce/koneksi/koneksi.php';

// Delete item from cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];

    // Validate if the remove id is numeric
    if (is_numeric($remove_id)) {
        $delete_query = mysqli_query($conn, "DELETE FROM cart WHERE id = '$remove_id'");
        if ($delete_query) {
            echo "<script>alert('Item successfully deleted from cart.');</script>";
            header('Location: ../index.php?page=cart'); // Redirect back to cart page after deletion
            exit(); // Exit after redirect
        } else {
            // Handle deletion failure
            echo "Failed to delete item from cart: " . mysqli_error($conn);
        }
    } else {
        // Handle non-numeric value error
        echo "Remove ID is not numeric.";
    }
}

// Delete all items from cart
if (isset($_GET['delete_all'])) {
    $delete_all_query = mysqli_query($conn, "DELETE FROM cart");
    if ($delete_all_query) {
        echo "<script>alert('All items successfully deleted from cart.');</script>";
        header('Location: index.php?page=cart'); // Redirect back to cart page after deletion
        exit(); // Exit after redirect
    } else {
        // Handle deletion failure
        echo "Failed to delete all items from cart: " . mysqli_error($conn);
    }
}

// Process update quantity form
if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];

    // Validate if the update value is numeric
    if (is_numeric($update_value) && is_numeric($update_id)) {
        $update_quantity_query = mysqli_query($conn, "UPDATE cart SET jumlah = '$update_value' WHERE id = '$update_id'");
        if ($update_quantity_query) {
            header('Location: index.php?page=Home');
            exit(); // Exit after redirect
        } else {
            echo "Failed to update quantity.";
        }
    } else {
        // Handle non-numeric value error
        echo "Update value or ID is not numeric.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.map.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<header>

</header>

<body>
    <div class="container">
        <section class="shopping-cart">
            <h1 class="heading">Shopping Cart</h1>
            <table>
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    // Select products from the database
                    $select_cart = mysqli_query($conn, "SELECT * FROM cart");
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            // Select product details from product table based on cart item
                            $product_id = $fetch_cart['id'];
                            $product_query = mysqli_query($conn, "SELECT nama, harga, image FROM cart WHERE id = '$product_id'");

                            if (mysqli_num_rows($product_query) > 0) {
                                $product_details = mysqli_fetch_assoc($product_query);

                                // Calculate subtotal for each item and add it to grand total
                                $sub_total = $product_details['harga'] * $fetch_cart['jumlah'];
                                $grand_total += $sub_total; ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($product_details['image'])) : ?>
                                            <!-- Display product image -->
                                            <img src="data:image/jpeg;base64,<?= base64_encode($product_details['image']) ?>" alt="" width="70%">
                                        <?php else : ?>
                                            <!-- No image available -->
                                            No image available
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $product_details['nama'] ?></td>
                                    <td>Rp<?= number_format($product_details['harga']) ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="update_quantity_id" value="<?= $product_id ?>">
                                            <input type="number" name="update_quantity" min="1" value="<?= $fetch_cart['jumlah'] ?>">
                                            <input type="submit" value="Update" name="update_update_btn">
                                        </form>
                                    </td>
                                    <td>Rp<?= $sub_total ?></td>
                                    <td>
                                        <a href="view/cart.php?remove=<?= $product_id ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn">
                                            <i class="fas fa-trash"></i> Remove
                                        </a>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                    <tr class="table-bottom">
                        <td><a href="index.php?page=Shop" class="option-btn" style="margin-top: 0;">Continue Shopping</a></td>
                        <td colspan="3">Grand Total</td>
                        <td>Rp<?php echo $grand_total; ?></td>
                        <td><a href="?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> Delete All </a></td>
                    </tr>
                </tbody>
            </table>
            <div class="checkout-btn">
                <a href="index.php?page=Checkout" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
            </div>
        </section>
    </div>
    <script src="../assets/js/apps.js"></script>
</body>

</html>