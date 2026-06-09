<?php
require 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MovieDB - Home</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"> </head>
<body>
    <div class="top-bg">
        <div class="navbar">
            <div class="nav-left">
                <h1 class="logo-text">MovieDB</h1>
            </div>
            <div class="nav-center">
                <input type="text" class="search-bar" placeholder="Search Movies">
                <input type="button" value="Login" class="btn-black" id="btnOpenLogin" onclick="openLogin()">
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="bottom-bg">
        <div class="categories-container">
            <div class="icon-nav"><img class="arrow" src="assets/img_icon/left_arrow.png" alt="left_arrow"></div>
            <div class="bracket">[</div>
            <div class="category-btn">Comedy</div>
            <div class="category-btn">Fantasy</div>
            <div class="category-btn">Action</div>
            <div class="category-btn">Adventure</div>
            <div class="category-btn">Anime</div>
            <div class="bracket">]</div>
            <div class="icon-nav"><img class="arrow" src="assets/img_icon/right_arrow.png" alt="right_arrow"></div>
            <div class="clear"></div>
        </div>
        
        <div class="article-section">
            <p><b>MovieDB-Baca Ulasan Film Terlengkap & Terpercaya</b></p>
            <br>
            <p>Sedang mencari platform tepercaya untuk membaca ulasan film secara online?<br>
            Tidak perlu mencari lagi selain website kami! Dengan ribuan judul yang terus bertambah, kami menawarkan koleksi ulasan film dan serial TV yang ekstensif untuk semua pecinta sinema. Platform kami menyediakan antarmuka ramah pengguna yang mudah dinavigasi dan dijelajahi, sehingga Anda dapat dengan cepat menemukan ulasan dari judul yang Anda cari sebelum memutuskan untuk menontonnya.</p>
            <br>
            <p>Kami memiliki jangkauan genre dan sub-genre yang sangat luas, memastikan selalu ada tontonan untuk semua orang. Dari berbagai macam genre. Kami selalu memperbarui platform kami dengan film-film baru yang menarik baik yang sedang tayang di bioskop maupun di layanan streaming dan semua artikel kami ditulis dengan analisis yang tajam dan mendalam. Anda tidak akan pernah kecewa dengan kualitas ulasan yang kami sajikan.</p>
            <br>
            <p><b>Aman untuk di gunakan</b><br>
            Kami mengerti betapa menyebalkannya berhadapan dengan iklan pop-up dan gangguan visual saat sedang fokus membaca ulasan. Itulah sebabnya kami memastikan website kami bersih dari iklan pop-up yang mengganggu. Platform kami sepenuhnya aman untuk digunakan, sehingga pengalaman membaca Anda tidak akan terdistraksi oleh hal-hal yang tidak diinginkan.</p>
            <br>
            <p><b>Sepenuhnya Gratis<br></b>
            Website kami sepenuhnya gratis untuk digunakan. Anda tidak perlu mendaftar atau membayar biaya langganan apa pun untuk mengakses koleksi ulasan film kami yang luas.</p>
        </div>
    </div>

    <div id="loginModal" class="modal-overlay">
        <div class="login-box">
            <span class="close-btn" onclick="closeLogin()">&times;</span>
            
            <h1 align="center" class="title-login">Login with Password</h1>
            <form action="login_process.php" method="POST" name="formLogin">
                <p class="form-label-login">Username</p>
                <input type="text" id="username" name="username" class="input-field-login" required>
                
                <p class="form-label-login">Password</p>
                <input type="password" id="password" name="password" class="input-field-login" required>
                
                <p class="links">
                    <a href="reset-password.php" style="color: #2b78e4;">Lupa sandi ?</a><br>
                    <span style="color: white;">Belum punya akun?</span> 
                    <b><a href="register.php" style="color: #2b78e4;">Register</a></b>
                </p>
                <div align="right" style="margin-top: -30px;">
                    <button type="submit" class="btn-login-submit">LOGIN</button>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>