<?php
include 'server/connection.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $delete_query = "DELETE from products where product_id = '$product_id'";
    $result = mysqli_query($conn,$delete_query);

    if ($result) {
        header("location: tables_produk.php?succes=Telah dihapus");
    } else {
        header("location: tables_produk.php");
    }
} else {
    header("location: tables_produk.php");
}

?>