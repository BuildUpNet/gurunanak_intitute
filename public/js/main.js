/* public/js/main.js */
(function () {
    "use strict";
    var sw = document.getElementById("sw");
    if (!sw) return;

    function posDrop(li, p) {
        var lr = li.getBoundingClientRect(),
            sr = sw.getBoundingClientRect();
        p.style.top = lr.bottom - sr.top + "px";
        p.style.left = Math.max(0, lr.left - sr.left) + "px";
    }
    function closeAll() {
        document
            .querySelectorAll(".mega-panel.open,.drop-panel.open")
            .forEach(function (p) {
                p.classList.remove("open");
            });
        document
            .querySelectorAll(".nvl li.mpopen,.nvl li.dpopen")
            .forEach(function (l) {
                l.classList.remove("mpopen", "dpopen");
            });
    }

    /* MEGA — fixed: dual-hover guard so panel stays open during mouse travel */
    document.querySelectorAll(".nvl li.hm").forEach(function (li) {
        var p = document.getElementById(li.dataset.mp);
        if (!p) return;
        var t;
        function doOpen() {
            clearTimeout(t);
            closeAll();
            li.classList.add("mpopen");
            p.classList.add("open");
        }
        function schedClose() {
            clearTimeout(t);
            t = setTimeout(function () {
                if (!li.matches(":hover") && !p.matches(":hover")) {
                    li.classList.remove("mpopen");
                    p.classList.remove("open");
                }
            }, 180);
        }
        li.addEventListener("mouseenter", doOpen);
        li.addEventListener("mouseleave", schedClose);
        p.addEventListener("mouseenter", function () {
            clearTimeout(t);
        });
        p.addEventListener("mouseleave", schedClose);
    });

    /* DROPS — same dual-hover fix */
    document.querySelectorAll(".nvl li.hd").forEach(function (li) {
        var p = document.getElementById(li.dataset.dp);
        if (!p) return;
        var t;
        function doOpen() {
            clearTimeout(t);
            closeAll();
            posDrop(li, p);
            li.classList.add("dpopen");
            p.classList.add("open");
        }
        function schedClose() {
            clearTimeout(t);
            t = setTimeout(function () {
                if (!li.matches(":hover") && !p.matches(":hover")) {
                    li.classList.remove("dpopen");
                    p.classList.remove("open");
                }
            }, 180);
        }
        li.addEventListener("mouseenter", doOpen);
        li.addEventListener("mouseleave", schedClose);
        p.addEventListener("mouseenter", function () {
            clearTimeout(t);
        });
        p.addEventListener("mouseleave", schedClose);
    });

    document.addEventListener("click", function (e) {
        if (!e.target.closest("#sw")) closeAll();
    });

    /* DRAWER */
    var ham = document.getElementById("hamBtn"),
        drawer = document.getElementById("drawer"),
        dov = document.getElementById("dov"),
        dClose = document.getElementById("dClose");

    function openD() {
        drawer.classList.add("open");
        dov.classList.add("show");
        ham.classList.add("open");
        ham.setAttribute("aria-expanded", "true");
        document.body.style.overflow = "hidden";
    }
    function closeD() {
        drawer.classList.remove("open");
        dov.classList.remove("show");
        ham.classList.remove("open");
        ham.setAttribute("aria-expanded", "false");
        document.body.style.overflow = "";
    }

    if (ham)
        ham.addEventListener("click", function () {
            drawer.classList.contains("open") ? closeD() : openD();
        });
    if (dClose) dClose.addEventListener("click", closeD);
    if (dov) dov.addEventListener("click", closeD);

    /* Mobile accordion */
    document.querySelectorAll(".dml[data-ds]").forEach(function (t) {
        t.addEventListener("click", function () {
            var s = document.getElementById(t.dataset.ds),
                isOpen = s.classList.contains("open");
            document.querySelectorAll(".dms.open").forEach(function (x) {
                x.classList.remove("open");
            });
            document.querySelectorAll(".dml.open").forEach(function (x) {
                x.classList.remove("open");
            });
            if (!isOpen) {
                s.classList.add("open");
                t.classList.add("open");
            }
        });
    });

    /* ─── Two-panel Courses mega: hover left category → show right panel ─── */
    document.querySelectorAll(".mp2-cat").forEach(function (cat) {
        cat.addEventListener("mouseenter", function () {
            var targetId = cat.dataset.cat;
            var target = document.getElementById(targetId);
            if (!target) return;
            var wrap = cat.closest(".mp2-wrap");
            wrap.querySelectorAll(".mp2-cat").forEach(function (c) { c.classList.remove("active"); });
            wrap.querySelectorAll(".mp2-panel").forEach(function (p) { p.classList.remove("active"); });
            cat.classList.add("active");
            target.classList.add("active");
            var content = wrap.querySelector(".mp2-content");
            if (content) content.style.display = "";
        });
    });

    /* ─── mp2-cat-link hover: hide right panel area (Awards, Administration) ─── */
    document.querySelectorAll(".mp2-cat-link").forEach(function (link) {
        link.addEventListener("mouseenter", function () {
            var wrap = link.closest(".mp2-wrap");
            wrap.querySelectorAll(".mp2-cat").forEach(function (c) { c.classList.remove("active"); });
            wrap.querySelectorAll(".mp2-panel").forEach(function (p) { p.classList.remove("active"); });
            var content = wrap.querySelector(".mp2-content");
            if (content) content.style.display = "none";
        });
    });

    /* ─── mp3-cat-link hover (Gallery categories with no subcategories): hide sub-category + preview columns ─── */
    document.querySelectorAll(".mp3-cat-link").forEach(function (link) {
        link.addEventListener("mouseenter", function () {
            document.querySelectorAll(".mp3-cat").forEach(function (c) { c.classList.remove("active"); });
            var yearsContainer = document.querySelector(".mp3-years-container");
            var preview = document.querySelector(".mp3-preview");
            if (yearsContainer) yearsContainer.style.display = "none";
            if (preview) preview.style.display = "none";
        });
    });
    document.querySelectorAll(".mp3-cat").forEach(function (cat) {
        cat.addEventListener("mouseenter", function () {
            var yearsContainer = document.querySelector(".mp3-years-container");
            var preview = document.querySelector(".mp3-preview");
            if (yearsContainer) yearsContainer.style.display = "";
            if (preview) preview.style.display = "";
        });
    });

    /* ─── Programs Mega Panel — Search ─── */
    (function () {
        var input    = document.getElementById("progSearch");
        var escBtn   = document.getElementById("progSearchEsc");
        var noRes    = document.getElementById("progNoRes");
        var termEl   = document.getElementById("progSearchTerm");
        var catsArea = document.getElementById("progCatsArea");
        if (!input || !catsArea) return;

        function runSearch(q) {
            var links = catsArea.querySelectorAll(".mp-prog__cat-link[data-search]");
            var found = 0;
            if (q) {
                // show all panels so hidden ones are searchable
                catsArea.querySelectorAll(".mp-prog__cat-panel").forEach(function (p) {
                    p.style.display = "block";
                });
                links.forEach(function (link) {
                    var match = link.dataset.search.indexOf(q) !== -1;
                    link.style.display = match ? "" : "none";
                    if (match) found++;
                });
            } else {
                // restore panel-based view (CSS handles active/inactive)
                catsArea.querySelectorAll(".mp-prog__cat-panel").forEach(function (p) {
                    p.style.display = "";
                });
                links.forEach(function (link) {
                    link.style.display = "";
                });
            }
            if (noRes) {
                noRes.style.display = (q && found === 0) ? "" : "none";
                if (termEl) termEl.textContent = q;
            }
        }

        input.addEventListener("input", function () {
            runSearch(this.value.toLowerCase().trim());
        });

        if (escBtn) {
            escBtn.addEventListener("click", function () {
                input.value = "";
                runSearch("");
                input.focus();
            });
        }

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && document.activeElement === input) {
                input.value = "";
                runSearch("");
            }
        });
    }());

    /* Back to top */
    var backTop = document.querySelector(".back-top");
    if (backTop) {
        backTop.addEventListener("click", function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    /* Footer year */
    var fy = document.getElementById("fyear");
    if (fy) fy.textContent = new Date().getFullYear();

    /* ─── Counter animation ─── */
    function animateCount(el) {
        var target = +el.dataset.target,
            start = 0,
            dur = 1800,
            step = (target / dur) * 16;
        var timer = setInterval(function () {
            start += step;
            if (start >= target) {
                start = target;
                clearInterval(timer);
            }
            el.textContent = Math.floor(start).toLocaleString();
        }, 16);
    }
    var cio = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) {
                    animateCount(en.target);
                    cio.unobserve(en.target);
                }
            });
        },
        { threshold: 0.5 },
    );
document.querySelectorAll(".counter[data-target]").forEach(function (el) {
    cio.observe(el);
});

    /* ─── Floating back-to-top ─── */
    var floatTop = document.getElementById("floatingTop");
    if (floatTop) {
        window.addEventListener(
            "scroll",
            function () {
                floatTop.classList.toggle("show", window.scrollY > 320);
            },
            { passive: true },
        );
        floatTop.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    /* ─── Scroll reveal ─── */
    var revIO = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) {
                    en.target.classList.add("vis");
                    revIO.unobserve(en.target);
                }
            });
        },
        { threshold: 0.1 },
    );
    document.querySelectorAll(".rv,.rvl,.rvr").forEach(function (el) {
        revIO.observe(el);
    });

    /* ─── Hero Swiper ─── */
    if (
        document.querySelector(".hp-hero__swiper") &&
        typeof Swiper !== "undefined"
    ) {
        var heroSwiper = new Swiper(".hp-hero__swiper", {
            loop: true,
            speed: 900,
            autoplay: { delay: 5000, disableOnInteraction: false },
            effect: "fade",
            fadeEffect: { crossFade: true },
            pagination: { el: ".hp-hero__dots", clickable: true },
            navigation: { nextEl: ".hp-hero__next", prevEl: ".hp-hero__prev" },
            on: {
                slideChange: function () {
                    var el = document.getElementById("heroSlideNum");
                    if (el) {
                        var n = this.realIndex + 1;
                        el.textContent = n < 10 ? "0" + n : n;
                    }
                },
            },
        });
    }

    /* ─── Testimonials Swiper ─── */
    if (
        document.querySelector(".hp-testi__swiper") &&
        typeof Swiper !== "undefined"
    ) {
        new Swiper(".hp-testi__swiper", {
            loop: true,
            speed: 700,
            spaceBetween: 24,
            slidesPerView: 1,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: ".hp-testi__dots",
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 } /* tablet */,
                1024: { slidesPerView: 3, spaceBetween: 24 } /* desktop */,
            },
        });
    }
window.switchProgCat = function (panelId, card) {
    document.querySelectorAll(".mp-prog__cat-panel").forEach(function (p) {
        p.classList.remove("mp-prog__cat-panel--active");
    });
    document.querySelectorAll(".mp-prog__card").forEach(function (c) {
        c.classList.remove("mp-prog__card--active");
    });
    var panel = document.getElementById(panelId);
    if (panel) panel.classList.add("mp-prog__cat-panel--active");
    if (card) card.classList.add("mp-prog__card--active");
};
window.switchGalleryCat = function (targetId, el) {
    document.querySelectorAll(".mp3-cat").forEach(function (item) {
        item.classList.remove("active");
    });

    el.classList.add("active");

    document.querySelectorAll(".mp3-years-list").forEach(function (item) {
        item.classList.remove("active");
    });

    var target = document.getElementById(targetId);
    if (target) {
        target.classList.add("active");
    }

    document.querySelectorAll(".gallery-preview-panel").forEach(function (item) {
        item.classList.remove("active");
        item.style.display = "none";
    });

    var previewId = el.getAttribute("data-preview");
    var preview = document.getElementById(previewId);

    if (preview) {
        preview.classList.add("active");
        preview.style.display = "block";
    }
};
})();
