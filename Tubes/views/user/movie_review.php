<?php
$conn = require '../../config.php'; 

$id_movie = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$query_movie = "SELECT * FROM movies WHERE id_movie = ?";
$stmt = mysqli_prepare($conn, $query_movie);

if (!$stmt) {
    die("Terjadi Kesalahan Database pada movie_review.php: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id_movie);
mysqli_stmt_execute($stmt);
$result_movie = mysqli_stmt_get_result($stmt);
$movie = mysqli_fetch_assoc($result_movie);

if (!$movie) {
    die("<h1 style='text-align:center; margin-top:50px;'>Maaf, Film tidak ditemukan!</h1>");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($movie['title']) ?> - MovieDB</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/movie_review.css"> </head>
<body class="bg-cream">

    <div class="navbar">
        <div class="nav-left">
            <a href="welcome.php" class="back-btn"> MovieDB</a>
        </div>
        <div class="nav-center">
            <input type="text" class="search-bar" placeholder="Search Movies">
        </div>
        <div class="nav-right">
            <button class="btn-black" onclick="window.location.href='index.php'">Login</button>
            <div class="user-avatar">&#128100;</div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="container">
        
        <div class="movie-hero">
            <div class="poster-col">
                <img src="../../assets/img_movie/<?= htmlspecialchars($movie['poster_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>" style="width: 100%;">
            </div>
            
            <div class="details-col">
                <div class="title-section">
                    <h1 class="movie-title"><?= htmlspecialchars($movie['title']) ?></h1>
                    <div class="rating-box">
                        <h2>4.5 / 5</h2>
                    </div>
                    <div class="clear"></div>
                </div>

                <h3 class="subtitle">Sinopsis</h3>
                <p class="synopsis">
                    <?= nl2br(htmlspecialchars($movie['description'])) ?>
                </p>

                <div class="action-buttons">
                    <button class="btn-action btn-trailer">&#127916;</button>
                    <button class="btn-action btn-gallery">&#128444;</button>
                    <button class="btn-action btn-merch">&#128085;</button>
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="reviews-section">
            <h1 class="review-title">Reviews</h1>

            <?php
            $query_reviews = "
                SELECT r.review_text, r.rating, u.username 
                FROM reviews r 
                JOIN users u ON r.id_user = u.id_user 
                WHERE r.id_movie = ? 
                ORDER BY r.id_review DESC";
                
            $stmt_rev = mysqli_prepare($conn, $query_reviews);
            mysqli_stmt_bind_param($stmt_rev, "i", $id_movie);
            mysqli_stmt_execute($stmt_rev);
            $reviews = mysqli_stmt_get_result($stmt_rev);

            if (mysqli_num_rows($reviews) > 0) {
                while ($row = mysqli_fetch_assoc($reviews)) {
            ?>
                <div class="review-card">
                    <p class="review-text">"<?= htmlspecialchars($row['review_text']) ?>"</p>
                    <div class="review-user">
                        <div class="user-pic bg-blue"></div>
                        <div class="user-info">
                            <strong><?= htmlspecialchars($row['username']) ?></strong><br>
                            <span>Rating: <?= htmlspecialchars($row['rating']) ?> / 5</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php 
                }
            } else {
                echo "<p style='color: #fff;'>Belum ada review untuk film ini. Jadilah yang pertama memberikan ulasan!</p>";
            }
            ?>
        </div>
    </div>
    <script src="../../assets/js/script.js"></script>

    <script src="../../assets/js/movie_review.js"></script>
</body>
</html>