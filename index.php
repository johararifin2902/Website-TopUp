<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi.php yang berisi koneksi ke database
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="./vendor/slick/slick.css">
   <link rel="stylesheet" href="./vendor/slick/slick-theme.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="img/jrtop-favicon.ico" type="image/x-icon">
   <title>JR Top - Indonesia</title>
</head>

<body>

   <!-- Notification -->
   <div class="notification" id="notif">
      <div class="notification__container">
         <i class="fas fa-bell"></i>
      </div>
   </div>

   <!-- Header -->
   <header class="header">
      <div class="header__container">
         <div class="header__nav">
            <div class="logo">
               <!-- <img src="./img/jrtop-logo.png" class="logo__img" alt="logo"> -->
               <p class="logo__slogan">
                  Cara tercepat dan termudah untuk pembelian kredit permainan.
               </p>
            </div>
            <div class="search">
               <span class="search__icon" id="search-btn">
                  <i class="fas fw fa-search"></i>
               </span>
            </div>
         </div>
         <form class="search-form" id="search-form">
            <div class="search-form__container">
               <input type="text" class="search-form__input" id="input" placeholder="Pencarian game atau voucher">
            </div>
         </form>
      </div>
   </header>

   <!-- Banner -->
   <section class="banner">
      <div class="banner__container">
         <div class="banner__slide">
            <img src="./img/banner/mlbb_50dpromo_id.jpg" class="banner__img" alt="">
         </div>
         <div class="banner__slide">
            <img src="./img/banner/pubg_promo_id.jpg" class="banner__img" alt="">
         </div>
         <div class="banner__slide">
            <img src="./img/banner/msw_promo_id.jpg" class="banner__img" alt="">
         </div>
         <div class="banner__slide">
            <img src="./img/banner/la_promo_id.jpg" class="banner__img" alt="">
         </div>
         <div class="banner__slide">
            <img src="./img/banner/hago_promo_id.jpg" class="banner__img" alt="">
         </div>
      </div>
   </section>

   <!-- Category 1 Category Popular -->
   <section class="category category--1">
      <div class="category__container">
         <h1 class="category__title">Populer</h1>
         <div class="category__product">

         <?php
// Query untuk mengambil data game dari tabel games
$sql = "SELECT * FROM game";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each row
    while ($row = $result->fetch_assoc()) {
        echo '<a href="topupitem.php?id_game=' . $row['id_game'] . '" class="category__product-container">';
        echo "<img src='images/" . htmlspecialchars($row['gambar_game']) . "' class='category__product-img' alt='" . htmlspecialchars($row['nama_game']) . "'>";

        echo '<p class="category__product-title">' . $row['nama_game'] . '</p>';
        echo '</a>';
    }
} else {
    echo '<p>Tidak ada data game yang tersedia.</p>';
}

// Menutup koneksi database
$conn->close();
?>


         </div>
      </div>
   </section>

   <!-- Footer -->
   <footer class="footer">
      <div class="footer__container">
         <div class="footer__logo">
            <!-- <img src="./img/jrtop-logo.png" class="footer__logo-img" alt="logo"> -->
         </div>
         <div class="footer__social">
            <a href="#" class="footer__social-link"><i class="fab fa-facebook"></i></a>
            <a href="#" class="footer__social-link"><i class="fab fa-twitter"></i></a>
            <a href="#" class="footer__social-link"><i class="fab fa-instagram"></i></a>
            <a href="#" class="footer__social-link"><i class="fab fa-youtube"></i></a>
            <a href="login.php">Login</a>
            <a href="logout.php">Logout</a>
            <a href="login-admin.php">Admin</a>
         </div>
      </div>
   </footer>

   <!-- Scripts -->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script src="./vendor/slick/slick.min.js"></script>
   <script src="js/app.js"></script>
</body>

</html>
