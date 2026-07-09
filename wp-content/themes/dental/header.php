<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <?php wp_head(); ?>
</head>

<body>

    <div class="wrapper">
    <div class="overlay"></div>

        <header class="header">
            <div class="container">
                <div class="header__inner">
                    <div class="header__top">
                        <a class="header__top-logo" href="<?php echo get_home_url(); ?>/">
                            <h3 class="visually-hidden">Лидер Дент</h3>
                            <h3 class="visually-hidden">Стоматологическая клиника</h3>
                            <img src="<?php bloginfo('template_url') ?>/assets/img/logo.png" alt="Логотип">
                        </a>
                        <div class="header__top-item address">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/geo.svg" alt="Геолокация">
                            <p>г. Красноярск, ул. Мужества 4 <br> (вход с торца 2 этаж)</p>
                        </div>
                        <div class="header__top-item">
                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/time.svg" alt="Рабочие часы">
                            <p>c 09:00 до 21:00</p>
                        </div>
                        <div class="header__top-item phones">
                            <a href="tel:+73912271343" class="header__top-phone">+7 (391) 227 13 43</a>
                            <a href="tel:+73912340909" class="header__top-phone">+7 (391) 234 09 09</a>
                        </div>
                        <button class="header__callback open-popup-callback">
                            Заказать звонок
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="white"/>
                            </svg>
                        </button>
                        <div class="header__top-mobile">
                            <button class="header__follow-search-hidden header__follow-icon-item" id="follow-search-hidden">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/icons/header_follow_search_hidden.svg" alt="Поиск">
                            </button>
                            <a href="tel:+73912271343" class="header__follow-phone header__follow-icon-item">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/icons/header_follow_phone.svg" alt="Контакты">
                            </a>
                            <button class="header__follow-menu header__follow-icon-item open-mobile-menu">
                                <div class="header__follow-menu-line"></div>
                                <div class="header__follow-menu-line"></div>
                            </button>
                        </div>
                    </div>
                    <div class="header__bottom">
                        <nav class="header-menu-pc">
                            <ul>
                                <li>
                                    <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/implantaciya/">
                                        Имплантация зубов
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                    </a>
                                </li>
                                <li>
                                    <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/protezirovanie/">
                                        Протезирование
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                    </a>
                                </li>
                                <li>
                                    <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/lechenie/">
                                        Лечение зубов
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                    </a>
                                </li>
                                <li>
                                    <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/hirurgiya/">
                                        Хирургия
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url( liderdent_get_sales_page_url() ); ?>">Акции</a>
                                </li>
                                <li>
                                    <a href="<?php echo get_home_url(); ?>/prices/">Цены</a>
                                </li>
                                <li>
                                    <a href="<?php echo get_home_url(); ?>/doctors/">Наши врачи</a>
                                </li>
                                <li>
                                    <a href="<?php echo get_home_url(); ?>/about/">О нас</a>
                                </li>
                            </ul>
                        </nav>
                        <button class="header__callback open-popup-callback">
                            Заказать звонок
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="white"/>
                            </svg>
                        </button>
                    </div>
                    <div class="header__follow">
                        <div class="container">
                            <div class="header__follow-inner">
                                <div class="header__follow-top">
                                    <a href="<?php echo get_home_url(); ?>/" class="header__follow-logo">
                                        <h3 class="visually-hidden">ЛидерДент</h3>
                                        <h3 class="visually-hidden">Стоматологическая клиника</h3>
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/logo.png" alt="Логотип">
                                    </a>
                                    <ul class="header__follow-short-menu">
                                        <li>
                                            <a href="<?php echo esc_url( liderdent_get_sales_page_url() ); ?>">Акции</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo get_home_url(); ?>/prices/">Цены</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo get_home_url(); ?>/doctors/">Наши врачи</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo get_home_url(); ?>/about/">О нас</a>
                                        </li>
                                    </ul>
                                    <div class="header__follow-search">
                                        <img src="<?php bloginfo('template_url') ?>/assets/img/icons/header_follow_search.svg" alt="Поиск">
                                        <input type="text" class="follow-search">
                                    </div>
                                    <div class="header__follow-info">
                                        <button class="header__follow-search-hidden header__follow-icon-item" id="follow-search-hidden">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/header_follow_search_hidden.svg" alt="Поиск">
                                        </button>
                                        <a href="tel:+73912271343" class="header__follow-phone header__follow-icon-item">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/header_follow_phone.svg" alt="Контакты">
                                        </a>
                                        <button class="header__follow-geo header__follow-icon-item">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/header_follow_geo.svg" alt="Местоположение">
                                        </button>
                                        <button class="header__follow-menu header__follow-icon-item open-mobile-menu">
                                            <div class="header__follow-menu-line"></div>
                                            <div class="header__follow-menu-line"></div>
                                        </button>
                                        <button class="header__callback open-popup-callback">
                                            Заказать звонок
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="white"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="header__follow-bottom">
                                    <nav class="header-menu-follow">
                                        <ul class="header-menu-follow__list">
                                            <li>
                                                <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/implantaciya/">
                                                    Имплантация зубов
                                                    <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                                </a>
                                            </li>
                                            <li>
                                                <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/protezirovanie/">
                                                    Протезирование
                                                    <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                                </a>
                                            </li>
                                            <li>
                                                <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/lechenie/">
                                                    Лечение зубов
                                                    <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo get_home_url(); ?>/category/services/hirurgiya/" class="to-open-menu">
                                                    Хирургия
                                                    <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                                </a>
                                            </li>
                                            <li class="follow-menu-hidden">
                                                <a href="<?php echo esc_url( liderdent_get_sales_page_url() ); ?>">Акции</a>
                                            </li>
                                            <li class="follow-menu-hidden">
                                                <a href="<?php echo get_home_url(); ?>/prices/">Цены</a>
                                            </li>
                                            <li class="follow-menu-hidden">
                                                <a href="<?php echo get_home_url(); ?>/doctors/">Наши врачи</a>
                                            </li>
                                            <li class="follow-menu-hidden">
                                                <a href="<?php echo get_home_url(); ?>/about/">О нас</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-mobile-nav">
                        <nav class="header-mobile-nav__content">
                            <ul class="header-mobile-nav__list">
                                <li>
                                    <button class="header-mobile-nav__btn">
                                        <div class="header-mobile-nav__btn-icon">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/mobile_search.svg">
                                        </div>
                                        <span>поиск</span>
                                    </button>
                                </li>
                                <li>
                                    <a href="<?php echo get_home_url(); ?>/doctors/" class="header-mobile-nav__btn">
                                        <div class="header-mobile-nav__btn-icon">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/mobile_doctors.svg">
                                        </div>
                                        <span>врачи</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://t.me/liderdent24" class="header-mobile-nav__btn" target="_blank">
                                        <div class="header-mobile-nav__btn-icon">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/mobile_signup.svg">
                                        </div>
                                        <span>запись</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo get_home_url(); ?>/service/" class="header-mobile-nav__btn">
                                        <div class="header-mobile-nav__btn-icon">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/mobile_service.svg">
                                        </div>
                                        <span>услуги</span>
                                    </a>
                                </li>
                                <li>
                                    <button class="header-mobile-nav__btn open-mobile-contacts">
                                        <div class="header-mobile-nav__btn-icon">
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/mobile_phone.svg">
                                        </div>
                                        <span>контакты</span>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="header-mobile-content">
                    <div class="mobile-menu">
                        <div class="mobile-menu__wrapper">
                            <a class="mobile-menu__logo" href="<?php echo get_home_url(); ?>/">
                                <h3 class="visually-hidden">Лидер Дент</h3>
                                <h3 class="visually-hidden">Стоматологическая клиника</h3>
                                <img src="<?php bloginfo('template_url') ?>/assets/img/logo.png" alt="Логотип">
                            </a>
                            <nav class="mobile-menu__nav">
                                <ul class="mobile-menu__nav-list">
                                    <li>
                                        <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/implantaciya/">
                                            <span>Имплантация зубов</span>
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                        </a>
                                    </li>
                                    <li>
                                        <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/protezirovanie/">
                                            <span>Протезирование</span>
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                        </a>
                                    </li>
                                    <li>
                                        <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/lechenie/">
                                            <span>Лечение зубов</span>
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                        </a>
                                    </li>
                                    <li>
                                        <a class="to-open-menu" href="<?php echo get_home_url(); ?>/category/services/hirurgiya/">
                                            <span>Хирургия</span>
                                            <img src="<?php bloginfo('template_url') ?>/assets/img/icons/arrow_down.svg">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo get_home_url(); ?>/pravovaya-i-yuridicheskaya-informaciya/">Юридическая информация</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url( liderdent_get_sales_page_url() ); ?>">Акции</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo get_home_url(); ?>/prices/">Цены</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo get_home_url(); ?>/doctors/">Наши врачи</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo get_home_url(); ?>/about/">О нас</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="mobile-menu__contacts">
                            <div class="mobile-menu__contacts-phones">
                                <a href="tel:+73912271343">+7 (391) 227 13 43</a>
                                <a href="tel:+73912340909">+7 (391) 234 09 09</a>
                            </div>
                            <button class="mobile-menu__callback header__callback open-popup-callback">
                                Заказать звонок
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="white"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mobile-contacts">
                        <div class="mobile-contacts__content">
                            <a href="tel:+73912271343" class="mobile-contacts__conten-phone">+7 (391) 227 13 43</a>
                            <a href="tel:+73912340909" class="mobile-contacts__conten-phone">+7 (391) 234 09 09</a>
                            <div class="mobile-contacts__content-mail">
                                <a href="mailto:aliderdent@mail.ru" class="">aliderdent@mail.ru</a>
                            </div>
                            <div class="mobile-contacts__content-time">
                                <img src="<?php bloginfo('template_url') ?>/assets/img/icons/time.svg" alt="Рабочие часы">
                                <p>c 09:00 до 21:00</p>
                            </div>
                            <button class="mobile-contacts__content-callback btn-gold open-popup-callback">
                                Заказать звонок
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="popup-callback" id="popup-callback">
                    <div class="popup-callback__head">
                        <h4 class="popup-callback__head-title">Оставьте Вашу заявку</h4>
                        <button class="popup-callback__head-close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 1024 1024">
                                <path fill="currentColor" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504L738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512L828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496L285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512L195.2 285.696a64 64 0 0 1 0-90.496"/>
                            </svg>
                        </button>
                    </div>
                    <form action="" class="popup-callback__form">
                        <input name="name" class="popup-callback__form-item" type="text" placeholder="Введите имя">
                        <input name="phone"  class="popup-callback__form-item" type="text" placeholder="+7 (___) ___ __-__">
                        <button class="popup-callback__form-item popup-callback__form-submit btn-gold" type="submit">
                            <span>Заказать звонок</span>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#D2AE6B"/>
                            </svg>
                        </button>
                        <p class="popup-callback__form-privacy">
                            Нажимая на кнопку, вы автоматически соглашаетесь с 
                            <a href="<?php echo get_home_url(); ?>/privacy/">Политикой обработки персональных данных.</a>
                        </p>
                        <p class="visually-hidden">Заявка на обратный звонок</p>
                    </form>
                </div>
                <div class="popup-callback" id="popup-credit">
                    <div class="popup-callback__head">
                        <h4 class="popup-callback__head-title">Узнать о рассрочке</h4>
                        <button class="popup-callback__head-close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 1024 1024">
                                <path fill="currentColor" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504L738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512L828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496L285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512L195.2 285.696a64 64 0 0 1 0-90.496"/>
                            </svg>
                        </button>
                    </div>
                    <form action="" class="popup-callback__form">
                        <input name="name" class="popup-callback__form-item" type="text" placeholder="Введите имя">
                        <input name="phone"  class="popup-callback__form-item" type="text" placeholder="+7 (___) ___ __-__">
                        <button class="popup-callback__form-item popup-callback__form-submit btn-gold" type="submit">
                            <span>Заказать звонок</span>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#D2AE6B"/>
                            </svg>
                        </button>
                        <p class="popup-callback__form-privacy">
                            Нажимая на кнопку, вы автоматически соглашаетесь с 
                            <a href="<?php echo get_home_url(); ?>/privacy/">Политикой обработки персональных данных.</a>
                        </p>
                        <p class="visually-hidden">Узнать подробности о рассрочке</p>
                    </form>
                </div>
                <div class="popup-callback" id="popup-doctors">
                    <div class="popup-callback__head">
                        <h4 class="popup-callback__head-title">Записаться на прием</h4>
                        <button class="popup-callback__head-close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 1024 1024">
                                <path fill="currentColor" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504L738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512L828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496L285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512L195.2 285.696a64 64 0 0 1 0-90.496"/>
                            </svg>
                        </button>
                    </div>
                    <form action="" class="popup-callback__form">
                        <input name="name" class="popup-callback__form-item" type="text" placeholder="Введите имя">
                        <input name="phone"  class="popup-callback__form-item" type="text" placeholder="+7 (___) ___ __-__">
                        <input name="doctor_title" type="hidden" value="">
                        <button class="popup-callback__form-item popup-callback__form-submit btn-gold" type="submit">
                            <span>Заказать звонок</span>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#D2AE6B"/>
                            </svg>
                        </button>
                        <p class="popup-callback__form-privacy">
                            Нажимая на кнопку, вы автоматически соглашаетесь с 
                            <a href="<?php echo get_home_url(); ?>/privacy/">Политикой обработки персональных данных.</a>
                        </p>
                        <p class="visually-hidden">Узнать подробности о рассрочке</p>
                    </form>
                </div>
                <div class="popup-callback" id="popup-service">
                    <div class="popup-callback__head">
                        <h4 class="popup-callback__head-title">Записаться на прием</h4>
                        <button class="popup-callback__head-close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 1024 1024">
                                <path fill="currentColor" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504L738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512L828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496L285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512L195.2 285.696a64 64 0 0 1 0-90.496"/>
                            </svg>
                        </button>
                    </div>
                    <form action="" class="popup-callback__form">
                        <input name="name" class="popup-callback__form-item" type="text" placeholder="Введите имя">
                        <input name="phone"  class="popup-callback__form-item" type="text" placeholder="+7 (___) ___ __-__">
                        <input name="service_title" type="hidden" value="">
                        <button class="popup-callback__form-item popup-callback__form-submit btn-gold" type="submit">
                            <span>Заказать звонок</span>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#D2AE6B"/>
                            </svg>
                        </button>
                        <p class="popup-callback__form-privacy">
                            Нажимая на кнопку, вы автоматически соглашаетесь с 
                            <a href="<?php echo get_home_url(); ?>/privacy/">Политикой обработки персональных данных.</a>
                        </p>
                        <p class="visually-hidden">Узнать подробности о рассрочке</p>
                    </form>
                </div>

            </div>
        </header>