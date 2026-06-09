<?php
require 'config.php';

$query_movies = "SELECT id_movie, title, poster_url FROM movies ORDER BY release_date DESC";
$result_movies = mysqli_query($conn, $query_movies);

if (!$result_movies) {
    die("Terjadi Kesalahan Database pada welcome.php: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MovieDB</title>
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body>
    <header class="navbar">
        <div class="nav-left">
            <a href="index.php" class="back-btn"> MovieDB</a>
        </div>
        
        <div class="nav-center">
            <input type="text" class="search-bar" placeholder="Search Movies">
        </div>
        <div class="nav-right">
            <?php if (isset($_SESSION['username'])): ?>
                <span style="color: white; margin-right: 10px;">Hi, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="index.php" class="btn-black" style="text-decoration:none; padding:5px 10px; border-radius:5px;">Logout</a>
            <?php else: ?>
                <button class="btn-black" onclick="window.location.href='index.php'">Login</button>
            <?php endif; ?>
            
            <div class="user-avatar" onclick="window.location.href='profile.php'" style="cursor: pointer;">&#128100;</div>
        </div>
        <div class="clear"></div>
    </header>

    <section class="hero-welcome">
        <div class="welcome-overlay"></div>
        <h1 class="welcome-text">WELCOME</h1>
        
        <div class="hero-posters">
            <img src="" alt="Movie 3">
            <img src="" alt="Movie 4">
        </div>
    </section>

    <div class="slider-wrapper">
        <button class="slide-btn left-btn" onclick="slideLeft()">&#10094;</button>
        <main class="movie-catalog" id="movieSlider">
            
            <?php
            if (mysqli_num_rows($result_movies) > 0) {
                while ($movie = mysqli_fetch_assoc($result_movies)) {
                    $poster = !empty($movie['poster_url']) ? $movie['poster_url'] : 'poster-placeholder.jpg';
            ?>
                    <div class="movie-card">
                        <a href="movie_review.php?id=<?= $movie['id_movie'] ?>" style="text-decoration: none; color: inherit;">
                            <img src="assets/assets/img_movie/<?= htmlspecialchars($poster) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                            <h4><?= htmlspecialchars($movie['title']) ?></h4>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "<p style='color:white; margin: 20px;'>Belum ada film di database. Silakan isi data ke tabel 'movies' di phpMyAdmin.</p>";
            }
            ?>
            
        </main>
        <button class="slide-btn right-btn" onclick="slideRight()">&#10095;</button>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>