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