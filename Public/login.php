<?php
session_start();
include('Server/connection.php');

if (isset($_POST['login_btn'])) {
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE gmail = ? AND password = ? LIMIT 1";
    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $gmail, $password);

    if ($stmt_login->execute()) {
        $stmt_login->bind_result($id, $gmail, $password, $nama, $alamat, $phone, $birtday,$user_foto);
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();
            $_SESSION['Id'] = $id;
            $_SESSION['Gmail'] = $gmail;
            $_SESSION['Password'] = $password;
            $_SESSION['Nama'] = $nama;
            $_SESSION['Alamat'] = $alamat;
            $_SESSION['Phone'] = $phone;
            $_SESSION['Birtday'] = $birtday;
            $_SESSION['User_foto'] = $user_foto;
            $_SESSION['logged_in'] = true;

            header('location: LandingPage.php');
            exit();
        } else {
            header('location: index.php?error=Could not verify your account');
        }
    } else {
        header('location: index.php?error=Something went wrong');
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
    <!-- Judul & Gambar Logo -->
    <form autocomplete="off" id="login-form" method="POST" action="login.php">
        <div role="alert">
            <?php if (isset($_GET['error'])) { ?>
                <div><?php echo $_GET['error']; ?></div>
            <?php } ?>
        </div>
        <section class="bg-gray-50 dark:bg-white">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-white text-gray-900 bg-gray-800 border-gray-800 rounded-lg">
                    <img class="w-8 h-8 mr-2 rounded-full" src="https://i.pinimg.com/564x/81/de/e5/81dee5592ac7757875b7441a35adfc60.jpg" alt="logo"> <!--Logo-->
                    JUBOLIN
                </a>
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 bg-slate-600">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-white text-gray-900 md:text-2xl">
                            Sign in to your account
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#" method="POST">
                            <div class="input email">
                                <label for="gmail" class="block mb-2 text-sm font-medium text-white text-gray-900">Your email</label>
                                <input type="email" name="gmail" id="gmail" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Gmail" required>
                            </div>
                            <div class="input password">
                                <label for="password" class="block mb-2 text-sm font-medium text-white text-gray-900">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="remember" class="text-white ">Remember me</label>
                                    </div>
                                </div>
                                <a href="#" class="text-sm font-medium text-white text-primary-600 hover:underline">Forgot password?</a>
                            </div>
                            <div>
                                <button type="submit" name="login_btn" id="login_btn" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 bg-black hover:text-black hover:bg-white">Login</button>
                            </div>
                        </form>
                        <p class="text-sm font-light text-white dark:text-gray-400">
                            Don't have an account yet? <a href="register.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </form>
</body>
</html>
