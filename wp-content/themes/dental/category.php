<?php get_header(); ?>

<style>
/* Описание рубрики услуг (над таблицей цен) */
.category-description {
    margin-bottom: 40px;
    padding: 25px 30px;
    background: #f9f9f9;
    border-left: 4px solid #d2ae6b;
    border-radius: 12px;
    font-size: 16px;
    line-height: 1.6;
    color: #333;
}

.category-description p:first-child {
    margin-top: 0;
}

.category-description p:last-child {
    margin-bottom: 0;
}

.category-description h2,
.category-description h3,
.category-description h4 {
    margin-top: 0;
    margin-bottom: 15px;
    color: #1A3A5C;
}

.category-description h2 {
    font-size: 1.8em;
}

.category-description h3 {
    font-size: 1.4em;
}

.category-description ul,
.category-description ol {
    padding-left: 20px;
    margin: 15px 0;
}

.category-description li {
    margin-bottom: 8px;
}

.category-description strong {
    color: #1A3A5C;
}
</style>

<main class="main-page-price">

    <?php do_action('theme_breadcrumbs'); ?>

    <?php
        $services = get_category_by_slug('services');
        $current  = get_queried_object();

        // ЕСЛИ ЭТО РУБРИКА УСЛУГ ИЛИ ЕЁ ДОЧЕРНЯЯ
        if ( $services && $current && ( $current->term_id === $services->term_id || $current->parent === $services->term_id ) ) :
        ?>

        <section class="page-price">
    <div class="container">
        <div class="page-price__inner">

            <h1 class="page-price__title page-title">
                <?php single_cat_title(); ?>
            </h1>

            <!-- ВЫВОД ОПИСАНИЯ РУБРИКИ -->
            <?php
            $theme_service_html = '';
            if ( $current && ! empty( $current->slug ) && function_exists( 'liderdent_service_description_html' ) ) {
                $theme_service_html = liderdent_service_description_html( (string) $current->slug );
            }
            $category_description = $theme_service_html !== '' ? $theme_service_html : category_description();
            if ( ! empty( $category_description ) ) :
            ?>
                <div class="category-description">
                    <?php echo apply_filters( 'the_content', $category_description ); ?>
                </div>
            <?php endif; ?>

            <?php if ( function_exists( 'liderdent_render_implant_faq' ) ) : ?>
                <?php liderdent_render_implant_faq(); ?>
            <?php endif; ?>

            <?php if ( is_category( 'implantaciya' ) ) : ?>
                <h2 class="page-price__subtitle">Цены и услуги по имплантации</h2>
            <?php endif; ?>

            <div class="page-price__content">

                <div class="page-price__line head">
                    <p class="page-price__line-item bold">Услуга</p>
                    <p class="page-price__line-item bold mobile-end">Стоимость</p>
                    <p class="page-price__line-item bold gold discount-hidden">Скидка</p>
                    <p class="page-price__line-item"></p>
                </div>

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <div class="page-price__line">
                            <p class="page-price__line-item form-service-title"><?php the_title(); ?></p>
                            <p class="page-price__line-item mobile-end"><?php the_field('service_price'); ?> руб.</p>
                            <p class="page-price__line-item discount-hidden"><?php the_field('service_discount'); ?> руб.</p>

                            <button class="page-price__line-button btn-gold open-popup-service" data-popup-target="#popup-service" data-service-title="<?php echo esc_attr( get_the_title() ); ?>">
                                <span class="pc">Записаться на прием</span>
                                <span class="mob">Записаться</span>
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                                </svg>
                            </button>
                        </div>

                    <?php endwhile; ?>

                <?php else : ?>

                    <div class="page-price__line">
                        <p class="page-price__line-item bold">Услуги не найдены</p>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

    <?php 
        // ЕСЛИ ЭТО ЛЮБАЯ ДРУГАЯ РУБРИКА (НАПРИМЕР, "БЛОГ")
        else : 
    ?>

        <section class="blog-category">
            <div class="container">
                <div class="blog-category__inner">

                    <h1 class="page-title blog-category__title">
                        <?php single_cat_title(); // Выводим название рубрики ?>
                    </h1>

                    <?php if ( have_posts() ) : ?>
                        <div class="blog-category__posts">
                            <?php
                            while ( have_posts() ) :
                                the_post();
                                get_template_part( 'template-parts/blog', 'card' );
                            endwhile;
                            ?>
                        </div>

                        <!-- Пагинация -->
                        <div class="blog-category__pagination">
                            <?php
                            the_posts_pagination( array(
                                'mid_size'  => 2,
                                'prev_text' => '←',
                                'next_text' => '→',
                            ) );
                            ?>
                        </div>

                    <?php else : ?>
                        <p class="blog-category__no-posts">Записей в этой рубрике пока нет.</p>
                    <?php endif; ?>

                </div>
            </div>
        </section>

    <?php endif; // Конец основного условия if/else ?>

</main>

<?php get_footer(); ?>