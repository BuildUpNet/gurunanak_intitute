/* Admin — Awards: preview the images picked for upload */
(function () {
    var input = document.getElementById('awardImagesInput');
    var box = document.getElementById('awardUploadPreview');
    if (!input || !box) return;

    input.addEventListener('change', function () {
        box.innerHTML = '';
        Array.prototype.forEach.call(this.files, function (file) {
            var img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.alt = file.name;
            box.appendChild(img);
        });
    });
})();
