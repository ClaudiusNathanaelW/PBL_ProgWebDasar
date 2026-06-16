<?php
$conn = require_once '../../config.php';

$sql_film = "SELECT COUNT(id_movie) AS total_film FROM movies";
$result_film = mysqli_query($conn, $sql_film);
$total_film = ($result_film && mysqli_num_rows($result_film) > 0) ? mysqli_fetch_assoc($result_film)['total_film'] : 0;

$sql_user = "SELECT COUNT(id_user) AS total_user FROM users WHERE role = 'user'";
$result_user = mysqli_query($conn, $sql_user);
$total_user = ($result_user && mysqli_num_rows($result_user) > 0) ? mysqli_fetch_assoc($result_user)['total_user'] : 0;

$sql_trx = "SELECT 
                i.id_invoice, 
                u.username as nama_pembeli, 
                SUM(id.quantity) as total_qty, 
                DATE(i.created_at) as tanggal, 
                i.payment_status 
            FROM invoices i
            JOIN users u ON i.id_user = u.id_user
            JOIN invoice_details id ON i.id_invoice = id.id_invoice
            GROUP BY i.id_invoice
            ORDER BY i.created_at DESC 
            LIMIT 5";
$result_trx = mysqli_query($conn, $sql_trx);

include '../layouts/header.php';
include '../layouts/sidebar.php';
?>


<link rel="stylesheet" href="../../assets/css/admin_dashboard.css">

<div id="content">
    
    <div id="summary-cards">
        <div class="card">
            <p class="card-title">Total Film</p>
            <div class="card-body" style="white-space: nowrap;">
                <span class="card-icon" style="display: inline-block; vertical-align: middle; margin-right: 10px;">
                    <img src="../../assets/img_icon/movie.png" alt="Movie Icon" style="width: 36px; height: auto;">
                </span>
                <span class="card-value" style="display: inline-block; vertical-align: middle;"><?php echo $total_film; ?></span>
            </div>
        </div>
        
        <div class="card">
            <p class="card-title">Total Active User</p>
            <div class="card-body" style="white-space: nowrap;">
                <span class="card-icon" style="display: inline-block; vertical-align: middle; margin-right: 10px;">
                    <img src="../../assets/img_icon/user.png" alt="User Icon" style="width: 36px; height: auto;">
                </span>
                <span class="card-value" style="display: inline-block; vertical-align: middle;"><?php echo $total_user; ?></span>
            </div>
        </div>
        <br style="clear: both;" />
    </div>

    <div id="transaction-section">
        <h3>Merch Transaction History</h3>
        <br>
        <table border="0" cellspacing="0" cellpadding="15" width="100%">
            <tr>
                <th align="left">ID Transaction</th>
                <th align="left">Nama</th>
                <th align="center">Qty</th>
                <th align="center">Tanggal</th>
                <th align="center">Status</th>
            </tr>
            
            <?php if ($result_trx && mysqli_num_rows($result_trx) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result_trx)): ?>
                    <tr>
                        <td>TRX-<?php echo str_pad($row['id_invoice'], 3, '0', STR_PAD_LEFT); ?></td>
                        <td><b><?php echo htmlspecialchars($row['nama_pembeli']); ?></b></td>
                        <td align="center"><?php echo $row['total_qty']; ?></td>
                        <td align="center"><?php echo $row['tanggal']; ?></td>
                        <td align="center">
                            <?php 
                                $status = $row['payment_status'];
                                $color = ($status == 'Paid') ? 'green' : (($status == 'Pending') ? 'orange' : 'red');
                            ?>
                            <span class="status-paid" style="color: <?php echo $color; ?>; font-weight: bold;">
                                <?php echo $status; ?>
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" align="center">Belum ada transaksi dijumpai.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
    
</div>

<br style="clear: both;" />
</div> 

</body>
</html>