<?php
include 'server/connection.php';

if (isset($_POST ['id'],$_POST ['name'],$_POST ['brand'],$_POST ['kategori'],$_POST ['deskripsi'],$_POST ['kriteria'],$_POST ['gambar'],$_POST ['harga'],$_POST ['offer'],$_POST ['color'])) {
    $product_id = $_POST ['id'];
    $product_name = $_POST ['name'];
    $product_brand = $_POST ['brand'];
    $product_category = $_POST ['kategori'];
    $product_description = $_POST ['deskripsi'];
    $product_criteria = $_POST ['kriteria'];
    $product_image1 = $_POST ['gambar'];
    $product_price = $_POST ['harga'];
    $special_offer = $_POST ['offer'];
    $product_color = $_POST ['color'];

    $update_query = "UPDATE products SET 
                        product_name = '$product_name', 
                        product_brand = '$product_brand',
                        product_category = '$product_category', 
                        product_description = '$product_description',
                        product_criteria = '$product_criteria', 
                        product_image1 = '$product_image1',
                        product_price = '$product_price', 
                        special_offer = '$special_offer', 
                        product_color = '$product_color'
                    WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        header("location: tables_produk.php?success=Data telah dimasukan");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Data kosong/tidak lengkap";
}
?>
