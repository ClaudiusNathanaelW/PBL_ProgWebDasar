<?php
require 'config.php';
$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt_check = mysqli_prepare($conn, $check_query);
    
    if (!$stmt_check) {
        die("Error pada Check Query: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt_check, "ss", $username, $email);
    mysqli_stmt_execute($stmt_check);
    $result = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result) > 0) {
        $message = "<p style='color: #ff4d4d; text-align: center; margin-bottom: 15px;'>Username atau Email sudah terdaftar!</p>";
    } else {
        $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $insert_query);
        
        if (!$stmt_insert) {
            die("Error pada Insert Query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt_insert, "sss", $username, $email, $password);
        
        if (mysqli_stmt_execute($stmt_insert)) {
            $message = "<p style='color: #4CAF50; text-align: center; margin-bottom: 15px;'>Registrasi Berhasil! Silakan <a href='index.php' style='color:#2b78e4;'>Login</a>.</p>";
        } else {
            $message = "<p style='color: #ff4d4d; text-align: center; margin-bottom: 15px;'>Terjadi kesalahan server.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieDB - Register</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"> </head>
<body class="bg-register">
    
    <header class="navbar">
        <div class="nav-left">
            <h1 class="logo-text">MovieDB</h1>
        </div>
        <div class="nav-center">
            <input type="text" class="search-bar" placeholder="Search Movies">
        </div>
        <div class="nav-right">
            <button type="button" class="btn-black" onclick="window.location.href='index.php'">Login</button>
        </div>
        <div class="clear"></div>
    </header>
    
    <main class="register-box">
        <h1 align="center" class="title-register">Welcome to the Community!</h1>
        
        <?= $message ?>

        <form action="register.php" method="POST" name="formRegister">
            <p class="form-label-reg">Username</p>
            <input type="text" name="username" class="input-field-reg" required>
            
            <p class="form-label-reg">Email</p>
            <input type="email" name="email" class="input-field-reg" required>
            
            <p class="form-label-reg">Password</p>
            <input type="password" name="password" class="input-field-reg" required>
            
            <div align="center" style="margin-top: 40px;">
                <button type="submit" name="btn_register" class="btn-teal" style="font-size: 20px; font-weight: bold; padding: 10px 30px; border-radius: 8px; cursor: pointer; border: none; color: white;">REGISTER</button>
            </div>
        </form>
    </main>
</body>
</html>