<?php
/* 
    Template Name: contacts
*/
?>

<?php get_header(); ?>

<main class="main-page-contacts">

    <?php do_action('theme_breadcrumbs'); ?>

    <section class="page-contacts">
        <div class="container">
            <div class="page-contacts__inner">
                <div class="page-contacts__head">
                    <h1 class="page-contacts__title">СВЯЖИТЕСЬ С НАМИ</h1>
                    <p class="page-contacts__subtitle first">МЫ ПРОКОНСУЛЬТИРУЕМ</p>
                    <p class="page-contacts__subtitle last">ПО ЛЮБОМУ ВОПРОСУ</p>
                </div>
                <div class="page-contacts__content">
                    <div class="page-contacts__content-item">
                        <h3 class="page-contacts__content-title">Адрес:</h3>
                        <p class="page-contacts__content-text">г. Красноярск. ул. Мужества, д. 4</p>
                    </div>
                    <div class="page-contacts__content-item">
                        <h3 class="page-contacts__content-title">Телефон</h3>
                        <a href="tel:+73912340909" class="page-contacts__content-text">+7 (391) 234 09 09</a>
                    </div>
                    <div class="page-contacts__content-item">
                        <h3 class="page-contacts__content-title">E-mail:</h3>
                        <a href="mailto:liderdent@mail.ru" class="page-contacts__content-text">liderdent@mail.ru</a>
                    </div>
                    <div class="page-contacts__content-item">
                        <h3 class="page-contacts__content-title">Часы работы</h3>
                        <p class="page-contacts__content-text">08:00 — 21:00</p>
                    </div>
                </div>
                <div class="page-contacts__map">
                    <div class="page-contacts__map-wrapper">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/map.jpg">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="request">
        <img class="request__background" src="<?php bloginfo('template_url') ?>/assets/img/request_background.png">
        <div class="container">
            <div class="request__inner">
                <form action="" class="request__form">
                    <h3 class="request__title">ОСТАВЬТЕ ОНЛАЙН-ЗАЯВКУ НА ПРИЁМ</h3>
                    <div class="request__info">
                        <p class="request__info-text">Запишитесь на первичную консультацию имплантолога, где вы получите:</p>
                        <p class="request__info-text">— Подберем импланты специально для вас.</p>
                        <p class="request__info-text">— Рассчитаем 3 варианта лечения с подробной сметой.</p>
                    </div>
                    <div class="request__content">
                        <input type="tel" class="request__phone" placeholder="+7 (___)___ __ __">
                        <button class="request__submit btn-gold">
                            Заказать звонок
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                            </svg>
                        </button>
                    </div>
                    <div class="request__policy">
                        <input class="request__policy-input" type="checkbox" name="" id="">
                        <p class="request__policy-text">
                            Отправляя заявку, вы соглашаетесь с политикой конфиденциальности.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="tour">
        <div class="container">
            <div class="tour__inner">
                <iframe src="https://www.3dtur24.ru/panorama/liderdent/main.html" width=100% height="550" frameborder="0"  style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
