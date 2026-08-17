<?php
/**
 * Lead forms: markup helpers, page context for Metrika ecommerce.
 */

function liderdent_current_page_path(): string {
	$path = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
	$path = (string) parse_url( $path, PHP_URL_PATH );
	return $path !== '' ? $path : '/';
}

function liderdent_current_lead_service(): string {
	if ( function_exists( 'liderdent_current_service_landing_slug' ) ) {
		$slug = liderdent_current_service_landing_slug();
		if ( $slug && function_exists( 'liderdent_get_service_content' ) ) {
			$svc = liderdent_get_service_content( $slug );
			if ( $svc ) {
				return (string) ( $svc['nav_title'] ?? $svc['h1'] ?? $slug );
			}
		}
	}
	return '';
}

function liderdent_current_lead_price(): string {
	if ( ! function_exists( 'liderdent_current_service_landing_slug' ) || ! function_exists( 'liderdent_get_service_content' ) ) {
		return '';
	}
	$slug = liderdent_current_service_landing_slug();
	if ( ! $slug ) {
		return '';
	}
	$svc = liderdent_get_service_content( $slug );
	if ( ! $svc ) {
		return '';
	}
	$raw = (string) ( $svc['price_from'] ?? $svc['price_label'] ?? '' );
	if ( preg_match( '/(\d[\d\s]{2,})/', $raw, $m ) ) {
		return (string) (int) preg_replace( '/\D+/', '', $m[1] );
	}
	return '';
}

/**
 * Prints attributes for a lead <form>.
 *
 * @param array{id:string,class?:string,type:string,source:string,service?:string,price?:string} $args
 */
function liderdent_lead_form_atts( array $args ): void {
	$id      = (string) ( $args['id'] ?? '' );
	$class   = (string) ( $args['class'] ?? '' );
	$type    = (string) ( $args['type'] ?? 'callback' );
	$source  = (string) ( $args['source'] ?? $id );
	$service = (string) ( $args['service'] ?? liderdent_current_lead_service() );
	$price   = (string) ( $args['price'] ?? liderdent_current_lead_price() );
	$page    = liderdent_current_page_path();

	printf(
		'id="%s" name="%s" method="post" action="%s" class="%s" data-lead-form="1" data-form-id="%s" data-form-type="%s" data-form-source="%s" data-page="%s" data-service="%s" data-price="%s"',
		esc_attr( $id ),
		esc_attr( $id ),
		esc_url( admin_url( 'admin-ajax.php' ) ),
		esc_attr( $class ),
		esc_attr( $id ),
		esc_attr( $type ),
		esc_attr( $source ),
		esc_attr( $page ),
		esc_attr( $service ),
		esc_attr( $price )
	);
}

/**
 * Hidden fields shared by popup and inline request forms.
 *
 * @param array{type:string,form_id:string,source:string,service?:string} $args
 */
function liderdent_lead_hidden_fields( array $args ): void {
	$type    = (string) ( $args['type'] ?? 'callback' );
	$form_id = (string) ( $args['form_id'] ?? '' );
	$source  = (string) ( $args['source'] ?? $form_id );
	$service = (string) ( $args['service'] ?? liderdent_current_lead_service() );
	$page    = liderdent_current_page_path();
	?>
	<input type="hidden" name="type" value="<?php echo esc_attr( $type ); ?>">
	<input type="hidden" name="form_id" value="<?php echo esc_attr( $form_id ); ?>">
	<input type="hidden" name="form_source" value="<?php echo esc_attr( $source ); ?>">
	<input type="hidden" name="page" value="<?php echo esc_attr( $page ); ?>">
	<input type="hidden" name="service_title" value="<?php echo esc_attr( $service ); ?>">
	<?php
}

function liderdent_nap_email(): string {
	$nap = function_exists( 'liderdent_seo_clinic_nap' ) ? liderdent_seo_clinic_nap() : [];
	return (string) ( $nap['email'] ?? 'aliderdent@mail.ru' );
}

function liderdent_nap_hours_human(): string {
	return '09:00 — 21:00';
}

function liderdent_nap_address_line(): string {
	$nap = function_exists( 'liderdent_seo_clinic_nap' ) ? liderdent_seo_clinic_nap() : [];
	$city   = (string) ( $nap['city'] ?? 'Красноярск' );
	$street = (string) ( $nap['street'] ?? 'ул. Мужества, 4' );
	return 'г. ' . $city . ', ' . $street;
}
