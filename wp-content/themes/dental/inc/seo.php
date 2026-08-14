<?php
/**
 * SEO: titles, descriptions, OG, LocalBusiness, redirects, robots cleanup.
 */

function liderdent_seo_og_image_url(): string {
	return get_template_directory_uri() . '/assets/img/fondesctop.jpg';
}

function liderdent_seo_clinic_nap(): array {
	return [
		'name'      => 'Стоматология ЛидерДент',
		'phone'     => [ '+7-391-227-13-43', '+7-391-234-09-09' ],
		'email'     => 'aliderdent@mail.ru',
		'street'    => 'ул. Мужества, 4',
		'city'      => 'Красноярск',
		'region'    => 'Красноярский край',
		'postal'   => '660118',
		'country'   => 'RU',
		'url'       => home_url( '/' ),
		'lat'       => 56.034124,
		'lng'       => 92.886726,
		'hours'     => 'Mo-Su 09:00-21:00',
		'priceRange'=> '₽₽',
	];
}

/**
 * Page-level SEO overrides keyed by context.
 *
 * @return array{title?:string,description?:string}|null
 */
function liderdent_seo_page_meta(): ?array {
	if ( is_front_page() ) {
		return [
			'title'       => 'Стоматология в Красноярске — лечение зубов, имплантация, ортодонтия | ЛидерДент',
			'description' => 'ЛидерДент — стоматология в Красноярске: лечение кариеса и каналов, имплантация, протезирование, брекеты и элайнеры, профессиональная гигиена. Современное оборудование, опытные врачи, запись онлайн и по телефону.',
		];
	}

	if ( is_page( 'sales' ) || is_page_template( 'page-promotion.php' ) ) {
		return [
			'title'       => 'Акции стоматологии «ЛидерДент» в Красноярске — скидки на имплантацию и брекеты',
			'description' => 'Актуальные акции клиники ЛидерДент в Красноярске: имплантация от 35 000 ₽, брекеты «под ключ», выгодные спецпредложения. Условия, сроки и запись на приём.',
		];
	}

	if ( is_page( 'doctors' ) || is_page_template( 'page-doctors.php' ) ) {
		return [
			'title'       => 'Врачи стоматологии «ЛидерДент» в Красноярске — стоматологи, ортодонт, хирург',
			'description' => 'Специалисты «ЛидерДент» в Красноярске: терапевты, ортопеды, хирурги-имплантологи, ортодонт, детский стоматолог. Опыт, квалификация, направления лечения и запись на приём.',
		];
	}

	if ( is_page( 'service' ) || is_page_template( 'page-service.php' ) ) {
		return [
			'title'       => 'Услуги стоматологии в Красноярске — лечение, имплантация, протезирование | ЛидерДент',
			'description' => 'Все услуги «ЛидерДент» в Красноярске: лечение кариеса и каналов, удаление зубов, имплантация, протезирование, ортодонтия (брекеты/элайнеры), гигиена и отбеливание. Консультация и запись на приём.',
		];
	}

	if ( is_page( 'prices' ) || is_page_template( 'page-prices.php' ) ) {
		return [
			'title'       => 'Цены на услуги стоматологии в Красноярске — прайс‑лист | «ЛидерДент»',
			'description' => 'Актуальные цены «ЛидерДент» в Красноярске: лечение зубов и каналов, имплантация, протезирование, ортодонтия, гигиена и отбеливание. Прозрачный прайс‑лист, стоимость консультации, запись на приём.',
		];
	}

	if ( is_category( 'implantaciya' ) ) {
		return [
			'title'       => 'Имплантация зубов в Красноярске — цены от 35 000 ₽ | ЛидерДент',
			'description' => 'Имплантация зубов в Красноярске в клинике ЛидерДент: Osstem и Inno от 35 000 ₽, диагностика, персональный куратор, рассрочка. Запись на консультацию имплантолога.',
		];
	}

	if ( is_category( 'blog' ) ) {
		return [
			'title'       => 'Блог стоматологии «ЛидерДент» — статьи о лечении и имплантации',
			'description' => 'Полезные статьи клиники ЛидерДент в Красноярске: имплантация, гигиена, брекеты и элайнеры, уход за зубами. Советы врачей и ответы на частые вопросы.',
		];
	}

	if ( is_singular( 'specialist' ) ) {
		$name = get_the_title();
		$spec = function_exists( 'get_field' ) ? (string) get_field( 'doctor_spec' ) : '';
		$spec = $spec !== '' ? $spec : 'стоматолог';
		return [
			'title'       => $name . ' — ' . $spec . ' в Красноярске | ЛидерДент',
			'description' => $name . ' — ' . $spec . ' клиники ЛидерДент в Красноярске. Опыт, направления лечения, запись на приём онлайн и по телефону.',
		];
	}

	return null;
}

function liderdent_seo_apply_title( string $title ): string {
	$meta = liderdent_seo_page_meta();
	return ( $meta && ! empty( $meta['title'] ) ) ? $meta['title'] : $title;
}

add_filter( 'pre_get_document_title', function ( $title ) {
	$meta = liderdent_seo_page_meta();
	return ( $meta && ! empty( $meta['title'] ) ) ? $meta['title'] : $title;
}, 20 );

add_filter( 'aioseo_title', 'liderdent_seo_apply_title', 20 );
add_filter( 'aioseo_description', function ( $description ) {
	$meta = liderdent_seo_page_meta();
	return ( $meta && ! empty( $meta['description'] ) ) ? $meta['description'] : $description;
}, 20 );

/**
 * Fallback meta description when AIOSEO did not print one.
 */
add_action( 'wp_head', function () {
	$meta = liderdent_seo_page_meta();
	if ( ! $meta || empty( $meta['description'] ) ) {
		return;
	}
	if ( defined( 'AIOSEO_VERSION' ) ) {
		return;
	}
	echo '<meta name="description" content="' . esc_attr( $meta['description'] ) . '" />' . "\n";
}, 1 );

/**
 * Ensure Open Graph / Twitter image.
 */
function liderdent_seo_ensure_social_image( array $tags ): array {
	$image = liderdent_seo_og_image_url();
	$keys  = [ 'og:image', 'og:image:secure_url', 'twitter:image' ];
	foreach ( $keys as $key ) {
		if ( empty( $tags[ $key ] ) ) {
			$tags[ $key ] = $image;
		}
	}
	if ( empty( $tags['og:image:width'] ) ) {
		$tags['og:image:width'] = '1920';
	}
	if ( empty( $tags['og:image:height'] ) ) {
		$tags['og:image:height'] = '1080';
	}
	return $tags;
}

add_filter( 'aioseo_facebook_tags', 'liderdent_seo_ensure_social_image', 20 );
add_filter( 'aioseo_twitter_tags', 'liderdent_seo_ensure_social_image', 20 );

add_action( 'wp_head', function () {
	$image = liderdent_seo_og_image_url();
	$meta  = liderdent_seo_page_meta();
	echo '<meta property="og:image" content="' . esc_url( $image ) . '" />' . "\n";
	echo '<meta name="twitter:image" content="' . esc_url( $image ) . '" />' . "\n";

	// Categories / CPT often miss OG in AIOSEO — fill title/desc/url.
	if ( is_category() || is_singular( 'specialist' ) ) {
		if ( $meta && ! empty( $meta['title'] ) ) {
			echo '<meta property="og:title" content="' . esc_attr( $meta['title'] ) . '" />' . "\n";
		}
		if ( $meta && ! empty( $meta['description'] ) ) {
			echo '<meta property="og:description" content="' . esc_attr( $meta['description'] ) . '" />' . "\n";
		}
		echo '<meta property="og:type" content="website" />' . "\n";
		echo '<meta property="og:locale" content="ru_RU" />' . "\n";
		echo '<meta property="og:url" content="' . esc_url( liderdent_seo_current_url() ) . '" />' . "\n";
	}
}, 5 );

function liderdent_seo_current_url(): string {
	if ( is_singular() ) {
		return get_permalink() ?: home_url( '/' );
	}
	if ( is_category() || is_tag() || is_tax() ) {
		$link = get_term_link( get_queried_object() );
		return is_wp_error( $link ) ? home_url( '/' ) : $link;
	}
	$request = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
	return home_url( $request );
}

/**
 * DentalClinic / Dentist JSON-LD + FAQ on implantaciya.
 */
add_action( 'wp_head', function () {
	$nap = liderdent_seo_clinic_nap();

	$clinic = [
		'@context'    => 'https://schema.org',
		'@type'       => 'Dentist',
		'@id'         => trailingslashit( $nap['url'] ) . '#dentist',
		'name'        => $nap['name'],
		'url'         => $nap['url'],
		'image'       => liderdent_seo_og_image_url(),
		'email'       => $nap['email'],
		'telephone'   => $nap['phone'],
		'priceRange'  => $nap['priceRange'],
		'address'     => [
			'@type'           => 'PostalAddress',
			'streetAddress'   => $nap['street'],
			'addressLocality' => $nap['city'],
			'addressRegion'   => $nap['region'],
			'postalCode'    => $nap['postal'],
			'addressCountry'  => $nap['country'],
		],
		'geo'         => [
			'@type'     => 'GeoCoordinates',
			'latitude'  => $nap['lat'],
			'longitude' => $nap['lng'],
		],
		'openingHoursSpecification' => [
			[
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ],
				'opens'     => '09:00',
				'closes'    => '21:00',
			],
		],
		'areaServed'  => [
			'@type' => 'City',
			'name'  => 'Красноярск',
		],
		'sameAs'      => [
			'https://t.me/liderdent_clinic',
		],
	];

	echo '<script type="application/ld+json">' . wp_json_encode( $clinic, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";

	if ( is_category( 'implantaciya' ) ) {
		$faq = [
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => array_map(
				static function ( $item ) {
					return [
						'@type'          => 'Question',
						'name'           => $item['q'],
						'acceptedAnswer' => [
							'@type' => 'Answer',
							'text'  => $item['a'],
						],
					];
				},
				liderdent_seo_implant_faq_items()
			),
		];
		echo '<script type="application/ld+json">' . wp_json_encode( $faq, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
	}
}, 30 );

/**
 * @return array<int, array{q:string,a:string}>
 */
function liderdent_seo_implant_faq_items(): array {
	return [
		[
			'q' => 'Сколько стоит имплантация зуба в Красноярске в ЛидерДент?',
			'a' => 'Имплантация Osstem и Inno в клинике ЛидерДент — от 35 000 ₽. Итоговая стоимость зависит от диагностики, объёма работ и выбранной системы. Точную смету врач составляет на консультации.',
		],
		[
			'q' => 'Больно ли ставить имплант?',
			'a' => 'Процедура проводится под местной анестезией. Большинство пациентов отмечают комфорт во время установки и умеренный дискомфорт в первые дни после операции, который снимается рекомендованными препаратами.',
		],
		[
			'q' => 'Как долго приживается имплант?',
			'a' => 'Обычно остеоинтеграция занимает от 2 до 6 месяцев в зависимости от клинической ситуации, плотности кости и выбранного протокола. Врач контролирует заживление на плановых осмотрах.',
		],
		[
			'q' => 'Есть ли рассрочка на имплантацию?',
			'a' => 'Да, в ЛидерДент доступна рассрочка на лечение и имплантацию сроком до 24 месяцев. Условия уточняются при составлении плана лечения.',
		],
	];
}

/**
 * HTML FAQ block for implantaciya category.
 */
function liderdent_render_implant_faq(): void {
	if ( ! is_category( 'implantaciya' ) ) {
		return;
	}
	$items = liderdent_seo_implant_faq_items();
	?>
	<section class="category-faq" aria-labelledby="implant-faq-title">
		<h2 id="implant-faq-title" class="category-faq__title">Частые вопросы об имплантации</h2>
		<div class="category-faq__list">
			<?php foreach ( $items as $item ) : ?>
				<details class="category-faq__item">
					<summary class="category-faq__question"><?php echo esc_html( $item['q'] ); ?></summary>
					<p class="category-faq__answer"><?php echo esc_html( $item['a'] ); ?></p>
				</details>
			<?php endforeach; ?>
		</div>
		<p class="category-faq__cta">
			<a class="btn-gold" href="<?php echo esc_url( home_url( '/prices/' ) ); ?>">Смотреть цены</a>
			<button type="button" class="btn-gold open-popup-callback">Записаться на консультацию</button>
		</p>
	</section>
	<?php
}

/**
 * 301 /blog/ → /category/blog/
 */
add_action( 'template_redirect', function () {
	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
		return;
	}
	$path = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
	$path = (string) parse_url( $path, PHP_URL_PATH );
	$path = trim( $path, '/' );
	if ( $path === 'blog' ) {
		wp_safe_redirect( home_url( '/category/blog/' ), 301 );
		exit;
	}
}, 1 );

/**
 * Fix malformed robots.txt rule from CMS config.
 */
add_filter( 'robots_txt', function ( $output ) {
	$output = str_replace( "Disallow: /Disallow: /cgi-bin\n", "Disallow: /cgi-bin\n", (string) $output );
	$output = str_replace( 'Disallow: /Disallow: /cgi-bin', "Disallow: /cgi-bin", (string) $output );
	return $output;
}, 99 );
