<?php
/* 
    Template Name: sales
*/
?>

<?php get_header(); ?>

<main class="main">
    <section class="promotion">
        <div class="container">
            <div class="promotion__inner">
                <div class="promotion__item">
                    <div class="promotion__content">
                        <h3 class="promotion__text">ПЕРВИЧНАЯ КОНСУЛЬТАЦИЯ БЕСПЛАТНО!</h3>
                        <div class="promotion__callback">
                            <a class="open_callback">Заказать звонок</a>
                        </div>
                    </div>
                    <div class="promotion__img">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/page_promotion_1.jpg" alt="">
                    </div>
                </div>
                <div class="promotion__item">
                    <div class="promotion__content">
                        <h3 class="promotion__text">Ослепительная улыбка по выгодной цене! КОМПЛЕКС</h3>
                        <div class="promotion__callback">
                            <a class="open_callback">Заказать звонок</a>
                        </div>
                    </div>
                    <div class="promotion__img">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/page_promotion_10.jpg" alt="">
                    </div>
                </div>
                <div class="promotion__item">
                    <div class="promotion__content">
                        <h3 class="promotion__text">УСТАНОВКА ИМПЛАНТА  Osstem 25500 РУБЛЕЙ </h3>
                        <div class="promotion__callback">
                            <a class="open_callback">Заказать звонок</a>
                        </div>
                    </div>
                    <div class="promotion__img">
                        <img src="<?php bloginfo('template_url') ?>/assets/img/page_promotion_3.jpg" alt="">
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