<?php
/**
 * One-time post slug migrations + permanent 301 redirects for old specialist URLs.
 */

function liderdent_specialist_slug_redirects(): array {
	return [
		'malikov-aleksej-georgievich' => 'asryan-mariam-araratovna',
		'safaryan-mariam-araratovna'  => 'asryan-mariam-araratovna',
		'karpova-elena-mihajlovna'    => 'voytova-polina-nikolaevna',
		'mironova-olga-viktorovna'    => 'markova-kristina-pavlovna',
	];
}

function liderdent_specialist_title_updates(): array {
	return [
		'safaryan-mariam-araratovna' => 'Асрян Мариам Араратовна',
	];
}

/**
 * Rename specialist posts once (option flag), then keep redirects forever.
 * Bump option key when adding new pairs so migration re-runs for new rows only.
 */
function liderdent_run_specialist_slug_migrations(): void {
	if ( get_option( 'liderdent_specialist_slug_migrations_v4' ) ) {
		return;
	}

	$did_change = false;
	$title_updates = liderdent_specialist_title_updates();

	foreach ( liderdent_specialist_slug_redirects() as $old_slug => $new_slug ) {
		$existing_new = get_posts(
			[
				'name'           => $new_slug,
				'post_type'      => 'specialist',
				'post_status'    => 'any',
				'posts_per_page' => 1,
				'fields'         => 'ids',
			]
		);
		if ( $existing_new ) {
			continue;
		}

		$old_posts = get_posts(
			[
				'name'           => $old_slug,
				'post_type'      => 'specialist',
				'post_status'    => 'any',
				'posts_per_page' => 1,
			]
		);
		if ( ! $old_posts ) {
			continue;
		}

		$update = [
			'ID'        => (int) $old_posts[0]->ID,
			'post_name' => $new_slug,
		];
		if ( ! empty( $title_updates[ $old_slug ] ) ) {
			$update['post_title'] = $title_updates[ $old_slug ];
		}

		$result = wp_update_post( $update, true );

		if ( ! is_wp_error( $result ) ) {
			$did_change = true;
		}
	}

	update_option( 'liderdent_specialist_slug_migrations_v4', 1, false );

	if ( $did_change ) {
		flush_rewrite_rules( false );
		if ( function_exists( 'wp_cache_flush' ) ) {
			wp_cache_flush();
		}
	}
}
add_action( 'init', 'liderdent_run_specialist_slug_migrations', 20 );

/**
 * 301 from old specialist slugs after migration.
 */
function liderdent_redirect_old_specialist_slugs(): void {
	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
		return;
	}

	$path = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
	$path = (string) parse_url( $path, PHP_URL_PATH );
	$path = trim( $path, '/' );

	if ( ! preg_match( '#^specialist/([^/]+)/?$#', $path, $matches ) ) {
		return;
	}

	$slug      = $matches[1];
	$redirects = liderdent_specialist_slug_redirects();
	if ( empty( $redirects[ $slug ] ) ) {
		return;
	}

	$target = home_url( '/specialist/' . $redirects[ $slug ] . '/' );
	wp_safe_redirect( $target, 301 );
	exit;
}
add_action( 'template_redirect', 'liderdent_redirect_old_specialist_slugs', 1 );
