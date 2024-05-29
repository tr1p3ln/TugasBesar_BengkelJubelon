<?php
session_start();
include('../Server/connection.php');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: Profile.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $gmail = $_POST['Gmail'];
    $password = $_POST['Password'];

    $query = "SELECT id, gmail, password, nama, alamat, phone,  user_foto FROM user WHERE gmail = ? AND password = ? LIMIT 1";
    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $gmail, $password);

    if ($stmt_login->execute()) {
        $stmt_login->bind_result($Id, $gmail, $password, $nama, $alamat, $phone, $user_foto);
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();
            $_SESSION['Id'] = $Id;
            $_SESSION['Gmail'] = $gmail;
            $_SESSION['Password'] = $password;
            $_SESSION['Nama'] = $nama;
            $_SESSION['Alamat'] = $alamat;
            $_SESSION['Phone'] = $phone;
            $_SESSION['User_foto'] = $user_foto;
            $_SESSION['logged_in'] = true;

            header('Location: LandingPage.php?message=Logged in successfully');
        } else {
            header('Location: login.php?error=Could not verify your account');
        }
    } else {
        header('Location: login.php?error=Something went wrong');
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jubolin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <form autocomplete="off" id="login-form" method="POST" action="login.php">
        <?php if(isset($_GET['error'])) ?> <!-- tambahkan { dan } -->
        <div role="alert">
        <?php if (isset($_GET['error'])) {
            echo $_GET['error']; //memunculkan teks 'error'
        } 
        ?>
        <!-- Judul & Gambar Logo -->
    <section class="bg-gray-50 dark:bg-white">  <!-- Background Warna-->
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-white bg-gray-800 border-gray-800 rounded-lg dark:text-white">
                <img class="w-8 h-8 mr-2 rounded-full" src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" alt="logo"> <!--Logo-->
                JUBOLIN 
            </a>
            <div class="w-full bg-gray-800 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl dark:text-white"> <!-- text Sign in-->
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="login.php" method="post" autocomplete="off">
                        <div class="input email"> <!-- Input Email-->
                        <label for="email" class="block mb-2 text-sm font-medium text-white dark:text-white">Your email</label>
                        <input type="text" name="Gmail" id="Gmail" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Gmail" required=""> 
                        </div>
                        <div class="input password"> <!-- Input Password-->
                            <label for="password" class="block mb-2 text-sm font-medium text-white dark:text-white">Password</label>
                            <input type="password" name="Password" id="Password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                                </div>
                                <div class="ml-3 text-sm">
                                <label for="remember" class="text-white dark:text-white">Remember me</label>
                                </div>
                            </div>
                            <!-- Harus Buat Page Forgot password -->
                            <a href="#" class="text-sm font-medium text-white text-primary-600 hover:underline dark:text-white">Forgot password?</a>
                        </div>
                        <button type="submit" id="signup_btn" name="signup_btn"  class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 btn btn-primary">
                            Dont have an account yet?" <a href="register.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                        <div>
                            <button type="submit" name="login_btn" id="login_btn" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </form>
</body>
</html>