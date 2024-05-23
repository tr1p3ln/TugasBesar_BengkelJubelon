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
<br>

<section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="" method="">
                                <input type="text" name="search" placeholder="Search..." value="">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <form action="Produk.php" method="post">
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
                                                                <input class="form-check-input" type="radio" value="ban" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'ban') {
                                                                                                                                                                            echo 'checked';
                                                                                                                                                                        } ?>>
                                                                <label class="form-check-label" for="product_category">Ban</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="oli" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'oli') {
                                                                                                                                                                            echo 'checked';
                                                                                                                                                                        } ?>>
                                                                <label class="form-check-label" for="product_category">Oli</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="filter" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'filter') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                                                <label class="form-check-label" for="product_category">Filter</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="Kampas Rem" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'kampas rem') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                                                <label class="form-check-label" for="product_category">Kampas Rem</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="Aki" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'aki') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                                                <label class="form-check-label" for="product_category">Aki</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="bearing" name="product_category" id="category_one" <?php if (isset($product_category) && $product_category == 'bearing') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                                                <label class="form-check-label" for="product_category">bearing</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <button class="btn btn-secondary" onclick="history.go(0);">
                                                <i class="bi bi-arrow-clockwise"></i>
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
                                        <a href="<?php echo "produk-detail.php?product_id=" . $row['product_id']; ?>" class="add-cart">+ Add To Cart</a>
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

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body> 
</html>