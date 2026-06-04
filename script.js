function doLogin() {
    var user = document.getElementById("username").value;
    var pass = document.getElementById("password").value;

    if (user == "" || pass == "") {
        alert("Peringatan: Username dan Password harus diisi!");
    } else {
        alert("Login Sukses! Mengalihkan ke halaman utama...");
        window.location.href = "welcome.html";
    }
}
function doRegister() {
    var user = document.getElementById("regUser").value;
    var email = document.getElementById("regEmail").value;
    var pass = document.getElementById("regPass").value;

    if (user == "" || email == "" || pass == "") {
        alert("Peringatan: Seluruh data form Register harus diisi lengkap!");
    } else {
        alert("Registrasi Berhasil! Silakan masuk melalui halaman Login.");
        window.location.href = "index.html";
    }
}
// Mengambil elemen form berdasarkan ID
var resetForm = document.getElementById("resetForm");

// Menambahkan event listener saat form disubmit
resetForm.addEventListener("submit", function(event) {
    // Mencegah halaman me-refresh secara otomatis
    event.preventDefault(); 
    
    // Mengambil nilai input dari kedua kolom password
    var newPass = document.getElementById("newPass").value;
    var confirmPass = document.getElementById("confirmPass").value;

    // Logika Validasi Sederhana
    if (newPass === "" || confirmPass === "") {
        alert("Peringatan: Kolom password tidak boleh kosong!");
    } else if (newPass !== confirmPass) {
        alert("Error: Password tidak cocok! Pastikan ketikan pada kedua kolom sama.");
    } else {
        alert("Reset Password Sukses! Silakan login kembali dengan password baru Anda.");
        // Arahkan kembali ke halaman login (index.html) setelah berhasil
        window.location.href = "index.html"; 
    }
});

// Fungsi untuk memunculkan Pop-up
function openLogin() {
    document.getElementById("loginModal").style.display = "block";
}

// Fungsi untuk menyembunyikan Pop-up
function closeLogin() {
    document.getElementById("loginModal").style.display = "none";
}
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
// FUNGSI SLIDER FILM 
function slideLeft() {
    var slider = document.getElementById("movieSlider");
    // Angka 220 adalah perhitungan dari width kartu (200px) + margin (20px)
    slider.scrollLeft -= 240; 
}

function slideRight() {
    var slider = document.getElementById("movieSlider");
    slider.scrollLeft += 240;
}
