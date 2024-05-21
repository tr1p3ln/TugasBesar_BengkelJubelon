<?php
    include('server/connection.php');

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        $query = "SELECT * FROM products WHERE product_id=$product_id";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $product_details = $stmt->get_result();
    } else {
        // no product id was given
        header('location: index.php');
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
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
  <link href="assets/css/detail.css" rel="stylesheet">

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
  
<main>

<section class="shop-details">
    <?php while ($row = $product_details->fetch_assoc()) { ?>
        <div class="product__details__pic">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <img class="product__item__pic set-bg" src="img/product/<?php echo $row['product_image1']; ?>" alt="Product Image">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4><?php echo $row['product_name']; ?></h4>
                            <h3><?php echo setRupiah($row['product_price']); ?></h3>
                            <div class="product__details__option">
                            </div>
                            <div class="product__details__cart__option">
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $row['product_image1']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="number" name="product_quantity" value="1">
                                        </div>
                                    </div>
                                    <button type="submit" name="add_to_cart" class="primary-btn"><i class="fa fa-shopping-cart fa-2x"></i> add to cart</button>
                                </form>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                            </div>
                            <div class="product__details__last__option">
                                <ul>
                                    <li><span>Categories:</span> <?php echo $row['product_category']; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Description</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p><?php echo $row['product_description']; ?></p>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </section>
    <!-- Shop Details Section End -->

</main>  