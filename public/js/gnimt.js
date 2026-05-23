/* public/js/gnimt.js */
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

    /* MEGA */
    document.querySelectorAll(".nvl li.hm").forEach(function (li) {
        var p = document.getElementById(li.dataset.mp);
        if (!p) return;
        li.addEventListener("mouseenter", function () {
            closeAll();
            li.classList.add("mpopen");
            p.classList.add("open");
        });
        li.addEventListener("mouseleave", function () {
            setTimeout(function () {
                if (!p.matches(":hover")) {
                    li.classList.remove("mpopen");
                    p.classList.remove("open");
                }
            }, 60);
        });
        p.addEventListener("mouseleave", function () {
            li.classList.remove("mpopen");
            p.classList.remove("open");
        });
    });

    /* DROPS */
    document.querySelectorAll(".nvl li.hd").forEach(function (li) {
        var p = document.getElementById(li.dataset.dp);
        if (!p) return;
        li.addEventListener("mouseenter", function () {
            closeAll();
            posDrop(li, p);
            li.classList.add("dpopen");
            p.classList.add("open");
        });
        li.addEventListener("mouseleave", function () {
            setTimeout(function () {
                if (!p.matches(":hover")) {
                    li.classList.remove("dpopen");
                    p.classList.remove("open");
                }
            }, 60);
        });
        p.addEventListener("mouseleave", function () {
            li.classList.remove("dpopen");
            p.classList.remove("open");
        });
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

    /* Counter animation */
    function animateCount(el) {
        var target = +el.dataset.target,
            start = 0,
            duration = 1600,
            step = (target / duration) * 16;
        var timer = setInterval(function () {
            start += step;
            if (start >= target) {
                start = target;
                clearInterval(timer);
            }
            el.textContent = Math.floor(start).toLocaleString();
        }, 16);
    }
    var io = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) {
                    animateCount(en.target);
                    io.unobserve(en.target);
                }
            });
        },
        { threshold: 0.5 },
    );
    document.querySelectorAll("[data-target]").forEach(function (el) {
        io.observe(el);
    });
})();
