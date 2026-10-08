<?php
/**
 * Результаты поиска /?s=
 */
get_header();

$q      = get_search_query();
$groups = function_exists( 'liderdent_site_search_results' ) ? liderdent_site_search_results( $q ) : [];
?>

<main class="main ld-search-page">
	<div class="container">
		<section class="ld-search-page__inner">
			<h1 class="ld-search-page__title"><?php echo $q !== '' ? 'Поиск: ' . esc_html( $q ) : 'Поиск по сайту'; ?></h1>

			<form class="ld-search-page__form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="visually-hidden" for="ld-search-page-input">Поиск по сайту</label>
				<input id="ld-search-page-input" type="search" name="s" placeholder="Поиск услуг, цен, врачей, статей…" value="<?php echo esc_attr( $q ); ?>">
				<button type="submit" class="btn-gold">Найти</button>
			</form>

			<?php
			if ( mb_strlen( $q, 'UTF-8' ) < 2 ) {
				echo '<p class="ld-search-page__empty">Введите минимум 2 символа</p>';
			} else {
				liderdent_render_search_groups( $groups );
			}
			?>
		</section>
	</div>
</main>

<?php
get_footer();
