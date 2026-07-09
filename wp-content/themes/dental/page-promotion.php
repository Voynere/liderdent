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
                                <button type="button" class="promotion-page__btn btn-gold open-popup-callback">
                                    Записаться / заказать звонок
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
                                    </svg>
                                </button>
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

    <?php get_template_part( 'template-parts/contacts-section' ); ?>

</main>

<?php get_footer(); ?>
