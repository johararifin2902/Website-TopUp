<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi.php yang berisi koneksi ke database

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak ada sesi username, redirect ke halaman login
    header('Location: login.php');
    exit;
}

// Ambil username dari sesi
$username = $_SESSION['username'];

// Ambil id_game dari URL (jika diperlukan)
$id_game = isset($_GET['id_game']) ? $_GET['id_game'] : null;

// Inisialisasi array produk
$products = [];

if ($id_game) {
    // Query untuk mengambil data produk dari tabel produk berdasarkan id_game
    $sql = "SELECT * FROM produk WHERE id_game = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_game);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debugging: Tampilkan informasi query dan hasilnya
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        echo "<p>Error dalam eksekusi query: " . htmlspecialchars($conn->error) . "</p>";
    }
} else {
    echo "<p>ID Game tidak ditemukan.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Top Up Mobile Legends Diamonds</title>
   <link rel="stylesheet" href="style.css">
   <style>
      /* style.css */
      body {
         font-family: sans-serif;
         margin: 0;
         padding: 0;
         background-color: #f2f2f2;
      }

      .container {
         width: 80%;
         margin: 0 auto;
         padding: 20px;
         background-color: #fff;
         border-radius: 5px;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      header {
         background-color: #4CAF50;
         color: #fff;
         padding: 10px 0;
         text-align: center;
         position: relative;
      }

      header img {
         width: 50px;
         height: auto;
         float: left;
         margin-left: 20px;
      }

      header h1 {
         margin: 5px 0 0;
         font-size: 24px;
      }

      main {
         padding: 40px 0;
      }

      h2 {
         text-align: center;
         margin-bottom: 20px;
      }

      .top-up-options {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
      }

      .option {
         width: 200px;
         margin: 10px;
         padding: 15px;
         border: 1px solid #ddd;
         border-radius: 5px;
         text-align: center;
         cursor: pointer;
         transition: background-color 0.3s ease, transform 0.3s ease, border-color 0.3s ease; /* tambahkan border-color untuk animasi */
      }

      .option:hover,
      .option.selected {
         background-color: #f2f2f2;
         transform: scale(1.05); /* perbesar sedikit saat hover atau dipilih */
         border-color: #4CAF50; /* warna border saat dipilih */
      }

      .option img {
         width: 50px;
         height: auto;
         margin-bottom: 10px;
      }

      .option span {
         display: block;
         font-size: 16px;
         margin-bottom: 5px;
      }

      .payment-methods {
         display: flex;
         justify-content: center;
         margin-bottom: 30px;
      }

      .payment-methods img {
         width: 100px;
         height: auto;
         margin: 10px;
         cursor: pointer;
      }

      .top-up-button {
         display: block;
         width: 200px;
         margin: 0 auto;
         padding: 15px 20px;
         background-color: #4CAF50;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }

      .top-up-button:hover {
         background-color: #45a049;
      }

      footer {
         background-color: #4CAF50;
         color: #fff;
         padding: 10px 0;
         text-align: center;
      }

      form {
         display: flex;
         flex-direction: column;
         align-items: center;
         margin-bottom: 20px;
      }

      label {
         margin-bottom: 5px;
      }

      input[type="text"] {
         margin-bottom: 10px;
         padding: 10px;
         width: 100%;
         max-width: 300px;
         border: 1px solid #ddd;
         border-radius: 5px;
      }

      .button {
         padding: 10px 20px;
         background-color: #4CAF50;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }

      .button:hover {
         background-color: #45a049;
      }

      .info {
         text-align: center;
         margin-top: 20px;
         font-size: 14px;
         color: #555;
      }
   </style>
</head>

<body>
   <header>
      <div class="container">
         <img src="logo.png" alt="Mobile Legends Logo">
         <h1>Top Up Mobile Legends Diamonds</h1>
      </div>
   </header>

   <main>
      <div class="container">
         <!-- Form untuk Username -->
         <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
            <h2>Masukkan User ID dan Zone ID</h2>

            <form action="" method="post">
               <label for="userid">User ID:</label>
               <input type="text" id="userid" name="userid" required>

               <label for="zoneid">Zone ID (opsional):</label>
               <input type="text" id="zoneid" name="zoneid">

               <button type="submit" class="button">Masuk</button>
            </form>

            <div class="info">
               Untuk mengetahui User ID Anda, silakan klik menu profile di bagian kiri atas pada menu utama game. User
               ID akan terlihat di bagian bawah Nama Karakter Game Anda. Silakan masukkan User ID Anda untuk
               menyelesaikan transaksi. Contoh: 12345678(1234).
            </div>
         </div>

         <h2>Choose Top Up Amount</h2>
         <div class="top-up-options">
            <?php
            if (!empty($products)) {
               foreach ($products as $product) {
                  echo '<div class="option" onclick="selectTopUp(this, ' . $product['id_produk'] . ', ' . $product['harga_produk'] . ')">';
                  echo '<img src="' . htmlspecialchars($product['gambar_produk']) . '" alt="' . htmlspecialchars($product['nama_produk']) . '">';
                  echo '<span>' . htmlspecialchars($product['nama_produk']) . '</span>';
                  echo '<span>Rp ' . number_format($product['harga_produk'], 0, ',', '.') . '</span>';
                  echo '</div>';
               }
            } else {
               echo '<p>Tidak ada produk yang tersedia untuk game ini.</p>';
            }
            ?>
         </div>

         <h2>Select Payment Method</h2>
         <div class="payment-methods">
            <div id="paymentMethod1" class="payment-method">
               <img src="xl.png" alt="Codashop">
               <div class="payment-method-details">
                  <h3>XL</h3>
                  <p>Bayar dengan mudah melalui Codashop.</p>
                  <span class="payment-method-reward">Tidak tersedia untuk denominasi ini</span>
               </div>
            </div>
            <div id="paymentMethod2" class="payment-method">
               <img src="shoopepay.png" alt="Unipin">
               <div class="payment-method-details">
                  <h3>ShopeePay</h3>
                  <p>Bayar dengan cepat dan aman melalui Unipin.</p>
                  <span class="payment-method-reward">Tidak tersedia untuk denominasi ini</span>
               </div>
            </div>
         </div>

         <!-- Tombol Top Up -->
         <button id="topUpButton" class="top-up-button" onclick="processTopUp()">Top Up Now</button>
      </div>
   </main>

   <!-- Footer -->
   <footer>
      <div class="container">
         <p>&copy; 2024 Mobile Legends</p>
      </div>
   </footer>

   <!-- Script JavaScript -->
   <script>
      // Fungsi untuk memproses top up
      function processTopUp() {
         // Peroleh User ID dan Zone ID dari input form
         let userId = document.getElementById('userid').value;
         let zoneId = document.getElementById('zoneid').value;

         // Peroleh produk yang dipilih (misalnya dari opsi yang memiliki kelas 'selected')
         let selectedOption = document.querySelector('.option.selected');
         let productId = selectedOption ? selectedOption.getAttribute('data-product-id') : null;
         let productName = selectedOption ? selectedOption.getAttribute('data-product-name') : null;
         let productPrice = selectedOption ? selectedOption.getAttribute('data-product-price') : null;

         // Peroleh metode pembayaran yang dipilih
         let paymentMethod = document.querySelector('.payment-method.selected');
         let paymentMethodName = paymentMethod ? paymentMethod.querySelector('h3').textContent : null;

         // Lakukan validasi, contoh:
         if (!userId || !productId || !productPrice || !paymentMethodName) {
            alert('Mohon lengkapi semua informasi sebelum melanjutkan!');
            return;
         }

         // Contoh implementasi:
         console.log('User ID:', userId);
         console.log('Zone ID:', zoneId);
         console.log('Produk yang dipilih:', productName, 'dengan ID', productId, 'dan harga', productPrice);
         console.log('Metode pembayaran yang dipilih:', paymentMethodName);

         // Lanjutkan dengan proses top up, misalnya dengan AJAX ke backend atau integrasi ke sistem pembayaran
         // Contoh:
         // fetch('process_topup.php', {
         //    method: 'POST',
         //    body: JSON.stringify({
         //       userId: userId,
         //       zoneId: zoneId,
         //       productId: productId,
         //       productName: productName,
         //       productPrice: productPrice,
         //       paymentMethodName: paymentMethodName
         //    }),
         //    headers: {
         //       'Content-Type': 'application/json'
         //    }
         // })
         // .then(response => response.json())
         // .then(data => {
         //    console.log('Response from server:', data);
         //    // Handle response dari server
         // })
         // .catch(error => {
         //    console.error('Error:', error);
         //    // Handle error
         // });
      }

      // Fungsi untuk memilih opsi top up
      function selectTopUp(element, productId, productPrice) {
         // Hapus kelas 'selected' dari semua elemen
         let allOptions = document.querySelectorAll('.option');
         allOptions.forEach(option => {
            option.classList.remove('selected');
         });

         // Tambahkan kelas 'selected' ke elemen yang dipilih
         element.classList.add('selected');

         // Perbarui teks pada setiap opsi pembayaran sesuai dengan harga produk yang dipilih
         document.getElementById('paymentMethod1').querySelector('.payment-method-reward').textContent = 'Harga produk yang dipilih: Rp ' + number_format(productPrice, 0, ',', '.');
         document.getElementById('paymentMethod2').querySelector('.payment-method-reward').textContent = 'Harga produk yang dipilih: Rp ' + number_format(productPrice, 0, ',', '.');

         // Contoh implementasi: Anda dapat menambahkan logika untuk menangani pemilihan top up di sini
         console.log('Pilih Top Up dengan ID Produk ' + productId + ' dan harga Rp ' + productPrice);
      }

      // Fungsi untuk format angka ke format mata uang
      function number_format(number, decimals, dec_point, thousands_sep) {
         number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
         let n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
               let k = Math.pow(10, prec);
               return '' + Math.round(n * k) / k;
            };
         // Fix untuk angka yang sangat kecil (misalnya: 0.00000001) yang dihasilkan toFixed memberikan hasil yang tidak diharapkan
         s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
         if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
         }
         if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
         }
         return s.join(dec);
      }
   </script>
</body>

</html>

