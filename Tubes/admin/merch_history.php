<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$query = "SELECT i.id_invoice, u.username, SUM(id.quantity) AS total_qty, i.created_at, i.payment_status 
          FROM invoices i 
          JOIN users u ON i.id_user = u.id_user 
          LEFT JOIN invoice_details id ON i.id_invoice = id.id_invoice 
          GROUP BY i.id_invoice 
          ORDER BY i.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

        <div id="content">
            <div id="transaction-section">
                <h3>MERCH TRANSACTION HISTORY</h3>
                <br>
                <table border="0" cellspacing="0" cellpadding="15" width="100%">
                    <tr>
                        <th align="left">ID Transaction</th>
                        <th align="left">Nama Pembeli</th>
                        <th align="center">Total Qty</th>
                        <th align="center">Tanggal</th>
                        <th align="center">Status</th>
                    </tr>
                    
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>#INV-<?= str_pad($row['id_invoice'], 4, '0', STR_PAD_LEFT) ?></td>
                            <td><b><?= htmlspecialchars($row['username']) ?></b></td>
                            <td align="center"><?= $row['total_qty'] ? $row['total_qty'] : 0 ?> items</td>
                            <td align="center"><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                            <td align="center">
                                <?php 
                                    $statusClass = '';
                                    if ($row['payment_status'] == 'Paid') $statusClass = 'status-paid';
                                    elseif ($row['payment_status'] == 'Pending') $statusClass = 'status-active';
                                    else $statusClass = 'status-inactive'; 
                                ?>
                                <span class="<?= $statusClass ?>"><?= $row['payment_status'] ?></span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" align="center">Belum ada transaksi pembelian merchandise.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <br style="clear: both;" />
    </div> </body>
</html>