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
 * Price rows for landing (posts in matching category).
 *
 * @return array<int, array{title:string,price:string,discount:string}>
 */
function liderdent_service_landing_price_rows( string $slug ): array {
	$term = get_term_by( 'slug', $slug, 'category' );
	if ( ! $term || is_wp_error( $term ) ) {
		return [];
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

	$rows = [];
	while ( $q->have_posts() ) {
		$q->the_post();
		$price = function_exists( 'get_field' ) ? (string) get_field( 'service_price' ) : '';
		$disc  = function_exists( 'get_field' ) ? (string) get_field( 'service_discount' ) : '';
		$rows[] = [
			'title'    => get_the_title(),
			'price'    => $price,
			'discount' => $disc,
		];
	}
	wp_reset_postdata();
	return $rows;
}

/**
 * Related landings (other service slugs).
 *
 * @return array<int, array{slug:string,title:string,url:string}>
 */
function liderdent_service_landing_related( string $slug, int $limit = 4 ): array {
	$out = [];
	foreach ( liderdent_get_services_content() as $s => $item ) {
		if ( $s === $slug ) {
			continue;
		}
		$out[] = [
			'slug'  => $s,
			'title' => (string) ( $item['nav_title'] ?? $item['h1'] ?? $s ),
			'url'   => liderdent_service_landing_url( $s ),
		];
		if ( count( $out ) >= $limit ) {
			break;
		}
	}
	return $out;
}
