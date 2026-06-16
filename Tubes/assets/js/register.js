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