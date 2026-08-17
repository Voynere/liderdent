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

## 2026-08-11 07:43 UTC

Сессия 11.08.2026: RAG-индекс пересобран (64 chunks: memory/knowledge/docs/code). Папки seov/ локально нет — план/SEO-отчёты отсутствуют. Прод https://liderdent24.ru отвечает 200 (home/doctors/prices/service). Сайт — WP тема dental, клиника ЛидерДент Красноярск.

## 2026-08-11 07:53 UTC

Восстановлен seov/plan.md (2026-08-11): этапы врачи → акции → SEO → UX. Ближайшее: deploy slug, smoke ПроДокторов, сверка списка врачей.

## 2026-08-16 14:45 UTC

GitHub Voynere/liderdent private с 2026-08-15. Локальный путь /home/voynere/Projects/liderdent. Клон/push через gh HTTPS, не git@ SSH (host key / ssh-askpass).

## 2026-08-17 01:13 UTC

Цели Метрики 106770436 (form_open, form_start, form_submit_success, form_submit_error) кодом шлются, в API не созданы: нет OAuth metrika:write. Положить токен в seov/.env.metrika и повторить POST /management/v1/counter/106770436/goals.

## 2026-08-17 01:57 UTC

Topvisor liderdent24.ru: проект 31594521, 216 ключей / 28 групп, Яндекс+Google Красноярск region_key=62 (indexes 87 и 151). Сбор позиций запущен 2026-08-17, checker/go вернул projectIds [31594521], отдельного task id нет. Ключ в seov/.env.topvisor (gitignore), тот же аккаунт что lighttread/proauc. Не дублировать проект. Таблица: seov/topvisor.md

## 2026-08-17 08:34 UTC

liderdent24.ru: клиника Красноярск, ул. Мужества, 4. Счётчик Метрики 106770436, аккаунт lider.mrt (как МРТ Лидер / Вебмастер). JS-цели form_open 598283148, form_start 598283149, form_submit_success 598283150, form_submit_error 598283151. Ecommerce dataLayer без PII. Topvisor проект 31594521, 216 ключей, 28 групп, Яндекс+Google Красноярск region_key=62. ДМС /dms/: СОГАЗ, Ингосстрах, АльфаСтрахование, Сберздоровье. Локальные env gitignore: seov/.env.metrika и seov/.env.topvisor. Клон: /Volumes/dwSN850x/Projects/liderdent.
