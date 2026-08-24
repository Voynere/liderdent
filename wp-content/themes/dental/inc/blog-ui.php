<?php
/**
 * Blog listing cards + mid-article CTA / service links + related articles.
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
		'inno'        => 'implantaciya-osstem-inno',
		'dentium'     => 'implantat-dentium',
		'nobel'       => 'implantat-nobel-straumann',
		'straumann'   => 'implantat-nobel-straumann',
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
		'cirkoni'     => 'koronka-dioksid-cirkoniya',
		'protez'      => 'protezirovanie',
		'hirurg'      => 'hirurgiya',
		'mudrost'     => 'hirurgiya',
		'udalen'      => 'hirurgiya',
		'nejromysh'   => 'nejromyshechnaya-stomatologiya',
		'vnchs'       => 'nejromyshechnaya-stomatologiya',
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
 * Explicit related article slugs for cross-linking (current slug excluded).
 *
 * @return array<string, array<int, string>>
 */
function liderdent_article_related_slug_map(): array {
	return [
		'cirkonievye-koronki-v-krasnoyarske-protezirovanie-v-liderdent' => [
			'lechenie-kanalov-zuba-v-krasnoyarske-etapy-sroki-perelechivanie-i-vosstanovlenie-zuba',
			'implantacziya-zubov-pod-klyuch-v-krasnoyarske-etapy-sroki-chto-vhodit-v-stoimost',
			'czena-stomatologii-v-krasnoyarske-iz-chego-skladyvaetsya-stoimost-lecheniya-i-kak-sravnivat-kliniki',
		],
		'udalenie-zuba-mudrosti-v-krasnoyarske-hirurgiya-liderdent' => [
			'odnomomentnaya-implantaciya-v-krasnoyarske-liderdent',
			'kt-zubov-3d-v-krasnoyarske-kogda-nuzhno-chto-pokazyvaet-kak-pomogaet-lecheniyu',
			'implantacziya-zubov-v-krasnoyarske-nadezhno-estetichno-nadolgo',
		],
		'nejromyshechnaya-stomatologiya-v-krasnoyarske-kogda-nuzhna' => [
			'brekety-ili-elajnery-chto-vybrat-dlya-ispravleniya-prikusa-v-krasnoyarske',
			'cirkonievye-koronki-v-krasnoyarske-protezirovanie-v-liderdent',
			'esteticheskaya-stomatologiya-v-krasnoyarske-ispravlenie-prikusa-dlya-krasivoj-ulybki-brekety-i-elajnery',
		],
		'implantaty-osstem-i-inno-v-krasnoyarske-kakuyu-sistemu-vybrat' => [
			'implantaty-nobel-straumann-i-dentium-v-krasnoyarske-sravnenie',
			'implantacziya-zubov-pod-klyuch-v-krasnoyarske-etapy-sroki-chto-vhodit-v-stoimost',
			'odnomomentnaya-implantaciya-v-krasnoyarske-liderdent',
		],
		'implantaty-nobel-straumann-i-dentium-v-krasnoyarske-sravnenie' => [
			'implantaty-osstem-i-inno-v-krasnoyarske-kakuyu-sistemu-vybrat',
			'implantacziya-zubov-v-krasnoyarske-nadezhno-estetichno-nadolgo',
			'kt-zubov-3d-v-krasnoyarske-kogda-nuzhno-chto-pokazyvaet-kak-pomogaet-lecheniyu',
		],
		'odnomomentnaya-implantaciya-v-krasnoyarske-liderdent' => [
			'implantaty-osstem-i-inno-v-krasnoyarske-kakuyu-sistemu-vybrat',
			'udalenie-zuba-mudrosti-v-krasnoyarske-hirurgiya-liderdent',
			'implantacziya-zubov-pod-klyuch-v-krasnoyarske-etapy-sroki-chto-vhodit-v-stoimost',
		],
		'implantacziya-zubov-pod-klyuch-v-krasnoyarske-etapy-sroki-chto-vhodit-v-stoimost' => [
			'implantaty-osstem-i-inno-v-krasnoyarske-kakuyu-sistemu-vybrat',
			'cirkonievye-koronki-v-krasnoyarske-protezirovanie-v-liderdent',
			'implantaty-nobel-straumann-i-dentium-v-krasnoyarske-sravnenie',
		],
		'brekety-pod-klyuch-200000-chto-vhodit-v-programmu' => [
			'brekety-ili-elajnery-chto-vybrat-dlya-ispravleniya-prikusa-v-krasnoyarske',
			'nejromyshechnaya-stomatologiya-v-krasnoyarske-kogda-nuzhna',
			'professionalnaya-gigiena-v-krasnoyarske-chto-vhodit-kak-chasto-delat-i-kak-sohranit-implanty-koronki',
		],
	];
}

/**
 * Blog posts that promote a service landing.
 *
 * @return array<string, array<int, string>>
 */
function liderdent_service_blog_slug_map(): array {
	return [
		'protezirovanie'                   => [ 'cirkonievye-koronki-v-krasnoyarske-protezirovanie-v-liderdent' ],
		'koronka-dioksid-cirkoniya'        => [ 'cirkonievye-koronki-v-krasnoyarske-protezirovanie-v-liderdent' ],
		'hirurgiya'                        => [ 'udalenie-zuba-mudrosti-v-krasnoyarske-hirurgiya-liderdent' ],
		'konsultaciya-hirurga'             => [ 'udalenie-zuba-mudrosti-v-krasnoyarske-hirurgiya-liderdent' ],
		'nejromyshechnaya-stomatologiya'   => [ 'nejromyshechnaya-stomatologiya-v-krasnoyarske-kogda-nuzhna' ],
		'implantaciya'                     => [
			'implantaty-osstem-i-inno-v-krasnoyarske-kakuyu-sistemu-vybrat',
			'implantaty-nobel-straumann-i-dentium-v-krasnoyarske-sravnenie',
			'implantacziya-zubov-pod-klyuch-v-krasnoyarske-etapy-sroki-chto-vhodit-v-stoimost',
		],
		'implantaciya-osstem-inno'         => [ 'implantaty-osstem-i-inno-v-krasnoyarske-kakuyu-sistemu-vybrat' ],
		'implantat-dentium'                => [ 'implantaty-nobel-straumann-i-dentium-v-krasnoyarske-sravnenie' ],
		'implantat-nobel-straumann'        => [ 'implantaty-nobel-straumann-i-dentium-v-krasnoyarske-sravnenie' ],
		'ortodontiya'                      => [
			'brekety-pod-klyuch-200000-chto-vhodit-v-programmu',
			'brekety-ili-elajnery-chto-vybrat-dlya-ispravleniya-prikusa-v-krasnoyarske',
		],
		'gigiena'                          => [
			'parodontit-i-professionalnaya-gigiena-v-liderdent',
			'vector-terapiya-v-krasnoyarske-lechenie-desen-pri-krovotochivosti-i-parodontite',
		],
		'lechenie'                         => [
			'lechenie-zubov-pod-mikroskopom-v-krasnoyarske-tochnost-prognoz-pokazaniya',
			'lechenie-kanalov-zuba-v-krasnoyarske-etapy-sroki-perelechivanie-i-vosstanovlenie-zuba',
		],
		'rentgenologicheskoe-obsledovanie' => [ 'kt-zubov-3d-v-krasnoyarske-kogda-nuzhno-chto-pokazyvaet-kak-pomogaet-lecheniyu' ],
	];
}

/**
 * @return array<int, array{url:string,title:string}>
 */
function liderdent_article_related_posts( $post = null, int $limit = 3 ): array {
	$post = get_post( $post );
	if ( ! $post ) {
		return [];
	}

	$map   = liderdent_article_related_slug_map();
	$slugs = $map[ $post->post_name ] ?? [];
	$out   = [];

	foreach ( $slugs as $slug ) {
		if ( $slug === $post->post_name ) {
			continue;
		}
		$found = get_posts(
			[
				'name'           => $slug,
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
			]
		);
		if ( ! $found ) {
			continue;
		}
		$related = $found[0];
		$out[]   = [
			'url'   => get_permalink( $related ) ?: '',
			'title' => get_the_title( $related ),
		];
		if ( count( $out ) >= $limit ) {
			break;
		}
	}

	return array_values( array_filter( $out, static fn( $row ) => $row['url'] !== '' ) );
}

/**
 * @return array<int, array{url:string,title:string}>
 */
function liderdent_service_related_articles( string $slug, int $limit = 3 ): array {
	$map   = liderdent_service_blog_slug_map();
	$slugs = $map[ $slug ] ?? [];
	$out   = [];

	foreach ( $slugs as $post_slug ) {
		$found = get_posts(
			[
				'name'           => $post_slug,
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
			]
		);
		if ( ! $found ) {
			continue;
		}
		$related = $found[0];
		$out[]   = [
			'url'   => get_permalink( $related ) ?: '',
			'title' => get_the_title( $related ),
		];
		if ( count( $out ) >= $limit ) {
			break;
		}
	}

	return array_values( array_filter( $out, static fn( $row ) => $row['url'] !== '' ) );
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

function liderdent_render_article_related_posts( $post = null ): void {
	$links = liderdent_article_related_posts( $post, 3 );
	if ( ! $links ) {
		return;
	}
	?>
	<nav class="article-related" aria-labelledby="article-related-title">
		<h2 id="article-related-title" class="article-related__title">Читайте также</h2>
		<ul class="article-related__list">
			<?php foreach ( $links as $link ) : ?>
				<li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<?php
}

function liderdent_render_service_related_articles( string $slug ): void {
	$links = liderdent_service_related_articles( $slug, 3 );
	if ( ! $links ) {
		return;
	}
	?>
	<section class="svc-landing__articles" aria-labelledby="svc-articles-title">
		<h2 id="svc-articles-title" class="svc-landing__h2">Статьи по теме</h2>
		<ul class="svc-landing__articles-list">
			<?php foreach ( $links as $link ) : ?>
				<li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</section>
	<?php
}
