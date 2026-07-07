# Fact

## 2026-07-03 — Bootstrap: RAG, seov, agent docs

- Поднята agent-память по образцу ferma-dv / mrt-lider: `.cursor/rag/rag.py` (SQLite FTS5).
- Добавлены правила bootstrap, agent-memory, dev-commit-push-ci.
- `docs/AGENT_ACCESS.md` — SSH (`mrtlider`), deploy.yml, WP-CLI на проде.
- `.cursor/knowledge/theme.md` — карта шаблонов и логики темы `dental`.
- Локальная папка `seov/` (gitignore) — планы, отчёты, будущий RAG контента сайта.
- План работ: положить в `seov/plan.md`, затем `python3 .cursor/rag/rag.py index`.
- Следующая сессия: прочитать `seov/plan.md` и начать первый этап плана.
