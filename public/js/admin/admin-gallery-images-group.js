/* Admin › Gallery group editor (all photos of one sub category on one page)
   - "Remove" dims the photo and frees its place for new photos
   - "Replace" shows the new picture before saving
   - keeps the photo counter and the uploader's free places up to date */
(function () {
    var form = document.getElementById("galGroupForm");
    if (!form) return;

    var MAX = parseInt(form.dataset.max, 10) || 8;
    var limited = form.dataset.limited === "1";
    var usedEl = document.getElementById("galGrpUsed");
    var room = document.getElementById("galGrpRoom");
    var photos = Array.prototype.slice.call(form.querySelectorAll("[data-photo]"));

    function kept() {
        return photos.filter(function (p) {
            return !p.querySelector("[data-remove-photo]").checked;
        }).length;
    }

    function refresh() {
        var k = kept();
        var newCount = window.galUploader ? window.galUploader.count() : 0;
        usedEl.textContent = k + newCount;
        if (limited && room) {
            var free = Math.max(0, MAX - k);
            room.textContent = free
                ? "You can add " + free + " more photo(s) here (max " + MAX + "). JPG, PNG or WEBP, max 4 MB each."
                : "This group is full (" + MAX + " photos). Tick Remove on a photo above to make room.";
        }
        if (window.galUploader) window.galUploader.setUsed(k, photos.length);
    }

    photos.forEach(function (p) {
        var remove = p.querySelector("[data-remove-photo]");
        remove.addEventListener("change", function () {
            p.classList.toggle("is-removed", remove.checked);
            refresh();
        });
        p.classList.toggle("is-removed", remove.checked);

        var replace = p.querySelector("[data-replace]");
        var thumb = p.querySelector("[data-thumb]");
        var note = p.querySelector("[data-replace-note]");
        var original = thumb.src;
        replace.addEventListener("change", function () {
            var file = replace.files && replace.files[0];
            if (!file) {
                thumb.src = original;
                note.textContent = "";
                p.classList.remove("is-replaced");
                return;
            }
            thumb.src = URL.createObjectURL(file);
            note.textContent = "New picture: " + file.name + " (" + (file.size / 1048576).toFixed(2) + " MB) — saved on Save All";
            p.classList.add("is-replaced");
        });
    });

    // New photos added / removed in the uploader → update the counter
    var list = document.getElementById("galUpList");
    if (list && window.MutationObserver) {
        new MutationObserver(function () {
            usedEl.textContent = kept() + (window.galUploader ? window.galUploader.count() : 0);
        }).observe(list, { childList: true });
    }

    refresh();
})();
