/* Admin › Gallery image create/edit
   Shows the chosen photo's pixel size + file size against the size guide
   (information only — never blocks the upload except the 4 MB server limit). */
(function () {
    var input = document.getElementById("imageInput");
    var box = document.getElementById("imgSizeCheck");
    if (!input || !box) return;

    var MIN_W = 1200, MIN_H = 900, MAX_W = 2400, MAX_H = 1800, MAX_MB = 4;

    function say(type, html) {
        box.className = "img-size-check is-" + type;
        box.innerHTML = html;
    }

    input.addEventListener("change", function () {
        var file = input.files && input.files[0];
        if (!file) {
            box.className = "img-size-check";
            box.innerHTML = "";
            return;
        }
        var mb = file.size / 1048576;
        var url = URL.createObjectURL(file);
        var img = new Image();
        img.onload = function () {
            var w = img.naturalWidth, h = img.naturalHeight;
            URL.revokeObjectURL(url);
            var info = "Selected: <b>" + w + " × " + h + " px</b>, <b>" + mb.toFixed(2) + " MB</b>. ";
            if (mb > MAX_MB) {
                say("bad", info + "File is larger than 4 MB — it will be rejected. Please compress / resize it.");
            } else if (w < MIN_W || h < MIN_H) {
                say("warn", info + "Smaller than the minimum (1200 × 900 px) — it may look blurry.");
            } else if (w > MAX_W || h > MAX_H) {
                say("warn", info + "Bigger than needed (max 2400 × 1800 px) — resizing will load faster.");
            } else {
                say("ok", info + "Good size.");
            }
        };
        img.onerror = function () {
            URL.revokeObjectURL(url);
            say("bad", "This file could not be read as an image.");
        };
        img.src = url;
    });
})();
