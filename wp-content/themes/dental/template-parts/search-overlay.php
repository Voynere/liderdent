<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="ld-search-overlay" id="ld-search-overlay" aria-hidden="true" role="dialog" aria-label="Поиск по сайту">
	<div class="ld-search-overlay__backdrop" data-ld-search-close></div>
	<div class="ld-search-overlay__panel">
		<form class="ld-search-overlay__head" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<input type="search" name="s" class="ld-search-overlay__input" placeholder="Поиск услуг, цен, врачей, статей…" autocomplete="off" aria-label="Поиск" enterkeyhint="search">
			<button type="button" class="ld-search-overlay__close" data-ld-search-close aria-label="Закрыть">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
			</button>
		</form>
		<div class="ld-search-overlay__body">
			<p class="ld-search-overlay__hint">Введите минимум 2 символа</p>
		</div>
	</div>
</div>
