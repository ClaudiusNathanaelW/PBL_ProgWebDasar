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
// Ambil elemen berdasarkan ID yang ada di HTML
const profileForm = document.getElementById('profileForm');
const viewProfile = document.getElementById('viewProfile');

// Jalankan fungsi ini HANYA saat tombol Submit/Save ditekan
profileForm.addEventListener('submit', function(e) {
    
    // MENCEGAH HALAMAN REFRESH (Sangat penting agar data tidak hilang)
    e.preventDefault(); 

    // 1. Ambil nilai data yang diketik di form
    const namaValue = document.getElementById('nama').value;
    const telpValue = document.getElementById('telp').value;
    const alamatValue = document.getElementById('alamat').value;
    const bioValue = document.getElementById('bio').value;

    // 2. Suntikkan/pindahkan nilai tersebut ke dalam kotak tampilan hasil
    document.getElementById('res-nama').innerText = namaValue;
    document.getElementById('res-telp').innerText = telpValue;
    document.getElementById('res-alamat').innerText = alamatValue;
    document.getElementById('res-bio').innerText = bioValue;

    // 3. Sembunyikan Form Input, Tampilkan Hasil
    profileForm.classList.add('hidden');
    viewProfile.classList.remove('hidden');
});
// Variabel untuk melacak status sidebar
var isSidebarCollapsed = false;

// Fungsi ini dipanggil saat id="toggle-btn" diklik
function toggleSidebar() {
    // Mengambil elemen berdasarkan ID
    var sidebar = document.getElementById("sidebar");
    var content = document.getElementById("content");
    var toggleBtn = document.getElementById("toggle-btn");

    if (isSidebarCollapsed == false) {
        // Menyempitkan sidebar menggunakan manipulasi CSS Inline
        sidebar.style.width = "5%";
        content.style.width = "90%";
        toggleBtn.innerHTML = ">"; // Mengubah ikon panah
        isSidebarCollapsed = true;
    } else {
        // Mengembalikan sidebar ke ukuran semula
        sidebar.style.width = "20%";
        content.style.width = "75%";
        toggleBtn.innerHTML = "<"; // Mengembalikan ikon panah
        isSidebarCollapsed = false;
    }
}