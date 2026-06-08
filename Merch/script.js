var cartArray = [];
var totalBelanja = 0;

function addCart(namaBarang, hargaBarang) {
    var itemAda = null;
    for (var i = 0; i < cartArray.length; i++) {
        if (cartArray[i].nama === namaBarang) {
            itemAda = cartArray[i];
            break;
        }
    }
    
    var qtySekarang = 1; 

    if (itemAda) {
        itemAda.qty++;
        qtySekarang = itemAda.qty; 
    } else {
        cartArray.push({
            nama: namaBarang,
            harga: hargaBarang,
            qty: 1
        });
        qtySekarang = 1; 
    }

    totalBelanja += hargaBarang;

    var formNama = document.getElementById("form-nama");
    var formHarga = document.getElementById("form-harga");
    var formQty = document.getElementById("form-qty");
    
    if (formNama) formNama.value = namaBarang;
    if (formHarga) formHarga.value = hargaBarang;
    if (formQty) formQty.value = qtySekarang; 
    
    var totalPriceText = document.getElementById("total-price");
    if(totalPriceText) {
        totalPriceText.innerText = totalBelanja.toLocaleString("id-ID");
    }
    
    renderCart();
}

function renderCart() {
    var cartList = document.getElementById("cart-list");
    if (!cartList) return; 

    cartList.innerHTML = "";
    for (var i = 0; i < cartArray.length; i++) {
        var item = cartArray[i];
        cartList.innerHTML += 
            '<li class="cart-item">' +
                '<div class="item-info">' +
                    '<strong>' + item.nama + '</strong><br>' +
                    'Rp ' + item.harga.toLocaleString("id-ID") + ' x ' + item.qty +
                '</div>' +
                '<div class="item-control">' +
                    '<button class="btn-minus" onclick="kurangQty(\'' + item.nama + '\')">-</button> ' +
                    '<button class="btn-plus" onclick="tambahQty(\'' + item.nama + '\')">+</button> ' +
                    '<button class="btn-delete" onclick="hapusItem(\'' + item.nama + '\')">🗑</button>' +
                '</div>' +
            '</li>';
    }
}

function tambahQty(namaBarang) {
    for (var i = 0; i < cartArray.length; i++) {
        if (cartArray[i].nama === namaBarang) {
            cartArray[i].qty++;
            totalBelanja += cartArray[i].harga;
            break;
        }
    }
    document.getElementById("total-price").innerText = totalBelanja.toLocaleString("id-ID");
    renderCart();
}

function kurangQty(namaBarang) {
    for (var i = 0; i < cartArray.length; i++) {
        if (cartArray[i].nama === namaBarang) {
            cartArray[i].qty--;
            totalBelanja -= cartArray[i].harga;
            if (cartArray[i].qty <= 0) {
                cartArray.splice(i, 1); 
            }
            break;
        }
    }
    document.getElementById("total-price").innerText = totalBelanja.toLocaleString("id-ID");
    renderCart();
}

function hapusItem(namaBarang) {
    for (var i = 0; i < cartArray.length; i++) {
        if (cartArray[i].nama === namaBarang) {
            totalBelanja -= (cartArray[i].harga * cartArray[i].qty);
            cartArray.splice(i, 1);
            break;
        }
    }
    document.getElementById("total-price").innerText = totalBelanja.toLocaleString("id-ID");
    renderCart();
}

function checkout() {
    if (cartArray.length === 0) {
        alert("Keranjang belanja Anda masih kosong!");
        return;
    }

    var gabunganNama = "";
    for (var i = 0; i < cartArray.length; i++) {
        gabunganNama += cartArray[i].nama + " (x" + cartArray[i].qty + ")";
        if (i < cartArray.length - 1) {
            gabunganNama += ", ";
        }
    }

    var formNama = document.getElementById("form-nama");
    var formHarga = document.getElementById("form-harga");
    var formQty = document.getElementById("form-qty");
    
    if (formNama) formNama.value = gabunganNama;
    if (formHarga) formHarga.value = totalBelanja;
    if (formQty) formQty.value = 1;

    var formAsli = document.getElementById("form-checkout-asli");
    if (formAsli) {
        formAsli.submit();
    } else {
        alert("Gagal memanggil form!");
    }
}

//  PEMBAYARAN  // 
var alamatTerisi = false;

window.onload = function() {
    var btnHapus = document.getElementById("btn-hapus-alamat");
    if (btnHapus) btnHapus.style.display = "none";

    var orderId = document.getElementById("order-id");
    if (orderId) orderId.innerHTML = "MDB" + new Date().getTime(); 

    var jatuhTempo = document.getElementById("jatuh-tempo");
    if (jatuhTempo) {
        var dueTime = new Date();
        dueTime.setHours(dueTime.getHours() + 24); // Set waktu 24 jam ke depan

        var hari = dueTime.getDate();
        var daftarBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var bulan = daftarBulan[dueTime.getMonth()];
        var tahun = dueTime.getFullYear();
        var jam = dueTime.getHours();
        var menit = dueTime.getMinutes();
        jatuhTempo.innerHTML = hari + " " + bulan + " " + tahun + " " + jam + ":" + (menit < 10 ? "0" : "") + menit;
    }
}

function bukaModalAlamat() {
    var modal = document.getElementById("modal-alamat-overlay");
    if (modal) modal.style.display = "block";
}

function tutupModalAlamat() {
    var modal = document.getElementById("modal-alamat-overlay");
    if (modal) modal.style.display = "none";
}

function simpanAlamatData(event) {
    event.preventDefault();
    var nama = document.getElementById("input-nama").value;
    var telp = document.getElementById("input-telp").value;
    var alamat = document.getElementById("input-jalan").value;

    document.getElementById("alamat-konten").innerHTML = 
        "<strong>" + nama + "</strong><p>" + telp + "</p><p>" + alamat + "</p>";

    document.getElementById("btn-hapus-alamat").style.display = "block";
    alamatTerisi = true;

    document.getElementById("input-nama").value = "";
    document.getElementById("input-telp").value = "";
    document.getElementById("input-jalan").value = "";
    tutupModalAlamat();
}

function clearAlamat() {
    document.getElementById("alamat-konten").innerHTML = '<p class="placeholder-text">Belum ada alamat pengiriman</p>';
    document.getElementById("btn-hapus-alamat").style.display = "none";
    alamatTerisi = false;
}

function bukaQris() {
    if (!alamatTerisi) {
        alert("Silakan isi alamat pengiriman terlebih dahulu!");
        return;
    }
    var qris = document.getElementById("modal-qris");
    if (qris) qris.style.display = "block";
}

function tutupQris() {
    var qris = document.getElementById("modal-qris");
    if (qris) qris.style.display = "none";
}

function konfirmasiPembayaran() {
    document.getElementById("status-teks").innerHTML = "Paid";
    document.getElementById("status-teks").className = "teks-paid";
    document.getElementById("status-bulatan").className = "bulatan-paid";

    var btnUtama = document.querySelector(".btn-utama-bayar");
    if (btnUtama) {
        btnUtama.innerHTML = "Pembayaran Berhasil";
        btnUtama.disabled = true;
    }
    tutupQris();
    alert("Pembayaran berhasil dikonfirmasi.");
}

window.onclick = function(e) {
    var modalAlamat = document.getElementById("modal-alamat-overlay");
    var modalQris = document.getElementById("modal-qris");
    if (e.target === modalAlamat) tutupModalAlamat();
    if (e.target === modalQris) tutupQris();
};