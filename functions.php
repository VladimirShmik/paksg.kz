<?php
function install_scripts()
{
    //Подключение CSS
    wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1.0');
    wp_enqueue_style('main-style', get_stylesheet_uri());

    //подключение JS
    wp_enqueue_script('jquery-script', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '1.0', false);
    wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '1.0', true);
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true);

}

add_action('wp_enqueue_scripts', 'install_scripts');

// Объявляем поддержку Woocommerce
add_theme_support('woocommerce');

// Выключаем стили Woocommerce
add_filter ('woocommerce_enqueue_styles', '__return_empty_array');

// Объявляем поддержку изображений
add_theme_support( 'post-thumbnails');

// Регистрируем меню
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Главное меню' ),
            'mobile-menu' => __( 'Мобильное меню' ),
        )
    );
};

// Формы Woocommerce приводим к виду Bootstrap
add_filter('woocommerce_form_field_args', function ($args, $key, $value) {
    $args['input_class'][] = 'form-control';
    $args['class'][] = 'form-group';
    return $args;
}, 10, 3);

// Объявляем поддержку галереи
add_theme_support('wc-product-gallery-slider');

// Убираем zoom-эффект Woocommerce
function remove_image_zoom_support()
{
    remove_theme_support('wc-product-gallery-zoom');
}

add_action('wp', 'remove_image_zoom_support', 100);

// Укорачиваем отрывок записи новостей
add_filter( 'excerpt_length', function(){
    return 15;
} );
add_filter( 'excerpt_more', function( $more ) {
    return '...';
} );

//Удаляем сайдбар
function remove_woocommerce_sidebar() {
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('init', 'remove_woocommerce_sidebar');

//Меняем заголовок категории
remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
function theme_woocommerce_template_loop_category_title($category)
{
    ?>
        <h2 class="product-title__title">
            <?php
            echo esc_html($category->name);

            if ($category->count > 0) {
                echo apply_filters('woocommerce_subcategory_count_html', '', $category);
            }
            ?>
        </h2>
    <?php
}

add_action('woocommerce_shop_loop_subcategory_title', 'theme_woocommerce_template_loop_category_title', 10);

//Удаляем хук сортировки
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

//Удаляем хук категорий в единичном товаре
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

//Удаляем хук заголовка в единичном товаре
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

//Удаляем хук рейтинга в единичном товаре
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

//Удаляем хук цены в единичном товаре
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

//Удаляем хук отрывка в единичном товаре
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

//Удаляем хук заказа в единичном товаре
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

// Отключаем табы внутри товаров
add_filter( 'woocommerce_product_tabs', 'my_remove_all_product_tabs', 98 );
function my_remove_all_product_tabs( $tabs ) {
    // Remove the description tab
    unset( $tabs['description']);
    // Remove the reviews tab
    unset( $tabs['reviews']);
    // Remove the additional information tab
    unset( $tabs['additional_information']);
    return $tabs;
}
// Замена надписи кнопки корзины
function custom_change_add_to_cart_text($text) {
    return __('Заказать', 'woocommerce');
}

add_filter('woocommerce_product_single_add_to_cart_text', 'custom_change_add_to_cart_text');

// Отключаем цены
add_filter('woocommerce_get_price_html', 'hide_product_price');

function hide_product_price($price) {
    return '';
}
// Редирект с корзины на оформление
add_filter('add_to_cart_redirect', 'tb_skip_cart_page');
function tb_skip_cart_page () {
    global $woocommerce;
    $redirect_checkout = $woocommerce->cart->get_checkout_url();
    return $redirect_checkout;
}
// Переделка кнопки в корзину
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item', 'custom_template_loop_link', 10);

function custom_template_loop_link() {
    global $product;
    ?>
    <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="product_type_simple">Подробнее</a>
    <?php
}

// Пересборка полей
add_filter( 'woocommerce_checkout_fields' , 'tb_remove_checkout_fields' );
function tb_remove_checkout_fields( $fields ) {
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['order']['order_comments']);
    unset($fields['account']['account_username']);
    unset($fields['account']['account_password']);
    unset($fields['account']['account_password-2']);
    return $fields;
}

// Фильтр для ФИО
add_filter( 'woocommerce_checkout_fields', 'wc_fio_field', 25 );

function wc_fio_field( $fields ) {

    // сначала переименовываем поле Имя
    $fields[ 'billing' ][ 'billing_first_name' ][ 'label' ] = 'ФИО';

    return $fields;

}

// Переделка кнопки корзины
function customize_woocommerce_add_to_cart_text() {
    return __('Заказать', 'woocommerce');
}

add_filter('woocommerce_product_add_to_cart_text', 'customize_woocommerce_add_to_cart_text');
