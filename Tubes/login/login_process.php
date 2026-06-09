<?php
require 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die("Terjadi Kesalahan pada Database: " . mysqli_error($conn) . "<br>Cek kembali nama tabel dan kolom di phpMyAdmin Anda.");
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['user_id'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            
            header("Location: welcome.php");
            exit;
        } else {
            echo "<script>alert('Password Salah!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='index.php';</script>";
    }
}
?>