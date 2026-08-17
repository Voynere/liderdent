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
                                        <video
                                            controls
                                            playsinline
                                            preload="metadata"
                                            src="<?php echo esc_url( $item['url'] ); ?>"
                                            <?php if ( ! empty( $item['poster'] ) ) : ?>poster="<?php echo esc_url( $item['poster'] ); ?>"<?php endif; ?>
                                        >
                                            <source src="<?php echo esc_url( $item['url'] ); ?>" type="video/<?php echo esc_attr( pathinfo( $item['file'], PATHINFO_EXTENSION ) ); ?>">
                                        </video>
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
                <?php
                get_template_part( 'template-parts/request-form', null, [
                    'form_id' => 'form-request-about',
                    'source'  => 'request-about',
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
                <iframe src="https://www.3dtur24.ru/panorama/liderdent/main.html" width="100%" height="550" frameborder="0" style="border:0" allowfullscreen title="3D тур клиники"></iframe>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
