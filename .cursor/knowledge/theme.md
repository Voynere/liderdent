# Theme `dental` — карта кода

## Шаблоны страниц

| Файл | Назначение |
|------|------------|
| `home.php` | Главная |
| `page-about.php` | О нас |
| `page-contacts.php` | Контакты |
| `page-doctors.php` | Врачи |
| `page-prices.php` | Цены |
| `page-service.php` | Хаб услуг `/service/` |
| `page-service-landing.php` | Виртуальный лендинг `/services/{slug}/` |
| `page-promotion.php` | Акции |
| `page-legal-info.php` | Правовая информация |
| `page-dms.php` | Лечение по ДМС `/dms/` |
| `single.php` | Запись блога → `content-article` |
| `single-specialist.php` | Карточка врача (CPT) |
| `category.php` | Архив категории (услуги-цены / блог) |
| `header.php` / `header-home.php` | Шапка (+ partial мобильного меню) |
| `footer.php` | Подвал |
| `template-parts/content-article.php` | Статья блога (`article-post`) |
| `template-parts/mobile-menu.php` | Общий drawer мобильного меню |
| `template-parts/messenger-widget.php` | Плавающий виджет TG / MAX / звонок |

## Виджет мессенджеров

- Файлы: `template-parts/messenger-widget.php`, стили в `assets/css/site-updates.css`
- Позиция: safe-area + привязка к контенту 1340px; на mobile подсказка сверху
- SVG-иконка (не emoji); пульс / бейдж / hint / панель
- Подключается в `functions.php` через `wp_footer`

## Мобильное меню

- Partial: `template-parts/mobile-menu.php` (подключается из обоих header)
- Пункты: Все услуги, 4 направления, Акции, Цены, ДМС, Врачи, Статьи, О нас, Контакты, Юр.инфо
- JS в `home.js`: open/close, Escape, overlay, `aria-expanded`, lock scroll (`html.mobile-menu-open`)

## Логика в `functions.php`

- Подключение стилей/скриптов: jQuery CDN, Swiper, Fancybox, `home.js`, `about.js`, `popup-form.js`
- `specialist.js` — только на страницах CPT `specialist`
- CPT `specialist` + ACF в REST
- AJAX `send_popup_form` → `wp_mail` на `aliderdent@mail.ru`
- SEO: `inc/seo.php`
- Лендинги: `inc/service-landings.php` + реестр `inc/services-content.php`
- Seeds: `inc/content-seed.php`
- ДМС: `inc/dms.php` + `page-dms.php` (`/dms/`, seed `liderdent_dms_page_v1`)
- Slug-миграции: `inc/slug-migrations.php`

## Услуги / посадочные

- Хаб: `/service/`
- Лендинги: `/services/{slug}/` — `featured_price` офферы + категории
- 301: `/category/services/{slug}/` → лендинг
- Цены на лендинге: `liderdent_featured_service_price_rows()` + WP-посты категории (dedupe)
- Офферы: `implantaciya-osstem-inno`, `konsultaciya-hirurga`, `koronka-dioksid-cirkoniya`, `implantat-dentium`, `implantat-nobel-straumann` (`in_nav => false`)

## Блог

- Архив: `/category/blog/` (301 с `/blog/`)
- Обложки: `assets/img/blog/*` + seed `liderdent_blog_thumbs_seed_v1`
- Mid-article: `blog-inline-*.jpg` + seed `liderdent_blog_inline_seed_v1` (маркер `article-figure--seed`)
- Шаблон: `article-post__*` в `site-updates.css`

## Врачи

- 6 CPT на проде: Хмыз, Сафаров, Умраев, Асрян, Войтова, Маркова
- Миграции: Асрян; Карпова→Войтова; Миронова→Маркова (`liderdent_specialist_slug_migrations_v2`)
- Кейсы ДО/ПОСЛЕ: `inc/doctors-profiles.php` + `ba-compare`

## Ассеты

- CSS: `assets/css/style.css` + `assets/css/site-updates.css`
- JS: `home.js`, `about.js`, `specialist.js`, `popup-form.js`
- Промо/услуги/блог: `assets/img/{promos,services,blog}/`

## URL-структура (прод)

- Услуги: `/service/` + `/services/{slug}/`
- Врачи: `/doctors/` + `/specialist/...`
- Цены: `/prices/` · ДМС: `/dms/` · Акции: `/sales/` · Блог: `/category/blog/`
- Privacy: `/privacy/` → правовая страница
- Прайс-SKU (посты дерева `services`, не блог): 301 на `/services/{slug}/` или хаб; noindex + вне sitemap
- Лендинги в sitemap: `/services-sitemap.xml` (тема) + индекс AIOSEO + строка в robots.txt

## Handoff

См. `docs/HANDOFF_2026-08-18.md`
