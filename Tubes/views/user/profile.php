<?php
session_start();
$conn = require '../../config.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);

    $update_query = "UPDATE users SET nama='$nama', telp='$telp', alamat='$alamat', bio='$bio' WHERE username='$username'";
    
    if (mysqli_query($conn, $update_query)) {
        $pesan = "<p style='color: #4CAF50; text-align: center; margin-bottom: 15px;'>Profil berhasil diperbarui!</p>";
    } else {
        $pesan = "<p style='color: red; text-align: center; margin-bottom: 15px;'>Gagal memperbarui profil: " . mysqli_error($conn) . "</p>";
    }
}

$query_user = "SELECT * FROM users WHERE username='$username'";
$result_user = mysqli_query($conn, $query_user);
$user_data = mysqli_fetch_assoc($result_user);
?>

<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <main class="profile-container">
        <div class="avatar-section">
            <a href="profile.php" style="text-decoration: none; display: block; cursor: pointer;">
                <div class="avatar-circle">
                    <i class="far fa-user"></i>
                </div>
            </a>
        </div>

        <?= $pesan ?>

        <form id="profileForm" method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($user_data['nama'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="telp">No Telp</label>
                <input type="tel" id="telp" name="telp" value="<?= htmlspecialchars($user_data['telp'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="<?= htmlspecialchars($user_data['alamat'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea id="bio" name="bio" rows="4"><?= htmlspecialchars($user_data['bio'] ?? '') ?></textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="save-btn">Save</button>
            </div>
        </form>

        <div id="viewProfile" class="hidden">
            <div class="info-row">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-box" id="res-nama"><?= htmlspecialchars($user_data['nama'] ?? '') ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">No Telp</div>
                <div class="info-box" id="res-telp"><?= htmlspecialchars($user_data['telp'] ?? '') ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Alamat</div>
                <div class="info-box" id="res-alamat"><?= htmlspecialchars($user_data['alamat'] ?? '') ?></div>
            </div>
            <div class="info-row align-top">
                <div class="info-label">Bio</div>
                <div class="info-box bio-box" id="res-bio"><?= nl2br(htmlspecialchars($user_data['bio'] ?? '')) ?></div>
            </div>
        </div>
    </main>

    </div> 
    <script src="assets/js/profile.js"></script>
</body>
</html>