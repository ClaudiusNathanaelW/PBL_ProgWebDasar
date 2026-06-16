<?php
$conn = require '../../config.php';
$sql = "SELECT * FROM merch"; 
$result = $conn->query($sql);
include '../layouts/header.php';
include '../layouts/sidebar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>MovieDB - Merch List</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css" />
    <script type="text/javascript" src="../../assets/js/script.js"></script>
</head>
<body>

    <div id="main-container">
        

        <div id="content">

            <div id="transaction-section">
                <h3>MERCH LIST</h3>
                <div style="margin-bottom: 20px;">
                    <div style="float: left;">
                        <input type="text" placeholder="Search" style="padding: 8px 15px; background-color: #E8E2EC; border: none; border-radius: 15px; color: #666;">
                    </div>
                    <div style="float: right;">
                        <a href="add_merch.php" style="text-decoration: none; font-size: 28px; color: #222222; font-weight: bold;">&#8853;</a>
                    </div>
                    <br style="clear: both;" />
                </div>

                <table border="0" cellspacing="0" cellpadding="15" width="100%">
                    <tr>
                        <th align="left">ID Merch</th>
                        <th align="left">ID Movie</th>
                        <th align="left">Nama</th>
                        <th align="center">Harga</th>
                        <th align="center">Stock</th>
                        <th align="center">Action</th>
                    </tr>
                    
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td align="left"><?php echo htmlspecialchars($row['id_merch']); ?></td>
                                <td align="left"><?php echo htmlspecialchars($row['id_movie']); ?></td>
                                <td align="left"><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td align="center"><?php echo htmlspecialchars($row['harga']); ?></td>
                                <td align="center"><?php echo htmlspecialchars($row['stock']); ?></td>
                                <td align="center">
                                    <a href="update_merch.php?id=<?php echo $row['id_merch']; ?>">
                                        <button class="btn-update">Update</button>
                                    </a>
                                    <a href="delete_merch.php?id=<?php echo $row['id_merch']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <button class="btn-delete">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" align="center">Data Merch belum tersedia di database.</td>
                        </tr>
                    <?php endif; ?>
                    
                </table>
            </div>
        </div>
        <br style="clear: both;" />
    </div>

</body>
</html>

<?php
// Tutup koneksi setelah selesai
$conn->close();
?>