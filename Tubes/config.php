<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "db_movie";

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        throw new Exception("Koneksi Database Gagal: " . mysqli_connect_error());
    }

    return $conn;
} catch (Exception $e) {
    die($e->getMessage());
}