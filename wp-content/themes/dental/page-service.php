<?php
/* 
    Template Name: page-service
*/
?>

<?php get_header(); ?>

<main class="main-page-service">

    <?php do_action('theme_breadcrumbs'); ?>

    <section class="page-service">
        <div class="container">
            <div class="page-service__inner">
                <h1 class="page-service__title page-title">НАШИ УСЛУГИ</h1>
                <div class="page-service__content">
                    <?php
                    // slug родительской рубрики "Услуги"
                    $parent_slug = 'services';

                    // получаем родительскую рубрику
                    $parent_term = get_term_by( 'slug', $parent_slug, 'category' );

                    $placeholder = get_template_directory_uri() . '/assets/img/page-service_implantaciya.png';

                    if ( $parent_term ) :

                        // получаем ТОЛЬКО дочерние рубрики
                        $terms = get_terms( array(
                            'taxonomy'   => 'category',
                            'parent'     => $parent_term->term_id,
                            'hide_empty' => false, // если нужно только с постами — true
                        ) );

                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
                            foreach ( $terms as $term ) :

                                // ссылка и название рубрики
                                $term_link = get_term_link( $term );
                                $term_name = $term->name;

                                // изображение рубрики через Categories Images
                                if ( function_exists( 'z_taxonomy_image_url' ) ) {
                                    $img_url = z_taxonomy_image_url( $term->term_id );
                                }

                                // заглушка, если изображения нет
                                if ( empty( $img_url ) ) {
                                    $img_url = $placeholder;
                                }
                                ?>

                                <a href="<?php echo esc_url( $term_link ); ?>" class="page-service__item">
                                    <h2 class="page-service__item-title">
                                        <?php echo esc_html( $term_name ); ?>
                                    </h2>

                                    <img class="page-service__item-arrow"
                                        src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_gold_link.svg"
                                        alt="">

                                    <!-- изображение рубрики -->
                                    <img class="page-service__item-background"
                                        src="<?php echo esc_url( $img_url ); ?>"
                                        alt="<?php echo esc_attr( $term_name ); ?>">
                                </a>

                            <?php
                            endforeach;
                        else :
                            echo '<p>Услуги не найдены.</p>';
                        endif;

                    else :
                        echo '<p>Родительская рубрика «Услуги» не найдена.</p>';
                    endif;
                    ?>

                </div>
            </div>
        </div>
    </section>

    <section class="about page-service-prices">
        <div class="container">
            <div class="about__inner">
                <?php liderdent_render_short_prices( 'service' ); ?>
            </div>
        </div>
    </section>

    <!-- <section class="before-after">
        <div class="container">
            <div class="before-after__inner">
                <h2 class="page-title before-after__title">КЕЙСЫ</h2>
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

</main>

<?php get_footer(); ?>