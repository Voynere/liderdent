/**
 * Site-wide search: overlay + AJAX (services, prices, doctors, articles).
 * Pattern from MRT Lider assets/js/search.js.
 */
(function () {
    'use strict';

    var DEBOUNCE_MS = 300;
    var debounceTimer = null;
    var lastQuery = '';
    var GROUP_ORDER = ['services', 'prices', 'promotions', 'doctors', 'articles', 'faq', 'pages'];

    function ajaxUrl() {
        return (window.LIDERDENT_SEARCH && window.LIDERDENT_SEARCH.ajax_url) || '/wp-admin/admin-ajax.php';
    }

    function openOverlay(prefill) {
        var overlay = document.getElementById('ld-search-overlay');
        if (!overlay) return;
        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('ld-search-open');
        var input = overlay.querySelector('.ld-search-overlay__input');
        if (!input) return;
        if (typeof prefill === 'string') {
            input.value = prefill;
        }
        input.focus();
        if (input.value.trim().length >= 2) {
            runSearch(input.value);
        } else {
            var body = overlay.querySelector('.ld-search-overlay__body');
            if (body) {
                body.innerHTML = '<p class="ld-search-overlay__hint">Введите минимум 2 символа</p>';
            }
        }
    }

    function closeOverlay() {
        var overlay = document.getElementById('ld-search-overlay');
        if (!overlay) return;
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('ld-search-open');
    }

    function escapeHtml(str) {
        var d = document.createElement('div');
        d.textContent = str == null ? '' : String(str);
        return d.innerHTML;
    }

    function renderResults(data) {
        var body = document.querySelector('.ld-search-overlay__body');
        if (!body) return;

        var html = '';
        var hasAny = false;
        GROUP_ORDER.forEach(function (key) {
            var group = data[key];
            var items = group && group.items ? group.items : [];
            if (!items.length) return;
            hasAny = true;
            html += '<div class="ld-search-group"><h3 class="ld-search-group__title">' + escapeHtml(group.label || '') + '</h3><ul class="ld-search-group__list">';
            items.forEach(function (item) {
                html += '<li><a href="' + escapeHtml(item.url) + '" class="ld-search-group__link">' +
                    escapeHtml(item.title) + '</a></li>';
            });
            html += '</ul></div>';
        });

        if (!hasAny) {
            html = '<p class="ld-search-overlay__empty">Ничего не найдено. Попробуйте другой запрос.</p>';
        }
        body.innerHTML = html;
    }

    function runSearch(q) {
        q = (q || '').trim();
        lastQuery = q;
        var body = document.querySelector('.ld-search-overlay__body');
        if (!body) return;

        if (q.length < 2) {
            body.innerHTML = '<p class="ld-search-overlay__hint">Введите минимум 2 символа</p>';
            return;
        }

        body.innerHTML = '<p class="ld-search-overlay__hint">Поиск…</p>';

        var params = new URLSearchParams({
            action: 'liderdent_site_search',
            q: q,
        });

        fetch(ajaxUrl() + '?' + params.toString(), { credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (lastQuery !== q) return;
                if (data.success && data.data) {
                    renderResults(data.data);
                } else {
                    body.innerHTML = '<p class="ld-search-overlay__empty">Ошибка поиска</p>';
                }
            })
            .catch(function () {
                if (lastQuery === q) {
                    body.innerHTML = '<p class="ld-search-overlay__empty">Ошибка соединения</p>';
                }
            });
    }

    function onSearchInput(e) {
        var q = e.target.value;
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () { runSearch(q); }, DEBOUNCE_MS);
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.header__follow-search-hidden, .js-site-search-open').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                window.setTimeout(function () { openOverlay(''); }, 0);
            });
        });

        document.querySelectorAll('form.header__follow-search').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                if (!document.getElementById('ld-search-overlay')) return;
                e.preventDefault();
                var field = form.querySelector('.follow-search');
                openOverlay(field ? field.value : '');
            });
            var field = form.querySelector('.follow-search');
            if (field) {
                var queueOpen = function () {
                    window.setTimeout(function () { openOverlay(field.value); }, 0);
                };
                field.addEventListener('focus', queueOpen);
                field.addEventListener('click', queueOpen);
                field.addEventListener('input', queueOpen);
            }
        });

        var overlay = document.getElementById('ld-search-overlay');
        if (overlay) {
            overlay.querySelectorAll('[data-ld-search-close]').forEach(function (el) {
                el.addEventListener('click', closeOverlay);
            });
            var input = overlay.querySelector('.ld-search-overlay__input');
            if (input) {
                input.addEventListener('input', onSearchInput);
                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') closeOverlay();
                });
            }
            var form = overlay.querySelector('form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    var value = input ? input.value.trim() : '';
                    if (value.length < 2) {
                        e.preventDefault();
                    }
                });
            }
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeOverlay();
        });
    });
})();
