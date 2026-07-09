<?php
/*
    Template Name: about
*/
?>

<?php get_header(); ?>

<main class="main-page-about">

    <?php do_action('theme_breadcrumbs'); ?>

    <section class="page-about">
        <div class="container">
            <div class="page-about__inner">
                <div class="page-about__content">
                    <h1 class="page-about__title page-title">О НАС</h1>
                    <div class="page-about__info">
                        <div class="page-about__info-item">
                            <p class="page-about__info-text">
                                Мы создавали клинику «ЛидерДент» для тех, кто ответственно подходит к своему здоровью.
                                Для нас быть современными — значит не только использовать новейшие технологии, но и
                                следовать трем ключевым принципам:
                            </p>
                        </div>
                        <div class="page-about__info-item">
                            <p class="page-about__info-text">
                                <span>— Доказательная медицина.</span> Мы применяем только проверенные мировым
                                сообществом методики и материалы с подтвержденной эффективностью и безопасностью. Ваше
                                здоровье — наша главная ценность.
                            </p>
                        </div>
                        <div class="page-about__info-item">
                            <p class="page-about__info-text">
                                <span>— Персональный подход.</span> Мы не лечим «зуб», мы лечим человека. Тщательная
                                диагностика, подробное обсуждение плана лечения и внимание к вашим пожеланиям — основа
                                нашего взаимодействия.
                            </p>
                        </div>
                        <div class="page-about__info-item">
                            <p class="page-about__info-text">
                                <span>— Высокий сервис.</span> Мы стремимся к тому, чтобы каждый визит в нашу клинику был комфортным и спокойным, от первой консультации до результата.
                            </p>
                        </div>
                    </div>
                </div>

                <?php
                $gallery_items = liderdent_get_clinic_gallery_items();
                if ( ! empty( $gallery_items ) ) : ?>
                    <div class="clinic-gallery">
                        <h2 class="page-title clinic-gallery__title">КЛИНИКА И АТМОСФЕРА</h2>
                        <div class="clinic-gallery__grid">
                            <?php foreach ( $gallery_items as $item ) : ?>
                                <div class="clinic-gallery__item">
                                    <?php if ( $item['type'] === 'video' ) : ?>
                                        <video controls playsinline preload="metadata" src="<?php echo esc_url( $item['url'] ); ?>"></video>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( $item['url'] ); ?>" alt="Клиника ЛидерДент">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                <div class="page-about__slider">
                    <div class="swiper aboutSlider">
                        <div class="swiper-wrapper">
                            <?php for ( $i = 1; $i <= 10; $i++ ) : ?>
                            <div class="swiper-slide">
                                <div class="page-about__slider-item">
                                    <img src="<?php bloginfo('template_url') ?>/assets/img/our_centre/our_centre_<?php echo (int) $i; ?>.webp" alt="">
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="page-about__important">
                    <div class="page-about__important-content">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/important_service.svg" alt="">
                        <p>
                            Выбирая нашу клинику, вы всегда можете рассчитывать на профессиональное качественное лечение
                            независимо от сложности проблемы, с которой обратились.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="request">
        <img class="request__background" src="<?php bloginfo('template_url') ?>/assets/img/request_background.png" alt="">
        <div class="container">
            <div class="request__inner">
                <form action="" class="request__form">
                    <h3 class="request__title">ОСТАВЬТЕ ОНЛАЙН-ЗАЯВКУ НА ПРИЁМ</h3>
                    <div class="request__info">
                        <p class="request__info-text">Запишитесь на первичную консультацию имплантолога, где вы получите:</p>
                        <p class="request__info-text">— Подберём импланты специально для вас.</p>
                        <p class="request__info-text">— Рассчитаем 3 варианта лечения с подробной сметой.</p>
                    </div>
                    <div class="request__content">
                        <input type="tel" class="request__phone" placeholder="+7 (___)___ __ __">
                        <button class="request__submit btn-gold" type="submit">
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
                <iframe src="https://www.3dtur24.ru/panorama/liderdent/main.html" width="100%" height="550" frameborder="0" style="border:0" allowfullscreen title="3D тур клиники"></iframe>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
