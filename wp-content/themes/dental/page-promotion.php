<?php
/*
    Template Name: sales
*/
?>

<?php get_header(); ?>

<main class="main page-promotion">

    <?php do_action('theme_breadcrumbs'); ?>

    <section class="promotion promotion-page">
        <div class="container">
            <div class="promotion__inner">
                <h1 class="page-title promotion-page__hero">АКЦИИ И СПЕЦПРЕДЛОЖЕНИЯ</h1>

                <?php foreach ( liderdent_get_promotions() as $promo ) :
                    $card_class = 'promotion-page__card';
                    if ( ! empty( $promo['featured'] ) ) {
                        $card_class .= ' promotion-page__card--featured';
                    }
                    $img = get_template_directory_uri() . '/assets/img/' . ( $promo['image'] ?? 'promotion_1.png' );
                    ?>
                    <article class="<?php echo esc_attr( $card_class ); ?>">
                        <div class="promotion-page__content">
                            <?php if ( ! empty( $promo['badge'] ) ) : ?>
                                <span class="promotion-page__badge"><?php echo esc_html( $promo['badge'] ); ?></span>
                            <?php endif; ?>
                            <h2 class="promotion__text"><?php echo esc_html( $promo['title'] ); ?></h2>
                            <?php if ( ! empty( $promo['subtitle'] ) ) : ?>
                                <p class="promotion-page__subtitle"><?php echo esc_html( $promo['subtitle'] ); ?></p>
                            <?php endif; ?>
                            <p><?php echo esc_html( $promo['text'] ); ?></p>
                            <?php if ( ! empty( $promo['phones'] ) ) : ?>
                                <p class="promotion-page__phones">
                                    <?php echo esc_html( implode( ' · ', $promo['phones'] ) ); ?>
                                </p>
                            <?php endif; ?>
                            <?php if ( ! empty( $promo['note'] ) ) : ?>
                                <p class="promotion-page__note"><?php echo esc_html( $promo['note'] ); ?></p>
                            <?php endif; ?>
                            <div class="promotion__callback">
                                <a class="open_callback btn-gold" href="#">Записаться / заказать звонок</a>
                            </div>
                        </div>
                        <div class="promotion-page__image">
                            <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $promo['title'] ); ?>">
                        </div>
                    </article>
                <?php endforeach; ?>
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
