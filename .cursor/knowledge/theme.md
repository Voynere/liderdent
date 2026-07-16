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
- `specialist.js` — только на страницах CPT `specialist` (сертификаты Swiper + `ba-compare`)
- CPT `specialist` + ACF-поля в REST API (`doctor_exp`, `doctor_spec`, `doctor_schedule`, `doctor_service`)
- AJAX `send_popup_form` → `wp_mail` на `aliderdent@mail.ru` (типы: callback, credit, service, doctor, popup)
- `theme_breadcrumbs()` — хлебные крошки с особой логикой для категории `services` → страница `/service/`
- SVG upload support
- WooCommerce theme support (включён, но магазин может не использоваться)

## Врачи: профили и ДО/ПОСЛЕ

- Тексты / ПроДокторов / кейсы: `inc/doctors-profiles.php`
- Сопоставление по ФИО заголовка CPT (`liderdent_normalize_doctor_key`)
- Галерея кейсов: в профиле `cases_gallery` → ключ каталога (`safarov` | `asryan`)
- Рендер: `liderdent_render_doctor_cases()` из `single-specialist.php`
- UI: интерактивный слайдер `.ba-compare` (clip-path + range), стили в `site-updates.css`, логика в `specialist.js`
- Медиа:
  - Сафаров: `assets/img/safarov-cases/`
  - Асрян: `assets/img/asryan-cases/` (case-0N-before/after.jpg)
- Прод Асрян (slug устаревший): `/specialist/malikov-aleksej-georgievich/` — title «Асрян Мариам Араратовна»

## Ассеты

- SCSS: `assets/scss/style.scss` → CSS: `assets/css/style.css` (в enqueue — `style.min.css`, проверить сборку)
- Доп. CSS правок: `assets/css/site-updates.css` (`liderdent-site-updates`)
- JS: `assets/js/` — `home.js`, `about.js`, `specialist.js`, `popup-form.js`, `main.js`
- Шрифт: Raleway

## URL-структура (прод)

- Услуги: `/service/` + категории `/category/services/...`
- Врачи: `/doctors/` + CPT `/specialist/...`
- Цены: `/prices/`
- Имплантация: `/category/services/implantaciya/`

## Плагины (локально, не в git)

- ACF, All in One SEO, WP Super Cache, UpdraftPlus, Cyr2Lat и др. — см. `wp-content/plugins/`
