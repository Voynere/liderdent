<?php
/**
 * Тексты врачей и виджеты ПроДокторов (редакция сайта).
 * Сопоставление по ФИО из заголовка записи specialist.
 */
function liderdent_normalize_doctor_key( string $title ): string {
    $title = mb_strtolower( trim( $title ) );
    $title = preg_replace( '/\s+/u', ' ', $title );
    return $title;
}

function liderdent_get_doctors_profiles(): array {
    return [
        'маркова кристина павловна' => [
            'specialization' => 'Стоматолог-ортодонт',
            'education' => [
                'Образование: высшее медицинское',
                'Красноярский государственный медицинский университет имени профессора Войно-Ясенецкого',
                'Повышение квалификации: «Детская стоматология»',
                '«Оказание медицинской помощи в экстренной форме. Сердечно-лёгочная реанимация»',
                '«Эндодонтические протоколы… Protaper gold»',
                '«iTop — индивидуальный тренинг стоматологической профилактики»',
                '«Ортодонт-эксперт. Как грамотно начать лечение пациента»',
                '«Ортодонт-эксперт. Всё о лечении детей. Молочный и сменный прикус (0–12 лет)»',
                '«Ортодонт-эксперт. Уровень 2. Брекеты и элайнеры»',
            ],
            'bio' => 'Кристина Павловна — стоматолог-ортодонт, которого ценят за профессионализм, внимательное отношение и индивидуальный подход к каждому пациенту. Она подробно объясняет особенности прикуса, составляет понятный план лечения и сопровождает пациента на всех его этапах.',
            'prodoctorov_id' => '1168429',
            'prodoctorov_slug' => '1168429-markova',
        ],
        'войтова полина николаевна' => [
            'specialization' => 'Стоматолог-терапевт',
            'education' => [
                'Образование: высшее медицинское',
                'Иркутский государственный медицинский университет',
            ],
            'bio' => 'Полина Николаевна — стоматолог-терапевт, отличающаяся аккуратностью, внимательностью и высоким уровнем профессионализма. Обеспечивает комфортное лечение, подробно объясняет каждый этап и придерживается честного подхода без навязывания лишних услуг.',
            'prodoctorov_id' => '1000891',
            'prodoctorov_slug' => '1000891-voytova',
        ],
        'асрян мариам араратовна' => [
            'specialization' => 'Стоматолог-терапевт',
            'education' => [
                'Образование: высшее медицинское',
                'Приволжский исследовательский медицинский университет',
            ],
            'bio' => 'Мариам Араратовна — стоматолог-терапевт, ценимая за внимательность, доброжелательность и умение работать как со взрослыми, так и с детьми. Отличается подробными консультациями, аккуратным лечением и способностью снизить страх перед стоматологическим приёмом.',
            'prodoctorov_id' => '961942',
            'prodoctorov_slug' => '961942-asryan',
        ],
        'умраев тимур ахмаевич' => [
            'specialization' => 'Стоматолог-хирург, имплантолог',
            'education' => [
                'Образование: высшее медицинское',
                'Красноярский государственный медицинский университет имени профессора Войно-Ясенецкого',
            ],
            'bio' => 'Тимур Ахмаевич — стоматолог-хирург и имплантолог, известный уверенностью в работе и высоким уровнем профессионализма. Проводит даже сложные хирургические вмешательства максимально бережно, сопровождая пациента на всех этапах лечения.',
            'prodoctorov_id' => '1278212',
            'prodoctorov_slug' => '1278212-umraev',
        ],
        'сафаров рамил набиевич' => [
            'specialization' => 'Стоматолог-ортопед',
            'education' => [
                'Образование: высшее медицинское',
                'Красноярский государственный медицинский университет имени профессора Войно-Ясенецкого',
            ],
            'bio' => 'Рамил Набиевич — стоматолог-ортопед, отличающийся компетентностью, честным подходом и внимательным отношением к пациентам. Подбирает оптимальные варианты лечения, подробно объясняет все этапы и обеспечивает качественное протезирование с естественным результатом.',
            'prodoctorov_id' => '1337450',
            'prodoctorov_slug' => '1337450-safarov',
            'cases_gallery' => true,
        ],
        'хмыз светлана сергеевна' => [
            'specialization' => 'Стоматолог, пародонтолог',
            'education' => [
                'Образование: высшее медицинское',
                'Красноярский государственный медицинский университет имени профессора Войно-Ясенецкого',
            ],
            'bio' => 'Светлана Сергеевна — стоматолог и пародонтолог с комплексным подходом к лечению заболеваний дёсен и зубов. Проводит подробные консультации, эффективно лечит пародонтит и пародонтоз, помогает сохранять зубы даже в сложных клинических ситуациях.',
            'prodoctorov_id' => '241115',
            'prodoctorov_slug' => '241115-hmyz',
        ],
    ];
}

function liderdent_get_doctor_profile( string $title ): ?array {
    $profiles = liderdent_get_doctors_profiles();
    $key      = liderdent_normalize_doctor_key( $title );
    return $profiles[ $key ] ?? null;
}

function liderdent_render_prodoctorov_widget( array $profile, string $doctor_title ): void {
    if ( empty( $profile['prodoctorov_id'] ) ) {
        return;
    }
    $id   = esc_attr( $profile['prodoctorov_id'] );
    $slug = esc_attr( $profile['prodoctorov_slug'] );
    $fio  = esc_html( $doctor_title );
    ?>
    <div class="single-specialist__prodoctorov">
        <h4 class="single-specialist__info-text bold">Отзывы на ПроДокторов</h4>
        <div id="pd_widget_footerd<?php echo $id; ?>"
             data-filters="lpu=111493"
             class="pd_widget_footer"
             data-doctor="<?php echo $id; ?>">
            <div class="pd_left">
                <a target="_blank" rel="noopener" class="pd_doctor_name"
                   href="https://prodoctorov.ru/krasnoyarsk/vrach/<?php echo $slug; ?>/">
                    <span class="doctor_fio"><?php echo $fio; ?></span>
                </a>
            </div>
            <div class="pd_middle">
                <div id="pd_widget_footer_content_middled<?php echo $id; ?>"></div>
            </div>
            <div class="pd_right">
                <div id="pd_widget_footer_content_rightd<?php echo $id; ?>"></div>
            </div>
        </div>
        <div class="pd_powered_by">
            <a target="_blank" rel="noopener" href="https://prodoctorov.ru/">
                <img class="pd_logo" width="132" height="24" alt="ПроДокторов"
                     src="https://prodoctorov.ru/static/_v1/pd/logos/logo-pd-widget.png">
            </a>
        </div>
    </div>
    <?php
}

function liderdent_get_clinic_gallery_items(): array {
    $dir = get_template_directory() . '/assets/img/clinic-gallery';
    if ( ! is_dir( $dir ) ) {
        return [];
    }
    $items = [];
    foreach ( scandir( $dir ) as $file ) {
        if ( $file === '.' || $file === '..' ) {
            continue;
        }
        $path = $dir . '/' . $file;
        if ( ! is_file( $path ) ) {
            continue;
        }
        $ext = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
        $type = in_array( $ext, [ 'mp4', 'webm', 'mov' ], true ) ? 'video' : 'image';
        $items[] = [
            'url'  => get_template_directory_uri() . '/assets/img/clinic-gallery/' . rawurlencode( $file ),
            'type' => $type,
            'file' => $file,
        ];
    }
    usort( $items, static fn( $a, $b ) => strcmp( $a['file'], $b['file'] ) );
    return $items;
}

function liderdent_get_doctor_cases( string $title ): array {
    $profile = liderdent_get_doctor_profile( $title );
    if ( empty( $profile['cases_gallery'] ) ) {
        return [];
    }

    $base = get_template_directory_uri() . '/assets/img/safarov-cases/';

    return [
        [
            'title'  => 'Временная коронка с пластикой десны',
            'before' => $base . 'case-01.jpg',
            'after'  => $base . 'case-02.jpg',
        ],
        [
            'title'  => 'Имплантация и восстановление зубного ряда',
            'before' => $base . 'case-03.jpg',
            'after'  => $base . 'case-04.jpg',
        ],
        [
            'title'  => 'Протезирование на имплантах',
            'before' => $base . 'case-06.jpg',
            'after'  => $base . 'case-05.jpg',
        ],
    ];
}

function liderdent_render_doctor_cases( string $title ): void {
    $cases = liderdent_get_doctor_cases( $title );
    if ( empty( $cases ) ) {
        return;
    }
    ?>
    <section class="before-after specialist-cases">
        <h2 class="page-title before-after__title">РАБОТЫ ДО / ПОСЛЕ</h2>

        <div class="before-after__content specialist-cases__grid">
            <?php foreach ( $cases as $index => $case ) : ?>
                <article class="before-after__item specialist-cases__card">
                    <div class="before-after__images">
                        <a class="before-after__images-item specialist-cases__photo"
                           href="<?php echo esc_url( $case['before'] ); ?>"
                           data-fancybox="doctor-cases-<?php echo (int) $index; ?>"
                           data-caption="До — <?php echo esc_attr( $case['title'] ); ?>">
                            <span class="specialist-cases__badge specialist-cases__badge--before">До</span>
                            <img src="<?php echo esc_url( $case['before'] ); ?>"
                                 alt="<?php echo esc_attr( 'До — ' . $case['title'] ); ?>"
                                 loading="lazy">
                        </a>
                        <a class="before-after__images-item specialist-cases__photo"
                           href="<?php echo esc_url( $case['after'] ); ?>"
                           data-fancybox="doctor-cases-<?php echo (int) $index; ?>"
                           data-caption="После — <?php echo esc_attr( $case['title'] ); ?>">
                            <span class="specialist-cases__badge specialist-cases__badge--after">После</span>
                            <img src="<?php echo esc_url( $case['after'] ); ?>"
                                 alt="<?php echo esc_attr( 'После — ' . $case['title'] ); ?>"
                                 loading="lazy">
                        </a>
                    </div>
                    <p class="before-after__item-text specialist-cases__caption"><?php echo esc_html( $case['title'] ); ?></p>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="before-after__slider specialist-cases__slider">
            <div class="swiper specialistCasesSlider">
                <div class="swiper-wrapper">
                    <?php foreach ( $cases as $index => $case ) : ?>
                        <div class="swiper-slide">
                            <article class="before-after__item specialist-cases__card">
                                <div class="before-after__images">
                                    <a class="before-after__images-item specialist-cases__photo"
                                       href="<?php echo esc_url( $case['before'] ); ?>"
                                       data-fancybox="doctor-cases-mobile-<?php echo (int) $index; ?>"
                                       data-caption="До — <?php echo esc_attr( $case['title'] ); ?>">
                                        <span class="specialist-cases__badge specialist-cases__badge--before">До</span>
                                        <img src="<?php echo esc_url( $case['before'] ); ?>"
                                             alt="<?php echo esc_attr( 'До — ' . $case['title'] ); ?>"
                                             loading="lazy">
                                    </a>
                                    <a class="before-after__images-item specialist-cases__photo"
                                       href="<?php echo esc_url( $case['after'] ); ?>"
                                       data-fancybox="doctor-cases-mobile-<?php echo (int) $index; ?>"
                                       data-caption="После — <?php echo esc_attr( $case['title'] ); ?>">
                                        <span class="specialist-cases__badge specialist-cases__badge--after">После</span>
                                        <img src="<?php echo esc_url( $case['after'] ); ?>"
                                             alt="<?php echo esc_attr( 'После — ' . $case['title'] ); ?>"
                                             loading="lazy">
                                    </a>
                                </div>
                                <p class="before-after__item-text specialist-cases__caption"><?php echo esc_html( $case['title'] ); ?></p>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="before-after__slider-arrows specialist-cases__arrows">
                <button class="before-after__slider-arrow prev specialist-cases__arrow prev" type="button" aria-label="Предыдущий кейс">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/arrow_left_slider_gold.svg' ); ?>" alt="">
                </button>
                <button class="before-after__slider-arrow next specialist-cases__arrow next" type="button" aria-label="Следующий кейс">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/arrow_right_slider_gold.svg' ); ?>" alt="">
                </button>
            </div>
        </div>
    </section>
    <?php
}

function liderdent_get_safarov_case_images(): array {
    $dir = get_template_directory() . '/assets/img/safarov-cases';
    if ( ! is_dir( $dir ) ) {
        return [];
    }
    $images = [];
    foreach ( scandir( $dir ) as $file ) {
        if ( ! preg_match( '/\.(jpe?g|png|webp)$/i', $file ) ) {
            continue;
        }
        $images[] = get_template_directory_uri() . '/assets/img/safarov-cases/' . rawurlencode( $file );
    }
    sort( $images );
    return $images;
}
