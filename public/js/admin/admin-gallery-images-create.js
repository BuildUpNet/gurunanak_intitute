/* Admin › Gallery photo uploader (Add Gallery Images page + "Add more photos" on the group editor)
   - choose 1–8 photos at once (more can be added with another click, up to the limit)
   - every photo gets its own preview, size check, Alt text and Display Order
   - limit = free places left in the sub category (max 8 photos per sub category)
   - Add page: sub category list is loaded for the chosen main category
   - Group editor: the page tells the free places via window.galUploader.setUsed(n) */
(function () {
    var form = document.getElementById("galUploadForm") || document.getElementById("galGroupForm");
    var input = document.getElementById("imageInput");
    var list = document.getElementById("galUpList");
    if (!form || !input || !list) return;

    var head = document.getElementById("galUpHead");
    var countEl = document.getElementById("galUpCount");
    var limitEl = document.getElementById("galUpLimit");
    var msg = document.getElementById("galUpMsg");
    var category = document.getElementById("category");
    var subcategory = document.getElementById("subcategory");
    var subRoom = document.getElementById("galSubRoom");

    var MAX = parseInt(input.dataset.max, 10) || 8;
    var TYPES = ["image/jpeg", "image/jpg", "image/png", "image/webp"];
    var MIN_W = 1200, MIN_H = 900, MAX_W = 2400, MAX_H = 1800, MAX_MB = 4;

    var items = [];        // { file, url, alt, order, check }
    var subCounts = {};    // sub category id → photos it already has
    var limit = MAX;
    var baseOrder = 0;     // photos already in the chosen sub category
    var isAddPage = !!(category && subcategory);
    var limited = input.dataset.limited !== "0"; // group without sub category: no 8-photo room limit

    function say(text, type) {
        msg.className = "gal-up-msg" + (text ? " is-" + (type || "warn") : "");
        msg.textContent = text || "";
    }

    function esc(s) {
        return String(s).replace(/[&<>"']/g, function (c) {
            return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c];
        });
    }

    /* Put the chosen files back into the real <input> so they are submitted */
    function syncInput() {
        try {
            var dt = new DataTransfer();
            items.forEach(function (it) { dt.items.add(it.file); });
            input.files = dt.files;
        } catch (e) {
            // Very old browser: the last picked files are submitted as they are
        }
    }

    function sizeCheck(item, done) {
        var mb = item.file.size / 1048576;
        var img = new Image();
        img.onload = function () {
            var w = img.naturalWidth, h = img.naturalHeight;
            var info = w + " × " + h + " px · " + mb.toFixed(2) + " MB";
            if (mb > MAX_MB) item.check = { type: "bad", text: info + " — larger than 4 MB, will be rejected" };
            else if (w < MIN_W || h < MIN_H) item.check = { type: "warn", text: info + " — smaller than 1200 × 900, may look blurry" };
            else if (w > MAX_W || h > MAX_H) item.check = { type: "warn", text: info + " — bigger than needed" };
            else item.check = { type: "ok", text: info + " — good size" };
            done();
        };
        img.onerror = function () {
            item.check = { type: "bad", text: "Could not be read as an image" };
            done();
        };
        img.src = item.url;
    }

    function render() {
        list.innerHTML = items.map(function (it, i) {
            var check = it.check
                ? '<span class="img-size-check is-' + it.check.type + '">' + esc(it.check.text) + "</span>"
                : "";
            return (
                '<div class="gal-up-item" data-index="' + i + '">' +
                    '<div class="gal-up-thumb"><img src="' + it.url + '" alt=""><span class="gal-up-no">' + (i + 1) + "</span></div>" +
                    '<div class="gal-up-body">' +
                        '<div class="gal-up-name" title="' + esc(it.file.name) + '">' + esc(it.file.name) + "</div>" +
                        check +
                        '<div class="gal-up-fields">' +
                            '<label class="gal-up-field gal-up-field--alt"><span>Image Alt Text</span>' +
                                '<input type="text" name="alts[' + i + ']" maxlength="255" class="form-control custom-input" data-key="alt" value="' + esc(it.alt) + '" placeholder="SEO alt text (optional)"></label>' +
                            '<label class="gal-up-field gal-up-field--order"><span>Display Order</span>' +
                                '<input type="number" name="orders[' + i + ']" min="0" max="9999" class="form-control custom-input" data-key="order" value="' + esc(it.order) + '"></label>' +
                        "</div>" +
                    "</div>" +
                    '<button type="button" class="gal-up-remove" data-remove aria-label="Remove ' + esc(it.file.name) + '"><i class="fas fa-times"></i></button>' +
                "</div>"
            );
        }).join("");

        head.hidden = items.length === 0;
        countEl.textContent = items.length;
        limitEl.textContent = limit;
    }

    function addFiles(fileList) {
        var files = Array.prototype.slice.call(fileList || []);
        var skippedType = 0, skippedLimit = 0;

        files.forEach(function (file) {
            if (TYPES.indexOf(file.type) === -1) { skippedType++; return; }
            if (items.length >= limit) { skippedLimit++; return; }
            var item = {
                file: file,
                url: URL.createObjectURL(file),
                alt: "",
                order: baseOrder + items.length + 1,
                check: null
            };
            items.push(item);
            sizeCheck(item, render);
        });

        var notes = [];
        if (skippedType) notes.push(skippedType + " file(s) skipped — only JPG, PNG or WEBP allowed.");
        if (skippedLimit) notes.push(skippedLimit + " photo(s) not added — max " + limit + " photo(s) here.");
        say(notes.join(" "));

        syncInput();
        render();
    }

    input.addEventListener("change", function () {
        // input.files is replaced by syncInput(), so copy the picked files first
        var picked = Array.prototype.slice.call(input.files || []);
        addFiles(picked);
    });

    // Typed Alt / Order values are kept when the list is drawn again
    list.addEventListener("input", function (e) {
        var row = e.target.closest(".gal-up-item");
        var key = e.target.dataset.key;
        if (row && key) items[+row.dataset.index][key] = e.target.value;
    });

    list.addEventListener("click", function (e) {
        var btn = e.target.closest("[data-remove]");
        if (!btn) return;
        var i = +btn.closest(".gal-up-item").dataset.index;
        URL.revokeObjectURL(items[i].url);
        items.splice(i, 1);
        say("");
        syncInput();
        render();
    });

    document.getElementById("galUpClear").addEventListener("click", function () {
        items.forEach(function (it) { URL.revokeObjectURL(it.url); });
        items = [];
        say("");
        syncInput();
        render();
    });

    function setLimit(used, orderStart) {
        limit = limited ? Math.max(0, MAX - used) : MAX;
        baseOrder = orderStart;
        if (items.length > limit) {
            items.splice(limit).forEach(function (it) { URL.revokeObjectURL(it.url); });
            say("Only " + limit + " more photo(s) fit here — extra new photos were removed.");
        }
        // Default orders continue after the photos already there
        items.forEach(function (it, i) { it.order = baseOrder + i + 1; });
        syncInput();
        render();
    }

    if (!isAddPage) {
        window.galUploader = {
            setUsed: function (used, orderStart) { setLimit(used, orderStart); },
            count: function () { return items.length; }
        };
        var startUsed = parseInt(input.dataset.used, 10) || 0;
        setLimit(startUsed, parseInt(input.dataset.orderStart, 10) || startUsed);
        return;
    }

    /* Limit = free places in the chosen sub category (or 8 without one) */
    function applyLimit() {
        var subId = subcategory.value;
        var used = subId ? (subCounts[subId] || 0) : 0;

        var free = Math.max(0, MAX - used);
        if (subId) {
            subRoom.textContent = free
                ? "This sub category has " + used + " / " + MAX + " photos — you can add " + free + " more."
                : "This sub category is full (" + MAX + " / " + MAX + " photos). Delete or move a photo first.";
            subRoom.className = "d-block mt-1 " + (free ? "text-muted" : "text-danger");
        } else {
            subRoom.textContent = "A sub category can hold max " + MAX + " photos.";
            subRoom.className = "text-muted d-block mt-1";
        }

        setLimit(used, used);
    }

    subcategory.addEventListener("change", applyLimit);

    function loadSubs(categoryId, selected) {
        subcategory.innerHTML = '<option value="">' + (categoryId ? "Loading..." : "None — show under category only") + "</option>";
        subCounts = {};
        if (!categoryId) { applyLimit(); return; }

        fetch(category.dataset.subUrl.replace("__ID__", categoryId))
            .then(function (r) { return r.json(); })
            .then(function (data) {
                var html = '<option value="">None — show under category only</option>';
                data.forEach(function (sub) {
                    var used = sub.images_count || 0;
                    subCounts[sub.id] = used;
                    html += '<option value="' + sub.id + '"' + (String(sub.id) === String(selected) ? " selected" : "") +
                        ">" + esc(sub.title) + " (" + used + "/" + MAX + ")</option>";
                });
                subcategory.innerHTML = html;
                applyLimit();
            })
            .catch(function () {
                subcategory.innerHTML = '<option value="">Error loading sub category</option>';
            });
    }

    category.addEventListener("change", function () { loadSubs(this.value, ""); });

    // Back after a validation error: reload the sub categories of the old category
    if (category.value) loadSubs(category.value, subcategory.dataset.old);

    form.addEventListener("submit", function (e) {
        if (!items.length) {
            e.preventDefault();
            say("Please choose at least 1 photo.", "bad");
            input.closest(".col-md-12").scrollIntoView({ behavior: "smooth", block: "center" });
        }
    });
})();
