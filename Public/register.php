<?php
include('../Server/connection.php');

if(isset($_POST['gmail']) && isset($_POST['password']) && isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['phone']) && isset($_POST['birtday'])) {
    $user_gmail = $_POST['gmail']; // Gmail Register
    $user_password = $_POST['password']; // Password Register
    $user_nama = $_POST['nama']; // Nama Register
    $user_alamat = $_POST['alamat']; // Alamat Register
    $user_phone = $_POST['phone']; // Phone Register
    $user_birtday = $_POST['birtday']; // Birthday Register

    // Validate required fields
    if(empty($user_gmail) || empty($user_password) || empty($user_nama) || empty($user_alamat) || empty($user_phone) || empty($user_birtday)) {
        echo "All fields are required.";
    }
    // Validate email format
    else if(!filter_var($user_gmail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    }
    // Validate phone number: ensure it is numeric and has a maximum length of 12
    else if(!is_numeric($user_phone) || strlen($user_phone) > 12) {
        echo "Invalid phone number. Please enter a valid phone number with a maximum of 12 digits.";
    }
    // Validate password length (minimum 8 characters for stronger security)
    else if(strlen($user_password) < 8) {
        echo "Password must be at least 8 characters long.";
    }
    // Validate password strength (require at least one uppercase letter, one lowercase letter, one digit, and one special character)
    else if(!preg_match('/[A-Z]/', $user_password) || !preg_match('/[a-z]/', $user_password) || !preg_match('/[0-9]/', $user_password) || !preg_match('/[\W]/', $user_password)) {
        echo "Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character.";
    } 
    else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // Check if email already exists
        $checkEmailQuery = "SELECT * FROM user WHERE gmail = '$user_gmail'";
        $emailResult = mysqli_query($conn, $checkEmailQuery);

        if(mysqli_num_rows($emailResult) > 0) {
            echo "Username already exists. Please choose a different username.";
        } else {
            // Check if hashed password already exists
            $checkPasswordQuery = "SELECT * FROM user";
            $passwordResult = mysqli_query($conn, $checkPasswordQuery);
            $passwordExists = false;

            while($row = mysqli_fetch_assoc($passwordResult)) {
                if (password_verify($user_password, $row['password'])) {
                    $passwordExists = true;
                    break;
                }
            }

            if($passwordExists) {
                echo "Password already exists. Please choose a different password.";
            } else {
                $query = "INSERT INTO user (gmail, password, nama, alamat, phone, birtday) VALUES ('$user_gmail', '$hashed_password', '$user_nama', '$user_alamat', '$user_phone', '$user_birtday')";
                if(mysqli_query($conn, $query)) {
                    echo "RECORD INSERTED SUCCESSFULLY!";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Jubolin</title>
        
    <!-- <style>
     *{
        border: 1px solid red;
        } 
    </style> -->
</head>
<body>

    <section class="h-full bg-gray-50 dark:bg-white size-full ">  <!-- Background Warna-->
        <div class="flex flex-col items-center justify-center w-full h-auto px-6 py-8 mx-auto md:h-screen lg:py-0 size-auto">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-white bg-gray-800 border-gray-800 rounded-lg ">
                <img class="w-8 h-8 mr-2 rounded-full" src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" alt="logo"> <!--Logo-->
                JUBOLIN 
            </a> <!--Text Logo-->
            <div class="w-full max-h-full bg-gray-800 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"> <!--Card Sign Up-->
                <div class="p-1 space-y-3 md:space-y-2 sm:p-1">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl dark:text-white"> <!-- text Sign in-->
                        Sign Up
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="" method="POST">
                        <div class="input email"> <!-- Input Email-->
                            <label for="gmail" class="block mb-2 text-sm font-medium text-white dark:text-white">Your email</label> <!-- text Your email -->
                            <input type="gmail" name="gmail" id="gmail" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Gmail" > 
                        </div>
                        <div class="input password"> <!-- Input Password-->
                            <label for="password" class="block mb-2 text-sm font-medium text-white dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div class="input nama"> <!-- Input Password-->
                            <label for="nama" class="block mb-2 text-sm font-medium text-white dark:text-white">Nama</label>
                            <input type="nama" name="nama" id="nama" placeholder="Nama" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="input alamat"> <!-- Input Password-->
                            <label for="alamat" class="block mb-2 text-sm font-medium text-white dark:text-white">Alamat</label>
                            <input type="alamat" name="alamat" id="alamat" placeholder="Alamat" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div class="input no_hanphone">
                            <label class="block">
                            <label for="telphone" class="block mb-2 text-sm font-medium text-white dark:text-white">Masukan No Handphone</label>
                            <input type="phone" name="phone" id="phone" placeholder="Phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </label>
                        </div>
                        <div class="input date">
                            <label for="date" class="block mb-2 text-sm font-medium text-white dark:text-white">Birthday</label>
                            <input type="date" name="birtday" id="birtday" placeholder="birthday" class="text-center rounded-lg">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                        <div class="button_CreateAccout">
                        <button type="submit" name="submit" class="w-full flex   text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 ">
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