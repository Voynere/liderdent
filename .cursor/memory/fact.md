# Fact

## 2026-07-03 — Bootstrap: RAG, seov, agent docs

- Поднята agent-память по образцу ferma-dv / mrt-lider: `.cursor/rag/rag.py` (SQLite FTS5).
- Добавлены правила bootstrap, agent-memory, dev-commit-push-ci.
- `docs/AGENT_ACCESS.md` — SSH (`mrtlider`), deploy.yml, WP-CLI на проде.
- `.cursor/knowledge/theme.md` — карта шаблонов и логики темы `dental`.
- Локальная папка `seov/` (gitignore) — планы, отчёты, будущий RAG контента сайта.
- План работ: положить в `seov/plan.md`, затем `python3 .cursor/rag/rag.py index`.
- Следующая сессия: прочитать `seov/plan.md` и начать первый этап плана.

## 2026-07-16 08:15 UTC

Как добавить кейсы врачу: 1) папка assets/img/<key>-cases/ 2) cases_gallery=<key> в профиле 3) записи в liderdent_get_doctor_cases_catalog().
