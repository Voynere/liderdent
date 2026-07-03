<?php
/* 
    Template Name: about
*/
?>

<?php get_header(); ?>

<main class="main">

    <section class="about">
        <div class="container">
            <div class="about__inner">
                <h2 class="page-title">ПРАЙС</h2>
                <div class="about__content">
                    <div class="about__left">
                        <p>1. Кариес от 8000 до 11000<br>
2. Пульпит от 10000 до 33000<br>
3. Периодонтит от 13.000 до 36.000<br>
4. Удаление простое от 5000 до 8000<br>
5. Удаление 8ки от 8000 до 14000<br>
6. Импланты от 33000 до 79000 в зависимости от импланта <br>
7. Профессиональная гигиена (взрослые) от 6500 <br>
8. Брекеты  79.000 за 1 челюсть <br>
9. Рентген снимки: прицел 600 и КТ 4500 для первичных пациентов., 2400 повторным<br>
10. Коронки: свой зуб от 28000/ имплант от  48000<br>
11. Консультация от 0 рублей 1 месяц открытия (мы хотели согласовать с вами первичный прием и составление комплексного плана от терапевтов для первичных пациентов), далее 1800 всех специалистов. Сейчас мы в поисках гнатолога, первичная консультация гнатолога будет 4000 рублей</p>
                    </div>
                    <div class="about__right">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/comfort_8.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <section class="callback">
        <div class="container">
            <div class="callback__inner">
                <div class="callback__img">
                    <img src="<?php bloginfo('template_url') ?>/assets/img/callback_form.jpg">
                </div>
                <div class="callback__content">
                    <div class="callback__title">
                        <p>Здоровые зубы за 2 визита</p>
                    </div>
                    <div class="callback__text">
                        <p>Запишитесь на первичную консультацию имплантолога, где вы получите:</p>
                        <ul>
                            <li>Подберем импланты специально для вас</li>
                            <li>Рассчитаем 3 варианта лечения с подробной сметой</li>
                        </ul>
                    </div>
                </div>
                <div class="callback__form">
                    <form id="callbackForm_page" action="#">
                        <div>
                            <label for="phone">Телефон</label>
                            <input class="callback__form-input" id="phone1" type="tel" onclick="this.setSelectionRange(0,0);" placeholder="+7 (___) ___ __-__">
                        </div>
                        <button class="callback__form-btn btn-green" type="submit">
                            <span>Получить консультацию</span>
                        </button>
                    </form>
                    <div class="callback__policy">
                        <p>Отправляя заявку, вы соглашаетесь с политикой конфиденциальности</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
     <section class="contacts">
        <div class="container">
            <div class="contacts__inner">
                <div class="contacts__map">
                 <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A322407f99216699ee1c4b28399f978668771f1ffb0f1d511c66384534417acd8&amp;width=1233&amp;height=596&amp;lang=ru_RU&amp;scroll=true"></script>

                </div>
                <div class="contacts__content">
                    <div class="contacts__title">
                        <h3>КОНТАКТЫ</h3>
                        <h4>+7-391 234 09 09</h4>
                    </div>
                    <div class="contacts__info">
                        <div class="contacts__info-item">
                            <div>
                                <img src="<?php bloginfo('template_url') ?>/assets/img/icons/time.svg" alt="">
                            </div>
                            <p>пн. — вс. 09:00 — 21:00</p>
                        </div>
                        <div class="contacts__info-item">
                            <div><img src="<?php bloginfo('template_url') ?>/assets/img/icons/geo.svg" alt=""></div>
                            <p>г. Красноярск<br>ул. Мужества 4 <br>(вход с торца 2 этаж)</p>
                        </div>
                        <div class="contacts__info-item">
                            <div><img src="<?php bloginfo('template_url') ?>/assets/img/icons/email.svg" alt=""></div>
                            <p>l1der.dent@yandex.ru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</main>

<?php get_footer(); ?>