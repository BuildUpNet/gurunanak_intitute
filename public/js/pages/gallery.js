/* Gallery page
   - album filter / pagination without page reload (links still work if JS fails)
   - photo viewer: click a photo to see it large (not cropped) with its title/description;
     prev / next browse the photos of that same event (or the whole group photos grid) */
(function () {
    var content = document.getElementById("galContent");
    if (!content) return;

    /* ─── Photo viewer ─── */
    var lb = document.getElementById("galLb");
    var lbImg = document.getElementById("galLbImg");
    var lbCount = document.getElementById("galLbCount");
    var lbAlbum = document.getElementById("galLbAlbum");
    var lbTitle = document.getElementById("galLbTitle");
    var lbDesc = document.getElementById("galLbDesc");
    var cards = [];
    var current = 0;
    var lastFocus = null;
    var swapTimer = null;

    function pad(n) {
        return n < 10 ? "0" + n : String(n);
    }

    function show(index) {
        if (!cards.length) return;
        current = (index + cards.length) % cards.length;
        var d = cards[current].dataset;

        lbImg.classList.add("is-swapping");
        clearTimeout(swapTimer);
        swapTimer = setTimeout(function () {
            lbImg.src = d.src;
            lbImg.alt = d.alt || "";
            lbImg.classList.remove("is-swapping");
        }, lb.classList.contains("is-open") ? 180 : 0);

        lbCount.textContent = pad(current + 1) + " / " + pad(cards.length);
        lbAlbum.textContent = d.album || "";
        lbTitle.textContent = d.title || "";
        lbDesc.textContent = d.desc || "";
        lbDesc.scrollTop = 0;
        lb.classList.toggle("no-caption", !d.album && !d.title && !d.desc);
    }

    function openLb(card) {
        if (!lb) return;
        // Events design: browse that event's photos; group design: the whole grid
        var scope = card.closest(".gal-event, .gal-group") || content;
        cards = Array.prototype.slice.call(scope.querySelectorAll("[data-gal-open]"));
        var index = cards.indexOf(card);
        if (index < 0) return;
        lastFocus = document.activeElement;
        lb.classList.toggle("is-single", cards.length < 2);
        show(index);
        lb.classList.add("is-open");
        lb.setAttribute("aria-hidden", "false");
        document.documentElement.classList.add("gal-lb-open");
        document.getElementById("galLbClose").focus();
    }

    function closeLb() {
        if (!lb || !lb.classList.contains("is-open")) return;
        lb.classList.remove("is-open");
        lb.setAttribute("aria-hidden", "true");
        document.documentElement.classList.remove("gal-lb-open");
        if (lastFocus && lastFocus.focus) lastFocus.focus();
    }

    content.addEventListener("click", function (e) {
        var trigger = e.target.closest("[data-gal-open]");
        if (!trigger) return;
        e.preventDefault();
        openLb(trigger);
    });

    if (lb) {
        document.getElementById("galLbClose").addEventListener("click", closeLb);
        document.getElementById("galLbPrev").addEventListener("click", function () {
            show(current - 1);
        });
        document.getElementById("galLbNext").addEventListener("click", function () {
            show(current + 1);
        });
        // Click on the dark backdrop (not the photo / text / buttons) closes
        lb.addEventListener("click", function (e) {
            if (e.target === lb || e.target.id === "galLbStage") closeLb();
        });
        document.addEventListener("keydown", function (e) {
            if (!lb.classList.contains("is-open")) return;
            if (e.key === "Escape") closeLb();
            else if (e.key === "ArrowLeft" && cards.length > 1) show(current - 1);
            else if (e.key === "ArrowRight" && cards.length > 1) show(current + 1);
        });

        var touchX = null;
        var touchY = null;
        lb.addEventListener("touchstart", function (e) {
            touchX = e.touches[0].clientX;
            touchY = e.touches[0].clientY;
        }, { passive: true });
        lb.addEventListener("touchend", function (e) {
            if (touchX === null || cards.length < 2) return;
            var dx = e.changedTouches[0].clientX - touchX;
            var dy = e.changedTouches[0].clientY - touchY;
            if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy)) show(dx < 0 ? current + 1 : current - 1);
            touchX = null;
        }, { passive: true });
    }

    /* ─── Album filter / pagination without reload ─── */
    var stats = document.getElementById("galHeroStats");
    var pending = null;

    function load(url, push) {
        if (pending) pending.abort();
        pending = new AbortController();

        var filter = content.querySelector(".gal-filter");
        var scrollLeft = filter ? filter.scrollLeft : 0;
        content.classList.add("is-loading");

        fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" }, signal: pending.signal })
            .then(function (res) {
                if (!res.ok) throw new Error(res.status);
                return res.text();
            })
            .then(function (html) {
                var doc = new DOMParser().parseFromString(html, "text/html");
                var next = doc.getElementById("galContent");
                if (!next) throw new Error("no content");

                content.innerHTML = next.innerHTML;
                var nextStats = doc.getElementById("galHeroStats");
                if (stats && nextStats) stats.innerHTML = nextStats.innerHTML;
                if (doc.title) document.title = doc.title;

                var newFilter = content.querySelector(".gal-filter");
                if (newFilter) newFilter.scrollLeft = scrollLeft;

                if (push) history.pushState({ gal: true }, "", url);

                // Keep the grid in view when the user was scrolled down (e.g. pagination)
                var top = content.getBoundingClientRect().top + window.pageYOffset - 140;
                if (window.pageYOffset > top) window.scrollTo({ top: top, behavior: "smooth" });
            })
            .catch(function (err) {
                if (err.name !== "AbortError") window.location.href = url;
            })
            .finally(function () {
                content.classList.remove("is-loading");
            });
    }

    content.addEventListener("click", function (e) {
        var link = e.target.closest(".gal-pill, .gal-chip, .gal-pagination a, .gal-empty a");
        if (!link || !link.href || e.ctrlKey || e.metaKey || e.shiftKey) return;
        e.preventDefault();
        // Active pill still works when a sub category is open (takes you back to the whole album)
        if (link.classList.contains("active") && link.href === window.location.href) return;
        load(link.href, true);
    });

    // Campus life links in the header / mobile drawer also load in place while on this page
    document.addEventListener("click", function (e) {
        var link = e.target.closest("#siteHeader a[href]");
        if (!link || e.ctrlKey || e.metaKey || e.shiftKey) return;
        if (link.origin !== location.origin || link.pathname !== location.pathname) return;
        e.preventDefault();
        var drawer = document.getElementById("drawer");
        var dClose = document.getElementById("dClose");
        if (drawer && dClose && drawer.classList.contains("open")) dClose.click();
        document.querySelectorAll(".mega-panel.open").forEach(function (p) {
            p.classList.remove("open");
        });
        document.querySelectorAll(".nvl li.mpopen").forEach(function (l) {
            l.classList.remove("mpopen");
        });
        if (document.activeElement) document.activeElement.blur();
        load(link.href, true);
    });

    history.replaceState({ gal: true }, "", window.location.href);
    window.addEventListener("popstate", function (e) {
        if (e.state && e.state.gal) load(window.location.href, false);
    });
})();
