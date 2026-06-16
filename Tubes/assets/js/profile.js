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