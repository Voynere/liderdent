# Liderdent (liderdent24.ru)

Локально — полная копия WordPress-сайта. В GitHub уходит только кастомный код (через `.gitignore`), как у ferma-dv и других WP-проектов.

## Что в git

- `wp-content/themes/dental/`
- `.github/workflows/` — деплой на сервер
- `scripts/`, `docs/`
- `.cursor/` — RAG-память агента, правила, карта темы

## Что только локально / на сервере

- Ядро WordPress
- Сторонние плагины
- `wp-config.php`, `.htaccess`
- uploads, cache, backups
- `seov/` — планы, отчёты, SEO-база (gitignore)

## Деплой

Push в `main` → GitHub Actions rsync темы `dental` на прод.

Секреты: `SERVER_HOST`, `SERVER_USER`, `SERVER_PORT`, `SERVER_SSH_KEY`, `SERVER_PATH`.

Прод: `/var/www/liderdent/data/www/liderdent24.ru` на `37.46.132.136` (`ssh mrtlider`).

## Agent / RAG

```bash
python3 .cursor/rag/rag.py query "deploy theme"
python3 .cursor/rag/rag.py index      # после правок в docs/ или seov/
python3 .cursor/rag/rag.py status
```

- Доступы и CI: `docs/AGENT_ACCESS.md`
- План работ (локально): `seov/plan.md`
- Карта темы: `.cursor/knowledge/theme.md`
