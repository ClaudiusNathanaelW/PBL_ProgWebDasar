<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MovieDB Merchandise</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>

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

        <div class="merch-content">
            <div class="merch-header">
                <h1 class="merch-title">One Piece Merchandise</h1>
                
                <div class="clear"></div>
            </div>

            <div class="layout-wrapper">
                <div class="product-section">
                    <div class="merch-card">
                        <div class="img-placeholder">[Gambar Plushie]</div>
                        <h4>Plushie A</h4>
                        <p>Rp 199.000</p>
                        <button class="btn-add" onclick="addCart('Plushie A',199000)">+</button>
                    </div>

                    <div class="merch-card">
                        <div class="img-placeholder">[Gambar Plushie]</div>
                        <h4>Plushie B </h4>
                        <p>Rp 199.000</p>
                        <button class="btn-add" onclick="addCart('Plushie B',199000)">+</button>
                    </div>

                    <div class="merch-card">
                        <div class="img-placeholder">[Gambar Plushie]</div>
                        <h4>Plushie C</h4>
                        <p>Rp 199.000</p>
                        <button class="btn-add" onclick="addCart('Plushie C',199000)">+</button>
                    </div>

                    <div class="merch-card">
                        <div class="img-placeholder">[Gambar Plushie]</div>
                        <h4>Plushie D</h4>
                        <p>Rp 200.000</p>
                        <button class="btn-add" onclick="addCart('Plushie D',200000)">+</button>
                    </div>

                    <div class="merch-card">
                        <div class="img-placeholder">[Gambar Plushie]</div>
                        <h4>Plushie E</h4>
                        <p>Rp 300.000</p>
                        <button class="btn-add" onclick="addCart('Plushie E',300000)">+</button>
                    </div>

                    <div class="merch-card">
                        <div class="img-placeholder">[Gambar Plushie]</div>
                        <h4>Plushie F</h4>
                        <p>Rp 200.000</p>
                        <button class="btn-add" onclick="addCart('Plushie F',200000)">+</button>
                    </div>

                    <div class="clear"></div>

                </div>

                <div class="cart-section">
                    <div class="cart-header">
                        <h3>🛒 Keranjang Saya</h3>
                    </div>

                    <div class="cart-body">
                        <ul id="cart-list"></ul>
                    </div>

                    <div class="cart-footer">
                        <div class="total-belanja-box">
                            Total Belanja: <span id="total-price" >Rp 0</span>
                        </div>

                        <form id="form-checkout-asli" action="pembayaran.php" method="POST">
                            <input type="hidden" id="form-nama" name="nama_item" value="">
                            <input type="hidden" id="form-harga" name="harga_item" value="0">
                            <input type="hidden" id="form-qty" name="qty_item" value="1">
                            
                            <button type="button" class="btn-checkout" onclick="checkout()">Checkout Sekarang</button>
                        </form>
                    </div>

                </div>

                <div class="clear"></div>
                
            </div>
        </div>
    </body>

</html>