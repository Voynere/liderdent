<?php get_header(); ?>

<style>
/* Стили для рубрики блога - ПРЯМО В ШАБЛОНЕ */
.blog-category {
    padding: 40px 0;
    background: #f5f5f5;
}

.blog-category__inner {
    max-width: 1340px;
    margin: 0 auto;
    padding: 0 20px;
}

.blog-category__title {
    margin-bottom: 40px;
    color: #1A3A5C;
    font-size: 2.5em;
    font-weight: 600;
}

.blog-category__posts {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.blog-category__post {
    display: flex;
    gap: 30px;
    padding: 25px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: box-shadow 0.3s ease;
}

.blog-category__post:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.blog-category__post-thumbnail {
    flex: 0 0 300px;
}

.blog-category__post-thumbnail img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 5px;
    display: block;
}

.blog-category__post-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.blog-category__post-title {
    margin: 0 0 15px 0;
    font-size: 1.5em;
    line-height: 1.3;
}

.blog-category__post-title a {
    color: #1A3A5C;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-category__post-title a:hover {
    color: #1E5791;
}

.blog-category__post-excerpt {
    margin-bottom: 20px;
    line-height: 1.6;
    color: #333;
}

.blog-category__post-readmore {
    display: inline-block;
    padding: 10px 25px;
    background: #1E5791;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 600;
    align-self: flex-start;
    transition: background 0.3s ease;
}

.blog-category__post-readmore:hover {
    background: #0a2f4d;
}

.blog-category__pagination {
    margin-top: 50px;
    text-align: center;
}

.blog-category__pagination .page-numbers {
    display: inline-block;
    padding: 8px 13px;
    margin: 0 3px;
    background: #f5f9ff;
    color: #1A3A5C;
    text-decoration: none;
    border-radius: 3px;
    transition: all 0.3s ease;
}

.blog-category__pagination .page-numbers.current {
    background: #1E5791;
    color: white;
}

.blog-category__pagination .page-numbers:hover:not(.current) {
    background: #d4e3ff;
}

@media (max-width: 768px) {
    .blog-category__post {
        flex-direction: column;
    }
    
    .blog-category__post-thumbnail {
        flex: 0 0 auto;
        width: 100%;
    }
    
    .blog-category__post-thumbnail img {
        height: 250px;
    }
}
/* Стили для описания рубрики услуг (над таблицей цен) */
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
            $category_description = category_description();
            if ( ! empty( $category_description ) ) : 
            ?>
                <div class="category-description">
                    <?php echo apply_filters( 'the_content', $category_description ); ?>
                </div>
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

        <?php if ( $current->parent === $services->term_id ) : ?>
        <section class="about page-service-category-prices">
            <div class="container">
                <div class="about__inner">
                    <?php liderdent_render_short_prices_for_category( $current->slug ); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

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
                            <?php while ( have_posts() ) : the_post(); ?>
                                
                                <article class="blog-category__post">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>" class="blog-category__post-thumbnail">
                                            <?php the_post_thumbnail( 'medium' ); ?>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <div class="blog-category__post-content">
                                        <h2 class="blog-category__post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        
                                        <div class="blog-category__post-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        
                                        <a href="<?php the_permalink(); ?>" class="blog-category__post-readmore">
                                            Читать далее →
                                        </a>
                                    </div>
                                </article>

                            <?php endwhile; ?>
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