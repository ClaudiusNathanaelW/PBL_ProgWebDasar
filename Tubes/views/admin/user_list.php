<?php
session_start();
$conn = require '../../config.php'; 

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$query = "SELECT * FROM users ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<?php include '../layouts/header.php'; ?>
<?php include '../layouts/sidebar.php'; ?>

        <div id="content">
            <div id="transaction-section">
                <h3>USER LIST</h3>
                <div style="margin-bottom: 20px;">
                    <div style="float: right;">
                        <a href="#" style="text-decoration: none; font-size: 28px; color: #222222; font-weight: bold;"></a>
                    </div>
                    <br style="clear: both;" />
                </div>

                <table border="0" cellspacing="0" cellpadding="15" width="100%">
                    <tr>
                        <th align="left">ID User</th>
                        <th align="left">Nama (Username)</th>
                        <th align="left">Email</th>
                        <th align="center">Tanggal Daftar</th>
                        <th align="center">Role</th>
                        <th align="center">Action</th>
                    </tr>
                    
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id_user'] ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td align="center"><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                            <td align="center">
                                <span class="<?= ($row['role'] == 'admin') ? 'status-active' : 'status-inactive' ?>">
                                    <?= strtoupper($row['role']) ?>
                                </span>
                            </td>
                            <td align="center">
                                <button class="btn-ban">BAN</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" align="center">Belum ada user yang terdaftar.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <br style="clear: both;" />
    </div> </body>
</html>