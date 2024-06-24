<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Delete record from database
    $sql = "DELETE FROM produk WHERE id_produk = '$id_produk'";
    if ($conn->query($sql) === TRUE) {
        // Set notification message
        $_SESSION['success_message'] = "Data produk berhasil dihapus";
    } else {
        $_SESSION['error_message'] = "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    $_SESSION['error_message'] = "ID produk tidak disediakan.";
}

// Redirect back to tables.php
header("Location: tables.php");
exit();
?>
