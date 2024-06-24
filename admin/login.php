<?php

session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assetss/css/styles.css">

    <title>Login Admin</title>
    </head>
    
    <body class="bg-primary">
    <?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = md5(mysqli_real_escape_string($koneksi, $_POST['password']));

        $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");

        if (!$query) {
            die('Query Error : ' . mysqli_error($koneksi));
        }

        if (mysqli_num_rows($query) == 1) {
            $data = mysqli_fetch_array($query);
            $_SESSION['user'] = $data;
            echo '<script>alert("Selamat datang, ' . $data['nama'] . '"); location.href="index.php";</script>';
        } else {
            echo '<script>alert("Username/password tidak sesuai.");</script>';
        }
    }
    ?>
    <div class="login">
        <img src="assets/img/login-bg.png" alt="image" class="login__bg">

        <form method="post" class="login__form">
            <h1 class="login__title">Login</h1>

            <div class="login__inputs">
                <div class="login__box">
                    <input type="text" name="username" placeholder="username" required class="login__input">
                    <i class="ri-mail-fill"></i>
                </div>

                <div class="login__box">
                    <input type="password" name="password" placeholder="password" required class="login__input">
                    <i class="ri-lock-2-fill"></i>
                </div>
            </div>

            <div class="login__check">
                <div class="login__check-box">
                    <input type="checkbox" class="login__check-input" id="user-check">
                    <label for="user-check" class="login__check-label">Remember me</label>
                </div>

                <a href="#" class="login__forgot">Forgot Password?</a>
            </div>

            <button type="submit" class="login__button">Login</button>

            <div class="login__register">
                Don't have an account? <a href="daftar.php">Register</a>
            </div>
        </form>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
