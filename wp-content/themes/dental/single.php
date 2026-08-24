<?php
/**
 * Шаблон отдельной записи
 */

get_header();

if ( has_category( 'blog' ) ) {
	get_template_part( 'template-parts/content', 'article' );
} else {
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;
	endif;
}

get_footer();
?>
