<?php
/**
 * DMS page: insurers, URL, one-time WP page seed.
 */

function liderdent_dms_page_url(): string {
	$page = get_page_by_path( 'dms' );
	return $page ? get_permalink( $page ) : home_url( '/dms/' );
}

/**
 * Confirmed DMS partners only — do not invent others.
 *
 * @return array<int, array{slug:string,name:string,file:string,alt:string}>
 */
function liderdent_dms_insurers(): array {
	return [
		[
			'slug' => 'sogaz',
			'name' => 'СОГАЗ',
			'file' => 'sogaz.png',
			'alt'  => 'Логотип страховой компании СОГАЗ',
		],
		[
			'slug' => 'yugoria',
			'name' => 'Югория страхование',
			'file' => 'yugoria.png',
			'alt'  => 'Логотип страховой компании Югория страхование',
		],
		[
			'slug' => 'sberhealth',
			'name' => 'Сберздоровье',
			'file' => 'sberhealth.svg',
			'alt'  => 'Логотип сервиса Сберздоровье',
		],
	];
}

function liderdent_dms_insurer_image_url( string $file ): string {
	return get_template_directory_uri() . '/assets/img/dms/' . ltrim( $file, '/' );
}

/**
 * Create published /dms/ page so permalinks, AIOSEO sitemap and breadcrumbs work from git.
 */
function liderdent_ensure_dms_page(): void {
	if ( get_option( 'liderdent_dms_page_v1' ) ) {
		return;
	}
	if ( ! function_exists( 'wp_insert_post' ) ) {
		return;
	}

	$existing = get_page_by_path( 'dms' );
	if ( ! $existing ) {
		$id = wp_insert_post(
			[
				'post_title'   => 'ДМС',
				'post_name'    => 'dms',
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
				'post_author'  => 1,
			],
			true
		);
		if ( is_wp_error( $id ) || ! $id ) {
			return;
		}
	}

	update_option( 'liderdent_dms_page_v1', 1, false );
	if ( function_exists( 'wp_cache_flush' ) ) {
		wp_cache_flush();
	}
}
add_action( 'init', 'liderdent_ensure_dms_page', 43 );
