<?php
/**
 * Краткий прайс-лист (редакция сайта, июль 2026).
 * Обновление: правка массива в теме + deploy.
 */
function liderdent_get_short_prices(): array {
    return [
        [
            'id'    => 'diagnostika',
            'title' => 'ДИАГНОСТИКА',
            'items' => [
                '3D компьютерная томография 2 челюсти (без описания) — 3 900 руб.',
                '3D компьютерная томография 1 челюсть (без описания) — 2 900 руб.',
                '3D компьютерная томография сегмент (без описания) — 2 000 руб.',
                '3D компьютерная томография ВНЧС 2 сустава 2 положения (без описания) — 5 900 руб.',
                '3D компьютерная томография ВНЧС 2 сустава 1 положение (без описания) — 2 200 руб.',
                '3D компьютерная томография ВНЧС 1 сустава 2 положения (без описания) — 2 000 руб.',
                '3D компьютерная томография ВНЧС 1 сустав 1 положение (без описания) — 1 900 руб.',
                '3D компьютерная томография пазух носа (без описания) — 3 000 руб.',
                'Ортопанограмма (ОПТГ; без описания) — 1 500 руб.',
                'Телеренгенография (ТРГ; без описания) — 1 500 руб.',
                'Зонография ВНЧС (без описания) — 1 500 руб.',
                '3D Цефалометрия (без описания) — 5 900 руб.',
                'Запись исследования на флешку — 800 руб.',
            ],
        ],
        [
            'id'    => 'terapiya',
            'title' => 'ТЕРАПИЯ',
            'items' => [
                'Консультация стоматолога-терапевта — 1 800 руб.',
                'Лечение кариеса — от 6 900 руб.',
                'Лечение пульпита — от 10 000 руб.',
                'Лечение периодонтита — от 12 000 руб.',
                'Эстетическая реставрация — от 15 000 ₽',
            ],
        ],
        [
            'id'    => 'detskaya-terapiya',
            'title' => 'ДЕТСКАЯ ТЕРАПИЯ',
            'items' => [
                'Консультация стоматолога-терапевта детского — 1 800 руб.',
                'Лечение кариеса — от 6 900 руб.',
                'Лечение пульпита — от 10 000 руб.',
                'Лечение периодонтита — от 12 000 руб.',
            ],
        ],
        [
            'id'    => 'hirurgiya',
            'title' => 'ХИРУРГИЯ',
            'items' => [
                'Консультация стоматолога-хирурга — 1 800 ₽',
                'Имплант Osstem — от 35 000 руб.',
                'Имплант Inno — от 35 000 руб.',
                'Имплант Straumann — от 75 000 руб.',
                'Имплант Dentium — от 40 000 руб.',
                'Имплант Dentium SuperLine — 45 000 руб.',
                'Синус лифтинг закрытый — от 13 000 руб.',
                'Синус лифтинг открытый — от 41 000 руб.',
                'Удаление зуба простое — от 5 000 руб.',
                'Удаление зуба сложное — от 8 000 руб.',
            ],
        ],
        [
            'id'    => 'gigiena',
            'title' => 'ПРОФЕССИОНАЛЬНАЯ ГИГИЕНА ПОЛОСТИ РТА',
            'items' => [
                'Чистка Air Flow (2 челюсти) — от 10 000 руб.',
                'Чистка ультразвуковая (2 челюсти) — от 6 500 руб.',
                'Детская профессиональная гигиена щётка-паста и покрытие фторсодержащими веществами — от 4 000 руб.',
            ],
        ],
        [
            'id'    => 'parodontologiya',
            'title' => 'ПАРОДОНТОЛОГИЯ',
            'items' => [
                'Консультация стоматолога-пародонтолога — 2 350 руб.',
                'Лечение заболеваний тканей пародонта аппаратом «ВЕКТОР» (одна челюсть) — от 12 200 руб.',
                'Лечение заболеваний тканей пародонта аппаратом «ВЕКТОР» — верхняя и нижняя челюсти — от 18 700 руб.',
            ],
        ],
        [
            'id'    => 'ortodontiya',
            'title' => 'ОРТОДОНТИЯ',
            'items' => [
                'Консультация стоматолога-ортодонта — 1 800 ₽',
                'Установка брекетов (1 челюсть) — от 80 000 руб.',
                'Установка брекетов (2 челюсти) — от 160 000 руб.',
                'Установка пластинки ортодонтической — от 25 000 руб.',
                'Элайнеры — от 95 000 ₽',
            ],
        ],
        [
            'id'    => 'ortopediya',
            'title' => 'ОРТОПЕДИЯ',
            'items' => [
                'Консультация стоматолога-ортопеда — 1 800 ₽',
                'Протезирование съёмным протезом — от 39 000 руб.',
                'Протезирование частичным съёмным протезом — от 32 000 руб.',
                'Протезирование коронкой, полукоронкой, виниром, накладкой Emax — от 40 000 руб.',
                'Протезирование временной коронкой — от 9 900 руб.',
                'Протезирование коронкой из оксида циркония на свой зуб — от 21 000 руб.',
                'Протезирование коронкой из оксида циркония на имплантате — от 25 000 руб.',
            ],
        ],
    ];
}

/**
 * Соответствие slug подкатегории услуг → блоки краткого прайса.
 */
function liderdent_get_category_short_price_map(): array {
    return [
        'rentgenologicheskoe-obsledovanie' => [ 'diagnostika' ],
        'czifrovaya-stomatologiya'         => [ 'diagnostika' ],
        'lechenie'                         => [ 'terapiya', 'detskaya-terapiya' ],
        'esteticheskaya-stomatologiya'     => [ 'terapiya' ],
        'hirurgiya'                        => [ 'hirurgiya' ],
        'implantaciya'                     => [ 'hirurgiya', 'ortopediya' ],
        'gigiena'                          => [ 'gigiena' ],
        'ortodontiya'                      => [ 'ortodontiya' ],
        'protezirovanie'                   => [ 'ortopediya' ],
    ];
}

function liderdent_filter_short_price_sections( ?array $section_ids ): array {
    $sections = liderdent_get_short_prices();

    if ( $section_ids === null ) {
        return $sections;
    }

    $allowed = array_flip( $section_ids );

    return array_values(
        array_filter(
            $sections,
            static fn( array $section ): bool => isset( $allowed[ $section['id'] ] )
        )
    );
}

function liderdent_render_short_prices( string $modifier = '', ?array $section_ids = null ): void {
    $sections = liderdent_filter_short_price_sections( $section_ids );

    if ( empty( $sections ) ) {
        return;
    }

    $class           = 'short-prices' . ( $modifier ? ' short-prices--' . esc_attr( $modifier ) : '' );
    $single_section  = count( $sections ) === 1;

    echo '<div class="' . esc_attr( $class ) . '">';
    echo '<h2 class="short-prices__title page-title">ЦЕНЫ КРАТКО</h2>';

    foreach ( $sections as $section ) {
        echo '<div class="short-prices__section">';
        if ( ! $single_section ) {
            echo '<h3 class="short-prices__section-title">' . esc_html( $section['title'] ) . '</h3>';
        }
        echo '<ul class="short-prices__list">';
        foreach ( $section['items'] as $item ) {
            echo '<li class="short-prices__item">' . esc_html( $item ) . '</li>';
        }
        echo '</ul></div>';
    }

    echo '<p class="short-prices__note">Актуальный полный прайс уточняйте у администратора.</p>';
    echo '</div>';
}

function liderdent_render_short_prices_for_category( string $category_slug, string $modifier = 'category' ): void {
    $map = liderdent_get_category_short_price_map();

    if ( empty( $map[ $category_slug ] ) ) {
        return;
    }

    liderdent_render_short_prices( $modifier, $map[ $category_slug ] );
}
