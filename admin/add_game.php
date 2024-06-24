<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama_game = $_POST['nama_game'];
    $gambar_game = $_FILES['gambar_game']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES['gambar_game']['name']);

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES['gambar_game']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO game (nama_game, gambar_game) VALUES ('$nama_game', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "Game added successfully";
        } else {
            $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $_SESSION['error_message'] = "Sorry, there was an error uploading your file.";
    }
    header("Location: add_game_form.php");
    exit();
}
?>

