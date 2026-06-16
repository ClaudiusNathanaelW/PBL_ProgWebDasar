<?php
session_start();
$conn = require '../../config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$query = "SELECT m.id_movie, m.title, m.created_at, GROUP_CONCAT(g.genre_name SEPARATOR ', ') AS genres 
          FROM movies m 
          LEFT JOIN movie_genres mg ON m.id_movie = mg.id_movie 
          LEFT JOIN genres g ON mg.id_genre = g.id_genre 
          GROUP BY m.id_movie 
          ORDER BY m.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/sidebar.php'; ?>

        <div id="content">
            <div id="transaction-section">
                <h3>MOVIE LIST</h3>
                <div style="margin-bottom: 20px;">
                    <div style="float: left;">
                        <input type="text" placeholder="Search" style="padding: 8px 15px; background-color: #E8E2EC; border: none; border-radius: 15px; color: #666;">
                    </div>
                    <div style="float: right;">
                        <a href="add_movie.php" style="text-decoration: none; font-size: 28px; color: #222222; font-weight: bold;">&#8853;</a>
                    </div>
                    <br style="clear: both;" />
                </div>

                <table border="0" cellspacing="0" cellpadding="15" width="100%">
                    <tr>
                        <th align="left">ID Movie</th>
                        <th align="left">Judul Film</th>
                        <th align="center">Genre</th>
                        <th align="center">Tanggal Rilis</th>
                        <th align="center">Action</th>
                    </tr>
                    
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id_movie'] ?></td>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td align="center"><?= $row['genres'] ? htmlspecialchars($row['genres']) : 'Belum ada genre' ?></td>
                            <td align="center"><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                            <td align="center">
                                <button class="btn-update">Update</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" align="center">Belum ada daftar film.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <br style="clear: both;" />
    </div> </body>
</html>