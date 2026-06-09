<?php
session_start();
$nama_produk  = isset($_POST['nama_item']) ? $_POST['nama_item'] : "Belum Ada Produk";
$harga_satuan = isset($_POST['harga_item']) ? $_POST['harga_item'] : 0;
$jumlah_beli  = isset($_POST['qty_item']) ? $_POST['qty_item'] : 0;

$subtotal = $harga_satuan * $jumlah_beli;
$tax      = $subtotal * 0.11; 
$total    = $subtotal + $tax;

function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pembayaran MovieDB</title>
<link rel="stylesheet" href="assets/pembayaran.css">
<script src="assets/pembayaran.js"></script>
</head>

<body class="pembayaran-page">

<body class="bg-cream">
    <div class="navbar">
        <div class="nav-left">
            <a href="welcome.php" class="back-btn">←</a>
            <h1 class="logo-text">MovieDB</h1>
        </div>

        <div class="nav-center">
            <input type="text" class="search-bar" placeholder="🔍 Search Movies">
        </div>

        <div class="nav-right">
            <button class="btn-black">Login</button>
            <span class="profile-icon">👤</span>
        </div>
            <div class="clear"></div>
        </div>

<div class="checkout-container clearfix">
    <div class="checkout-card">
        <div class="alamat-header clearfix">
            <h3 style="float: left; margin: 0;">Alamat Pengiriman</h3>
            <button 
                class="btn-ubah-alamat" 
                onclick="bukaModalAlamat()" 
                style="float: right;">
                Ubah Alamat
            </button>
        </div>

        <div style="position: relative; margin-top: 15px;">
            <span 
                id="btn-hapus-alamat" 
                class="hapus-alamat-x" 
                onclick="clearAlamat()">
                ✕
            </span>

            <div id="alamat-konten" class="alamat-box">
                <p class="placeholder-text">
                    Belum ada alamat pengiriman
                </p>
            </div>
        </div>
    </div>

    <div class="payment-wrapper clearfix">

        <div class="col-kiri">
            <div class="checkout-card ringkasan-card">
                <h3>Ringkasan Pesanan</h3>

                <?php
                $items = explode(',', $nama_produk);

                foreach($items as $item){
                ?>
                    <div class="produk-item clearfix">
                        <span style="float:left;">
                            <?php echo trim($item); ?>
                        </span>

                        <span style="float:right;">
                            x1
                        </span>
                    </div>
                <?php
                }
                ?>

                <div class="produk-harga" style="text-align: right; margin-bottom: 10px;">
                    <?php echo formatRupiah($subtotal); ?>
                </div>
                <hr>
                <div class="ringkasan-row clearfix">
                    <span style="float: left;">Subtotal</span>
                    <span style="float: right;"><?php echo formatRupiah($subtotal); ?></span>
                </div>

                <div class="ringkasan-row clearfix">
                    <span style="float: left;">Tax 11%</span>
                    <span style="float: right;"><?php echo formatRupiah($tax); ?></span>
                </div>

                <div class="ringkasan-row total clearfix" style="margin-top: 15px; font-weight: bold;">
                    <span style="float: left;">Total</span>
                    <span style="float: right;"><?php echo formatRupiah($total); ?></span>
                </div>
            </div>
        </div>

        <div class="col-kanan">
            <div class="checkout-card payment-card">
                <h3>Pembayaran</h3>
                
                <div class="qris-box clearfix" onclick="bukaQris()">
                    <small style="display: block; margin-bottom: 5px;">Metode Pembayaran</small>
                    <div class="qris-logo">QRIS</div>
                </div>

                <div class="status-pembayaran-box clearfix">
                    <span style="float: left;">Status :</span>
                    
                    <div style="float: right;">
                        <span id="status-bulatan" class="bulatan-unpaid"></span>
                        <span id="status-teks" class="teks-unpaid">Unpaid</span>
                    </div>
                </div>

                <button id="btn-utama" class="btn-utama-bayar" onclick="bukaQris()">
                    Bayar Sekarang
                </button>
            </div>
        </div>

    </div>

</div>

<div id="modal-alamat-overlay" class="modal-overlay">
    <div class="modal-content-box">
        <span class="modal-close-corner" onclick="tutupModalAlamat()">✕</span>
        <h3>Tambah Alamat</h3>
        <form onsubmit="simpanAlamatData(event)">
            <input type="text" id="input-nama" placeholder="Nama Lengkap" required>
            <input type="text" id="input-telp" placeholder="No Telepon" required>
            <textarea id="input-jalan" placeholder="Alamat Lengkap" required></textarea>
            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>
</div>

<div id="modal-qris" class="modal-overlay">
    <div class="popup-qris">
        <span class="modal-close-corner" onclick="tutupQris()">✕</span>
        
        <div class="qris-header">
            <div class="logo-qris">QRIS</div>
        </div>

        <div class="qris-image-box">
            <img src="images/qris.png" alt="QRIS" class="qris-image">
        </div>

        <div class="qris-info">

            <div class="info-row clearfix">
                <span style="float: left;">ID Pesanan</span>
                <strong id="order-id" style="float: right;"></strong>
            </div>
            <div class="info-row clearfix">
                <span style="float: left;">Jatuh Tempo</span>
                <strong id="jatuh-tempo" style="float: right;"></strong>
            </div>
            <div class="info-row clearfix">
                <span style="float: left;">Jumlah Pembayaran</span>
                <strong id="total-pembayaran" style="float: right;"><?php echo formatRupiah($total); ?></strong>
            </div>

            <button class="btn-konfirmasi-bayar" onclick="konfirmasiPembayaran()">
                Saya Sudah Membayar
            </button>
        </div>
    </div>
</div>

</body>
</html>