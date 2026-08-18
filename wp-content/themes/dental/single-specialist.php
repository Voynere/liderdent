<?php
/* 
    Template Name: single-specialist
*/
?>

<?php get_header(); ?>

<main class="main-single-specialist">

    <?php do_action('theme_breadcrumbs'); ?>

    <section class="single-specialist">
        <div class="container">
            <div class="single-specialist__inner">

                <?php
                // Loop (на случай, если шаблон используется как page-template или single)
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                        $post_id = get_the_ID();
                        $title   = get_the_title( $post_id );
                        $profile = liderdent_get_doctor_profile( $title );

                        // Изображение: миниатюра или заглушка
                        $placeholder_img = get_template_directory_uri() . '/assets/img/doctor_2.png';
                        if ( has_post_thumbnail( $post_id ) ) {
                            $img_url = get_the_post_thumbnail_url( $post_id, 'large' );
                        } else {
                            $img_url = $placeholder_img;
                        }

                        // ACF базовые поля
                        $doctor_spec = '';
                        $doctor_exp  = '';
                        if ( function_exists( 'get_field' ) ) {
                            $doctor_spec = get_field( 'doctor_spec', $post_id );
                            $doctor_exp  = get_field( 'doctor_exp', $post_id );
                        }
                        if ( is_array( $doctor_spec ) ) $doctor_spec = implode( ', ', $doctor_spec );
                        if ( is_array( $doctor_exp ) )  $doctor_exp  = implode( ', ', $doctor_exp );

                        // ----- Сбор образования -----
                        $educations = array();

                        // Попробуем номерованные поля doctor_education_1..7 (вы указали максимум 7)
                        if ( function_exists( 'get_field' ) ) {
                            for ( $i = 1; $i <= 7; $i++ ) {
                                $key = "doctor_education_{$i}";
                                $val = get_field( $key, $post_id );
                                if ( $val ) {
                                    if ( is_array( $val ) ) {
                                        // если это массив — попробуем найти текст внутри
                                        $text = '';
                                        foreach ( $val as $sub ) {
                                            if ( is_string( $sub ) && trim( $sub ) !== '' ) { $text = $sub; break; }
                                            if ( is_array( $sub ) ) {
                                                // вложенный массив — возьмём первую строку
                                                foreach ( $sub as $v ) {
                                                    if ( is_string( $v ) && trim( $v ) !== '' ) { $text = $v; break 2; }
                                                }
                                            }
                                        }
                                        if ( $text ) $educations[] = $text;
                                    } else {
                                        $educations[] = $val;
                                    }
                                }
                            }

                            // Если ничего не найдено, попробуем одно поле doctor_education как массив/строка/репитер
                            if ( empty( $educations ) ) {
                                $edu_field = get_field( 'doctor_education', $post_id );
                                if ( $edu_field ) {
                                    // Если строка
                                    if ( is_string( $edu_field ) ) {
                                        $educations[] = $edu_field;
                                    }
                                    // Если массив — может быть репитер или галерея строк
                                    elseif ( is_array( $edu_field ) ) {
                                        // Если элементы — строки
                                        $all_strings = true;
                                        foreach ( $edu_field as $el ) {
                                            if ( ! is_string( $el ) ) { $all_strings = false; break; }
                                        }
                                        if ( $all_strings ) {
                                            $educations = array_merge( $educations, $edu_field );
                                        } else {
                                            // элементы — возможно ассоциативные массивы (ряды репитера)
                                            foreach ( $edu_field as $row ) {
                                                if ( is_string( $row ) ) {
                                                    $educations[] = $row;
                                                } elseif ( is_array( $row ) ) {
                                                    // попытаемся найти первое текстовое значение в ряду
                                                    $found = false;
                                                    foreach ( $row as $v ) {
                                                        if ( is_string( $v ) && trim( $v ) !== '' ) {
                                                            $educations[] = $v;
                                                            $found = true;
                                                            break;
                                                        }
                                                    }
                                                    if ( ! $found ) {
                                                        // ничего не найдено — пропускаем
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        // Ограничим до 7 (на случай если пришло больше)
                        if ( count( $educations ) > 7 ) {
                            $educations = array_slice( $educations, 0, 7 );
                        }

                        if ( $profile && ! empty( $profile['education'] ) ) {
                            $educations = $profile['education'];
                        }

                        if ( $profile && ! empty( $profile['specialization'] ) ) {
                            $doctor_spec = $profile['specialization'];
                        }

                        ?>

                        <div class="single-specialist__main">
                            <div class="single-specialist__left">
                                <div class="single-specialist__image">
                                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                                </div>
                                <button class="single-specialist__signup btn-gold" data-popup-target="#popup-doctors" data-doctor-title="<?php echo esc_attr( $title ); ?>">
                                    <span class="pc">Записаться на консультацию</span>
                                    <span class="mob">Записаться</span>
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="single-specialist__info">
                                <h1 class="single-specialist__info-title"><?php echo esc_html( $title ); // Имя поста ?></h1>

                                <div class="single-specialist__info-item">
                                    <h4 class="single-specialist__info-text">Специализация:</h4>
                                    <p class="single-specialist__info-text">
                                        <?php if ( ! empty( $doctor_spec ) ) echo esc_html( $doctor_spec ); // acf doctor_spec ?>
                                    </p>
                                </div>

                                <div class="single-specialist__info-item">
                                    <h4 class="single-specialist__info-text">Стаж:</h4>
                                    <p class="single-specialist__info-text">
                                        <?php if ( ! empty( $doctor_exp ) ) echo esc_html( $doctor_exp ); // acf doctor_exp ?>
                                    </p>
                                </div>

                                <div class="single-specialist__info-item">
                                    <?php if ( $profile ) :
                                        liderdent_render_prodoctorov_widget( $profile, $title );
                                    else : ?>
                                    <p class="single-specialist__info-text">Рейтинг:</p>
                                    <div class="single-specialist__info-raiting" aria-hidden="true">
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/star.svg" alt="Рейтинг">
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ( $profile && ! empty( $profile['bio'] ) ) : ?>
                                <div class="single-specialist__info-item">
                                    <p class="single-specialist__info-text single-specialist__bio"><?php echo esc_html( $profile['bio'] ); ?></p>
                                </div>
                                <?php endif; ?>

                                <div class="single-specialist__info-item education">
                                    <h4 class="single-specialist__info-text bold">Образование</h4>

                                    <?php
                                    if ( ! empty( $educations ) ) :
                                        foreach ( $educations as $edu_item ) : ?>
                                            <p class="single-specialist__info-text"><?php echo esc_html( $edu_item ); // doctor_education_X ?></p>
                                        <?php endforeach;
                                    else : ?>
                                        <p class="single-specialist__info-text"><?php esc_html_e( 'Информация отсутствует', 'your-theme-textdomain' ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        if ( function_exists( 'liderdent_render_doctor_certificates' ) ) {
                            liderdent_render_doctor_certificates( $post_id );
                        }
                        liderdent_render_doctor_cases( $title );
                        ?>

                    <?php
                    endwhile; // end loop
                endif; // have_posts
                ?>

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

</main>

<?php get_footer(); ?>
