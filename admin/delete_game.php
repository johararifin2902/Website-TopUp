<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id_game'])) {
    $id_game = $_GET['id_game'];

    // Menghapus data game dari database
    $sql = "DELETE FROM game WHERE id_game = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_game);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Game berhasil dihapus.";
    } else {
        $_SESSION['error_message'] = "Gagal menghapus game.";
    }

    $stmt->close();
}

header("Location: add_game_form.php");
exit();
?>
