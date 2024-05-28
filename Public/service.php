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
          <li><a href="Contact.html">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="cart.php"><i class="bi bi-cart3"></i></i> Cart</a>
      <a class="btn-getstarted" href="Profile.html"><i class="bi bi-person-circle"></i> Profile</a>
    </div>
  </header>

  <br>

  <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form id="checkout-form" method="POST" action="server/place_service.php">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Service Details</h6>
                            <div class="checkout__input">
                                <p>Name Lengkap<span>*</span></p>
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
                                        <p>No Telepon<span>*</span></p>
                                        <input type="text" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Kota<span>*</span></p>
                                <input type="text" name="city">
                            </div>
                            <div class="checkout__input">
                                <p>Alamat<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" class="checkout__input__add">
                            </div>
                            <div class="checkout__input">
                              <p>Tipe Motor<span>*</span></p>
                              <select class="form-select" id="inputGroupSelect01">
                                <option selected>Pilih...</option>
                                <option value="1">Cub</option>
                                <option value="2">Sport Bike</option>
                                <option value="3">Dual Sport</option>
                                <option value="4">Skuter</option>
                              </select>
                            </div>
                            <div class="checkout__input">
                                <p>Keluhaan<span>*</span></p>
                                <input type="text" name="keluhan" placeholder="keluhan motor" class="checkout__input__add">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </form>
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