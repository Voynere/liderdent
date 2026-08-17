<?php
/**
 * Template Name: dms
 * Страница «Лечение по ДМС» — slug /dms/.
 */

get_header();

$insurers = function_exists( 'liderdent_dms_insurers' ) ? liderdent_dms_insurers() : [];
$phone    = '+7 (391) 234-09-09';
?>

<main class="main page-dms">
	<?php do_action( 'theme_breadcrumbs' ); ?>

	<section class="page-dms__section">
		<div class="container">
			<div class="page-dms__inner">
				<h1 class="page-dms__title">Лечение по ДМС</h1>
				<p class="page-dms__intro">Стоматология «ЛидерДент» в Красноярске принимает пациентов по полису добровольного медицинского страхования. Сейчас лечение можно пройти по программам четырёх компаний — список ниже. Перед визитом уточните у страховщика, какие услуги входят в ваш полис.</p>

				<ul class="page-dms__grid">
					<?php foreach ( $insurers as $insurer ) : ?>
						<li class="page-dms__card">
							<img
								class="page-dms__logo"
								src="<?php echo esc_url( liderdent_dms_insurer_image_url( $insurer['file'] ) ); ?>"
								alt="<?php echo esc_attr( $insurer['alt'] ); ?>"
								loading="lazy"
								decoding="async"
							>
							<span class="page-dms__name"><?php echo esc_html( $insurer['name'] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>

				<p class="page-dms__note">Адрес клиники: г. Красноярск, ул. Мужества, 4. Если полис подходит — запишем на удобное время и подскажем, какие документы взять с собой.</p>

				<p class="page-dms__cta">
					<button type="button" class="svc-landing__btn open-popup-callback">
						Записаться на приём
						<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="currentColor"/>
						</svg>
					</button>
					<a class="page-dms__phone" href="tel:+73912340909"><?php echo esc_html( $phone ); ?></a>
				</p>
			</div>
		</div>
	</section>

	<section class="request">
		<img class="request__background" src="<?php bloginfo( 'template_url' ); ?>/assets/img/request_background.png" alt="">
		<div class="container">
			<div class="request__inner">
				<?php
				get_template_part(
					'template-parts/request-form',
					null,
					[
						'form_id' => 'form-request-dms',
						'source'  => 'request-dms',
						'variant' => 'generic',
						'service' => 'Запись по ДМС',
					]
				);
				?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
