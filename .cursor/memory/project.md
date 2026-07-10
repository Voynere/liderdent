# Project facts

## Site

- **URL:** https://liderdent24.ru
- **Repo:** Voynere/liderdent (GitHub)
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

## Последняя сессия (10.07.2026)

- Виджет чата: интерактив + позиция по контенту (`ca5ec14`)
- Hero-видео и галерея «О нас» — на проде
- Следующее: ПроДокторов на проде, баннеры акций (заказчик)
