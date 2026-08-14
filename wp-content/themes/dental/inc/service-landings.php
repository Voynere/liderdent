<?php
/**
 * Virtual service landings: /services/{slug}/
 * Pattern adapted from MRT Lider (page-service-landing + PHP registry).
 */

function liderdent_service_landing_slugs(): array {
	return array_keys( liderdent_get_services_content() );
}

function liderdent_service_landing_url( string $slug ): string {
	return home_url( '/services/' . sanitize_title( $slug ) . '/' );
}

function liderdent_register_service_landing_rewrites(): void {
	add_rewrite_rule(
		'^services/([^/]+)/?$',
		'index.php?liderdent_service_landing=$matches[1]',
		'top'
	);
}
add_action( 'init', 'liderdent_register_service_landing_rewrites', 5 );

function liderdent_service_landing_query_vars( array $vars ): array {
	$vars[] = 'liderdent_service_landing';
	return $vars;
}
add_filter( 'query_vars', 'liderdent_service_landing_query_vars' );

/**
 * Flush rewrites once after deploy.
 */
function liderdent_maybe_flush_service_landing_rewrites(): void {
	if ( get_option( 'liderdent_service_landing_rewrites_v1' ) ) {
		return;
	}
	liderdent_register_service_landing_rewrites();
	flush_rewrite_rules( false );
	update_option( 'liderdent_service_landing_rewrites_v1', 1, false );
}
add_action( 'init', 'liderdent_maybe_flush_service_landing_rewrites', 99 );

/**
 * Route virtual landing + 301 from /category/services/{slug}/.
 */
function liderdent_route_service_landings(): void {
	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
		return;
	}

	$path = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
	$path = (string) parse_url( $path, PHP_URL_PATH );
	$path = trim( $path, '/' );

	// 301 old category URLs → landings
	if ( preg_match( '#^category/services/([^/]+)/?$#', $path, $m ) ) {
		$slug = $m[1];
		if ( in_array( $slug, liderdent_service_landing_slugs(), true ) ) {
			wp_safe_redirect( liderdent_service_landing_url( $slug ), 301 );
			exit;
		}
	}

	$slug = get_query_var( 'liderdent_service_landing' );
	if ( ! $slug ) {
		// Fallback if rewrite not flushed yet
		if ( preg_match( '#^services/([^/]+)/?$#', $path, $m ) ) {
			$slug = $m[1];
		}
	}
	if ( ! $slug ) {
		return;
	}

	$slug = sanitize_title( (string) $slug );
	$item = liderdent_get_service_content( $slug );
	if ( ! $item ) {
		status_header( 404 );
		nocache_headers();
		include get_query_template( '404' );
		exit;
	}

	status_header( 200 );
	$GLOBALS['liderdent_current_service_landing'] = $slug;
	include get_template_directory() . '/page-service-landing.php';
	exit;
}
add_action( 'template_redirect', 'liderdent_route_service_landings', 2 );

function liderdent_current_service_landing_slug(): string {
	return (string) ( $GLOBALS['liderdent_current_service_landing'] ?? '' );
}

/**
 * Featured price rows shown on every service landing.
 *
 * @return array<int, array{title:string,price:string,discount:string,url:string,slug:string}>
 */
function liderdent_featured_service_price_rows(): array {
	$rows = [];
	foreach ( liderdent_get_services_content() as $slug => $item ) {
		if ( empty( $item['featured_price'] ) ) {
			continue;
		}
		$price = (string) ( $item['price_label'] ?? '' );
		if ( $price === '' && ! empty( $item['price_from'] ) ) {
			$price = preg_replace( '/[^\d]/u', '', (string) $item['price_from'] ) ?: '';
			if ( $price !== '' && preg_match( '/от/ui', (string) $item['price_from'] ) ) {
				$price = 'от ' . $price;
			}
		}
		$rows[] = [
			'slug'     => $slug,
			'title'    => (string) ( $item['price_title'] ?? $item['nav_title'] ?? $item['h1'] ?? $slug ),
			'price'    => $price,
			'discount' => '',
			'url'      => liderdent_service_landing_url( $slug ),
		];
	}
	return $rows;
}

/**
 * Normalize title for price-row dedupe.
 */
function liderdent_price_title_key( string $title ): string {
	$title = mb_strtolower( trim( $title ) );
	$title = preg_replace( '/\s+/u', ' ', $title ) ?? $title;
	return rtrim( $title, " \t\n\r\0\x0B)" );
}

/**
 * Price rows for landing: featured offers + category posts (deduped).
 *
 * @return array<int, array{title:string,price:string,discount:string,url?:string,slug?:string}>
 */
function liderdent_service_landing_price_rows( string $slug ): array {
	$featured = liderdent_featured_service_price_rows();
	$seen     = [];
	foreach ( $featured as $row ) {
		$seen[ liderdent_price_title_key( $row['title'] ) ] = true;
	}

	// Resolve WP category: offer landings use parent slug.
	$svc      = liderdent_get_service_content( $slug );
	$cat_slug = $slug;
	if ( $svc && ! empty( $svc['parent'] ) ) {
		$cat_slug = (string) $svc['parent'];
	}

	$term = get_term_by( 'slug', $cat_slug, 'category' );
	if ( ! $term || is_wp_error( $term ) ) {
		return $featured;
	}

	$q = new WP_Query(
		[
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'cat'            => (int) $term->term_id,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
		]
	);

	$extra = [];
	while ( $q->have_posts() ) {
		$q->the_post();
		$title = get_the_title();
		$key   = liderdent_price_title_key( $title );
		if ( isset( $seen[ $key ] ) ) {
			continue;
		}
		$skip = false;
		foreach ( $featured as $f ) {
			$ft = liderdent_price_title_key( $f['title'] );
			if ( $ft !== '' && ( str_contains( $key, $ft ) || str_contains( $ft, $key ) ) ) {
				$skip = true;
				break;
			}
		}
		if ( $skip ) {
			continue;
		}
		$price = function_exists( 'get_field' ) ? (string) get_field( 'service_price' ) : '';
		$disc  = function_exists( 'get_field' ) ? (string) get_field( 'service_discount' ) : '';
		$extra[] = [
			'title'    => $title,
			'price'    => $price,
			'discount' => $disc,
			'url'      => '',
		];
		$seen[ $key ] = true;
	}
	wp_reset_postdata();

	return array_merge( $featured, $extra );
}

/**
 * Related landings (parent/siblings for offers; main nav services otherwise).
 *
 * @return array<int, array{slug:string,title:string,url:string}>
 */
function liderdent_service_landing_related( string $slug, int $limit = 4 ): array {
	$map  = liderdent_get_services_content();
	$svc  = $map[ $slug ] ?? null;
	$out  = [];
	$seen = [];

	$push = static function ( string $s ) use ( &$out, &$seen, $map, $limit, $slug ): void {
		if ( $s === $slug || isset( $seen[ $s ] ) || ! isset( $map[ $s ] ) || count( $out ) >= $limit ) {
			return;
		}
		$item = $map[ $s ];
		$out[] = [
			'slug'  => $s,
			'title' => (string) ( $item['nav_title'] ?? $item['h1'] ?? $s ),
			'url'   => liderdent_service_landing_url( $s ),
		];
		$seen[ $s ] = true;
	};

	$parent = is_array( $svc ) ? (string) ( $svc['parent'] ?? '' ) : '';
	if ( $parent ) {
		$push( $parent );
		foreach ( $map as $s => $item ) {
			if ( (string) ( $item['parent'] ?? '' ) === $parent ) {
				$push( $s );
			}
		}
	}

	foreach ( $map as $s => $item ) {
		if ( array_key_exists( 'in_nav', $item ) && $item['in_nav'] === false ) {
			continue;
		}
		$push( $s );
	}

	return $out;
}
