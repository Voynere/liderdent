<?php
/* 
    Template Name: legal-info
*/
?>

<?php get_header(); ?>

<main class="main-page-contacts">
    <?php do_action('theme_breadcrumbs'); ?>

    <section class="legal-info">
        <div class="container">
            <div class="legal-info__inner">
                <h1 class="page-title legal-info__title">ПРАВОВАЯ И ЮРИДИЧЕСКАЯ ИНФОРМАЦИЯ</h1>
                <div class="legal-info__content">
                    <ul class="legal-info__list">
                        <?php
                        // Статичные подписи (фоллбэк, если в ACF не заполнено)
                        $defaults = array(
                            1 => 'Правила внутреннего распорядка для потребителей.',
                            2 => 'Об утверждении правил предоставления медицинскими организациями платных медицинских услуг.',
                            3 => 'Положение о гарантиях при оказании стоматологических услуг в ООО «Лидер Дент».',
                            4 => 'Договор на оказание платных медицинных услуг.',
                            5 => 'Политика обработки персональных данных.',
                            6 => 'Согласие на обработку персональных данных.',
                            7 => 'Территориальная программа.'
                        );

                        for ($i = 1; $i <= 7; $i++) {
                            // Текст и PDF из ACF
                            $text_field = get_field( "legal_text_{$i}" );
                            $pdf_field  = get_field( "legal_pdf_{$i}" );

                            // Получаем URL из поля
                            $pdf_url = '';
                            if ( is_array( $pdf_field ) && ! empty( $pdf_field['url'] ) ) {
                                $pdf_url = $pdf_field['url'];
                            } elseif ( is_string( $pdf_field ) && trim( $pdf_field ) !== '' ) {
                                $pdf_url = $pdf_field;
                            } elseif ( is_numeric( $pdf_field ) ) {
                                // ACF может вернуть ID файла
                                $pdf_url = wp_get_attachment_url( (int) $pdf_field );
                            }

                            // сначала ACF, иначе статичный фоллбэк
                            $link_text = $text_field ? $text_field : ( isset( $defaults[$i] ) ? $defaults[$i] : "Документ {$i}" );

                            // Подготовка вывода
                            $has_pdf = ! empty( $pdf_url );
                            $link_attrs = $has_pdf ? ' target="_blank" rel="noopener noreferrer"' : ' aria-disabled="true"';
                            $link_href = $has_pdf ? esc_url( $pdf_url ) : '#';
                            ?>
                            <li class="legal-info__list-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/icons/pdf.svg" alt="" class="legal-info__list-icon">
                                <?php if ( $has_pdf ) : ?>
                                    <a class="legal-info__list-link" href="<?php echo $link_href; ?>"<?php echo $link_attrs; ?>>
                                        <?php echo esc_html( $link_text ); ?>
                                    </a>
                                <?php else : ?>
                                    <span class="legal-info__list-link"<?php echo $link_attrs; ?>>
                                        <?php echo esc_html( $link_text ); ?>
                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="legal-info-licenses">
        <div class="container">
            <div class="legal-info-licenses__inner">
                <h2 class="legal-info-licenses__title pc page-title">
                    ЛИЦЕНЗИЯ <span class="mobile-hidden">НА ОСУЩЕСТВЛЕНИЕ МЕДИЦИНСКОЙ ДЕЯТЕЛЬНОСТИ</span>
                </h2>
                <div class="legal-info-licenses__content">
                    <?php
                    // дефолтные изображения (фоллбэк)
                    $default_licenses = array(
                        1 => get_template_directory_uri() . '/assets/img/license_1.jpg',
                        2 => get_template_directory_uri() . '/assets/img/license_2.jpg',
                        // 3 => get_template_directory_uri() . '/assets/img/license_3.jpg',
                    );

                    for ($j = 1; $j <= 2; $j++) {
                        $field_name = "legal_license_{$j}";
                        $img_field = get_field( $field_name );

                        $img_src = '';
                        $img_alt = 'Лицензия';

                        if ( is_array( $img_field ) && ! empty( $img_field['url'] ) ) {
                            $img_src = $img_field['url'];
                            if ( ! empty( $img_field['alt'] ) ) $img_alt = $img_field['alt'];
                            elseif ( ! empty( $img_field['title'] ) ) $img_alt = $img_field['title'];
                        } elseif ( is_numeric( $img_field ) ) {
                            $img_src = wp_get_attachment_image_url( (int) $img_field, 'full' );
                            $img_alt = get_post_meta( (int) $img_field, '_wp_attachment_image_alt', true ) ?: $img_alt;
                        } elseif ( is_string( $img_field ) && trim( $img_field ) !== '' ) {
                            $img_src = $img_field;
                        }

                        // Если поле пустое -> используем статическую картинку
                        if ( empty( $img_src ) ) {
                            $img_src = isset( $default_licenses[$j] ) ? $default_licenses[$j] : $default_licenses[1];
                        }

                        // Вывод: ссылка с data-fancybox, чтобы открыть в галерее
                        ?>
                        <div class="legal-info-licenses__content-item">
                            <a href="<?php echo esc_url( $img_src ); ?>"
                            data-fancybox="licenses-gallery"
                            class="legal-info-licenses__link"
                            title="<?php echo esc_attr( $img_alt ); ?>">
                                <img src="<?php echo esc_url( $img_src ); ?>"
                                    alt="<?php echo esc_attr( $img_alt ); ?>"
                                    loading="lazy" />
                            </a>
                        </div>
                    <?php } ?>
                </div>
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
