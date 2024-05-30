<?php
include('Server/connection.php');

if (isset($_POST['gmail']) && isset($_POST['password']) && isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['phone']) && isset($_POST['birtday'])) {
    $user_gmail = $_POST['gmail']; //Gmail Register
    $user_password = $_POST['password']; //Password Register
    $user_nama = $_POST['nama']; //Nama Register
    $user_alamat = $_POST['alamat']; //Alamat Register
    $user_phone = $_POST['phone']; //Phone Resigter
    $user_birtday = $_POST['birtday']; // Birthday Register

    // Check if the user already exists
    $checkQuery = "SELECT * FROM user WHERE gmail = '$user_gmail'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Insert new user into the database
        $query = "INSERT INTO user (gmail, Password, nama, alamat, phone, birtday) VALUES ('$user_gmail', '$user_password', '$user_nama', '$user_alamat', '$user_phone', '$user_birtday')";
        if (mysqli_query($conn, $query)) {
            // Redirect to login.php after successful registration
            header("Location: login.php");
            exit(); // Make sure to exit after redirect
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
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
    <section class="h-full bg-gray-50 dark:bg-white size-full">
        <div class="flex flex-col items-center justify-center w-full h-auto px-6 py-8 mx-auto md:h-screen lg:py-0 size-auto">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 bg-gray-800 border-gray-800 rounded-lg dark:text-white">
                <img class="w-8 h-8 mr-2 rounded-full" src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" alt="logo">
                JUBOLIN
            </a>
            <div class="w-full max-h-full rounded-lg shadow bg-gra dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 bg-slate-600">
                <div class="p-1 space-y-3 md:space-y-2 sm:p-1">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign Up
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="" method="POST">
                        <div class="input email">
                            <label for="gmail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="gmail" id="gmail" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Gmail">
                        </div>
                        <div class="input password">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="input nama">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="nama" id="nama" placeholder="Nama" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="input alamat">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="input no_hanphone">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan No Handphone</label>
                            <input type="text" name="phone" id="phone" placeholder="Phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="input date">
                            <label for="birtday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                            <input type="date" name="birtday" id="birtday" placeholder="Birthday" class="text-center rounded-lg">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="button_CreateAccount">
                                <button type="submit" name="submit" class="w-full flex text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Create Your Account
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
