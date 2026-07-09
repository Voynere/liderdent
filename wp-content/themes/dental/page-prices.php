<?php
/*
 * Страница «Цены» — автоматически для slug prices (page-prices.php).
 */
?>

<?php get_header(); ?>

<main class="main page-prices">

    <?php do_action('theme_breadcrumbs'); ?>

    <section class="about">
        <div class="container">
            <div class="about__inner">
                <h1 class="page-title">ПРАЙС</h1>
                <div class="about__content">
                    <div class="about__left">
                        <?php liderdent_render_short_prices( 'page' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="callback">
        <div class="container">
            <div class="callback__inner">
                <div class="callback__img">
                    <img src="<?php bloginfo('template_url') ?>/assets/img/callback_form.jpg" alt="">
                </div>
                <div class="callback__content">
                    <div class="callback__title">
                        <p>Здоровые зубы за 2 визита</p>
                    </div>
                    <div class="callback__text">
                        <p>Запишитесь на первичную консультацию имплантолога, где вы получите:</p>
                        <ul>
                            <li>Подберём импланты специально для вас</li>
                            <li>Рассчитаем 3 варианта лечения с подробной сметой</li>
                        </ul>
                    </div>
                </div>
                <div class="callback__form">
                    <form id="callbackForm_page" action="#">
                        <div>
                            <label for="phone">Телефон</label>
                            <input class="callback__form-input" id="phone1" type="tel" onclick="this.setSelectionRange(0,0);" placeholder="+7 (___) ___ __-__">
                        </div>
                        <button class="callback__form-btn btn-green" type="submit">
                            <span>Получить консультацию</span>
                        </button>
                    </form>
                    <div class="callback__policy">
                        <p>Отправляя заявку, вы соглашаетесь с политикой конфиденциальности</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contacts">
        <div class="container">
            <div class="contacts__inner">
                <div class="contacts__map">
                 <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A322407f99216699ee1c4b28399f978668771f1ffb0f1d511c66384534417acd8&amp;width=1233&amp;height=596&amp;lang=ru_RU&amp;scroll=true"></script>
                </div>
                <div class="contacts__content">
                    <div class="contacts__title">
                        <h3>КОНТАКТЫ</h3>
                        <h4>+7-391 234 09 09</h4>
                    </div>
                    <div class="contacts__info">
                        <div class="contacts__info-item">
                            <div>
                                <img src="<?php bloginfo('template_url') ?>/assets/img/icons/time.svg" alt="">
                            </div>
                            <p>пн. — вс. 09:00 — 21:00</p>
                        </div>
                        <div class="contacts__info-item">
                            <div><img src="<?php bloginfo('template_url') ?>/assets/img/icons/geo.svg" alt=""></div>
                            <p>г. Красноярск<br>ул. Мужества 4 <br>(вход с торца 2 этаж)</p>
                        </div>
                        <div class="contacts__info-item">
                            <div><img src="<?php bloginfo('template_url') ?>/assets/img/icons/email.svg" alt=""></div>
                            <p>l1der.dent@yandex.ru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
