# Project facts

## Site

- **URL:** https://liderdent24.ru
- **Repo:** Voynere/liderdent (GitHub, **private** с 2026-08-15)
- **Локальный клон:** `/Volumes/dwSN850x/Projects/liderdent` (есть также `/home/voynere/Projects/liderdent`)
- **Stack:** WordPress + custom theme `wp-content/themes/dental/`
- **Клиника:** стоматология «ЛидерДент», Красноярск

## Deploy

- Prod SSH alias: `mrtlider` (тот же сервер, что mrt-lider.ru)
- Site path: `/var/www/liderdent/data/www/liderdent24.ru`
- CI: `.github/workflows/deploy.yml` на `main` — rsync темы `dental` + `scripts/`
- Secrets: `SERVER_HOST`, `SERVER_USER`, `SERVER_PORT`, `SERVER_SSH_KEY`, `SERVER_PATH`

## Agent memory

- RAG: `python3 .cursor/rag/rag.py query "..."`
- План работ: `seov/plan.md` (локально, gitignore)
- Отчёт: `seov/SEO-отчет-прогресс.md`
- Доступы: `docs/AGENT_ACCESS.md`

## Последняя сессия (17.08.2026 вечер)

- Аудит: SEO ~7/10, UX ~6.5/10 → после P0 ориентир ~7.5.
- P0 на проде: формы `.request__form` → `send_popup_form`; `404.php`; NAP; robots.txt.
- Метрика 106770436, аккаунт `lider.mrt`; цели form_* 598283148–151; ecommerce без PII.
- Topvisor 31594521 (216 ключей, Красноярск); сбор запущен, снимок когда percent=100.
- ДМС `/dms/` + пункт меню. Head `e265e2d`.
- Завтра: тонкие прайс-посты; снимок Topvisor; бэклог `seov/plan.md`.
- Handoff: `docs/HANDOFF_2026-08-17.md`
