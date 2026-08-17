# Decision


## 2026-07-09 22:33 UTC

Редакция сайта docx: прайс в inc/short-prices.php, врачи inc/doctors-profiles.php, акции inc/promotions-data.php, виджет мессенджеров, галерея clinic-gallery, Safarov safarov-cases

## 2026-07-10 00:36 UTC

Hero-видео на всех экранах; preload постера вместо webm; Swiper/Fancybox условно; lazy-load картинок и 3dtur iframe

## 2026-07-10 03:46 UTC

Кнопка чата: интерактивность (пульс, бейдж, подсказка) + привязка к max-width контента 1340px, сдвиг +100px вправо на 2K

## 2026-07-16 08:15 UTC

Сессия 16.07.2026 закрыта: ДО/ПОСЛЕ Асрян на проде (385fc56). Каталог cases: safarov|asryan в doctors-profiles.php; UI ba-compare. Продолжить: ПроДокторов smoke, баннеры акций, фото врачей, опц. slug Асрян.

## 2026-08-11 07:53 UTC

Slug Асрян: миграция в теме inc/slug-migrations.php — malikov-aleksej-georgievich → asryan-mariam-araratovna + 301. Срабатывает на init после деплоя (опция liderdent_specialist_slug_migrations_v1). SSH alias mrtlider на этой машине отсутствует.

## 2026-08-13 23:52 UTC

2026-08-14: UI+SEO аудит прода. SEO 6/10 UI 7/10. Critical: нет H1 на / и /doctors/; /sales/ title=sales; имплантация слабый сниппет; нет DentalClinic/og:image; цены 33k vs 35k на главной. Отчёт seov/SEO-отчет-прогресс.md, canvas ui-seo-audit.

## 2026-08-14 01:43 UTC

2026-08-14: Внедрён SEO/UI пакет — inc/seo.php (title/desc, og:image, Dentist JSON-LD, FAQ имплантации, 301 /blog/, robots). H1 на home/doctors, hero CTA, цена импланта 35к, logo не H3, aria-labels.

## 2026-08-14 01:51 UTC

2026-08-14: ПроДокторов OK в браузере. Slug v2: karpova→voytova, mironova→markova +301 (18f5c4a). /privacy/→правовая страница. NAP контактов OK.

## 2026-08-14 02:36 UTC

2026-08-14: посадочные /services/{slug}/ как МРТ Лидер — service-landings.php + page-service-landing.php, 8 услуг, 301 с category. Deploy b4d302d smoke 27/27.

## 2026-08-14 02:55 UTC

5 оффер-лендингов прайса: implantaciya-osstem-inno, konsultaciya-hirurga, koronka-dioksid-cirkoniya, implantat-dentium, implantat-nobel-straumann; featured_price блок на всех /services/*

## 2026-08-14 03:12 UTC

Блог: 15/15 статей с featured image; 12 новых JPEG в assets/img/blog + seed liderdent_blog_thumbs_seed_v1 (5f410bf)

## 2026-08-14 08:04 UTC

Блог: article-post CSS без inline; mid-article seed 6 постов (liderdent_blog_inline_seed_v1). CPT врачей: архивировать нечего. Deploy 0cf361c

## 2026-08-14 08:06 UTC

Handoff 2026-08-14: docs/HANDOFF_2026-08-14.md. Прод head ~0cf361c. Сделано: hero, /services/+офферы, блог 15 thumbs+6 inline, mobile-menu, messenger. Бэклог: category blog cards, more inline imgs, mobile QA.

## 2026-08-16 14:45 UTC

2026-08-17: клон /home/voynere/Projects/liderdent через gh HTTPS (SSH git@github.com host key fail). Репо Voynere/liderdent PRIVATE. Тема без правок. Handoff docs/HANDOFF_2026-08-17.md. Завтра: category.php карточки блога, mid-article ~9, mobile QA.

## 2026-08-17 00:52 UTC

2026-08-17 аудит прода: SEO 7/10 UX 6.5/10. P0–P4 от 14.08 живые. Новые блокеры: request__form не шлёт заявки; 404 пустой; robots Disallow склеен (AIOSEO); NAP 3 email + часы 08 vs 09. Sitemap без /services/{slug}/, тонкие прайс-посты в индексе. Город Красноярск. Canvas site-seo-ux-plan, план seov/plan.md. Не коммитили.

## 2026-08-17 01:02 UTC

2026-08-17 P0: request__form → send_popup_form; 404.php; NAP SSOT aliderdent@mail.ru + 09:00–21:00; robots.txt отдаёт тема. Метрика 106770436 ecommerce dataLayer: impressions/detail/add/checkout/purchase (без PII). Цели: form_open, form_start, form_submit_success, form_submit_error. SHA bcfb9d4, deploy 31983710396 зелёный.

## 2026-08-17 01:21 UTC

Метрика и Вебмастер liderdent = аккаунт lider.mrt как МРТ Лидер. JS-цели счётчика 106770436 заведены 2026-08-17: form_open=598283148, form_start=598283149, form_submit_success=598283150, form_submit_error=598283151. Токен TOKEN_LIDER_MRT на проде в wp-content/mrt-secrets/yandex-direct.env (не в git). Повтор: gh workflow run create-metrika-goals.yml. На этой машине нет ~/.ssh/mrt_deploy.
