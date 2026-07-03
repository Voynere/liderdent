<?php
/**
 * Шаблон отдельной записи
 */

get_header();

// ID рубрики "Статьи" - ЗАМЕНИТЕ 5 НА ВАШ ID!
$articles_category_id = 13;

// Проверяем, относится ли текущая запись к рубрике "Статьи"
if ( in_category( $articles_category_id ) ) {
    // Подключаем специальный шаблон для статей
    get_template_part( 'template-parts/content', 'article' );
} else {
    // Для всех остальных записей используем стандартный шаблон
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', get_post_type() );
        endwhile;
    endif;
}

get_footer();
?>