<?php
session_start();
include('../Server/connection.php');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

// Periksa apakah ID pengguna ada di session
if (isset($_SESSION['Id'])) {
  $user_id = $_SESSION['Id'];
  
  // Mengambil data pengguna dari database
  $sql = "SELECT nama, user_foto, gmail, password, alamat, phone FROM user WHERE id = ?";
  $stmt = $conn->prepare($sql);
  
  if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($nama, $foto, $gmail, $password, $alamat, $phone);
    $stmt->fetch();
    $stmt->close();

    // Menggunakan htmlspecialchars untuk menghindari XSS
    $nama_pengguna = !empty($nama) ? htmlspecialchars($nama) : '';
    $user_foto = !empty($foto) ? htmlspecialchars($foto) : '';
    $gmail_pengguna = !empty($gmail) ? htmlspecialchars($gmail) : '';
    $password_pengguna = !empty($password) ? htmlspecialchars($password) : '';
    $alamat_pengguna = !empty($alamat) ? htmlspecialchars($alamat) : '';
    $phone_pengguna = !empty($phone) ? htmlspecialchars($phone) : '';
  }
}

// Proses pembaruan data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Mengambil dan memvalidasi input dari form
  $nama = htmlspecialchars($_POST['nama']);
  $gmail = htmlspecialchars($_POST['gmail']);
  $password = htmlspecialchars($_POST['password']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $phone = htmlspecialchars($_POST['phone']);

  // Validasi input
  if (empty($nama) || empty($gmail) || empty($password) || empty($alamat) || empty($phone)) {
    echo "Semua field harus diisi.";
    exit;
  }

  // Hash password sebelum menyimpannya
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Siapkan SQL query untuk memperbarui data pengguna
  $sql = "UPDATE user SET gmail = ?, password = ?, nama = ?, phone = ?, alamat = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  
  if ($stmt) {
    $stmt->bind_param("sssssi", $gmail, $hashed_password, $nama, $phone, $alamat, $user_id);
    
    if ($stmt->execute()) {
      // Jika update berhasil
      echo "Data berhasil diperbarui.";
      
      // Perbarui session
      $_SESSION['gmail'] = $gmail;
      $_SESSION['password'] = $hashed_password; // Simpan password yang di-hash
      $_SESSION['nama'] = $nama;
      $_SESSION['phone'] = $phone;
      $_SESSION['alamat'] = $alamat;
    } else {
      echo "Terjadi kesalahan: " . $stmt->error;
    }
    $stmt->close();
  } else {
    echo "Terjadi kesalahan: " . $conn->error;
  }

  // Tutup koneksi database
  $conn->close();
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

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" alt="logo-navbar"> <!--Logo-->
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
      <a class="btn-getstarted" href="index.html#about"><i class="bi bi-cart3"></i> Cart</a>
      <a class="btn-getstarted" href="index.html#about"><i class="bi bi-person-circle"></i> Profile</a>
    </div>
  </header>

  <div class="flex items-center justify-center py-8 my-3">
    <div class="w-full max-w-sm bg-gray-800 border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
      <!--Border Avatar-->
      <div class="flex items-center gap-4">
        <img class="w-16 h-16 rounded-full" src="https://www.freepik.com/icon/user_747376#fromView=keyword&page=1&position=8&uuid=9dc54b46-9e0b-4136-a783-c8d53a14c507" alt="User Foto"> <!--Foto Read From User Database-->
        <div class="font-medium text-white">
          <div id="user_nama"><?php echo $nama_pengguna; ?></div> <!-- Nama User Read From database user-->
        </div>
      </div>

      <!--Card User-->
      <form action="profile.php" method="POST">
        <div class="relative z-0 w-full mb-5 text-white group">
          <input type="email" name="gmail" id="gmail" value="<?php echo $gmail_pengguna ?>" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="gmail" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
            address</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="password" name="password" id="password" value="<?php echo $password_pengguna ?>" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
        </div>

        <div class="">
          <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="nama" id="nama" value="<?php echo $nama_pengguna ?>" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="nama" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama</label>
          </div>
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
          <div class="relative z-0 w-full mb-5 group">
            <input type="tel" pattern="[0-9]{12}" name="phone" id="phone" value="<?php echo $phone_pengguna ?>" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />

            <label for="phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
              Phone number</label>
          </div>
        </div>

        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="alamat" id="alamat" value="<?php echo $alamat_pengguna ?>" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="alamat" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat</label>
        </div>

        <input type="submit" value="Simpan" class="text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:hover:bg-blue-700 dark:focus:ring-blue-800 btn bg-blue-600 hover:bg-blue-800">
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
