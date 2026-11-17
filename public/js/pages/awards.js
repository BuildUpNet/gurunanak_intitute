/* Awards & Recognition page
   - Each section: ‹ › arrows only when its image row overflows (5+ on desktop)
   - Click an image → shared full-screen popup with that section's images (‹ ›, arrow keys, swipe, Esc) */
(function () {
    'use strict';

    function init() {
        var lb = document.getElementById('awdLb');
        var lbImg = document.getElementById('awdLbImg');
        var lbCounter = document.getElementById('awdLbCounter');
        var cards = [];
        var lbIndex = 0;
        var touchX = null;

        function pad(n) {
            return n < 10 ? '0' + n : '' + n;
        }

        function showLb(i) {
            lbIndex = (i + cards.length) % cards.length;
            var img = cards[lbIndex].querySelector('img');
            lbImg.src = img.src;
            lbImg.alt = img.alt;
            lbCounter.textContent = pad(lbIndex + 1) + ' / ' + pad(cards.length);
        }

        function openLb(sectionCards, i) {
            cards = sectionCards;
            lb.classList.toggle('awd-lb--single', cards.length < 2);
            showLb(i);
            lb.classList.add('open');
            lb.setAttribute('aria-hidden', 'false');
            document.body.classList.add('awd-lb-lock');
        }

        function closeLb() {
            lb.classList.remove('open');
            lb.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('awd-lb-lock');
        }

        document.querySelectorAll('[data-awd-section]').forEach(function (section) {
            var track = section.querySelector('[data-awd-track]');
            var nav = section.querySelector('[data-awd-nav]');
            var prev = section.querySelector('[data-awd-prev]');
            var next = section.querySelector('[data-awd-next]');
            var sectionCards = Array.prototype.slice.call(track.querySelectorAll('.awd-card'));

            function step() {
                var card = sectionCards[0];
                var gap = parseFloat(getComputedStyle(track).columnGap) || 0;
                return card ? card.offsetWidth + gap : track.clientWidth;
            }

            function updateNav() {
                var max = track.scrollWidth - track.clientWidth;
                nav.hidden = max <= 2;
                prev.disabled = track.scrollLeft <= 2;
                next.disabled = track.scrollLeft >= max - 2;
            }

            prev.addEventListener('click', function () {
                track.scrollBy({ left: -step(), behavior: 'smooth' });
            });
            next.addEventListener('click', function () {
                track.scrollBy({ left: step(), behavior: 'smooth' });
            });
            track.addEventListener('scroll', updateNav, { passive: true });
            window.addEventListener('resize', updateNav, { passive: true });
            window.addEventListener('load', updateNav);
            updateNav();

            if (lb) {
                sectionCards.forEach(function (card, i) {
                    card.addEventListener('click', function () {
                        openLb(sectionCards, i);
                    });
                });
            }
        });

        if (!lb) return;

        document.getElementById('awdLbClose').addEventListener('click', closeLb);
        document.getElementById('awdLbPrev').addEventListener('click', function () {
            showLb(lbIndex - 1);
        });
        document.getElementById('awdLbNext').addEventListener('click', function () {
            showLb(lbIndex + 1);
        });
        lb.addEventListener('click', function (e) {
            if (e.target === lb) closeLb();
        });
        document.addEventListener('keydown', function (e) {
            if (!lb.classList.contains('open')) return;
            if (e.key === 'Escape') closeLb();
            if (e.key === 'ArrowRight') showLb(lbIndex + 1);
            if (e.key === 'ArrowLeft') showLb(lbIndex - 1);
        });
        lb.addEventListener('touchstart', function (e) {
            touchX = e.changedTouches[0].clientX;
        }, { passive: true });
        lb.addEventListener('touchend', function (e) {
            if (touchX === null) return;
            var dx = e.changedTouches[0].clientX - touchX;
            if (Math.abs(dx) > 50) showLb(lbIndex + (dx < 0 ? 1 : -1));
            touchX = null;
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
