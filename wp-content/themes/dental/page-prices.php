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

    <?php get_template_part( 'template-parts/contacts-section' ); ?>

</main>

<?php get_footer(); ?>
