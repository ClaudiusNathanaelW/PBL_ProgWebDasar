// Fungsi untuk memutar trailer
function playTrailer() {
    alert("Memuat Trailer One Piece Film: Z...");
    // Logika pengalihan halaman atau pemunculan pop-up iframe bisa diletakkan di sini
}

// Fungsi untuk membuka galeri foto
function openGallery() {
    alert("Membuka Galeri Gambar Film...");
}

// Fungsi untuk membuka halaman merchandise
function openMerch() {
    alert("Mengalihkan ke halaman Katalog Merchandise One Piece...");
    // Contoh pengalihan: window.location.href = "merch-onepiece.html";
}

// Fungsi untuk membuka pop-up reaksi
function openReactionModal() {
    document.getElementById("reactionModal").style.display = "block";
}

// Fungsi untuk menutup pop-up reaksi
function closeReactionModal() {
    document.getElementById("reactionModal").style.display = "none";
}

// Menutup pop-up secara otomatis jika pengguna mengklik area gelap di luar kotak pop-up
window.onclick = function(event) {
    var modal = document.getElementById("reactionModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}