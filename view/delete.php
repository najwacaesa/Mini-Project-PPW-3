<?php
// Include your connection file
include '../Beauty_E-Commerce/koneksi/koneksi.php';

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];

    // Validate if the remove id is numeric
    if(is_numeric($remove_id)) {
        $delete_query = mysqli_query($conn, "DELETE FROM cart WHERE id = '$remove_id'");
        if($delete_query){
            header('Location: cart.php'); // Mengarahkan kembali ke halaman cart setelah menghapus produk
            exit(); // Exit after redirect
        } else {
            echo "Failed to delete item from cart.";
        }
    } else {
        // Handle non-numeric value error
        echo "Remove ID is not numeric.";
    }
}
?>
