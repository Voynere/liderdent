# Custom code scope

## Included by default

- `wp-content/themes/dental/`

## Manual review paths

These files live outside the theme directory and are **not** included unless verified:

- `wp-content/themes/home.php` — legacy file at themes root (33 KB), differs from `dental/home.php`
- `wp-content/themes/index.php` — stub at themes root

## Explicitly excluded

- WordPress core
- third-party plugins (ACF, AIOSEO, CF7, cyr2lat, updraftplus, wp-mail-smtp, wp-super-cache, etc.)
- `wp-config.php`, `.htaccess`
- uploads, caches, backups, logs
- `llms.txt`

## Notes

If custom plugins are added later, include the full plugin directory and extend the deploy workflow.
