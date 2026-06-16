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

// Fungsi untuk memunculkan Pop-up
function openLogin() {
    document.getElementById("loginModal").style.display = "block";
}

// Fungsi untuk menyembunyikan Pop-up
function closeLogin() {
    document.getElementById("loginModal").style.display = "none";
}