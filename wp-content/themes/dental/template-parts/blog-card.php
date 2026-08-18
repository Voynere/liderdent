<?php
/**
 * Blog archive card: image, title, date, excerpt, link.
 */
$permalink = get_permalink();
$title     = get_the_title();
$image     = function_exists( 'liderdent_blog_card_image_url' ) ? liderdent_blog_card_image_url() : '';
?>
<article <?php post_class( 'blog-category__post' ); ?>>
	<?php if ( $image ) : ?>
		<a href="<?php echo esc_url( $permalink ); ?>" class="blog-category__post-thumbnail">
			<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" decoding="async" width="640" height="400">
		</a>
	<?php else : ?>
		<a href="<?php echo esc_url( $permalink ); ?>" class="blog-category__post-thumbnail blog-category__post-thumbnail--empty" aria-hidden="true">
			<span class="blog-category__post-placeholder">Статья</span>
		</a>
	<?php endif; ?>

	<div class="blog-category__post-content">
		<time class="blog-category__post-meta" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
			<?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?>
		</time>
		<h2 class="blog-category__post-title">
			<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
		</h2>
		<div class="blog-category__post-excerpt">
			<?php the_excerpt(); ?>
		</div>
		<a href="<?php echo esc_url( $permalink ); ?>" class="blog-category__post-readmore">
			Читать далее
		</a>
	</div>
</article>
