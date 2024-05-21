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

function setRupiah($price)
{
    $result = "Rp".number_format($price, 0, ',', '.');
    return $result;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Bengkel Jubelon</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assetsimg/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/cart.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="LandingPage.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" alt="logo-navbar"> 
        <h1 class="sitename">Jubelon</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="LandingPage.php" class="">Home</a></li>
          <li><a href="Produk.php">Produk</a></li>
          <li><a href="service.php">Service</a></li>
          <li><a href="index.html#team">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="cart.php"><i class="bi bi-cart3"></i></i> Cart</a>
      <a class="btn-getstarted" href="index.html#about"><i class="bi bi-person-circle"></i> Profile</a>
    </div>
</header>

<br>    


<section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_SESSION['cart'])) { ?>
                                    <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="img/product/<?php echo $value['product_image']; ?>" alt="" class="product__cart__item__pic">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6><?php echo $value['product_name']; ?></h6>
                                                    <h5><?php echo setRupiah(($value['product_price'])); ?></h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <form method="POST" action="cart.php">
                                                        <div>
                                                            <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>" />
                                                            <h6><input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"></h6>
                                                        </div>
                                                        <div>
                                                            <button class="editbtn" type="submit" name="edit_quantity"><i class="fa fa-refresh"></i> Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="cart__price">
                                                <span><?php echo setRupiah(($value['product_quantity'] * ($value['product_price']))); ?> </span>
                                            </td>
                                            <form method="POST" action="cart.php">
                                                <td>
                                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                                    <button type="submit" class="btn btn-danger" name="remove_product"><i class="bi bi-trash"></i></i></button>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="produk.php" class="btn btn-primary">Continue Shopping <i class="fa fa-arrow-circle-o-right fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Total <span><?php if(isset($_SESSION['cart'])) { echo setRupiah($_SESSION['total']); } ?></span></li>
                        </ul>
                        <form method="POST" action="checkout.php">
                            <input type="submit" class="primary-btn" value="Checkout" name="checkout">
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
    <!-- Shopping Cart Section End -->
