<?php
require 'config.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_reset'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM users WHERE username = ?";
    $stmt_check = mysqli_prepare($conn, $check_query);
    
    if (!$stmt_check) {
        die("Error pada Check Query: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt_check, "s", $username);
    mysqli_stmt_execute($stmt_check);
    $result = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result) > 0) {
        $update_query = "UPDATE users SET password = ? WHERE username = ?";
        $stmt_update = mysqli_prepare($conn, $update_query);
        
        if (!$stmt_update) {
            die("Error pada Update Query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt_update, "ss", $new_password, $username);
        
        if (mysqli_stmt_execute($stmt_update)) {
            $message = "<p style='color: #4CAF50; text-align: center; margin-bottom: 15px;'>Password berhasil di-reset! Silakan <a href='index.php' style='color:#2b78e4;'>Login</a>.</p>";
        } else {
            $message = "<p style='color: #ff4d4d; text-align: center; margin-bottom: 15px;'>Gagal mengubah password.</p>";
        }
    } else {
        $message = "<p style='color: #ff4d4d; text-align: center; margin-bottom: 15px;'>Username tidak ditemukan!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieDB - Reset Password</title>
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
        <h1 align="center" class="title-register">Reset Password</h1>
        
        <?= $message ?>

        <form action="reset-password.php" method="POST" name="formReset">
             <p class="form-label-reg">Username</p>
            <input type="text" name="username" class="input-field-reg" required placeholder="Masukkan Username Anda">
            
            <p class="form-label-reg">New Password</p>
            <input type="password" name="new_password" class="input-field-reg" required placeholder="Masukkan Sandi Baru">
            
            <div align="center" style="margin-top: 40px;">
                <button type="submit" name="btn_reset" class="btn-teal" style="font-size: 20px; font-weight: bold; padding: 10px 30px; border-radius: 8px; cursor: pointer; border: none; color: white;">RESET PASSWORD</button>
            </div>
        </form>
    </main>
</body>
</html>