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
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Register</title>
</head>
<body>

    <?php
    if(isset($_POST["username"])) {
        $nama = $_POST["nama"];
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        $query = mysqli_query($koneksi,"INSERT INTO user(nama,username,password) values('$nama', '$username', '$password')");
        if($query){
            echo '<script>alert("Selamat, Pendaftaran anda berhasil,")</script>';
        } else{
            echo '<script>alert("Pendaftaran Gagal.")</script>';
        }
    }
    ?>
    
    <div class="login">
        <img src="assets/img/login-bg.png" alt="image" class="login__bg">

        <form method="post" class="login__form">
            <h1 class="login__title">Register</h1>

            <div class="login__inputs">
                <div class="login__box">
                  <input type="text" name="nama" placeholder="Nama" required class="login__input">
                  <i class="ri-mail-fill"></i>
               </div>
               <div class="login__box">
                  <input type="text" name="username" placeholder="Username" required class="login__input">
                  <i class="ri-mail-fill"></i>
               </div>

               <div class="login__box">
                  <input type="password" name="password" placeholder="Password" required class="login__input">
                  <i class="ri-lock-2-fill"></i>
               </div>
            </div>

            <div class="login__check">
               <div class="login__check-box">
                  <input type="checkbox" class="login__check-input" id="user-check">
                  <label for="user-check" class="login__check-label">Remember me</label>
               </div>


            </div>

            <button type="submit" class="login__button">Register</button>

            <div class="login__register">
               have an account? <a href="login.php">Login</a>
            </div>
         </form>
      </div>

</body>
</html>
