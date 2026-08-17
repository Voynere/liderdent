<?php
/**
 * Template for HTTP 404.
 */
get_header();
?>

<main class="main page-404">
	<div class="container">
		<section class="page-404__inner">
			<h1 class="page-404__title">Страница не найдена</h1>
			<p class="page-404__text">Такой страницы нет или её перенесли. Можно вернуться на главную, открыть услуги или оставить заявку — перезвоним.</p>

			<form class="page-404__search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="visually-hidden" for="page-404-search">Поиск по сайту</label>
				<input id="page-404-search" type="search" name="s" placeholder="Поиск по сайту" value="<?php echo esc_attr( get_search_query() ); ?>">
				<button type="submit" class="btn-gold">Найти</button>
			</form>

			<nav class="page-404__nav" aria-label="Полезные разделы">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
				<a href="<?php echo esc_url( home_url( '/service/' ) ); ?>">Услуги</a>
				<a href="<?php echo esc_url( home_url( '/prices/' ) ); ?>">Цены</a>
				<a href="<?php echo esc_url( home_url( '/doctors/' ) ); ?>">Врачи</a>
				<a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>">Контакты</a>
			</nav>

			<p class="page-404__cta">
				<button type="button" class="btn-gold open-popup-callback">Записаться на приём</button>
				<a class="page-404__phone" href="tel:+73912340909">+7 (391) 234 09 09</a>
			</p>
		</section>
	</div>
</main>

<?php
get_footer();
