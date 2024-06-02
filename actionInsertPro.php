<?php 

include 'server/connection.php';

if(isset($_POST ['name'],$_POST ['brand'],$_POST ['kategori'],$_POST ['deskripsi'],$_POST ['kriteria'],$_POST ['gambar'],$_POST ['harga'],$_POST ['offer'],$_POST ['color'])){
    $product_name = $_POST ['name'];
    $product_brand = $_POST ['brand'];
    $product_category = $_POST ['kategori'];
    $product_description = $_POST ['deskripsi'];
    $product_criteria = $_POST ['kriteria'];
    $product_image1 = $_POST ['gambar'];
    $product_price = $_POST ['harga'];
    $special_offer = $_POST ['offer'];
    $product_color = $_POST ['color'];

    $create_query = "INSERT into products values (null, '$product_name', '$product_brand', '$product_category', '$product_description', '$product_criteria', '$product_image1', $product_price, $special_offer, '$product_color')";
    $result = mysqli_query($conn,$create_query);

    if ($result) {
        header("location: tables_Produk.php?succes=Data telah dimasukan");
    }

    mysqli_close($conn);
} else {
    echo "Data kosong/tidak lengkap";
}


?>