<?php
include('server/connection.php');


if (isset($_POST['search']) && isset($_POST['product_category'])) {
    $category = $_POST['product_category'];
    $query_product = "select * from products where product_category = ?";
    $stmt_product = $conn->prepare($query_product);
    $stmt_product->bind_param('s', $category);
    $stmt_product->execute();
    $products = $stmt_product->get_result();
} else {
    $query_product = "SELECT * FROM products";
    $stmt_product = $conn->prepare($query_product);
    $stmt_product->execute();
    $products = $stmt_product->get_result();
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
  <link href="assets/css/produk.css" rel="stylesheet">

</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" alt="logo-navbar"> 
        <h1 class="sitename">Jubelon</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="LandingPage.php" class="">Home</a></li>
          <li><a href="Produk.php">Produk</a></li>
          <li><a href="service-details.html">Service</a></li>
          <li><a href="index.html#team">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="index.html#about"><i class="bi bi-cart3"></i></i> Cart</a>
      <a class="btn-getstarted" href="index.html#about"><i class="bi bi-person-circle"></i> Profile</a>
    </div>
</header>

<section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <form action="shop.php" method="post">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__categories">
                                                    <ul class="nice-scroll">
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="sepatu" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'sepatu') {
                                                                                                                                                                            echo 'checked';
                                                                                                                                                                        } ?>>
                                                                <label class="form-check-label" for="product_category">Ban</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="jaket" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'jaket') {
                                                                                                                                                                            echo 'checked';
                                                                                                                                                                        } ?>>
                                                                <label class="form-check-label" for="product_category">Oli</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="kaos" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'kaos') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                                                <label class="form-check-label" for="product_category">Kaos</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="tas" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'tas') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                                                <label class="form-check-label" for="product_category">Tas</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="syal" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'syal') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                                                <label class="form-check-label" for="product_category">Syal</label>
                                                            </div>
                                                        </li>
                                                        <!-- <li><a href="#">Men (20)</a></li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <button class="btn btn-secondary" onclick="history.go(0);">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                            <input type="submit" class="btn btn-primary" name="search" value="Search">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php while ($row = $products->fetch_assoc()) { ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <img class="product__item__pic set-bg" src="img/product/<?php echo $row['product_image1']; ?>" alt="Product Image">
                                    <div class="product__item__text">
                                        <h6><?php echo $row['product_name']; ?></h6>
                                        <h5><?php echo $row['product_brand']; ?></h5>
                                        <a href="<?php echo "shop-details.php?product_id=" . $row['product_id']; ?>" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>Rp.<?php echo $row['product_price']; ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__pagination">
                                <a class="active" href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">21</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>