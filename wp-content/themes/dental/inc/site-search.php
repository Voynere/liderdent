<?php
/**
 * Site search: services registry, prices, doctors, articles, promotions.
 * Overlay AJAX matches MRT Lider (mrt_site_search); ?s= uses the same index.
 */

function liderdent_search_contains( string $hay, string $q ): bool {
	if ( $q === '' ) {
		return false;
	}
	return mb_stripos( $hay, $q, 0, 'UTF-8' ) !== false;
}

function liderdent_search_plain( string $html ): string {
	$text = wp_strip_all_tags( $html );
	$text = html_entity_decode( $text, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
	$text = preg_replace( '/\s+/u', ' ', $text );
	return is_string( $text ) ? trim( $text ) : '';
}

/**
 * @return array<string, array{label: string, items: array<int, array{title: string, url: string}>}>
 */
function liderdent_site_search_results( string $q ): array {
	$empty = [
		'services'   => [ 'label' => 'Услуги', 'items' => [] ],
		'prices'     => [ 'label' => 'Цены', 'items' => [] ],
		'promotions' => [ 'label' => 'Акции', 'items' => [] ],
		'doctors'    => [ 'label' => 'Врачи', 'items' => [] ],
		'articles'   => [ 'label' => 'Статьи', 'items' => [] ],
		'faq'        => [ 'label' => 'Вопросы', 'items' => [] ],
		'pages'      => [ 'label' => 'Разделы', 'items' => [] ],
	];

	$q = trim( $q );
	if ( mb_strlen( $q, 'UTF-8' ) < 2 ) {
		return $empty;
	}

	$empty['services']['items']   = liderdent_search_services( $q );
	$empty['prices']['items']     = liderdent_search_prices( $q );
	$empty['promotions']['items'] = liderdent_search_promotions( $q );
	$empty['doctors']['items']    = liderdent_search_doctors( $q );
	$empty['articles']['items']   = liderdent_search_articles( $q );
	$empty['faq']['items']        = liderdent_search_faq( $q );
	$empty['pages']['items']      = liderdent_search_pages( $q );

	return $empty;
}

/**
 * @return array<int, array{title: string, url: string}>
 */
function liderdent_search_services( string $q ): array {
	if ( ! function_exists( 'liderdent_get_services_content' ) ) {
		return [];
	}

	$scored = [];
	foreach ( liderdent_get_services_content() as $slug => $item ) {
		if ( ! is_array( $item ) ) {
			continue;
		}
		$title = (string) ( $item['nav_title'] ?? $item['h1'] ?? '' );
		if ( $title === '' ) {
			continue;
		}
		$score = liderdent_search_service_score( $item, $q );
		if ( $score < 2 ) {
			continue;
		}
		$scored[] = [
			'score' => $score,
			'title' => $title,
			'url'   => liderdent_service_landing_url( (string) $slug ),
		];
	}

	usort(
		$scored,
		static function ( array $a, array $b ): int {
			return $b['score'] <=> $a['score'];
		}
	);

	$items = [];
	foreach ( array_slice( $scored, 0, 8 ) as $row ) {
		$items[] = [
			'title' => $row['title'],
			'url'   => $row['url'],
		];
	}

	return $items;
}

function liderdent_search_service_score( array $item, string $q ): int {
	$score = 0;
	$title = (string) ( $item['nav_title'] ?? '' ) . ' ' . (string) ( $item['h1'] ?? '' );
	if ( liderdent_search_contains( $title, $q ) ) {
		$score += 3;
	}

	$mid = implode(
		' ',
		[
			(string) ( $item['seo_title'] ?? '' ),
			(string) ( $item['seo_description'] ?? '' ),
			(string) ( $item['intro'] ?? '' ),
		]
	);
	if ( ! empty( $item['indications'] ) && is_array( $item['indications'] ) ) {
		$mid .= ' ' . implode( ' ', $item['indications'] );
	}
	if ( ! empty( $item['faq'] ) && is_array( $item['faq'] ) ) {
		foreach ( $item['faq'] as $row ) {
			if ( is_array( $row ) ) {
				$mid .= ' ' . (string) ( $row['q'] ?? '' );
			}
		}
	}
	if ( liderdent_search_contains( $mid, $q ) ) {
		$score += 2;
	}

	return $score;
}

/**
 * @return array<int, array{title: string, url: string}>
 */
function liderdent_search_prices( string $q ): array {
	if ( ! function_exists( 'liderdent_get_short_prices' ) ) {
		return [];
	}

	$url   = home_url( '/prices/' );
	$items = [];
	$seen  = [];
	foreach ( liderdent_get_short_prices() as $section ) {
		if ( ! is_array( $section ) ) {
			continue;
		}
		$section_title = (string) ( $section['title'] ?? '' );
		$lines         = array_map( 'strval', (array) ( $section['items'] ?? [] ) );
		$section_hit   = $section_title !== '' && liderdent_search_contains( $section_title, $q );
		if ( $section_hit ) {
			$added = 0;
			foreach ( $lines as $line ) {
				if ( $line === '' || isset( $seen[ $line ] ) ) {
					continue;
				}
				$seen[ $line ] = true;
				$items[]       = [
					'title' => $line,
					'url'   => $url,
				];
				if ( ++$added >= 3 || count( $items ) >= 8 ) {
					break;
				}
			}
		}
		foreach ( $lines as $line ) {
			if ( $line === '' || isset( $seen[ $line ] ) || ! liderdent_search_contains( $line, $q ) ) {
				continue;
			}
			$seen[ $line ] = true;
			$items[]       = [
				'title' => $line,
				'url'   => $url,
			];
			if ( count( $items ) >= 8 ) {
				break 2;
			}
		}
	}

	return array_slice( $items, 0, 8 );
}

/**
 * @return array<int, array{title: string, url: string}>
 */
function liderdent_search_promotions( string $q ): array {
	if ( ! function_exists( 'liderdent_get_promotions' ) ) {
		return [];
	}

	$url   = function_exists( 'liderdent_get_sales_page_url' ) ? liderdent_get_sales_page_url() : home_url( '/sales/' );
	$items = [];
	foreach ( liderdent_get_promotions() as $promo ) {
		if ( ! is_array( $promo ) ) {
			continue;
		}
		$title = (string) ( $promo['title'] ?? '' );
		$hay   = $title . ' ' . (string) ( $promo['subtitle'] ?? '' ) . ' ' . (string) ( $promo['text'] ?? '' ) . ' ' . (string) ( $promo['badge'] ?? '' );
		if ( $title !== '' && liderdent_search_contains( $hay, $q ) ) {
			$subtitle = trim( (string) ( $promo['subtitle'] ?? '' ) );
			$label    = $title;
			if ( $subtitle !== '' && preg_match( '/\d|₽|руб/u', $subtitle ) ) {
				$label .= ' — ' . $subtitle;
			}
			$items[] = [
				'title' => $label,
				'url'   => $url,
			];
		}
		if ( count( $items ) >= 4 ) {
			break;
		}
	}

	return $items;
}

/**
 * @return array<int, array{title: string, url: string}>
 */
function liderdent_search_doctors( string $q ): array {
	$posts = get_posts(
		[
			'post_type'      => 'specialist',
			'post_status'    => 'publish',
			'posts_per_page' => 20,
			'orderby'        => 'title',
			'order'          => 'ASC',
		]
	);

	$items = [];
	foreach ( $posts as $post ) {
		if ( ! $post instanceof WP_Post ) {
			continue;
		}
		$spec = '';
		if ( function_exists( 'get_field' ) ) {
			$spec = (string) get_field( 'doctor_spec', $post->ID );
			$spec .= ' ' . (string) get_field( 'doctor_service', $post->ID );
		}
		$profile = function_exists( 'liderdent_get_doctor_profile' ) ? liderdent_get_doctor_profile( $post->post_title ) : null;
		$hay     = $post->post_title . ' ' . $spec;
		if ( is_array( $profile ) ) {
			$hay .= ' ' . (string) ( $profile['specialization'] ?? '' ) . ' ' . (string) ( $profile['bio'] ?? '' );
		}
		if ( ! liderdent_search_contains( $hay, $q ) ) {
			continue;
		}
		$label = $post->post_title;
		if ( is_array( $profile ) && ! empty( $profile['specialization'] ) ) {
			$label .= ' — ' . $profile['specialization'];
		}
		$items[] = [
			'title' => $label,
			'url'   => get_permalink( $post ),
		];
		if ( count( $items ) >= 6 ) {
			break;
		}
	}

	return $items;
}

/**
 * @return array<int, array{title: string, url: string}>
 */
function liderdent_search_articles( string $q ): array {
	$blog = get_category_by_slug( 'blog' );
	if ( ! $blog || is_wp_error( $blog ) ) {
		return [];
	}

	$posts = get_posts(
		[
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 5,
			's'              => $q,
			'category'       => (int) $blog->term_id,
		]
	);

	$items = [];
	foreach ( $posts as $post ) {
		if ( ! $post instanceof WP_Post ) {
			continue;
		}
		$items[] = [
			'title' => get_the_title( $post ),
			'url'   => get_permalink( $post ),
		];
	}

	return $items;
}

/**
 * @return array<int, array{title: string, url: string}>
 */
function liderdent_search_faq( string $q ): array {
	if ( ! function_exists( 'liderdent_get_services_content' ) ) {
		return [];
	}

	$items = [];
	foreach ( liderdent_get_services_content() as $slug => $item ) {
		if ( empty( $item['faq'] ) || ! is_array( $item['faq'] ) ) {
			continue;
		}
		$url = liderdent_service_landing_url( (string) $slug );
		foreach ( $item['faq'] as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}
			$question = liderdent_search_plain( (string) ( $row['q'] ?? '' ) );
			if ( $question === '' || ! liderdent_search_contains( $question, $q ) ) {
				continue;
			}
			$items[] = [
				'title' => $question,
				'url'   => $url,
			];
			if ( count( $items ) >= 5 ) {
				return $items;
			}
		}
	}

	return $items;
}

/**
 * @return array<int, array{title: string, url: string}>
 */
function liderdent_search_pages( string $q ): array {
	$sales = function_exists( 'liderdent_get_sales_page_url' ) ? liderdent_get_sales_page_url() : home_url( '/sales/' );
	$dms   = function_exists( 'liderdent_dms_page_url' ) ? liderdent_dms_page_url() : home_url( '/dms/' );
	$pages = [
		[ 'title' => 'Цены', 'url' => home_url( '/prices/' ), 'keys' => 'цены прайс стоимость сколько стоит' ],
		[ 'title' => 'Акции', 'url' => $sales, 'keys' => 'акции скидка акция спецпредложение' ],
		[ 'title' => 'Врачи', 'url' => home_url( '/doctors/' ), 'keys' => 'врачи специалисты доктора' ],
		[ 'title' => 'О клинике', 'url' => home_url( '/about/' ), 'keys' => 'о нас о клинике' ],
		[ 'title' => 'Контакты', 'url' => home_url( '/contacts/' ), 'keys' => 'контакты адрес телефон мужества' ],
		[ 'title' => 'Лечение по ДМС', 'url' => $dms, 'keys' => 'дмс полис страховка согаз ингосстрах' ],
		[ 'title' => 'Услуги', 'url' => home_url( '/service/' ), 'keys' => 'услуги направления' ],
		[ 'title' => 'Статьи', 'url' => home_url( '/category/blog/' ), 'keys' => 'статьи блог' ],
	];

	$items = [];
	foreach ( $pages as $page ) {
		if ( liderdent_search_contains( $page['title'] . ' ' . $page['keys'], $q ) ) {
			$items[] = [
				'title' => $page['title'],
				'url'   => $page['url'],
			];
		}
	}

	return $items;
}

function liderdent_render_search_groups( array $groups ): void {
	$order = [ 'services', 'prices', 'promotions', 'doctors', 'articles', 'faq', 'pages' ];
	$any   = false;
	foreach ( $order as $key ) {
		$group = $groups[ $key ] ?? null;
		if ( ! is_array( $group ) || empty( $group['items'] ) ) {
			continue;
		}
		$any = true;
		echo '<section class="ld-search-group">';
		echo '<h2 class="ld-search-group__title">' . esc_html( (string) ( $group['label'] ?? '' ) ) . '</h2>';
		echo '<ul class="ld-search-group__list">';
		foreach ( $group['items'] as $item ) {
			if ( ! is_array( $item ) || empty( $item['url'] ) ) {
				continue;
			}
			echo '<li><a class="ld-search-group__link" href="' . esc_url( (string) $item['url'] ) . '">' . esc_html( (string) ( $item['title'] ?? '' ) ) . '</a></li>';
		}
		echo '</ul></section>';
	}
	if ( ! $any ) {
		echo '<p class="ld-search-page__empty">Ничего не найдено. Попробуйте другой запрос.</p>';
	}
}

add_action( 'wp_ajax_liderdent_site_search', 'liderdent_handle_site_search' );
add_action( 'wp_ajax_nopriv_liderdent_site_search', 'liderdent_handle_site_search' );
function liderdent_handle_site_search(): void {
	$q = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
	wp_send_json_success( liderdent_site_search_results( $q ) );
}

add_action(
	'wp_footer',
	static function () {
		get_template_part( 'template-parts/search-overlay' );
	},
	6
);
