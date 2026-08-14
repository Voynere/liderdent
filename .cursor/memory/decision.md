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
