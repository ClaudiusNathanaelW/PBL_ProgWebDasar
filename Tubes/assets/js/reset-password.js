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