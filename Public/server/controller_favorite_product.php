<?php
    include('connection.php');
    $query_fav_product = "select * from products where product_criteria = 'favourite' limit 8";
    $stmt_fav_product = $conn-> prepare($query_fav_product);
    $stmt_fav_product-> execute();
    $fav_product = $stmt_fav_product-> get_result();
?>