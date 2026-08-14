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
