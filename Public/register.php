<?php
session_start(); // Mulai session

include('../Server/connection.php');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { 
    header('Location: register.php'); //Kalo program Profile dah beres ganti location nya ke LandingPage.php
    exit;
}

if(isset($_POST['submit'])) {
    $user_gmail = $_POST['gmail'];
    $user_password = $_POST['password'];
    $user_nama = $_POST['nama'];
    $user_alamat = $_POST['alamat'];
    $user_phone = $_POST['phone'];
    $photo_name = $_FILES['photo']['name']; // Menggunakan 'name' untuk mendapatkan nama file

    // Upload image
    $upload_dir = 'img/profile/';
    $file_name = uniqid() . '.jpg'; // Misalnya, Anda bisa menggunakan uniqid() untuk nama file
    $upload_file = $upload_dir . $file_name;

    // Validate required fields
    if(empty($user_gmail) || empty($user_password) || empty($user_nama) || empty($user_alamat) || empty($user_phone) || empty($photo_name)) {
        echo "All fields are required.";
    }
    // Validate email format
    else if(!filter_var($user_gmail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    }
    // Validate phone number
    else if(!is_numeric($user_phone) || strlen($user_phone) > 12) {
        echo "Invalid phone number. Please enter a valid phone number with a maximum of 12 digits.";
    }
    // Validate password length
    else if(strlen($user_password) < 8) {
        echo "Password must be at least 8 characters long.";
    }
    // Validate password strength
    else if(!preg_match('/[A-Z]/', $user_password) || !preg_match('/[a-z]/', $user_password) || !preg_match('/[0-9]/', $user_password) || !preg_match('/[\W]/', $user_password)) {
        echo "Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character.";
    } 
    else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // Check if email already exists
        $checkEmailQuery = "SELECT * FROM user WHERE gmail = ?";
        $stmt = mysqli_prepare($conn, $checkEmailQuery);
        mysqli_stmt_bind_param($stmt, "s", $user_gmail);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0) {
            echo "Email already exists. Please choose a different email.";
        } else {
            // File upload validation
            $allowed_types = array('jpg', 'jpeg');
            $file_extension = pathinfo($photo_name, PATHINFO_EXTENSION);

            if (!in_array(strtolower($file_extension), $allowed_types)) {
                echo "Only JPG files are allowed.";
            } else {
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_file)) {
                    // Insert into database
                    $query = "INSERT INTO user (gmail, password, nama, alamat, phone, user_foto) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "ssssss", $user_gmail, $hashed_password, $user_nama, $user_alamat, $user_phone, $file_name);

                    if(mysqli_stmt_execute($stmt)) {
                        // Jika data berhasil dimasukkan, maka pindahkan ke halaman login.php
                        header('Location: login.php');
                        exit;
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "Failed to upload photo.";
                }
            }
        }
    }
} else {
    echo "Invalid request.";
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Jubolin</title>
</head>
<body>

    <section class="h-full bg-gray-50 dark:bg-white size-full ">
        <div class="flex flex-col items-center justify-center w-full h-auto px-6 py-8 mx-auto md:h-screen lg:py-0 size-auto">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-white bg-gray-800 border-gray-800 rounded-lg ">
                <img class="w-8 h-8 mr-2 rounded-full" src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" alt="logo">
                JUBOLIN 
            </a>
            <div class="w-full max-h-full bg-gray-800 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-1 space-y-3 md:space-y-2 sm:p-1">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl dark:text-white">
                        Sign Up
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="" method="POST" enctype="multipart/form-data">
                        <div class="input email">
                            <label for="gmail" class="block mb-2 text-sm font-medium text-white dark:text-white">Your email</label>
                            <input type="email" name="gmail" id="gmail" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Gmail" required>
                        </div>
                        <div class="input password">
                            <label for="password" class="block mb-2 text-sm font-medium text-white dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="input nama">
                            <label for="nama" class="block mb-2 text-sm font-medium text-white dark:text-white">Nama</label>
                            <input type="text" name="nama" id="nama" placeholder="Nama" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="input alamat">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-white dark:text-white">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="input no_hanphone">
                            <label for="phone" class="block mb-2 text-sm font-medium text-white dark:text-white">Masukan No Handphone</label>
                            <input type="tel" name="phone" id="phone" placeholder="Phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="input photo">
                            <label for="photo" class="block mb-2 text-sm font-medium text-white dark:text-white">Photo</label>
                            <input type="file" id="photo" name="photo" class="bg-white">
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" name="submit" class="w-full flex text-white text-center bg-gray-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Create Your Account 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  
</body>
</html>
