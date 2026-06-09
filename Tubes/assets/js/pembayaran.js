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