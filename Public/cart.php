<?php
session_start();
if (isset($_POST['add_to_cart'])) {
    // If user has already add product to the cart
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id");
        // If product has already added to cart or not
        if (!in_array($_POST['product_id'], $products_array_ids)) {
            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][$product_id] = $product_array;

            // Product has already been added
        } else {
            echo '<script>alert("Product was already added to the cart")</script>';
        }

        // If user the first add product to the cart
    } else {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
    }

    // Calculate total
    calculateTotalCart();

    // Remove product from the cart
} else if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];

    unset($_SESSION['cart'][$product_id]);

    // Calculate total
    calculateTotalCart();

    // Codingan baru
} else if (isset($_POST['edit_quantity'])) {
    // We get the id from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    // We get product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    // Update the product quantity
    $product_array['product_quantity'] = $product_quantity;

    // Return array back its place
    $_SESSION['cart'][$product_id] = $product_array;

    // Calculate total
    calculateTotalCart();
} else {
    //header('location: index.php');
}

function calculateTotalCart()
{
    $total_price = 0;
    $total_quantity = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}

$kurs_dollar = 15502;

function setRupiah($price)
{
    $result = "Rp".number_format($price, 0, ',', '.');
    return $result;
}

?>