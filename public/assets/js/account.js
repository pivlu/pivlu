/**
 * Pivlu - Open source Business Platform.
 * Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License
 * https://pivlu.com
 */
(function () {
    'use strict';

    /* -------------------------------------------------------
     * Dark / Light Mode Toggle
     * Uses Bootstrap 5.3 data-bs-theme attribute.
     * Persists preference in localStorage.
     * ------------------------------------------------------- */
    var THEME_KEY = 'pivlu-theme';
    var html      = document.documentElement;
    var toggle    = document.getElementById('darkModeToggle');
    var checkbox  = document.getElementById('darkModeCheck');

    function applyTheme(theme) {
        html.setAttribute('data-bs-theme', theme);
        if (checkbox) {
            checkbox.checked = theme === 'dark';
        }
    }

    // Apply stored preference (or system preference) on load
    var stored = localStorage.getItem(THEME_KEY);
    if (stored) {
        applyTheme(stored);
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        applyTheme('dark');
    } else {
        if (checkbox) checkbox.checked = false;
    }

    // Toggle on click
    if (toggle) {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var current = html.getAttribute('data-bs-theme') || 'light';
            var next    = current === 'dark' ? 'light' : 'dark';
            applyTheme(next);
            localStorage.setItem(THEME_KEY, next);
        });
    }

    /* -------------------------------------------------------
     * Mobile sidebar toggle
     * ------------------------------------------------------- */
    var sidebarToggle   = document.getElementById('sidebarToggle');
    var sidebar         = document.getElementById('accountSidebar');
    var sidebarBackdrop = document.getElementById('sidebarBackdrop');

    function openSidebar() {
        if (sidebar) sidebar.classList.add('show');
        if (sidebarBackdrop) sidebarBackdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        if (sidebar) sidebar.classList.remove('show');
        if (sidebarBackdrop) sidebarBackdrop.classList.remove('show');
        document.body.style.overflow = '';
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            if (sidebar && sidebar.classList.contains('show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    if (sidebarBackdrop) {
        sidebarBackdrop.addEventListener('click', closeSidebar);
    }

    /* -------------------------------------------------------
     * CSRF token for AJAX requests
     * ------------------------------------------------------- */
    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (csrfMeta) {
        window.csrfToken = csrfMeta.getAttribute('content');
    }

})();
