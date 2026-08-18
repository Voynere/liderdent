<?php
/**
 * Шаблон статьи из рубрики «Статьи».
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-post' ); ?>>
	<header class="article-post__header entry-header">
		<h1 class="article-post__title entry-title"><?php the_title(); ?></h1>
		<time class="article-post__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
			<?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?>
		</time>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="article-post__thumb post-thumbnail">
			<?php
			the_post_thumbnail(
				'large',
				[
					'class'   => 'article-post__thumb-img',
					'loading' => 'eager',
					'alt'     => the_title_attribute( [ 'echo' => false ] ),
				]
			);
			?>
		</div>
	<?php endif; ?>

	<div class="article-post__content entry-content">
		<?php
		ob_start();
		the_content(
			sprintf(
				'<span class="article-post__more">%s</span>',
				esc_html__( 'Читать далее »', 'liderdent' )
			)
		);
		$html = (string) ob_get_clean();
		if ( function_exists( 'liderdent_insert_article_midblock_html' ) ) {
			echo liderdent_insert_article_midblock_html( $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		wp_link_pages(
			[
				'before'      => '<div class="article-post__pages page-links">' . esc_html__( 'Страницы:', 'liderdent' ) . ' ',
				'after'       => '</div>',
				'link_before' => '<span class="article-post__page-num">',
				'link_after'  => '</span>',
			]
		);
		?>
	</div>

	<footer class="article-post__footer entry-footer">
		<div class="article-post__cats cat-links">
			<span class="article-post__meta-label"><?php esc_html_e( 'Рубрика:', 'liderdent' ); ?></span>
			<?php the_category( ', ' ); ?>
		</div>
		<?php if ( has_tag() ) : ?>
			<div class="article-post__tags tags-links">
				<span class="article-post__meta-label"><?php esc_html_e( 'Метки:', 'liderdent' ); ?></span>
				<?php the_tags( '', ', ', '' ); ?>
			</div>
		<?php endif; ?>
	</footer>
</article>
