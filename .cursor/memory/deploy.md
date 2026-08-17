# Deploy


## 2026-07-10 00:06 UTC

После деплоя галерея /about/ ломалась из-за WP Super Cache: wp super-cache flush не работает, нужен rm -rf wp-content/cache/supercache/*

## 2026-07-10 01:30 UTC

Зависший CI run (49 мин) блокировал очередь deploy-liderdent-production — отменять через gh run cancel

## 2026-07-10 03:46 UTC

Сессия 10.07: main @ ca5ec14, deploy run 29067560606 success, prod smoke 200

## 2026-08-11 07:55 UTC

Slug Асрян на проде: /specialist/asryan-mariam-araratovna/ = 200, старый malikov → 301. SHA f005ddb, deploy run 31470865583 зелёный.

## 2026-08-14 01:46 UTC

Deploy c058236 SEO/UI зелёный run 31761548369. Smoke: H1 home/doctors, sales title без slug, implant FAQ+title, Dentist/og:image, /blog/ 301, цена 35к.

## 2026-08-14 01:51 UTC

Deploy 18f5c4a slug Войтова/Маркова + privacy 301, run 31761853166, smoke 11/11.

## 2026-08-14 02:15 UTC

2026-08-14 a356185: сгенерированы баннеры акций + обложки услуг/блога; уникальные тексты 6 категорий; seed 3 статей блога. Фото врачей не трогали (уже на проде). CI 31763077192 smoke 16/16.

## 2026-08-16 14:45 UTC

Handoff 2026-08-17: код темы не деплоился (только docs/RAG). После push проверить deploy.yml на docs-only коммит — rsync темы без изменений.

## 2026-08-17 08:34 UTC

17.08 деплои Voynere/liderdent deploy.yml все зелёные: bcfb9d4 run 31983710396 (P0 формы/404/NAP/ecommerce); 3b0cd30 run 31984653283 (скрипт целей Метрики); 8738760 run 31994185998 (ДМС /dms/); e265e2d run 31994276267 (RAG ДМС). Smoke / 200. Workflow rsync только темы dental — docs/memory на WP не едут.

## 2026-08-17 08:36 UTC

Handoff 17.08 закоммичен: SHA 8157b3e, deploy.yml run 32011038754 зелёный. Тема без правок с 8738760. Smoke / 200.

## 2026-08-17 08:40 UTC

Конец дня 17.08: HEAD d920290, deploy.yml run 32011352973 зелёный. Тема без правок с 8738760. Smoke / 200. Завтра: тонкие прайс-посты, снимок Topvisor 31594521, бэклог seov/plan.md.
