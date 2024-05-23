<?php
include('../Server/connection.php')
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
  <link href="assets/css/main.css" rel="stylesheet">

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

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="section hero">

      <div class="container">
        <div class="row gy-4">
          <div class="order-2 col-lg-6 order-lg-1 d-flex flex-column justify-content-center">
            <h1 class="">Bengkel Jubelon</h1>
            <p>Menjual spare part dan juga service untuk motor anda barang yang tersedia bisa cek</p>
            <div class="d-flex">
              <a href="Produk.php" class="btn-get-started">Produk</a>
              <a href="service.php" class="glightbox btn-watch-video d-flex align-items-center">Service</a>
              <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
            </div>
          </div>
          <div class="order-1 col-lg-6 order-lg-2 hero-img">
            <img src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->


    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Service</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <h4><a href="service.php" class="stretched-link">Ganti Oli</a></h4>
              <p>Proses menguras oli mesin lama yang sudah terpakai dari kendaraan ke dalam wadah. Lalu menggantinya dengan oli baru yang bersih dan filter oli yang baru </p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <h4><a href="service.php" class="stretched-link">Pasang Spare Part</a></h4>
              <p>Proses pengelolaan stok atau inventaris suku cadang dan komponen yang digunakan saat operasional perbaikan atau maintenance.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <h4><a href="service.php" class="stretched-link">Konsultasi</a></h4>
              <p>Agar pengguna dapat merawat dan mereparasi sepeda motor sebagai mekanik sepeda motor sesuai standar reparasi bengkel, setidaknya dapat melakukan perawatan sistem bahan bakar</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <h4><a href="service.php" class="stretched-link">Bore Up</a></h4>
              <p>Istilah dalam memodifikasi kendaraan pada sektor mesin dengan cara menaikkan kapasitas silinder.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Portfolio Section -->
    <section id="produk" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Produk</h2>

      </div><!-- End Section Title -->
`
        <div class="container">
          <div class="row product_filter">
                <?php while ($row = $fav_product->fetch_assoc()) { ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 mix new-arrivals">
                        <div class="product__item">
                            <img class="product__item__pic set-bg" src="img/product/<?php echo $row['product_image1']; ?>" alt="Product Image">
                            <div class="product__item__text">
                                <h6><?php echo $row['product_name']; ?></h6>
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
          </div><!-- End Portfolio Container -->

    </section><!-- /Portfolio Section -->

  </main>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <!-- <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">Ninestars</span>
          </a>
          <div class="pt-3 footer-contact">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
        </div> -->

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="LandingPage.php">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="Produk.php">Produk</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="service.php">Service</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Contact</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Service</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  </footer>

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