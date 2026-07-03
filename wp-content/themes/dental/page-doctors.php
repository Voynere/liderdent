<?php
/* 
    Template Name: page-doctors
*/
?>

<?php get_header(); ?>

<main class="main-page-doctors">

    <?php do_action('theme_breadcrumbs'); ?>

    <section class="page-doctors">
        <div class="container">
            <div class="page-doctors__inner">
                <h2 class="page-title page-doctors__title">НАШИ ВРАЧИ</h2>
                <div class="page-doctors__content">

                    <?php
                    $args = array(
                        'post_type'      => 'specialist',
                        'posts_per_page' => -1,         
                        'post_status'    => 'publish',
                        'orderby'        => 'menu_order', 
                        'order'          => 'ASC',
                    );
                    $specialists = new WP_Query( $args );

                    // Путь к заглушке для изображения
                    $placeholder_img = get_template_directory_uri() . '/assets/img/doctor_1.png';

                    if ( $specialists->have_posts() ) :
                        while ( $specialists->have_posts() ) : $specialists->the_post();
                            $post_id = get_the_ID();
                            $title   = get_the_title();
                            $permalink = get_permalink();

                            // Изображение: если есть миниатюра — используем её, иначе заглушку
                            if ( has_post_thumbnail( $post_id ) ) {
                                $img_src = get_the_post_thumbnail_url( $post_id, 'medium' );
                            } else {
                                $img_src = $placeholder_img;
                            }

                            // ACF-поля
                            $doctor_spec = '';
                            $doctor_exp  = '';

                            if ( function_exists('get_field') ) {
                                $doctor_spec = get_field('doctor_spec', $post_id);
                                $doctor_exp  = get_field('doctor_exp', $post_id);
                            }

                            // Если поле вернулось массивом — преобразуем в строку
                            if ( is_array( $doctor_spec ) ) {
                                $doctor_spec = implode( ', ', $doctor_spec );
                            }
                            if ( is_array( $doctor_exp ) ) {
                                $doctor_exp = implode( ', ', $doctor_exp );
                            }
                            ?>

                            <a class="page-doctors__item" href="<?php echo esc_url( $permalink ); ?>">
                                <div class="page-doctors__item-img">
                                    <img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="page-doctors__img">
                                </div>
                                <div class="page-doctors__item-info">
                                    <h4 class="page-doctors__item-title"><?php echo esc_html( $title ); ?></h4>
                                    <div class="page-doctors__item-wrapper">
                                        <?php if ( ! empty( $doctor_spec ) ) : ?>
                                            <p class="page-doctors__item-text"><?php echo esc_html( $doctor_spec ); // acf doctor_spec ?></p>
                                        <?php endif; ?>
    
                                        <?php if ( ! empty( $doctor_exp ) ) : ?>
                                            <p class="page-doctors__item-text"><?php echo esc_html( $doctor_exp ); // acf doctor_exp ?></p>
                                        <?php endif; ?>
    
                                        <div class="page-doctors__item-stars" aria-hidden="true">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                        </div>
                                    </div>
                                </div>
                                <div class="page-doctors__item-arrow">
                                    <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_grey_link.svg" alt="Ссылка">
                                </div>
                            </a>

                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <p><?php esc_html_e( 'Пока нет специалистов для отображения.', 'liderdent24' ); ?></p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<!--     
    <section class="before-after">
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
    
</main>

<?php get_footer(); ?>
