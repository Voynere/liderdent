# Theme `dental` — карта кода

## Шаблоны страниц

| Файл | Назначение |
|------|------------|
| `home.php` | Главная |
| `page-about.php` | О нас |
| `page-contacts.php` | Контакты |
| `page-doctors.php` | Врачи |
| `page-prices.php` | Цены |
| `page-service.php` | Услуги (лендинг) |
| `page-promotion.php` | Акции |
| `page-legal-info.php` | Правовая информация |
| `single.php` | Запись блога |
| `single-specialist.php` | Карточка врача (CPT) |
| `category.php` | Архив категории |
| `header.php` / `header-home.php` | Шапка |
| `footer.php` | Подвал |
| `template-parts/content-article.php` | Карточка статьи |
| `template-parts/messenger-widget.php` | Плавающий виджет TG / MAX / звонок |

## Виджет мессенджеров

- Файлы: `template-parts/messenger-widget.php`, стили в `assets/css/site-updates.css`
- Позиция: `right: max(12px, calc((100% - 1340px) / 2 - 100px))` — привязка к `.container` (1340px)
- Интерактив: пульс, float, бейдж, подсказка (hover + раз за сессию через 4с), плавная панель
- Подключается в `functions.php` через `wp_footer`

## Логика в `functions.php`

- Подключение стилей/скриптов: jQuery CDN, Swiper, Fancybox, `home.js`, `about.js`, `popup-form.js`
- `specialist.js` — только на страницах CPT `specialist`
- CPT `specialist` + ACF-поля в REST API (`doctor_exp`, `doctor_spec`, `doctor_schedule`, `doctor_service`)
- AJAX `send_popup_form` → `wp_mail` на `aliderdent@mail.ru` (типы: callback, credit, service, doctor, popup)
- `theme_breadcrumbs()` — хлебные крошки с особой логикой для категории `services` → страница `/service/`
- SVG upload support
- WooCommerce theme support (включён, но магазин может не использоваться)

## Ассеты

- SCSS: `assets/scss/style.scss` → CSS: `assets/css/style.css` (в enqueue — `style.min.css`, проверить сборку)
- JS: `assets/js/` — `home.js`, `about.js`, `specialist.js`, `popup-form.js`, `main.js`
- Шрифт: Raleway

## URL-структура (прод)

- Услуги: `/service/` + категории `/category/services/...`
- Врачи: `/doctors/` + CPT `/specialist/...`
- Цены: `/prices/`
- Имплантация: `/category/services/implantaciya/`

## Плагины (локально, не в git)

- ACF, All in One SEO, WP Super Cache, UpdraftPlus, Cyr2Lat и др. — см. `wp-content/plugins/`
