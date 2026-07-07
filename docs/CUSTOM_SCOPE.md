# Custom code scope

## Included in git

- `wp-content/themes/dental/`
- `.cursor/` (rules, knowledge, RAG script; `store.sqlite` — локально)
- `docs/AGENT_ACCESS.md`

## Local-only (ignored by .gitignore)

- WordPress core (`wp-admin/`, `wp-includes/`, root `wp-*.php`)
- All plugins under `wp-content/plugins/`
- `wp-config.php`, `.htaccess`
- uploads, cache, backups, logs
- `llms.txt`, root favicons
- `seov/` — планы, отчёты, RAG контента сайта

## Manual review

- `wp-content/themes/home.php` — legacy file outside `dental/`
- `wp-content/themes/index.php` — stub outside `dental/`

## Adding custom plugins later

Un-ignore the plugin in `.gitignore` and extend `.github/workflows/deploy.yml`.
