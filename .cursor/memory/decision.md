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

## 2026-08-17 04:22 UTC

2026-08-17: страница /dms/ лечение по ДМС. Меню ДМС в шапке/футере. Страховки только СОГАЗ, Ингосстрах, АльфаСтрахование, Сберздоровье. Шаблон page-dms.php, seed liderdent_dms_page_v1. CTA попап + form-request-dms. SHA 8738760, deploy 31994185998 зелёный.

## 2026-08-17 08:34 UTC

2026-08-17 вечер: сессия закрыта. P0 на проде — .request__form → send_popup_form; 404.php; NAP aliderdent@mail.ru 09:00–21:00; robots отдаёт тема. ДМС /dms/ (СОГАЗ, Ингосстрах, АльфаСтрахование, Сберздоровье) + пункт меню. Метрика 106770436 lider.mrt, цели form_open 598283148, form_start 598283149, form_submit_success 598283150, form_submit_error 598283151, ecommerce без PII. Topvisor 31594521 сбор запущен. Handoff docs/HANDOFF_2026-08-17.md. Завтра: тонкие прайс-посты, снимок Topvisor percent=100, бэклог seov/plan.md. Head до handoff-коммита e265e2d.

## 2026-08-18 01:39 UTC

2026-08-18: тонкие прайс-посты дерева services — 301 на /services/{slug}/ или /prices/, noindex + вне sitemap. /specialist/ архив → /doctors/. SHA ba918aa, deploy 32088865314 зелёный. Topvisor 31594521 снимок 17.08: Яндекс ТОП-10 29%, Google 13%. Скрытая PBN-ссылка убрана из deploy.yml и с прода.

## 2026-08-18 03:24 UTC

18.08: карточки блога + mid-article CTA + mobile QA на проде. SHA 2cd3336, CI 32095238893 зелёный. Отзывы на главной: нет источника цитат, фейк не рисовали.

## 2026-08-18 07:12 UTC

Сертификаты Асрян Мариам: 2 скана C.T. DENT 2016 на /specialist/asryan-mariam-araratovna/. Реестр liderdent_doctor_certificates_map() по slug. SHA 47a3d28, CI 32110243931 зелёный.

## 2026-08-24 07:31 UTC

Фамилия врача Асрян→Сафарян: slug safaryan-mariam-araratovna, 301 с asryan и malikov, миграция v3 обновляет post_title. Ассеты safaryan-cases/, certs/safaryan/.

## 2026-08-24 07:32 UTC

ДМС /dms/: СОГАЗ, Югория страхование, Сберздоровье (убраны Ингосстрах и АльфаСтрахование). Логотип yugoria.jpg.

## 2026-08-24 08:04 UTC

Блог seed v2: 5 статей (цирконий, мудрость, нейромышечная, Osstem/Inno, Nobel/Dentium); BlogPosting+BreadcrumbList; related на статьях и лендингах; single.php по slug blog. SHA a65f3b0

## 2026-08-31 02:48 UTC

Блог seed v3: 10 статей (синус-лифтинг, All-on-4, рассрочка, коронка на имплант, кариес цена, болит зуб, приживление импланта, имплант при пародонтите, сроки брекетов, ОПТГ vs КТ). Топвизор 31594521: +43 ключа / +10 групп, всего 259/38. SHA 69d5399, deploy 33350750898 зелёный.

## 2026-08-31 08:00 UTC

31.08: hero главной — не 100vh. Завтра compact split ~560px: слева оффер+35к+CTA, справа видео-карточка без затемнения, под ними 4 плитки услуг. H1 не менять. Handoff docs/HANDOFF_2026-08-31.md, canvas hero-redesign.

## 2026-09-03 06:58 UTC

2026-09-03: с /sales/ снята акция «Имплантация Osstem, Inno под ключ» 35 000 ₽. Пакет «имплант + коронка» теперь 75 000 ₽ (было 68 170). Тизер на главной тоже обновлён. SHA a30a040.

## 2026-09-09 07:00 UTC

Акции /sales/: имплант+коронка 75к — срок 01.09.2026–01.11.2026; брекеты «Улыбка без комплексов» продлены до 30.09.2026 (было 31.08). SHA b962202.

## 2026-10-08 06:24 UTC

Акция «Улыбка без комплексов»: с 08.10.2026 цена 215 000 ₽ вместо 250 000 ₽, срок до 31.10.2026 (было 200 000 до 30.09). Карточка /sales/, тизер главной, ортодонтия, сид статей. SHA 9d9c021.

## 2026-10-08 07:45 UTC

Фамилия врача снова Асрян: slug asryan-mariam-araratovna, 301 с safaryan и malikov, миграция v4 ставит post_title «Асрян Мариам Араратовна».
