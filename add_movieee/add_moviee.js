function setupImagePreview(inputId, previewBoxId) {
    var fileInput = document.getElementById(inputId);
    var previewBox = document.getElementById(previewBoxId);

    fileInput.addEventListener('change', function() {
        var file = this.files[0]; 

        if (file) {
            var reader = new FileReader();

            reader.addEventListener('load', function() {
                
                previewBox.innerHTML = '<img src="' + this.result + '" style="max-width: 100%; max-height: 100%; object-fit: contain;">';
            });
            reader.readAsDataURL(file);
        } else {
            previewBox.innerHTML = '<span class="preview-text">[Image Preview Box]</span>';
        }
    });
}

window.onload = function() {
    setupImagePreview('poster-input', 'poster-preview');
    setupImagePreview('merch-input', 'merch-preview');
};