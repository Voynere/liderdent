<?php
/*
Template Name: home
*/

?>

<?php get_header('home'); ?>

<main class="main">
    <section class="hero">
        <div class="hero__video-container">
            <div class="hero__poster" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/img/fondesctop.jpg' ); ?>');"></div>
            <video class="hero__video"
                   muted
                   loop
                   playsinline
                   preload="none"
                   poster="<?php echo esc_url( get_template_directory_uri() . '/assets/img/fondesctop.jpg' ); ?>">
                <source src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/compressed_mobile.webm' ); ?>" type="video/webm">
                <source src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/compressed_mobile.mp4' ); ?>" type="video/mp4">
            </video>
        </div>

    <div class="container">
        <div class="hero__inner">
            <p class="hero__title-top">МЫ РАДЫ ПРИВЕТСТВОВАТЬ ВАС</p>
            <p class="hero__title-bottom">В СТОМАТОЛОГИИ «ЛидерДент»</p>
            <p class="hero__info">Важной составляющей философии нашей стоматологии <br>является — безупречное качество работы.</p>
            <p class="hero__info-mobile">Важной составляющей философии нашей стоматологии является — безупречное качество работы.</p>
        </div>
    </div>
</section>

    <!-- <section class="hello">
        <div class="container">
            <div class="hello__inner">
                <p class="hello__title-top">МЫ РАДЫ ПРИВЕТСТВОВАТЬ ВАС</p>
                <p class="hello__title-bottom">В СТОМАТОЛОГИИ «ЛидерДент»</p>
                <p class="hello__info">Важной составляющей философии нашей стоматологии <br>является — безупречное качество работы.</p>
                <p class="hello__info-mobile">Важной составляющей философии нашей стоматологии является — безупречное качество работы.</p>
            </div>
        </div>
    </section> -->

    <section class="service">
        <div class="container">
            <div class="service__inner">
                <h2 class="page-title service__title">НАШИ УСЛУГИ</h2>
                <div class="service__content">
                    <a href="<?php echo get_home_url(); ?>/category/services/implantaciya/" class="service__item first">
                        <div class="service__item-top">
                            <h3 class="service__item-title">ИМПЛАНТАЦИЯ ЗУБОВ</h3>
                            <p class="service__item-price">ОТ 33.000 РУБ</p>
                            <div class="service__item-info">
                                <p>— Предсказуемый результат.</p>
                                <p>— Комфорт и быстрое восстановление.</p>
                                <p class="bold">— Ваш персональный куратор имплантации.</p>
                            </div>
                        </div>
                        <div class="service__item-bottom">
                            <p class="service__item-important">Действует рассрочка</p>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                            </svg>
                        </div>
                    </a>

                    <a href="<?php echo get_home_url(); ?>/category/services/protezirovanie/" class="service__item">
                        <div class="service__item-top">
                            <h3 class="service__item-title">ПРОТЕЗИРОВАНИЕ</h3>
                            <p class="service__item-price">ОТ 8.000 РУБ.</p>
                        </div>
                        <div class="service__item-bottom">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                            </svg>
                        </div>
                    </a>
                    <a href="<?php echo get_home_url(); ?>/category/services/lechenie/" class="service__item">
                        <div class="service__item-top">
                            <h3 class="service__item-title">ЛЕЧЕНИЕ ЗУБОВ</h3>
                            <p class="service__item-price">ОТ 8.000 РУБ.</p>
                        </div>
                        <div class="service__item-bottom">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                            </svg>
                        </div>
                    </a>
                    <a href="<?php echo get_home_url(); ?>/category/services/gigiena/" class="service__item">
                        <div class="service__item-top">
                            <h3 class="service__item-title">ГИГИЕНА ЗУБОВ</h3>
                            <p class="service__item-price">ОТ 6.500 РУБ.</p>
                        </div>
                        <div class="service__item-bottom">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                            </svg>
                        </div>
                    </a>
                    <a href="<?php echo get_home_url(); ?>/service/" class="service__item all-service">
                        <div class="service__item-top">
                            <h3 class="service__item-title">ПЕРЕЙТИ КО ВСЕМ УСЛУГАМ</h3>
                        </div>
                        <div class="service__item-bottom">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                            </svg>
                        </div>
                        <div class="all-service__mobile btn-gold">
                            Перейти ко всем услугам
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="our-centre">
        <div class="container">
            <div class="our-centre__inner">
                <div class="our-centre__content">
                    <h2 class="page-title our-centre__title">НАШ ЦЕНТР</h2>
                    <div class="our-centre__info">
                        <h5 class="our-centre__info-title">
                            КОМФОРТНОЕ ЛЕЧЕНИЕ <br>В КЛИНИКЕ ЛИДЕР ДЕНТ
                        </h5>
                        <div class="our-centre__info-text">
                            <p>Микроскоп Leica M320 Hi-End 2023 года (Швейцария)</p>
                            <p>Стоматологическая установка KaVo ESTETICA E30</p>
                            <p>Рентген аппарат Kavo Focus 2023 года (Германия)</p>
                            <p>Система отбеливания нового поколения 2023 года</p>
                        </div>
                    </div>
                </div>
                <div class="our-centre__slider">
                    <div class="our-centre__slider-arrows">
                        <button class="our-centre__slider-arrow prev">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_left_slider_gold.svg">
                        </button>
                        <button class="our-centre__slider-arrow next">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_right_slider_gold.svg">
                        </button>
                    </div>
                    <div class="swiper serviceSlider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_1.jpg" alt="" loading="lazy" decoding="async">
                            </div>
                            <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_2.jpg" alt="" loading="lazy" decoding="async">
                            </div>
                            <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_3.jpg" alt="" loading="lazy" decoding="async">
                            </div>
                            <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_4.jpg" alt="" loading="lazy" decoding="async">
                            </div>
                            <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_5.jpg" alt="" loading="lazy" decoding="async">
                            </div>
                            <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_6.jpg" alt="" loading="lazy" decoding="async">
                            </div>
                            <!-- <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php // bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_7.jpg">
                            </div> -->
                            <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_8.jpg" alt="" loading="lazy" decoding="async">
                            </div>
                            <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_9.jpg" alt="" loading="lazy" decoding="async">
                            </div>
                            <div class="swiper-slide our-centre__slider-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/new_our_centre/our_centre_10.jpg" alt="" loading="lazy" decoding="async">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="doctors">
        <div class="container">
            <div class="doctors__inner">
                <h2 class="page-title doctors__title">НАШИ ВРАЧИ</h2>
                <?php

                $max_total = 7;
                $placeholder = get_template_directory_uri() . '/assets/img/doctor_1.png';

                // 1) Попытаемся получить главного врача (doctor_main == true)
                $main_query = new WP_Query([
                    'post_type' => 'specialist',
                    'posts_per_page' => 1,
                    'meta_query' => [
                        [
                            'key' => 'doctor_main',
                            'value' => '1',
                            'compare' => '='
                        ]
                    ]
                ]);

                $items = [];

                // Если найден главный — добавляем в начало
                if ( $main_query->have_posts() ) {
                    $main_query->the_post();
                    $items[] = get_post();
                    wp_reset_postdata();
                }

                // 2) Получаем остальных специалистов, исключая уже добавленного (если есть)
                $exclude = [];
                if ( ! empty( $items ) ) {
                    $exclude[] = $items[0]->ID;
                }

                $others_query = new WP_Query([
                    'post_type' => 'specialist',
                    'posts_per_page' => $max_total, // возьмём максимум, потом обрежем
                    'post__not_in' => $exclude,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ]);

                if ( $others_query->have_posts() ) {
                    while ( $others_query->have_posts() ) {
                        $others_query->the_post();
                        $items[] = get_post();
                        if ( count( $items ) >= $max_total ) break;
                    }
                    wp_reset_postdata();
                }

                // Если вообще нет ни одного специалиста — можно вывести заглушку или ничего
                if ( empty( $items ) ) : ?>
                    <p><?php esc_html_e( 'Специалисты не найдены', 'your-theme-textdomain' ); ?></p>
                <?php else : ?>

                    <div class="doctors__content">
                        <div class="doctors__content-top">

                            <?php
                            // Первый — большой (если есть)
                            if ( isset( $items[0] ) ) :
                                $p = $items[0];
                                $id = $p->ID;
                                $title = get_the_title( $id );
                                $spec = function_exists('get_field') ? get_field('doctor_spec', $id) : '';
                                $exp  = function_exists('get_field') ? get_field('doctor_exp', $id) : '';
                                $img  = has_post_thumbnail( $id ) ? get_the_post_thumbnail_url( $id, 'large' ) : $placeholder;
                            ?>
                                <a href="<?php echo get_permalink( $id ); ?>" class="doctors__item first">
                                    <div class="doctors__item-info">
                                        <h4 class="doctors__item-title"><?php echo esc_html( $title ); ?></h4>
                                        <?php if ( $spec ) : ?><p class="doctors__item-text specialization"><?php echo esc_html( $spec ); ?></p><?php endif; ?>
                                        <?php if ( $exp ) : ?><p class="doctors__item-text exp">Стаж: <?php echo esc_html( $exp ); ?></p><?php endif; ?>
                                        <div class="doctors__item-stars"></div>
                                    </div>
                                    <div class="doctors__item-img">
                                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>" fetchpriority="high">
                                    </div>
                                </a>
                            <?php endif; ?>

                            <?php
                            // Следующие 3 элемента в верхней строке (индексы 1..3)
                            for ( $i = 1; $i <= 3; $i++ ) :
                                if ( ! isset( $items[$i] ) ) break;
                                $p = $items[$i];
                                $id = $p->ID;
                                $title = get_the_title( $id );
                                $spec = function_exists('get_field') ? get_field('doctor_spec', $id) : '';
                                $exp  = function_exists('get_field') ? get_field('doctor_exp', $id) : '';
                                $img  = has_post_thumbnail( $id ) ? get_the_post_thumbnail_url( $id, 'medium' ) : $placeholder;
                            ?>
                                <a href="<?php echo get_permalink( $id ); ?>" class="doctors__item">
                                    <div class="doctors__item-info">
                                        <h4 class="doctors__item-title"><?php echo esc_html( $title ); ?></h4>
                                        <?php if ( $spec ) : ?><p class="doctors__item-text specialization"><?php echo esc_html( $spec ); ?></p><?php endif; ?>
                                        <?php if ( $exp ) : ?><p class="doctors__item-text exp">Стаж: <?php echo esc_html( $exp ); ?></p><?php endif; ?>
                                    </div>
                                    <div class="doctors__item-img">
                                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" decoding="async">
                                    </div>
                                </a>
                            <?php endfor; ?>

                        </div>

                        <div class="doctors__content-bottom">
                            <?php
                            // Элементы для нижней строки — индексы 4..6
                            for ( $i = 4; $i <= 6; $i++ ) :
                                if ( ! isset( $items[$i] ) ) break;
                                $p = $items[$i];
                                $id = $p->ID;
                                $title = get_the_title( $id );
                                $spec = function_exists('get_field') ? get_field('doctor_spec', $id) : '';
                                $exp  = function_exists('get_field') ? get_field('doctor_exp', $id) : '';
                                $img  = has_post_thumbnail( $id ) ? get_the_post_thumbnail_url( $id, 'medium' ) : $placeholder;
                            ?>
                                <a href="<?php echo get_permalink( $id ); ?>" class="doctors__item">
                                    <div class="doctors__item-info">
                                        <h4 class="doctors__item-title"><?php echo esc_html( $title ); ?></h4>
                                        <?php if ( $spec ) : ?><p class="doctors__item-text specialization"><?php echo esc_html( $spec ); ?></p><?php endif; ?>
                                        <?php if ( $exp ) : ?><p class="doctors__item-text exp">Стаж: <?php echo esc_html( $exp ); ?></p><?php endif; ?>
                                    </div>
                                    <div class="doctors__item-img">
                                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" decoding="async">
                                    </div>
                                </a>
                            <?php endfor; ?>

                            <div class="doctors__buttons">
                                <a href="<?php echo get_home_url(); ?>/doctors/" class="doctors__buttons-all doctors__buttons-btn btn-white">
                                    Все врачи
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                                    </svg>
                                </a>
                                <button class="doctors__buttons-signup doctors__buttons-btn btn-gold open-popup-callback">
                                    Записаться
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>

    <section class="how">
        <div class="container">
            <div class="how__inner">
                <h2 class="page-title how__title">КАК МЫ РАБОТАЕМ</h2>
                <div class="how__content">
                    <div class="how__item">
                        <p class="how__item-title">(1) Первичный осмотр</p>
                        <p class="how__item-text">Выслушиваем жалобы, выявляем проблемы, <br>составляем план и время для лечения.</p>
                    </div>
                    <div class="how__item">
                        <p class="how__item-title">(2) Гигиена</p>
                        <p class="how__item-text">Профилактическая, лечебная и поддерживающая процедура, <br>позволяющая убрать налет и зубной камень.</p>
                    </div>
                    <div class="how__item">
                        <p class="how__item-title">(3) Лечение</p>
                        <p class="how__item-text">Профессиональная команда бережно решит <br>любую поставленную задачу.</p>
                    </div>
                    <div class="how__item">
                        <p class="how__item-title">(4) Период восстановления</p>
                        <p class="how__item-text">Вы можете обратиться к нам по любым вопросам: <br>Когда можно принимать пищу? Через сколько <br>спадёт отёк?</p>
                    </div>
                    <div class="how__item">
                        <p class="how__item-title">(5) Плановый осмотр и профилактика</p>
                        <p class="how__item-text">Персональный менеджер возьмёт на себя всю заботу <br>о процессе вашего лечения.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="before-after">
        <div class="container">
            <div class="before-after__inner">
                <h2 class="page-title before-after__title">ДО / ПОСЛЕ</h2>
                <div class="before-after__content">
                    <div class="before-after__item">
                        <div class="before-after__images">
                            <div class="before-after__images-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/service_slider_img.jpg">
                            </div>
                            <div class="before-after__images-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/doctor_2.png">
                            </div>
                        </div>
                        <p class="before-after__item-text">Исправление прикуса</p>
                    </div>
                    <div class="before-after__item">
                        <div class="before-after__images">
                            <div class="before-after__images-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/service_slider_img.jpg">
                            </div>
                            <div class="before-after__images-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/doctor_2.png">
                            </div>
                        </div>
                        <p class="before-after__item-text">Протезирование зубов</p>
                    </div>
                    <div class="before-after__item">
                        <div class="before-after__images">
                            <div class="before-after__images-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/service_slider_img.jpg">
                            </div>
                            <div class="before-after__images-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/doctor_2.png">
                            </div>
                        </div>
                        <p class="before-after__item-text">Протезирование зубов</p>
                    </div>
                    <div class="before-after__item">
                        <div class="before-after__images">
                            <div class="before-after__images-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/service_slider_img.jpg">
                            </div>
                            <div class="before-after__images-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/doctor_2.png">
                            </div>
                        </div>
                        <p class="before-after__item-text">Исправление прикуса</p>
                    </div>
                </div>
                <div class="before-after__slider">
                    <div class="swiper beforeAfterSlider">
                        <div class="swiper-wrapper">
                        </div>
                    </div>
                    <div class="before-after__slider-arrows">
                        <button class="before-after__slider-arrow prev">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_left_slider_gold.svg">
                        </button>
                        <button class="before-after__slider-arrow next">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_right_slider_gold.svg">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="credit">
        <div class="container">
            <div class="credit__inner">
                <div class="credit__background">
                    <img src="<?php bloginfo('template_url') ?>/assets/img/credit.png" alt="" loading="lazy" decoding="async">
                </div>
                <div class="credit__info">
                    <h3 class="credit__info-title">ЛЕЧИСЬ СЕЙЧАС, <br>ПЛАТИ ПОТОМ</h3>
                    <div class="credit__info-block">
                        <p class="credit__block-title">(!)  Предоставляем рассрочку сроком до 24 месяцев.</p>
                        <p class="credit__block-text">Мы учитываем желания наших пациентов, <br>поэтому у нас можно оформить лояльную <br>рассрочку на все виды лечения и протезирования.</p>
                    </div>
                    <button class="credit__info-link btn-gold mob-hidden" data-popup-target="#popup-credit">
                        Узнать подробности
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040" />
                        </svg>
                    </button>
                </div>
                <div class="credit__icons">
                    <div class="credit__icons-wrapper">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/credit_vtb.png">
                    </div>
                    <div class="credit__icons-wrapper">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/credit_mkb.png">
                    </div>
                    <div class="credit__icons-wrapper">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/credit_alfa.png">
                    </div>
                    <div class="credit__icons-wrapper">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/credit_sber.png">
                    </div>
                    <div class="credit__icons-wrapper">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/credit_sovcombank.png">
                    </div>
                    <div class="credit__icons-wrapper">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/credit_rosbank.png">
                    </div>
                </div>
                <div class="credit__link-mobile">
                    <button class="credit__info-link btn-gold" data-popup-target="#popup-credit">
                        Узнать подробности
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="promotion">
        <div class="container">
            <div class="promotion__inner">
                <h2 class="page-title promotion__title">АКЦИИ</h2>
                <?php $sales_url = liderdent_get_sales_page_url(); ?>
                <div class="promotion__content">
                    <a href="<?php echo esc_url( $sales_url ); ?>" class="promotion__item odd">
                        <div class="promotion__background">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/promotion_1.png" alt="" loading="lazy" decoding="async">
                        </div>
                        <div class="promotion__item-inner">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                            </svg>
                            <div class="promotion__item-info">
                                <h3 class="promotion__item-title">Улыбка без комплексов</h3>
                                <p class="promotion__item-text">Брекеты «под ключ» 200 000 ₽</p>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo esc_url( $sales_url ); ?>" class="promotion__item even">
                        <div class="promotion__background">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/promotion_2.png" alt="" loading="lazy" decoding="async">
                        </div>
                        <div class="promotion__item-inner">
                            <div class="promotion__item-info">
                                <h3 class="promotion__item-title">Имплантация от 35 000 рублей</h3>
                                <p class="promotion__item-text">Osstem, Inno «под ключ»</p>
                            </div>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                            </svg>
                        </div>
                    </a>
                </div>
                <p class="promotion-page__all-link">
                    <a href="<?php echo esc_url( $sales_url ); ?>" class="btn-gold">Все акции и условия</a>
                </p>
                <div class="promotion__slider">
                    <div class="swiper promotionSlider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="<?php echo esc_url( $sales_url ); ?>" class="promotion__item odd">
                                    <div class="promotion__background">
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/promotion_1.png" alt="" loading="lazy" decoding="async">
                                    </div>
                                    <div class="promotion__item-inner">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                                        </svg>
                                        <div class="promotion__item-info">
                                            <h3 class="promotion__item-title">Улыбка без комплексов</h3>
                                            <p class="promotion__item-text">Брекеты 200 000 ₽</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="<?php echo esc_url( $sales_url ); ?>" class="promotion__item even">
                                    <div class="promotion__background">
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/promotion_2.png" alt="" loading="lazy" decoding="async">
                                    </div>
                                    <div class="promotion__item-inner">
                                        <div class="promotion__item-info">
                                            <h3 class="promotion__item-title">Имплантация от 35 000 ₽</h3>
                                            <p class="promotion__item-text">КТ в подарок</p>
                                        </div>
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="promotion__slider-arrows">
                        <button class="promotion__slider-arrow prev">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_left_slider_gold.svg">
                        </button>
                        <button class="promotion__slider-arrow next">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_right_slider_gold.svg">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="request">
        <img class="request__background" src="<?php bloginfo('template_url') ?>/assets/img/request_background.png" alt="" loading="lazy" decoding="async">
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
                <iframe src="https://www.3dtur24.ru/panorama/liderdent/main.html" width="100%" height="550" frameborder="0" style="border:0" allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>