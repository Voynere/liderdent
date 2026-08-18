<?php
/**
 * Blog listing cards + mid-article CTA / service links.
 */

function liderdent_blog_card_image_url( $post = null ): string {
	$post = get_post( $post );
	if ( ! $post ) {
		return '';
	}
	if ( has_post_thumbnail( $post ) ) {
		$url = get_the_post_thumbnail_url( $post, 'medium_large' );
		return $url ? $url : '';
	}
	if ( ! function_exists( 'liderdent_blog_thumbnail_map' ) ) {
		return '';
	}
	$map  = liderdent_blog_thumbnail_map();
	$rel  = $map[ $post->post_name ] ?? '';
	if ( $rel === '' ) {
		return '';
	}
	$path = get_template_directory() . '/' . $rel;
	return file_exists( $path ) ? get_template_directory_uri() . '/' . $rel : '';
}

/**
 * Related service landings for a blog post (registry only).
 *
 * @return array<int, array{url:string,title:string}>
 */
function liderdent_article_related_landings( $post = null ): array {
	$post = get_post( $post );
	if ( ! $post || ! function_exists( 'liderdent_get_service_content' ) || ! function_exists( 'liderdent_service_landing_url' ) ) {
		return [];
	}

	$hay = mb_strtolower( $post->post_name . ' ' . $post->post_title );
	$map = [
		'implant'     => 'implantaciya',
		'osstem'      => 'implantaciya-osstem-inno',
		'brek'        => 'ortodontiya',
		'elajn'       => 'ortodontiya',
		'prikus'      => 'ortodontiya',
		'gigien'      => 'gigiena',
		'chistk'      => 'gigiena',
		'parodont'    => 'gigiena',
		'vector'      => 'gigiena',
		'mikroskop'   => 'lechenie',
		'kanal'       => 'lechenie',
		'karies'      => 'lechenie',
		'kt-zubov'    => 'rentgenologicheskoe-obsledovanie',
		'rentgen'     => 'rentgenologicheskoe-obsledovanie',
		'tomograf'    => 'rentgenologicheskoe-obsledovanie',
		'koronk'      => 'protezirovanie',
		'protez'      => 'protezirovanie',
	];

	$slugs = [];
	foreach ( $map as $needle => $slug ) {
		if ( str_contains( $hay, $needle ) ) {
			$slugs[ $slug ] = true;
		}
	}

	$out = [];
	foreach ( array_keys( $slugs ) as $slug ) {
		$item = liderdent_get_service_content( $slug );
		if ( ! $item ) {
			continue;
		}
		$out[] = [
			'url'   => liderdent_service_landing_url( $slug ),
			'title' => (string) ( $item['nav_title'] ?? $item['h1'] ?? $slug ),
		];
		if ( count( $out ) >= 3 ) {
			break;
		}
	}

	if ( str_contains( $hay, 'czena' ) || str_contains( $hay, 'stoimost' ) ) {
		$out[] = [
			'url'   => home_url( '/prices/' ),
			'title' => 'Цены на услуги',
		];
	}

	if ( $out ) {
		return array_slice( $out, 0, 3 );
	}

	foreach ( [ 'lechenie', 'implantaciya' ] as $slug ) {
		$item = liderdent_get_service_content( $slug );
		if ( ! $item ) {
			continue;
		}
		$out[] = [
			'url'   => liderdent_service_landing_url( $slug ),
			'title' => (string) ( $item['nav_title'] ?? $item['h1'] ?? $slug ),
		];
	}

	return array_slice( $out, 0, 3 );
}

/**
 * Insert mid-article CTA after the second paragraph, or at the end.
 */
function liderdent_insert_article_midblock_html( string $html ): string {
	ob_start();
	liderdent_render_article_midblock();
	$mid = (string) ob_get_clean();
	if ( $mid === '' ) {
		return $html;
	}

	$parts = preg_split( '/(<\/p>)/i', $html, 3, PREG_SPLIT_DELIM_CAPTURE );
	if ( ! is_array( $parts ) || count( $parts ) < 5 ) {
		return $html . $mid;
	}

	return $parts[0] . $parts[1] . $parts[2] . $parts[3] . $mid . $parts[4];
}

function liderdent_render_article_midblock( $post = null ): void {
	$post = get_post( $post );
	if ( ! $post ) {
		return;
	}
	$links = liderdent_article_related_landings( $post );
	?>
	<aside class="article-mid" aria-label="Запись на приём">
		<p class="article-mid__lead">Нужна консультация в Красноярске? Запишитесь в «ЛидерДент» или посмотрите услугу.</p>
		<div class="article-mid__cta">
			<button type="button" class="btn-gold open-popup-callback">Записаться на приём</button>
			<a class="article-mid__phone" href="tel:+73912271343">+7 (391) 227-13-43</a>
		</div>
		<?php if ( $links ) : ?>
			<nav class="article-mid__links" aria-label="Похожие услуги">
				<span class="article-mid__links-label">Услуги по теме:</span>
				<ul>
					<?php foreach ( $links as $link ) : ?>
						<li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</nav>
		<?php endif; ?>
	</aside>
	<?php
}
