<?php
/**
 * Shared mobile drawer menu (header.php + header-home.php).
 */
?>
<div class="mobile-menu" id="mobile-menu" role="dialog" aria-modal="true" aria-label="Мобильное меню" aria-hidden="true">
	<div class="mobile-menu__wrapper">
		<div class="mobile-menu__top">
			<a class="mobile-menu__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="visually-hidden">Лидер Дент — стоматологическая клиника</span>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>" alt="Лидер Дент — стоматологическая клиника в Красноярске">
			</a>
			<button type="button" class="mobile-menu__close close-mobile-menu" aria-label="Закрыть меню">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<nav class="mobile-menu__nav" aria-label="Мобильная навигация">
			<ul class="mobile-menu__nav-list">
				<li>
					<a href="<?php echo esc_url( home_url( '/service/' ) ); ?>">Все услуги</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/services/implantaciya/' ) ); ?>">Имплантация зубов</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/services/protezirovanie/' ) ); ?>">Протезирование</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/services/lechenie/' ) ); ?>">Лечение зубов</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/services/hirurgiya/' ) ); ?>">Хирургия</a>
				</li>
				<li>
					<a href="<?php echo esc_url( function_exists( 'liderdent_get_sales_page_url' ) ? liderdent_get_sales_page_url() : home_url( '/sales/' ) ); ?>">Акции</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/prices/' ) ); ?>">Цены</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/doctors/' ) ); ?>">Наши врачи</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/category/blog/' ) ); ?>">Статьи</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">О нас</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>">Контакты</a>
				</li>
				<li>
					<a href="<?php echo esc_url( home_url( '/pravovaya-i-yuridicheskaya-informaciya/' ) ); ?>">Юридическая информация</a>
				</li>
			</ul>
		</nav>
	</div>
	<div class="mobile-menu__contacts">
		<div class="mobile-menu__contacts-phones">
			<a href="tel:+73912271343">+7 (391) 227 13 43</a>
			<a href="tel:+73912340909">+7 (391) 234 09 09</a>
		</div>
		<button type="button" class="mobile-menu__callback header__callback open-popup-callback">
			Заказать звонок
			<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="white"/>
			</svg>
		</button>
	</div>
</div>
