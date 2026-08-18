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
	$landing_slug = '';
	if ( function_exists( 'liderdent_current_service_landing_slug' ) ) {
		$landing_slug = liderdent_current_service_landing_slug();
	}
	if ( $landing_slug === '' && get_query_var( 'liderdent_service_landing' ) ) {
		$landing_slug = sanitize_title( (string) get_query_var( 'liderdent_service_landing' ) );
	}
	if ( $landing_slug && function_exists( 'liderdent_get_service_content' ) ) {
		$svc = liderdent_get_service_content( $landing_slug );
		if ( $svc ) {
			return [
				'title'       => (string) ( $svc['seo_title'] ?? ( $svc['h1'] ?? '' ) ),
				'description' => (string) ( $svc['seo_description'] ?? '' ),
			];
		}
	}

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

	if ( is_page( 'dms' ) || is_page_template( 'page-dms.php' ) ) {
		return [
			'title'       => 'Лечение по ДМС в Красноярске — СОГАЗ, Ингосстрах, АльфаСтрахование, Сберздоровье | ЛидерДент',
			'description' => 'Стоматология ЛидерДент в Красноярске принимает по ДМС: СОГАЗ, Ингосстрах, АльфаСтрахование и Сберздоровье. Запись на приём по полису, ул. Мужества, 4.',
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

	// Categories / CPT / virtual landings often miss OG in AIOSEO — fill title/desc/url.
	$is_landing = ( function_exists( 'liderdent_current_service_landing_slug' ) && liderdent_current_service_landing_slug() )
		|| (bool) get_query_var( 'liderdent_service_landing' );
	if ( is_category() || is_singular( 'specialist' ) || $is_landing ) {
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
 * Canonical URL for personal-data policy (legal page).
 */
function liderdent_privacy_policy_url(): string {
	$page = get_page_by_path( 'pravovaya-i-yuridicheskaya-informaciya' );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/pravovaya-i-yuridicheskaya-informaciya/' );
}

/**
 * 301 /blog/ → /category/blog/
 * 301 /privacy/ → правовая страница (политика ПДн)
 * 301 /specialist/ archive → /doctors/
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
	if ( $path === 'privacy' || $path === 'privacy-policy' || $path === 'politika-konfidencialnosti' ) {
		wp_safe_redirect( liderdent_privacy_policy_url(), 301 );
		exit;
	}
	if ( $path === 'specialist' || is_post_type_archive( 'specialist' ) ) {
		wp_safe_redirect( home_url( '/doctors/' ), 301 );
		exit;
	}
}, 1 );

/**
 * Price-list SKU posts: rows in /category/services/* tables, not blog articles.
 * They have no single template/H1 and pollute the index (e.g. /478-2/).
 */
function liderdent_is_price_sku_post( $post = null ): bool {
	$post = get_post( $post );
	if ( ! $post || $post->post_type !== 'post' ) {
		return false;
	}
	if ( has_category( 'blog', $post ) ) {
		return false;
	}
	$services = get_category_by_slug( 'services' );
	if ( ! $services ) {
		return false;
	}
	foreach ( get_the_category( $post->ID ) as $cat ) {
		if ( (int) $cat->term_id === (int) $services->term_id ) {
			return true;
		}
		if ( cat_is_ancestor_of( (int) $services->term_id, (int) $cat->term_id ) ) {
			return true;
		}
	}
	return false;
}

/**
 * IDs of published price SKU posts (for AIOSEO / core sitemap exclude).
 *
 * @return int[]
 */
function liderdent_price_sku_post_ids(): array {
	static $ids = null;
	if ( is_array( $ids ) ) {
		return $ids;
	}
	$ids      = [];
	$services = get_category_by_slug( 'services' );
	if ( ! $services ) {
		return $ids;
	}
	$children = get_term_children( (int) $services->term_id, 'category' );
	if ( is_wp_error( $children ) ) {
		$children = [];
	}
	$blog = get_category_by_slug( 'blog' );
	$q    = new WP_Query(
		[
			'post_type'              => 'post',
			'post_status'            => 'publish',
			'posts_per_page'         => -1,
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'category__in'           => array_merge( [ (int) $services->term_id ], array_map( 'intval', $children ) ),
			'category__not_in'       => $blog ? [ (int) $blog->term_id ] : [],
		]
	);
	$ids = array_map( 'intval', $q->posts );
	return $ids;
}

/**
 * Featured offer slugs that already have /services/{slug}/ landings.
 *
 * @return array<string,string> post_name => landing slug
 */
function liderdent_price_sku_offer_aliases(): array {
	return [
		'ustanovka-implantata-osstem-koreya-vklyuchaya'      => 'implantaciya-osstem-inno',
		'ustanovka-implantata-dentium-yuzhnaya-koreya-v'     => 'implantat-dentium',
		'ustanovka-implantata-nobel-ssha-straumann-shvejczar' => 'implantat-nobel-straumann',
		'ustanovka-implantata-straumann-shvejczariya-vk'     => 'implantat-nobel-straumann',
		'protezirovanie-koronkoj-iz-dioksida'                 => 'koronka-dioksid-cirkoniya',
		'konsultacziya-vracha-hirurga'                       => 'konsultaciya-hirurga',
		'konsultacziya-stomatologa-hirurga'                  => 'konsultaciya-hirurga',
	];
}

function liderdent_price_sku_redirect_url( $post = null ): string {
	$post = get_post( $post );
	if ( ! $post ) {
		return home_url( '/prices/' );
	}

	$aliases = liderdent_price_sku_offer_aliases();
	$slug    = $post->post_name;
	if ( isset( $aliases[ $slug ] ) && function_exists( 'liderdent_get_service_content' ) && liderdent_get_service_content( $aliases[ $slug ] ) ) {
		return liderdent_service_landing_url( $aliases[ $slug ] );
	}

	$landings = function_exists( 'liderdent_get_services_content' ) ? liderdent_get_services_content() : [];
	$cats     = get_the_category( $post->ID );

	foreach ( $cats as $cat ) {
		if ( isset( $landings[ $cat->slug ] ) ) {
			return liderdent_service_landing_url( $cat->slug );
		}
	}
	foreach ( $cats as $cat ) {
		if ( ! $cat->parent ) {
			continue;
		}
		$parent = get_term( (int) $cat->parent, 'category' );
		if ( $parent && ! is_wp_error( $parent ) && isset( $landings[ $parent->slug ] ) ) {
			return liderdent_service_landing_url( $parent->slug );
		}
	}

	$services = get_category_by_slug( 'services' );
	foreach ( $cats as $cat ) {
		if ( ! $services || (int) $cat->term_id === (int) $services->term_id ) {
			continue;
		}
		if ( cat_is_ancestor_of( (int) $services->term_id, (int) $cat->term_id ) ) {
			$link = get_category_link( $cat );
			if ( $link && ! is_wp_error( $link ) ) {
				return $link;
			}
		}
	}

	return home_url( '/prices/' );
}

add_action(
	'template_redirect',
	static function () {
		if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
			return;
		}
		if ( ! is_singular( 'post' ) || ! liderdent_is_price_sku_post() ) {
			return;
		}
		wp_safe_redirect( liderdent_price_sku_redirect_url( get_queried_object() ), 301 );
		exit;
	},
	3
);

add_filter(
	'wp_robots',
	static function ( array $robots ): array {
		if ( liderdent_is_price_sku_post() || is_post_type_archive( 'specialist' ) ) {
			$robots['noindex']  = true;
			$robots['nofollow'] = true;
		}
		return $robots;
	},
	20
);

add_filter(
	'aioseo_robots_meta',
	static function ( $attributes ) {
		if ( ! is_array( $attributes ) ) {
			$attributes = [];
		}
		if ( liderdent_is_price_sku_post() || is_post_type_archive( 'specialist' ) ) {
			unset( $attributes['index'] );
			$attributes['noindex'] = 'noindex';
		}
		return $attributes;
	},
	20
);

add_filter(
	'aioseo_sitemap_exclude_posts',
	static function ( $ids, $type = '' ) {
		unset( $type );
		$ids = is_array( $ids ) ? $ids : [];
		foreach ( liderdent_price_sku_post_ids() as $id ) {
			$ids[] = $id;
		}
		return array_values( array_unique( array_map( 'intval', $ids ) ) );
	},
	20,
	2
);

add_filter(
	'wp_sitemaps_posts_query_args',
	static function ( array $args, string $post_type ): array {
		if ( $post_type !== 'post' ) {
			return $args;
		}
		$exclude = liderdent_price_sku_post_ids();
		if ( ! $exclude ) {
			return $args;
		}
		$args['post__not_in'] = array_merge( (array) ( $args['post__not_in'] ?? [] ), $exclude );
		return $args;
	},
	20,
	2
);

/**
 * Canonical robots.txt — AIOSEO previously emitted `Disallow: /Disallow: /cgi-bin`.
 */
function liderdent_robots_txt_body(): string {
	$sitemap = home_url( '/sitemap.xml' );
	$rss     = home_url( '/sitemap.rss' );
	return implode(
		"\n",
		[
			'User-agent: *',
			'Disallow: /wp-admin/',
			'Allow: /wp-admin/admin-ajax.php',
			'Disallow: /cgi-bin',
			'Disallow: /?',
			'Disallow: *?s=',
			'Disallow: *&s=',
			'Disallow: /search',
			'Disallow: /author/',
			'Disallow: */embed$',
			'Disallow: */xmlrpc.php',
			'Disallow: *utm*=',
			'Disallow: *openstat=',
			'',
			'Sitemap: ' . $sitemap,
			'Sitemap: ' . $rss,
			'',
		]
	);
}

function liderdent_serve_robots_txt(): void {
	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
		return;
	}
	$path = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
	$path = (string) parse_url( $path, PHP_URL_PATH );
	if ( $path !== '/robots.txt' && $path !== 'robots.txt' ) {
		return;
	}
	status_header( 200 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	echo liderdent_robots_txt_body();
	exit;
}
add_action( 'init', 'liderdent_serve_robots_txt', 0 );
add_action( 'template_redirect', 'liderdent_serve_robots_txt', 0 );

add_filter( 'robots_txt', function () {
	return liderdent_robots_txt_body();
}, 999 );

add_filter( 'aioseo_robots_txt_content', function () {
	return liderdent_robots_txt_body();
}, 999 );
