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