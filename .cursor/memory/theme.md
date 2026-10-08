# Theme


## 2026-07-10 01:29 UTC

Кнопка чата messenger-widget: пульсация, float, бейдж, подсказка при hover и через 4с (sessionStorage), плавное открытие панели

## 2026-07-10 03:46 UTC

Позиция messenger-widget на широких экранах: right: max(12px, calc((100% - 1340px) / 2 - 100px)) — край контента минус 100px

## 2026-07-16 02:31 UTC

Асрян Мариам: галерея работ ДО/ПОСЛЕ — assets/img/asryan-cases/, cases_gallery=asryan в doctors-profiles.php, интерактивный ba-compare слайдер (clip-path + range). Общий UI с Сафаровым.

## 2026-08-11 08:19 UTC

Мобильное выезжающее меню на главной (header-home.php): добавлен пункт Акции → /sales/. В header.php уже был. Deploy f451209 run 31472602978 зелёный.

## 2026-08-14 02:50 UTC

Hero главной: тёмная подложка rgba(20,20,20,0.62), белый текст с тенью, CTA hero__cta-btn как шапка (#404040)

## 2026-08-14 07:46 UTC

UX: общий mobile-menu partial (Услуги/Блог/Контакты, close/Escape), messenger SVG+safe-area+2K. Deploy 6b8bd1b

## 2026-08-18 01:49 UTC

2026-08-18: H1 служебных без ALL CAPS (услуги/цены/о клинике/контакты/акции/юр.). Sitemap лендингов /services-sitemap.xml — 13 URL из реестра, в индексе AIOSEO и robots.txt. SHA 4151d53, deploy 32089473366 зелёный.

## 2026-10-08 07:25 UTC

Хаб /service/: названия разделов поверх фото (service-hub.css). Цифровая и эстетическая стоматология — фото service-czifrovaya.jpg и service-esteticheskaya.jpg, не прозрачные PNG из медиатеки.

## 2026-10-08 07:30 UTC

Поиск на liderdent24.ru: оверлей как у МРТ Лидер. Шапка .follow-search и кнопки поиска открывают #ld-search-overlay, AJAX liderdent_site_search. Индекс: услуги из реестра, краткий прайс, акции, врачи CPT, статьи категории blog, FAQ лендингов, разделы. Страница /?s= — search.php. Файлы: inc/site-search.php, assets/js/search.js, template-parts/search-overlay.php.
