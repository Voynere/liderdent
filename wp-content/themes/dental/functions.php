<?php

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css' );
	wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css' );
	$style_path = get_template_directory() . '/assets/css/style.min.css';
	$style_uri  = get_template_directory_uri() . '/assets/css/style.min.css';
	$version    = file_exists($style_path) ? filemtime($style_path) : null;
	wp_enqueue_style( 'style', $style_uri, [], $version );

    wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js');
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'icon', 'https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js', array('jquery'), 'null', true );
	wp_enqueue_script( 'ionicons-esm', 'https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.esm.js', array('jquery'), 'null', true );
	wp_enqueue_script( 'ionicons', 'https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.js', array('jquery'), 'null', true );
	wp_enqueue_script( 'fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js', array(), null, true );
	wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true );
	wp_enqueue_script( 'about', get_template_directory_uri() . '/assets/js/about.js', array('jquery'), 'null', true );
	wp_enqueue_script( 'home', get_template_directory_uri() . '/assets/js/home.js', array('jquery'), '1.8.3', true );
	// wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), 'null', true );

    // подключение specialist.js только для страниц специалистов
    $specialist_js_path = get_template_directory() . '/assets/js/specialist.js';
    $specialist_js_uri  = get_template_directory_uri() . '/assets/js/specialist.js';
    $specialist_ver    = file_exists( $specialist_js_path ) ? filemtime( $specialist_js_path ) : null;
    if (
        is_singular( 'specialist' )
        || is_post_type_archive( 'specialist' )
        || is_category( 'specialist' )
        || ( is_single() && in_category( 'specialist' ) )
    ) {
        wp_enqueue_script( 'specialist', $specialist_js_uri, array( 'jquery' ), $specialist_ver, true );
    }

    wp_enqueue_script(
        'popup-form',
        get_template_directory_uri() . '/assets/js/popup-form.js',
        [],
        null,
        true
    );

    wp_localize_script('popup-form', 'POPUP_FORM', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('popup_form_nonce')
    ]);
});


function custom_add_woocommerce_support() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );	
}
add_action( 'after_setup_theme', 'custom_add_woocommerce_support' );

// Подключение хуков
// require get_template_directory() . '/custom-post-type.php';

# Добавляет SVG в список разрешенных для загрузки файлов.
function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');

function fix_svg_mime_type($data, $file, $filename, $mimes) {
    $filetype = wp_check_filetype($filename, $mimes);
    return [
        'ext' => $filetype['ext'],
        'type' => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}
add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 4);

function svg_mime_type_icon($icon, $mime, $post_id) {
    if ($mime === 'image/svg+xml') {
        return wp_get_attachment_url($post_id);
    }
    return $icon;
}
add_filter('wp_mime_type_icon', 'svg_mime_type_icon', 10, 3);


// Хлебные крошки
function theme_breadcrumbs() {
    if ( is_front_page() ) return;

    // Путь на страницу "Услуги" (page slug = 'service')
    $services_page = get_page_by_path('service');
    $services_url  = $services_page ? get_permalink($services_page->ID) : home_url('/service/');

    // Таксономная запись рубрики services (category slug = 'services'), если есть
    $services_cat = get_category_by_slug('services');

    echo '<div class="breadcrumbs">
            <div class="container">
                <div class="breadcrumbs__inner">
                    <ul class="breadcrumbs__list">';

    // Главная
    echo '<li class="breadcrumbs__item home">
            <a href="' . esc_url(home_url('/')) . '" class="breadcrumbs__link home">Главная</a>
          </li>';

    $sep = '<li><p class="breadcrumbs__sep">|</p></li>';

    /* =========================
     * СТРАНИЦЫ
     * ========================= */
    if ( is_page() ) {
        global $post;

        if ( $post->post_parent ) {
            $parents = array_reverse( get_post_ancestors($post->ID) );
            foreach ( $parents as $parent_id ) {
                echo $sep;
                echo '<li class="breadcrumbs__item category">
                        <a href="' . esc_url(get_permalink($parent_id)) . '" class="breadcrumbs__link category">'
                            . esc_html( get_the_title($parent_id) ) .
                        '</a>
                      </li>';
            }
        }

        echo $sep;
        echo '<li>
                <p class="breadcrumbs__link open">' . esc_html( get_the_title() ) . '</p>
              </li>';
    }
    
    /* =========================
    * СПЕЦИАЛИСТЫ (CPT)
    * ========================= */
    elseif ( is_singular('specialist') ) {

        // Страница всех врачей (/doctors/)
        $doctors_page = get_page_by_path('doctors');

        if ( $doctors_page ) {
            echo $sep;
            echo '<li class="breadcrumbs__item category">
                    <a href="' . esc_url(get_permalink($doctors_page->ID)) . '" class="breadcrumbs__link category">
                        ' . esc_html( get_the_title($doctors_page->ID) ) . '
                    </a>
                </li>';
        }

        // Текущий специалист
        echo $sep;
        echo '<li>
                <p class="breadcrumbs__link open">' . esc_html( get_the_title() ) . '</p>
            </li>';
    }

    /* =========================
     * ЗАПИСИ (POST)
     * ========================= */
    elseif ( is_single() ) {
        $categories = get_the_category();

        if ( !empty($categories) ) {
            $cat = $categories[0];

            // Родительская категория
            if ( $cat->parent ) {
                $parent = get_category($cat->parent);

                // Если родитель — категория services, то вместо /category/services/ ставим страницу /service/
                if ( $services_cat && $parent && $parent->term_id == $services_cat->term_id ) {
                    $parent_link = $services_url;
                } else {
                    $parent_link = get_category_link($parent);
                }

                echo $sep;
                echo '<li class="breadcrumbs__item category">
                        <a href="' . esc_url($parent_link) . '" class="breadcrumbs__link category">'
                            . esc_html($parent->name) .
                        '</a>
                      </li>';
            }

            // Текущая категория
            echo $sep;
            // Если текущая категория сама services — используем страницу /service/
            if ( $services_cat && $cat->term_id == $services_cat->term_id ) {
                $cat_link = $services_url;
            } else {
                $cat_link = get_category_link($cat);
            }

            echo '<li>
                    <a href="' . esc_url($cat_link) . '" class="breadcrumbs__link category">'
                        . esc_html($cat->name) .
                    '</a>
                  </li>';
        }

        // Текущий пост (без ссылки)
        echo $sep;
        echo '<li>
                <p class="breadcrumbs__link open">' . esc_html( get_the_title() ) . '</p>
              </li>';
    }

    /* =========================
     * КАТЕГОРИИ
     * ========================= */
    elseif ( is_category() ) {
        $cat = get_queried_object();

        if ( $cat->parent ) {
            $parent = get_category($cat->parent);

            // Если родитель — services, ставим ссылку на страницу /service/
            if ( $services_cat && $parent && $parent->term_id == $services_cat->term_id ) {
                $parent_link = $services_url;
            } else {
                $parent_link = get_category_link($parent);
            }

            echo $sep;
            echo '<li class="breadcrumbs__item category">
                    <a href="' . esc_url($parent_link) . '" class="breadcrumbs__link category">'
                        . esc_html($parent->name) .
                    '</a>
                  </li>';
        }

        echo $sep;
        echo '<li>
                <p class="breadcrumbs__link open">' . esc_html( single_cat_title('', false) ) . '</p>
              </li>';
    }

    /* =========================
     * ПРОЧЕЕ (архивы, CPT)
     * ========================= */
    elseif ( is_archive() ) {
        echo $sep;
        echo '<li>
                <p class="breadcrumbs__link open">' . esc_html( post_type_archive_title('', false) ) . '</p>
              </li>';
    }

    echo '        </ul>
                </div>
            </div>
          </div>';
}
add_action('theme_breadcrumbs', 'theme_breadcrumbs');


//Кастомные посты врачей
function register_specialist_post_type() {
    register_post_type('specialist', [
        'labels' => [
            'name' => 'Специалисты',
            'singular_name' => 'Специалист'
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true, // Включаем поддержку REST API
    ]);
}
add_action('init', 'register_specialist_post_type');


function register_acf_fields_for_rest_api() {
    // Регистрация кастомных полей для типа поста 'specialist'
    register_rest_field('specialist', 'doctor_exp', array(
        'get_callback' => 'get_acf_field',
        'update_callback' => null,
        'schema' => null,
    ));

    register_rest_field('specialist', 'doctor_spec', array(
        'get_callback' => 'get_acf_field',
        'update_callback' => null,
        'schema' => null,
    ));

    register_rest_field('specialist', 'doctor_schedule', array(
        'get_callback' => 'get_acf_field',
        'update_callback' => null,
        'schema' => null,
    ));

    register_rest_field('specialist', 'doctor_service', array(
        'get_callback' => 'get_acf_field',
        'update_callback' => null,
        'schema' => null,
    ));

    register_rest_field('specialist', 'featured_media', array(
        'get_callback' => 'get_featured_image_url',
        'update_callback' => null,
        'schema' => null,
    ));
}
add_action('rest_api_init', 'register_acf_fields_for_rest_api');

function get_acf_field($object, $field_name, $request) {
    return get_field($field_name, $object['id']);
}

function get_featured_image_url($object, $field_name, $request) {
    $featured_image_id = get_post_thumbnail_id($object['id']);
    $featured_image_url = wp_get_attachment_url($featured_image_id);
    return $featured_image_url;
}


add_action('wp_ajax_send_popup_form', 'send_popup_form_handler');
add_action('wp_ajax_nopriv_send_popup_form', 'send_popup_form_handler');
function send_popup_form_handler() {
    $log_file = WP_CONTENT_DIR . '/popup_debug.log';

    // Логируем входящие данные
    file_put_contents($log_file, "=== AJAX CALL at ".date('Y-m-d H:i:s')." ===\n", FILE_APPEND);
    file_put_contents($log_file, "REMOTE_ADDR: " . ($_SERVER['REMOTE_ADDR'] ?? '') . "\n", FILE_APPEND);
    file_put_contents($log_file, "POST: " . print_r($_POST, 1) . "\n", FILE_APPEND);

    // проверка action — необязательна, но полезна
    if ( empty($_POST['action']) ) {
        file_put_contents($log_file, "NO ACTION PROVIDED\n\n", FILE_APPEND);
        wp_send_json_error('NO_ACTION');
    }

    // nonce (временно можно отключить, но сначала логируем)
    if ( empty($_POST['nonce']) || ! wp_verify_nonce( $_POST['nonce'], 'popup_form_nonce' ) ) {
        file_put_contents($log_file, "NONCE FAIL\n\n", FILE_APPEND);
        wp_send_json_error('NONCE_FAIL');
    }

    // данные
    $name  = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $type  = isset($_POST['type']) ? sanitize_text_field(wp_unslash($_POST['type'])) : 'popup';
    $service_title = isset($_POST['service_title']) ? sanitize_text_field(wp_unslash($_POST['service_title'])) : '';
    $doctor_title  = isset($_POST['doctor_title'])  ? sanitize_text_field(wp_unslash($_POST['doctor_title']))  : '';

    // Примитивная валидация
    if ( empty($phone) ) {
        file_put_contents($log_file, "NO PHONE\n\n", FILE_APPEND);
        wp_send_json_error('NO_PHONE');
    }

    $to = 'aliderdent@mail.ru';
    $type_labels = [
        'callback' => 'обратный звонок',
        'credit'   => 'рассрочка',
        'service'  => 'запись на услугу',
        'doctor'    => 'запись к врачу',
        'popup'    => 'модальное окно',
    ];
    $type_label = $type_labels[$type] ?? $type;

    if ( $type === 'callback' ) {
        $subject = 'Заявка с сайта на обратный звонок';
    } elseif ( $type === 'service' ) {
        $service_subject = $service_title ? ' "' . $service_title . '"' : '';
        $subject = 'Заявка с сайта на услугу' . $service_subject;
    } else {
        $subject = "Заявка с сайта — {$type_label}";
    }

    $service_line = $service_title ? "Услуга: {$service_title}\n" : '';
    $doctor_line  = $doctor_title  ? "Врач: {$doctor_title}\n" : '';

    $message = "Вид заявки: {$type_label}\n{$service_line}{$doctor_line}Имя: {$name}\nТелефон: {$phone}\n";


    $sent = wp_mail($to, $subject, $message, $headers);

    file_put_contents($log_file, "wp_mail returned: " . ($sent ? 'true' : 'false') . "\n", FILE_APPEND);

    if ( ! $sent ) {
        // Лог ошибок PHPMailer (если доступно)
        add_action('wp_mail_failed', function($wp_error) use ($log_file) {
            file_put_contents($log_file, "wp_mail_failed: " . print_r($wp_error, 1) . "\n", FILE_APPEND);
        });
        file_put_contents($log_file, "MAIL FAILED\n\n", FILE_APPEND);
        wp_send_json_error('MAIL_FAILED');
    }

    file_put_contents($log_file, "OK\n\n", FILE_APPEND);
    wp_send_json_success('SENT');
}

add_action( 'wp_mail_failed', function( $wp_error ) {
    $log_file = WP_CONTENT_DIR . '/popup_debug.log';
    file_put_contents($log_file, "PHPMailer error: " . print_r($wp_error, true) . "\n", FILE_APPEND);
});
// Функция для определения мобильных устройств
function is_mobile_device() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $mobile_agents = array(
        'Mobile', 'Android', 'iPhone', 'iPad', 'iPod', 'BlackBerry', 
        'Windows Phone', 'Opera Mini', 'IEMobile'
    );
    
    foreach ($mobile_agents as $agent) {
        if (stripos($user_agent, $agent) !== false) {
            return true;
        }
    }
    return false;
}