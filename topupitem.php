<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi.php yang berisi koneksi ke database

// Ambil id_game dari URL
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
         transition: background-color 0.3s ease, transform 0.3s ease, border-color 0.3s ease;
         /* tambahkan border-color untuk animasi */
      }

      .option:hover,
      .option.selected {
         background-color: #f2f2f2;
         transform: scale(1.05);
         /* perbesar sedikit saat hover atau dipilih */
         border-color: #4CAF50;
         /* warna border saat dipilih */
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

      /* Tambahkan gaya untuk item yang dipilih */
      .option.selected {
         background-color: #f2f2f2;
         transform: scale(1.05);
         border-color: #4CAF50;
      }

      .payment-method {
         width: 150px;
         margin: 10px;
         padding: 15px;
         border: 1px solid #ddd;
         border-radius: 5px;
         text-align: center;
         cursor: pointer;
         transition: background-color 0.3s ease, border-color 0.3s ease;
      }

      .payment-method.selected {
         background-color: #f2f2f2;
         border-color: #4CAF50;
      }

      .payment-method img {
         width: 50px;
         height: auto;
         margin-bottom: 10px;
      }

      .payment-method h3 {
         margin: 10px 0;
      }

      .payment-method p {
         margin: 5px 0;
      }

      .payment-method .payment-method-reward {
         margin-top: 10px;
         font-size: 12px;
         color: #777;
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
         <!-- Tambahkan form input untuk User ID dan Zone ID -->
         <div class="container">
            <h1>Masukkan User ID</h1>


            <form action="" method="post">
               <label for="username">Username:</label>
               <input type="text" id="username" name="username"
                  value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>"
                  readonly required>


               <label for="userid">User ID:</label>
               <input type="text" id="userid" name="userid" required>

               <label for="zoneid">Zone ID (opsional):</label>
               <input type="text" id="zoneid" name="zoneid">

            </form>

            <div class="info">
               Untuk mengetahui User ID Anda, silakan klik menu profile di bagian kiri atas pada menu utama game. User
               ID akan terlihat di bagian bawah Nama Karakter Game Anda. Silakan masukkan User ID Anda untuk
               menyelesaikan transaksi. Contoh: 12345678(1234).
            </div>
         </div>

         <!-- Tampilkan username yang telah login -->
         <?php if (isset($_SESSION['username'])): ?>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
         <?php endif; ?>

         <h2>Choose Top Up Amount</h2>
         <!-- Bagian HTML untuk menampilkan opsi top up -->
<div class="top-up-options">
    <?php
    if (!empty($products)) {
        foreach ($products as $product) {
            echo '<div class="option" data-id="' . $product['id_produk'] . '" data-harga="' . $product['harga_produk'] . '" onclick="selectTopUp(this, ' . $product['id_produk'] . ', ' . $product['harga_produk'] . ')">';
            echo '<img src="images/' . htmlspecialchars($product['gambar_produk']) . '" alt="' . htmlspecialchars($product['nama_produk']) . '">';

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
            <div id="paymentMethod1" class="payment-method" onclick="selectPaymentMethod(this, 1)">
               <img src="xl.png" alt="XL">
               <div class="payment-method-details">
                  <h3>XL</h3>
                  <p>Bayar dengan mudah melalui XL.</p>
                  <span class="payment-method-reward">Tidak tersedia untuk denominasi ini</span>
               </div>
            </div>
            <div id="paymentMethod2" class="payment-method" onclick="selectPaymentMethod(this, 2)">
               <img src="shoopepay.png" alt="ShopeePay">
               <div class="payment-method-details">
                  <h3>ShopeePay</h3>
                  <p>Bayar dengan cepat dan aman melalui ShopeePay.</p>
                  <span class="payment-method-reward">Tidak tersedia untuk denominasi ini</span>
               </div>
            </div>
            <div id="paymentMethod3" class="payment-method" onclick="selectPaymentMethod(this, 3)">
               <img src="gopay.png" alt="Metode Pembayaran 3">
               <div class="payment-method-details">
                  <h3>Gopay</h3>
                  <p>Bayar dengan cepat dan aman melalui Gopay.</p>
                  <span class="payment-method-reward">Tidak tersedia untuk denominasi ini</span>
               </div>
            </div>
            <div id="paymentMethod4" class="payment-method" onclick="selectPaymentMethod(this, 4)">
               <img src="dana.png" alt="Metode Pembayaran 4">
               <div class="payment-method-details">
                  <h3>Dana</h3>
                  <p>Bayar dengan cepat dan aman melalui Dana.</p>
                  <span class="payment-method-reward">Tidak tersedia untuk denominasi ini</span>
               </div>
            </div>

         </div>


         <!-- Tombol untuk proses top up -->
         <button class="top-up-button" onclick="topUpNow()">Top Up Now</button>


      </div>
   </main>
   <footer>
      <div class="container">
         <p>&copy; 2024 Mobile Legends</p>
      </div>
   </footer>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script>




      function selectTopUp(element, idProduk, hargaProduk) {
         // Hapus kelas 'selected' dari semua elemen
         let allOptions = document.querySelectorAll('.option');
         allOptions.forEach(option => {
            option.classList.remove('selected');
         });
         // Tambahkan kelas 'selected' ke elemen yang dipilih
         element.classList.add('selected');

         // Perbarui teks pada setiap opsi pembayaran sesuai dengan harga produk yang dipilih
         document.getElementById('paymentMethod1').querySelector('.payment-method-reward').textContent = 'Harga produk yang dipilih: Rp ' + number_format(hargaProduk, 0, ',', '.');

         document.getElementById('paymentMethod2').querySelector('.payment-method-reward').textContent = 'Harga produk yang dipilih: Rp ' + number_format(hargaProduk, 0, ',', '.');

         document.getElementById('paymentMethod3').querySelector('.payment-method-reward').textContent = 'Harga produk yang dipilih: Rp ' + number_format(hargaProduk, 0, ',', '.');

         document.getElementById('paymentMethod4').querySelector('.payment-method-reward').textContent = 'Harga produk yang dipilih: Rp ' + number_format(hargaProduk, 0, ',', '.');

         // Contoh implementasi: Anda dapat menambahkan logika untuk menangani pemilihan top up di sini
         console.log('Pilih Top Up dengan ID Produk ' + idProduk + ' dan harga Rp ' + hargaProduk);
         // Misalnya, simpan idProduk dan hargaProduk dalam variabel JavaScript untuk penggunaan selanjutnya
         // Contoh:
         // document.getElementById('selectedProductId').value = idProduk;
         // document.getElementById('selectedProductPrice').value = hargaProduk;
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
      // Fungsi untuk memilih metode pembayaran
      function selectPaymentMethod(element, methodId) {
         // Hapus kelas 'selected' dari semua elemen metode pembayaran
         let allMethods = document.querySelectorAll('.payment-method');
         allMethods.forEach(method => {
            method.classList.remove('selected');
         });

         // Tambahkan kelas 'selected' ke elemen yang dipilih
         element.classList.add('selected');

         // Simpan methodId dalam variabel JavaScript atau input tersembunyi jika diperlukan
         document.getElementById('selectedPaymentMethod').value = methodId;

         // Contoh implementasi: Anda dapat menambahkan logika untuk menangani pemilihan metode pembayaran di sini
         console.log('Pilih Metode Pembayaran dengan ID: ' + methodId);
      }


      <!-- Bagian JavaScript untuk menangani top up -->

      function topUpNow() {
    // Ambil nilai dari form input
    var userId = document.getElementById('userid').value;
    var zoneId = document.getElementById('zoneid').value;
    var selectedProductId = document.querySelector('.option.selected').getAttribute('data-id');
    var selectedPaymentMethodId = document.querySelector('.payment-method.selected').getAttribute('data-method-id');

    // Cari nama produk yang dipilih
    var selectedProductName = document.querySelector('.option.selected span:nth-of-type(1)').textContent;
    // Cari nama metode pembayaran yang dipilih
    var selectedPaymentMethodName = document.querySelector('.payment-method.selected h3').textContent;

    // Simpan harga produk yang dipilih
    var hargaProduk = document.querySelector('.option.selected').getAttribute('data-harga');

    // Siapkan data untuk dikirim ke server
    var transactionData = {
        userId: userId,
        zoneId: zoneId,
        selectedProductId: selectedProductId,
        selectedPaymentMethodId: selectedPaymentMethodId,
        selectedProductName: selectedProductName,
        selectedPaymentMethodName: selectedPaymentMethodName,
        hargaProduk: hargaProduk
    };

    // Kirim data ke server menggunakan AJAX
    $.ajax({
        type: "POST",
        url: "save_transaction.php", // Ganti dengan file PHP yang akan menyimpan data ke database
        data: transactionData,
        success: function(response) {
            // Tampilkan pesan sukses atau lakukan sesuatu setelah penyimpanan berhasil
            console.log('Transaksi berhasil disimpan ke database.');
            alert('Transaksi berhasil disimpan ke database.');

            // Redirect ke halaman detail transaksi dengan menyertakan ID transaksi
            window.location.href = 'detail_transaksi.php?id_transaksi=' + response;
        },
        error: function(error) {
            // Tampilkan pesan error atau lakukan sesuatu jika terjadi kesalahan
            console.error('Terjadi kesalahan saat menyimpan transaksi:', error);
            alert('Terjadi kesalahan saat menyimpan transaksi.');
        }
    });
}





   </script>


</body>

</html>