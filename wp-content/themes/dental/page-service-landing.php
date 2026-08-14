<?php
/**
 * Virtual template: /services/{slug}/
 * Included from liderdent_route_service_landings().
 */
$slug = liderdent_current_service_landing_slug();
$svc  = liderdent_get_service_content( $slug );
if ( ! $svc ) {
	status_header( 404 );
	include get_query_template( '404' );
	return;
}

$h1         = (string) ( $svc['h1'] ?? $svc['nav_title'] ?? $slug );
$price_from = (string) ( $svc['price_from'] ?? '' );
$badge      = (string) ( $svc['badge'] ?? '' );
$intro      = (string) ( $svc['intro'] ?? '' );
$img        = liderdent_service_image_url( $slug );
$steps      = is_array( $svc['steps'] ?? null ) ? $svc['steps'] : [];
$indications = is_array( $svc['indications'] ?? null ) ? $svc['indications'] : [];
$faq        = is_array( $svc['faq'] ?? null ) ? $svc['faq'] : [];
$what_is    = (string) ( $svc['what_is'] ?? '' );
$prep       = (string) ( $svc['preparation'] ?? '' );
$prices     = liderdent_service_landing_price_rows( $slug );
$related    = liderdent_service_landing_related( $slug, 4 );
$phone_disp = '+7 (391) 234 09 09';
$phone_href = 'tel:+73912340909';

get_header();
?>

<main class="main svc-landing">
	<div class="container">
		<nav class="svc-landing__crumbs" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span aria-hidden="true">|</span>
			<a href="<?php echo esc_url( home_url( '/service/' ) ); ?>">Услуги</a>
			<span aria-hidden="true">|</span>
			<span><?php echo esc_html( $svc['nav_title'] ?? $h1 ); ?></span>
		</nav>

		<section class="svc-landing__hero">
			<div class="svc-landing__hero-text">
				<?php if ( $badge ) : ?>
					<span class="svc-landing__badge"><?php echo esc_html( $badge ); ?></span>
				<?php endif; ?>
				<h1 class="svc-landing__h1"><?php echo esc_html( $h1 ); ?></h1>
				<?php if ( $price_from ) : ?>
					<p class="svc-landing__price"><?php echo esc_html( $price_from ); ?></p>
				<?php endif; ?>
				<?php if ( $intro ) : ?>
					<p class="svc-landing__intro"><?php echo esc_html( $intro ); ?></p>
				<?php endif; ?>
				<div class="svc-landing__cta">
					<button type="button" class="svc-landing__btn open-popup-callback">
						Записаться на приём
						<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="currentColor"/>
						</svg>
					</button>
					<a class="svc-landing__phone" href="<?php echo esc_url( $phone_href ); ?>"><?php echo esc_html( $phone_disp ); ?></a>
				</div>
			</div>
			<?php if ( $img ) : ?>
				<div class="svc-landing__hero-media">
					<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $h1 ); ?>" loading="eager" decoding="async">
				</div>
			<?php endif; ?>
		</section>

		<?php if ( $steps ) : ?>
			<section class="svc-landing__steps" aria-labelledby="svc-steps-title">
				<h2 id="svc-steps-title" class="svc-landing__h2">Как проходит лечение</h2>
				<ol class="svc-landing__steps-list">
					<?php foreach ( $steps as $i => $step ) : ?>
						<li>
							<span class="svc-landing__step-num"><?php echo (int) $i + 1; ?></span>
							<div>
								<strong><?php echo esc_html( (string) ( $step['title'] ?? '' ) ); ?></strong>
								<p><?php echo esc_html( (string) ( $step['text'] ?? '' ) ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</section>
		<?php endif; ?>

		<section class="svc-landing__grid">
			<?php if ( $what_is ) : ?>
				<article>
					<h2 class="svc-landing__h2">Что это такое</h2>
					<p><?php echo esc_html( $what_is ); ?></p>
				</article>
			<?php endif; ?>
			<?php if ( $indications ) : ?>
				<article>
					<h2 class="svc-landing__h2">Показания</h2>
					<ul class="svc-landing__list">
						<?php foreach ( $indications as $row ) : ?>
							<li><?php echo esc_html( (string) $row ); ?></li>
						<?php endforeach; ?>
					</ul>
				</article>
			<?php endif; ?>
			<?php if ( $prep ) : ?>
				<article>
					<h2 class="svc-landing__h2">Подготовка</h2>
					<p><?php echo esc_html( $prep ); ?></p>
				</article>
			<?php endif; ?>
		</section>

		<?php if ( $prices ) : ?>
			<section class="svc-landing__prices" aria-labelledby="svc-prices-title">
				<h2 id="svc-prices-title" class="svc-landing__h2">Цены на услуги</h2>
				<div class="page-price__content svc-landing__price-table">
					<div class="page-price__line head">
						<p class="page-price__line-item bold">Услуга</p>
						<p class="page-price__line-item bold mobile-end">Стоимость</p>
						<p class="page-price__line-item"></p>
					</div>
					<?php foreach ( $prices as $row ) : ?>
						<div class="page-price__line">
							<p class="page-price__line-item form-service-title"><?php echo esc_html( $row['title'] ); ?></p>
							<p class="page-price__line-item mobile-end">
								<?php echo esc_html( $row['price'] !== '' ? $row['price'] . ' руб.' : 'по запросу' ); ?>
							</p>
							<button type="button" class="page-price__line-button btn-gold open-popup-service" data-popup-target="#popup-service" data-service-title="<?php echo esc_attr( $row['title'] ); ?>">
								<span class="pc">Записаться</span>
								<span class="mob">Запись</span>
							</button>
						</div>
					<?php endforeach; ?>
				</div>
				<p class="svc-landing__prices-note">
					<a href="<?php echo esc_url( home_url( '/prices/' ) ); ?>">Смотреть полный прайс</a>
				</p>
			</section>
		<?php endif; ?>

		<?php if ( $faq ) : ?>
			<section class="svc-landing__faq category-faq" aria-labelledby="svc-faq-title">
				<h2 id="svc-faq-title" class="category-faq__title">Частые вопросы</h2>
				<div class="category-faq__list">
					<?php foreach ( $faq as $item ) : ?>
						<details class="category-faq__item">
							<summary class="category-faq__question"><?php echo esc_html( (string) ( $item['q'] ?? '' ) ); ?></summary>
							<p class="category-faq__answer"><?php echo esc_html( (string) ( $item['a'] ?? '' ) ); ?></p>
						</details>
					<?php endforeach; ?>
				</div>
			</section>
			<script type="application/ld+json">
			<?php
			$faq_ld = [
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => array_map(
					static function ( $item ) {
						return [
							'@type'          => 'Question',
							'name'           => (string) ( $item['q'] ?? '' ),
							'acceptedAnswer' => [
								'@type' => 'Answer',
								'text'  => (string) ( $item['a'] ?? '' ),
							],
						];
					},
					$faq
				),
			];
			echo wp_json_encode( $faq_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
			?>
			</script>
		<?php endif; ?>

		<?php if ( $related ) : ?>
			<section class="svc-landing__related" aria-labelledby="svc-related-title">
				<h2 id="svc-related-title" class="svc-landing__h2">Другие услуги</h2>
				<div class="svc-landing__related-grid">
					<?php foreach ( $related as $rel ) : ?>
						<a class="svc-landing__related-card" href="<?php echo esc_url( $rel['url'] ); ?>">
							<?php echo esc_html( $rel['title'] ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="svc-landing__banner">
			<div>
				<h2 class="svc-landing__h2">Запишитесь на консультацию</h2>
				<p>Подберём план лечения и озвучим смету до начала работ.</p>
			</div>
			<button type="button" class="svc-landing__btn svc-landing__btn--light open-popup-callback">
				Заказать звонок
				<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="currentColor"/>
				</svg>
			</button>
		</section>
	</div>

	<script type="application/ld+json">
	<?php
	$service_ld = [
		'@context'    => 'https://schema.org',
		'@type'       => 'MedicalProcedure',
		'name'        => $h1,
		'description' => (string) ( $svc['seo_description'] ?? $intro ),
		'url'         => liderdent_service_landing_url( $slug ),
		'provider'    => [
			'@type' => 'Dentist',
			'name'  => 'Стоматология ЛидерДент',
			'url'   => home_url( '/' ),
		],
	];
	if ( $price_from ) {
		$service_ld['offers'] = [
			'@type'         => 'Offer',
			'priceCurrency' => 'RUB',
			'description'   => $price_from,
			'availability'  => 'https://schema.org/InStock',
		];
	}
	echo wp_json_encode( $service_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
	?>
	</script>
</main>

<?php
get_footer();
