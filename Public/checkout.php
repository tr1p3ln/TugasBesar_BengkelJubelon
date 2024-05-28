<?php
session_start();
if (!empty($_SESSION['cart'])) {
    // Let user in
} else {
    // Send user to hompe page
    // Kalau mau dihilangkan tinggal diberi comment
    //header('location: index.php');
}


function setRupiah($price)
{
    $result = "Rp".number_format($price, 0, ',', '.');
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">

<section>
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
    <link href="assets/css/checkout.css" rel="stylesheet">

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
        <a class="btn-getstarted" href="Profile.html"><i class="bi bi-person-circle"></i> Profile</a>
        </div>
    </header>
</section>

<section>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form id="checkout-form" method="POST" action="server/place_order.php">
                    <div class="alert alert-danger" role="alert">
                        <?php if (isset($_GET['message'])) {
                            echo $_GET['message'];
                        } ?>
                        <?php if (isset($_GET['message'])) { ?>
                            <a href="login.php" class="btn btn-primary">Login</a>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="checkout__input">
                                <p>Name<span>*</span></p>
                                <input type="text" name="name">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" class="checkout__input__add">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Price</span></div>
                                <ul class="checkout__total__products">
                                    <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                        <li><?php echo $value['product_quantity']; ?> <?php echo $value['product_name']; ?> <span> <?php echo setRupiah(($value['product_price'])); ?></span></li>
                                    <?php } ?>
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Total <span><?php echo setRupiah(($_SESSION['total'])); ?></span></li>
                                </ul>

                                <input type="submit" class="site-btn" id="checkout-btn" name="place_order" value="PLACE ORDER" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>