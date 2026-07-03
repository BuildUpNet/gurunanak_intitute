/* ============================================================
   Admin Icon Picker — Font Awesome 6 Free (Solid)
   Usage: any element with class="icon-pick-btn" and
          data-target="inputId"  OR  inside .icon-pick-wrap
============================================================ */
(function () {

    /* ── Icon library ─────────────────────────────────────── */
    var ICONS = [
        /* Education & Academic */
        { g: 'Education', c: 'fas fa-graduation-cap' },
        { g: 'Education', c: 'fas fa-book' },
        { g: 'Education', c: 'fas fa-book-open' },
        { g: 'Education', c: 'fas fa-school' },
        { g: 'Education', c: 'fas fa-university' },
        { g: 'Education', c: 'fas fa-chalkboard' },
        { g: 'Education', c: 'fas fa-chalkboard-teacher' },
        { g: 'Education', c: 'fas fa-certificate' },
        { g: 'Education', c: 'fas fa-award' },
        { g: 'Education', c: 'fas fa-medal' },
        { g: 'Education', c: 'fas fa-pencil-alt' },
        { g: 'Education', c: 'fas fa-pen' },
        { g: 'Education', c: 'fas fa-edit' },
        { g: 'Education', c: 'fas fa-calculator' },
        { g: 'Education', c: 'fas fa-flask' },
        { g: 'Education', c: 'fas fa-microscope' },
        { g: 'Education', c: 'fas fa-atom' },
        { g: 'Education', c: 'fas fa-dna' },
        { g: 'Education', c: 'fas fa-brain' },
        { g: 'Education', c: 'fas fa-ruler' },
        { g: 'Education', c: 'fas fa-ruler-combined' },

        /* Medical & Health */
        { g: 'Medical', c: 'fas fa-heartbeat' },
        { g: 'Medical', c: 'fas fa-hospital' },
        { g: 'Medical', c: 'fas fa-stethoscope' },
        { g: 'Medical', c: 'fas fa-pills' },
        { g: 'Medical', c: 'fas fa-user-md' },
        { g: 'Medical', c: 'fas fa-ambulance' },
        { g: 'Medical', c: 'fas fa-syringe' },
        { g: 'Medical', c: 'fas fa-tooth' },
        { g: 'Medical', c: 'fas fa-eye' },
        { g: 'Medical', c: 'fas fa-heart' },
        { g: 'Medical', c: 'fas fa-lungs' },
        { g: 'Medical', c: 'fas fa-x-ray' },
        { g: 'Medical', c: 'fas fa-band-aid' },
        { g: 'Medical', c: 'fas fa-first-aid' },
        { g: 'Medical', c: 'fas fa-vial' },
        { g: 'Medical', c: 'fas fa-wheelchair' },
        { g: 'Medical', c: 'fas fa-procedures' },
        { g: 'Medical', c: 'fas fa-notes-medical' },
        { g: 'Medical', c: 'fas fa-clinic-medical' },
        { g: 'Medical', c: 'fas fa-thermometer' },
        { g: 'Medical', c: 'fas fa-weight' },
        { g: 'Medical', c: 'fas fa-eye-dropper' },

        /* Technology & IT */
        { g: 'Technology', c: 'fas fa-laptop' },
        { g: 'Technology', c: 'fas fa-desktop' },
        { g: 'Technology', c: 'fas fa-code' },
        { g: 'Technology', c: 'fas fa-database' },
        { g: 'Technology', c: 'fas fa-cloud' },
        { g: 'Technology', c: 'fas fa-server' },
        { g: 'Technology', c: 'fas fa-wifi' },
        { g: 'Technology', c: 'fas fa-mobile-alt' },
        { g: 'Technology', c: 'fas fa-tablet-alt' },
        { g: 'Technology', c: 'fas fa-robot' },
        { g: 'Technology', c: 'fas fa-microchip' },
        { g: 'Technology', c: 'fas fa-bug' },
        { g: 'Technology', c: 'fas fa-cogs' },
        { g: 'Technology', c: 'fas fa-terminal' },
        { g: 'Technology', c: 'fas fa-network-wired' },
        { g: 'Technology', c: 'fas fa-shield-alt' },
        { g: 'Technology', c: 'fas fa-lock' },
        { g: 'Technology', c: 'fas fa-key' },
        { g: 'Technology', c: 'fas fa-sitemap' },
        { g: 'Technology', c: 'fas fa-gamepad' },
        { g: 'Technology', c: 'fas fa-satellite' },
        { g: 'Technology', c: 'fas fa-hdd' },
        { g: 'Technology', c: 'fas fa-memory' },
        { g: 'Technology', c: 'fas fa-print' },

        /* Business & Career */
        { g: 'Business', c: 'fas fa-briefcase' },
        { g: 'Business', c: 'fas fa-building' },
        { g: 'Business', c: 'fas fa-chart-bar' },
        { g: 'Business', c: 'fas fa-chart-line' },
        { g: 'Business', c: 'fas fa-chart-pie' },
        { g: 'Business', c: 'fas fa-coins' },
        { g: 'Business', c: 'fas fa-dollar-sign' },
        { g: 'Business', c: 'fas fa-money-bill' },
        { g: 'Business', c: 'fas fa-handshake' },
        { g: 'Business', c: 'fas fa-industry' },
        { g: 'Business', c: 'fas fa-store' },
        { g: 'Business', c: 'fas fa-shopping-cart' },
        { g: 'Business', c: 'fas fa-bullhorn' },
        { g: 'Business', c: 'fas fa-lightbulb' },
        { g: 'Business', c: 'fas fa-rocket' },
        { g: 'Business', c: 'fas fa-trophy' },
        { g: 'Business', c: 'fas fa-tasks' },
        { g: 'Business', c: 'fas fa-project-diagram' },
        { g: 'Business', c: 'fas fa-clipboard-list' },
        { g: 'Business', c: 'fas fa-file-alt' },
        { g: 'Business', c: 'fas fa-file-invoice' },
        { g: 'Business', c: 'fas fa-receipt' },
        { g: 'Business', c: 'fas fa-landmark' },
        { g: 'Business', c: 'fas fa-piggy-bank' },
        { g: 'Business', c: 'fas fa-wallet' },
        { g: 'Business', c: 'fas fa-credit-card' },
        { g: 'Business', c: 'fas fa-percentage' },

        /* People */
        { g: 'People', c: 'fas fa-user' },
        { g: 'People', c: 'fas fa-users' },
        { g: 'People', c: 'fas fa-user-graduate' },
        { g: 'People', c: 'fas fa-user-tie' },
        { g: 'People', c: 'fas fa-user-md' },
        { g: 'People', c: 'fas fa-user-nurse' },
        { g: 'People', c: 'fas fa-child' },
        { g: 'People', c: 'fas fa-baby' },
        { g: 'People', c: 'fas fa-male' },
        { g: 'People', c: 'fas fa-female' },
        { g: 'People', c: 'fas fa-hands-helping' },
        { g: 'People', c: 'fas fa-user-friends' },
        { g: 'People', c: 'fas fa-people-carry' },
        { g: 'People', c: 'fas fa-running' },

        /* Communication */
        { g: 'Communication', c: 'fas fa-envelope' },
        { g: 'Communication', c: 'fas fa-phone' },
        { g: 'Communication', c: 'fas fa-phone-alt' },
        { g: 'Communication', c: 'fas fa-comment' },
        { g: 'Communication', c: 'fas fa-comments' },
        { g: 'Communication', c: 'fas fa-broadcast-tower' },
        { g: 'Communication', c: 'fas fa-satellite-dish' },
        { g: 'Communication', c: 'fas fa-share-alt' },
        { g: 'Communication', c: 'fas fa-paper-plane' },
        { g: 'Communication', c: 'fas fa-bell' },
        { g: 'Communication', c: 'fas fa-rss' },
        { g: 'Communication', c: 'fas fa-at' },

        /* General / UI */
        { g: 'General', c: 'fas fa-home' },
        { g: 'General', c: 'fas fa-star' },
        { g: 'General', c: 'fas fa-check' },
        { g: 'General', c: 'fas fa-check-circle' },
        { g: 'General', c: 'fas fa-times' },
        { g: 'General', c: 'fas fa-times-circle' },
        { g: 'General', c: 'fas fa-plus' },
        { g: 'General', c: 'fas fa-minus' },
        { g: 'General', c: 'fas fa-info-circle' },
        { g: 'General', c: 'fas fa-question-circle' },
        { g: 'General', c: 'fas fa-exclamation-circle' },
        { g: 'General', c: 'fas fa-search' },
        { g: 'General', c: 'fas fa-cog' },
        { g: 'General', c: 'fas fa-wrench' },
        { g: 'General', c: 'fas fa-tools' },
        { g: 'General', c: 'fas fa-map-marker-alt' },
        { g: 'General', c: 'fas fa-globe' },
        { g: 'General', c: 'fas fa-flag' },
        { g: 'General', c: 'fas fa-fire' },
        { g: 'General', c: 'fas fa-leaf' },
        { g: 'General', c: 'fas fa-tree' },
        { g: 'General', c: 'fas fa-sun' },
        { g: 'General', c: 'fas fa-moon' },
        { g: 'General', c: 'fas fa-image' },
        { g: 'General', c: 'fas fa-camera' },
        { g: 'General', c: 'fas fa-video' },
        { g: 'General', c: 'fas fa-music' },
        { g: 'General', c: 'fas fa-film' },
        { g: 'General', c: 'fas fa-download' },
        { g: 'General', c: 'fas fa-upload' },
        { g: 'General', c: 'fas fa-link' },
        { g: 'General', c: 'fas fa-clock' },
        { g: 'General', c: 'fas fa-calendar' },
        { g: 'General', c: 'fas fa-calendar-alt' },
        { g: 'General', c: 'fas fa-bookmark' },
        { g: 'General', c: 'fas fa-tag' },
        { g: 'General', c: 'fas fa-tags' },
        { g: 'General', c: 'fas fa-trash' },
        { g: 'General', c: 'fas fa-redo' },
        { g: 'General', c: 'fas fa-undo' },
        { g: 'General', c: 'fas fa-power-off' },
        { g: 'General', c: 'fas fa-layer-group' },
        { g: 'General', c: 'fas fa-th-large' },
        { g: 'General', c: 'fas fa-th' },
        { g: 'General', c: 'fas fa-list' },
        { g: 'General', c: 'fas fa-bars' },
        { g: 'General', c: 'fas fa-ellipsis-v' },
        { g: 'General', c: 'fas fa-ellipsis-h' },
        { g: 'General', c: 'fas fa-arrow-right' },
        { g: 'General', c: 'fas fa-arrow-left' },
        { g: 'General', c: 'fas fa-arrow-up' },
        { g: 'General', c: 'fas fa-arrow-down' },
        { g: 'General', c: 'fas fa-chevron-right' },
        { g: 'General', c: 'fas fa-external-link-alt' },

        /* Transport */
        { g: 'Transport', c: 'fas fa-car' },
        { g: 'Transport', c: 'fas fa-bus' },
        { g: 'Transport', c: 'fas fa-train' },
        { g: 'Transport', c: 'fas fa-plane' },
        { g: 'Transport', c: 'fas fa-bicycle' },
        { g: 'Transport', c: 'fas fa-motorcycle' },
        { g: 'Transport', c: 'fas fa-truck' },
        { g: 'Transport', c: 'fas fa-ship' },
        { g: 'Transport', c: 'fas fa-taxi' },
        { g: 'Transport', c: 'fas fa-road' },
    ];

    var groups = [];
    ICONS.forEach(function (icon) {
        if (groups.indexOf(icon.g) === -1) groups.push(icon.g);
    });

    /* ── State ──────────────────────────────────────────────── */
    var currentInput  = null;
    var activeGroup   = 'All';

    /* ── Build modal HTML ────────────────────────────────────── */
    function buildModal() {
        var overlay = document.createElement('div');
        overlay.id = 'ipm-overlay';

        var groupTabs = '<button type="button" class="ipm-tab ipm-tab--active" data-group="All">All</button>';
        groups.forEach(function (g) {
            groupTabs += '<button type="button" class="ipm-tab" data-group="' + g + '">' + g + '</button>';
        });

        overlay.innerHTML =
            '<div id="ipm-box">' +
                '<div id="ipm-head">' +
                    '<div id="ipm-title"><i class="fas fa-icons"></i> Choose an Icon</div>' +
                    '<input type="text" id="ipm-search" placeholder="Search icons..." autocomplete="off">' +
                    '<button type="button" id="ipm-close" aria-label="Close">&times;</button>' +
                '</div>' +
                '<div id="ipm-tabs">' + groupTabs + '</div>' +
                '<div id="ipm-grid"></div>' +
            '</div>';

        document.body.appendChild(overlay);
        return overlay;
    }

    /* ── Render grid ─────────────────────────────────────────── */
    function renderGrid(query, group) {
        var grid = document.getElementById('ipm-grid');
        if (!grid) return;
        var q = (query || '').toLowerCase().trim();

        var filtered = ICONS.filter(function (icon) {
            var matchGroup = (group === 'All' || icon.g === group);
            var matchQuery = !q || icon.c.replace('fas fa-', '').indexOf(q) !== -1;
            return matchGroup && matchQuery;
        });

        if (filtered.length === 0) {
            grid.innerHTML = '<p style="grid-column:1/-1;text-align:center;color:#9fafc8;padding:30px 0;">No icons found</p>';
            return;
        }

        var html = '';
        filtered.forEach(function (icon) {
            html +=
                '<button type="button" class="ipm-card" data-icon="' + icon.c + '" title="' + icon.c.replace('fas fa-', '') + '">' +
                    '<i class="' + icon.c + '"></i>' +
                    '<span>' + icon.c.replace('fas fa-', '') + '</span>' +
                '</button>';
        });
        grid.innerHTML = html;
    }

    /* ── Open / Close ────────────────────────────────────────── */
    function openPicker(inputEl) {
        currentInput = inputEl;
        var overlay = document.getElementById('ipm-overlay') || buildModal();
        overlay.style.display = 'flex';
        document.getElementById('ipm-search').value = '';
        activeGroup = 'All';
        document.querySelectorAll('.ipm-tab').forEach(function (t) {
            t.classList.toggle('ipm-tab--active', t.dataset.group === 'All');
        });
        renderGrid('', 'All');
        setTimeout(function () { document.getElementById('ipm-search').focus(); }, 80);
    }

    function closePicker() {
        var overlay = document.getElementById('ipm-overlay');
        if (overlay) overlay.style.display = 'none';
        currentInput = null;
    }

    /* ── Event delegation ────────────────────────────────────── */
    document.addEventListener('click', function (e) {

        /* Open picker button */
        var btn = e.target.closest('.icon-pick-btn');
        if (btn) {
            e.preventDefault();
            var targetId = btn.dataset.target;
            var input;
            if (targetId) {
                input = document.getElementById(targetId);
            } else {
                input = btn.closest('.icon-pick-wrap') && btn.closest('.icon-pick-wrap').querySelector('.icon-input');
            }
            if (input) openPicker(input);
            return;
        }

        /* Click the preview box itself */
        var previewBox = e.target.closest('.icon-picker-trigger');
        if (previewBox) {
            var id = previewBox.dataset.target;
            if (id) openPicker(document.getElementById(id));
            return;
        }

        /* Select icon card */
        var card = e.target.closest('.ipm-card');
        if (card && currentInput) {
            var cls = card.dataset.icon;
            currentInput.value = cls;
            currentInput.dispatchEvent(new Event('input', { bubbles: true }));
            /* update any sibling preview <i> */
            var wrap = currentInput.closest('.icon-pick-wrap');
            if (wrap) {
                var preview = wrap.querySelector('.icon-live-preview');
                if (preview) preview.className = 'icon-live-preview ' + cls;
            }
            /* update standalone #iconPreview on page */
            var standalone = document.getElementById('iconPreview');
            if (standalone) standalone.className = cls;
            closePicker();
            return;
        }

        /* Close on overlay click */
        if (e.target.id === 'ipm-overlay') { closePicker(); return; }
        if (e.target.id === 'ipm-close' || e.target.closest('#ipm-close')) { closePicker(); return; }

        /* Group tabs */
        var tab = e.target.closest('.ipm-tab');
        if (tab) {
            activeGroup = tab.dataset.group;
            document.querySelectorAll('.ipm-tab').forEach(function (t) {
                t.classList.toggle('ipm-tab--active', t === tab);
            });
            renderGrid(document.getElementById('ipm-search').value, activeGroup);
        }
    });

    /* Search in picker */
    document.addEventListener('input', function (e) {
        if (e.target.id === 'ipm-search') {
            renderGrid(e.target.value, activeGroup);
        }
    });

    /* ESC to close */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closePicker();
    });

}());
