---
verify: bash scripts/verify.sh
---

# ЛИДЕР ДЕНТ (liderdent24.ru) — WordPress theme `wp-content/themes/dental`

Custom theme over ACF + AIOSEO + WooCommerce (price catalogue). Production: PHP 7.4/FPM, MariaDB, VPS (see docs/).

## Conventions

- Lead capture goes through AJAX `send_popup_form` (registered in `functions.php`, NOT in `inc/seo.php`) — `wp_ajax_nopriv_` must stay, logged-out visitors are the whole revenue path.
- NAP (name/address/phone/hours) is read from `liderdent_seo_clinic_nap()` in `inc/seo.php` only. Never hardcode `Мужества 4`, `aliderdent@mail.ru`, `09:00–21:00` in templates or schema.
- JSON-LD (`DentalClinic`/`Dentist`/`FAQPage`) + robots + sitemap wiring lives in `inc/seo.php`; virtual `/services-sitemap.xml` is served on `init` + `template_redirect`.
- Home hero: H1 «Стоматология в Красноярске / «ЛидерДент»» and `<title>` are deliberate SEO decisions — do not rewrite silently. Video init is `initHeroVideo()` in `assets/js/home.js` — don't touch when editing hero markup.
- Metrika goals `form_open` / `form_start` depend on `#popup-callback` + `#popup-credit` existing in both `header.php` and `header-home.php`, and on `.open-popup-callback` in `footer.php`.
- Price-SKU cleanup (301 + noindex of ~60 thin `/product/` pages) relies on the AIOSEO filters in `inc/seo.php` — verify before touching.

## Don't break

- `bash scripts/verify.sh` (PHP lint of the whole theme + the invariants above). Run it after any theme edit.
- Review SEO state snapshots before/after in `seov/` (`topvisor.md`, `SEO-отчет-прогресс.md`, `metrika-snapshot.json`); handoffs in `docs/HANDOFF_*.md`.
