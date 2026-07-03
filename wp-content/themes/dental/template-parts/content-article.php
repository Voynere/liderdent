<?php
/**
 * Шаблон для вывода статей из рубрики "Статьи"
 * Адаптирован под стили сайта liderdent24.ru
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-post' ); ?> style="max-width: 1340px; margin: 0 auto; padding: 20px; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-radius: 8px;">

    <!-- Заголовок статьи в стиле сайта -->
    <header class="entry-header" style="margin-bottom: 30px; text-align: left; border-bottom: 2px solid #e3f0ff; padding-bottom: 20px;">
        <h1 class="entry-title" style="font-size: 2.5em; color: #1A3A5C; margin: 0 0 10px 0; line-height: 1.2;"><?php the_title(); ?></h1>
    </header>

    <!-- Миниатюра статьи в стиле "карточки" -->
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail" style="margin-bottom: 30px; text-align: center;">
            <?php the_post_thumbnail( 'large', array( 
                'style' => 'max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);' 
            ) ); ?>
        </div>
    <?php endif; ?>

    <!-- Содержание статьи, адаптированное под шрифты сайта -->
    <div class="entry-content" style="font-size: 1.1em; line-height: 1.7; color: #333;">
        <?php
        the_content( sprintf(
            '<span class="continue-reading" style="display: inline-block; margin-top: 20px; padding: 10px 25px; background: #1E5791; color: white; text-decoration: none; border-radius: 5px; font-weight: 600;">%s</span>',
            esc_html__( 'Читать далее »', 'liderdent' )
        ) );

        // Пагинация для длинных статей
        wp_link_pages( array(
            'before' => '<div class="page-links" style="margin: 30px 0; padding: 15px; background: #f5f9ff; border-radius: 5px; text-align: center;">' . 'Страницы: ',
            'after'  => '</div>',
            'link_before' => '<span style="margin: 0 5px; padding: 5px 10px; background: #1E5791; color: white; border-radius: 3px;">',
            'link_after'  => '</span>',
        ) );
        ?>
    </div>

    <!-- Footer с рубриками и метками в стиле сайта -->
    <footer class="entry-footer" style="margin-top: 40px; padding: 20px 0 0; border-top: 2px solid #e3f0ff;">
        <div class="cat-links" style="margin-bottom: 10px;">
            <span style="font-weight: 600; color: #1A3A5C;">Рубрика:</span> 
            <?php the_category( ', ' ); ?>
        </div>
        <?php if ( has_tag() ) : ?>
            <div class="tags-links">
                <span style="font-weight: 600; color: #1A3A5C;">Метки:</span> 
                <?php the_tags( '', ', ', '' ); ?>
            </div>
        <?php endif; ?>
    </footer>
</article>



<!-- Добавляем стили для ссылок внутри контента -->
<style>
    .entry-content a {
        color: #1E5791;
        text-decoration: underline;
        text-underline-offset: 3px;
    }
    .entry-content a:hover {
        color: #0a2f4d;
    }
    .entry-content h2, .entry-content h3 {
        color: #1A3A5C;
        margin-top: 1.5em;
    }
    .entry-content h2 {
        font-size: 2em;
        border-left: 5px solid #1E5791;
        padding-left: 15px;
    }
    .entry-content h3 {
        font-size: 1.5em;
    }
    .entry-content ul, .entry-content ol {
        padding-left: 20px;
    }
    .entry-content li {
        margin-bottom: 5px;
    }
    .wp-block-image img {
    padding: 10px;
}
</style>