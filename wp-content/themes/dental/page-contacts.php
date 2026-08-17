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
                        <p class="page-contacts__content-text"><?php echo esc_html( liderdent_nap_address_line() ); ?></p>
                    </div>
                    <div class="page-contacts__content-item">
                        <h3 class="page-contacts__content-title">Телефон</h3>
                        <a href="tel:+73912340909" class="page-contacts__content-text">+7 (391) 234 09 09</a>
                    </div>
                    <div class="page-contacts__content-item">
                        <h3 class="page-contacts__content-title">E-mail:</h3>
                        <a href="mailto:<?php echo esc_attr( liderdent_nap_email() ); ?>" class="page-contacts__content-text"><?php echo esc_html( liderdent_nap_email() ); ?></a>
                    </div>
                    <div class="page-contacts__content-item">
                        <h3 class="page-contacts__content-title">Часы работы</h3>
                        <p class="page-contacts__content-text"><?php echo esc_html( liderdent_nap_hours_human() ); ?></p>
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
                <?php
                get_template_part( 'template-parts/request-form', null, [
                    'form_id' => 'form-request-contacts',
                    'source'  => 'request-contacts',
                    'variant' => 'generic',
                    'service' => 'Запись на приём',
                ] );
                ?>
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
