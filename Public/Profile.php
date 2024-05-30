<?php
session_start();
include('../Server/connection.php');

if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

$nama_pengguna = "Nama pengguna tidak ditemukan";
$user_foto = "default.jpg"; // Default profile picture

if (isset($_SESSION['Id'])) {
  // Mengambil data pengguna dari database
  $user_id = $_SESSION['Id'];
  $sql = "SELECT nama, user_foto FROM user WHERE id = ?";
  $stmt = $conn->prepare($sql);
  if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($nama, $foto);
    $stmt->fetch();
    $stmt->close();
  }
  $conn->close();

  // Menyimpan nama pengguna dan foto
  if (!empty($nama)) {
    $nama_pengguna = htmlspecialchars($nama);
  }
  if (!empty($foto)) {
    $user_foto = htmlspecialchars($foto);
  }
}

// Program Logout
if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_foto']);
    header('location: login.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
  <!--header-->
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" alt="logo-navbar">
        <h1 class="sitename">Jubelon</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="LandingPage.php">Home</a></li>
          <li><a href="Produk.php">Produk</a></li>
          <li><a href="service.php">Service</a></li>
          <li><a href="index.html#team">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="index.html#about"><i class="bi bi-cart3"></i> Cart</a>
      <a class="btn-getstarted" href="index.html#about"><i class="bi bi-person-circle"></i> Profile</a>
    </div>
  </header>

  <!-- card User Profile -->
  <div class="user_card">
    <div class="flex items-center justify-center py-8 my-3">
      <div class="w-full max-w-sm bg-gray-800 border border-gray-700 rounded-lg shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <!-- Avatar dan Nama -->
        <div class="flex items-center gap-4">
          <img class="w-16 h-16 rounded-full" src="<?php echo 'Public/img/' . $user_foto; ?>" alt="Foto Profil"> <!-- Isi atribut alt dengan deskripsi yang sesuai -->
          <div class="font-medium text-white">
            <div id="user_nama"><?php echo $nama_pengguna; ?></div><!-- Nama User dari database user -->
          </div>
        </div>
        <!-- Edit Profile Button -->
        <a href="EditProfile.html" class="block px-4 py-2 mt-5 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
          Edit Profile
        </a>
      </div>
    </div>
  </div>
</body>

</html>