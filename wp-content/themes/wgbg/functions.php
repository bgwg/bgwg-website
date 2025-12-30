<?php
/**
 * Theme functions
 */

/* -------------------------------------------------
 * Enqueue scripts and styles
 * ------------------------------------------------- */
function gc_scripts() {

    // Styles
    wp_enqueue_style('flag-icon.min.css', get_template_directory_uri() . '/css/flag-icon.min.css', [], '01');
    wp_enqueue_style('font-awesome.min.css', get_template_directory_uri() . '/css/font-awesome.min.css', [], '01');
    wp_enqueue_style('bootstrap.min.css', get_template_directory_uri() . '/css/bootstrap.min.css', [], '01');
    wp_enqueue_style('sidenav.min.css', get_template_directory_uri() . '/css/sidenav.min.css', [], '01');
    wp_enqueue_style('slick.css', get_template_directory_uri() . '/css/slick.css', [], '01');
    wp_enqueue_style('slick-theme.css', get_template_directory_uri() . '/css/slick-theme.css', [], '01');
    wp_enqueue_style('style.css', get_template_directory_uri() . '/css/style.css', [], '01');

    $theme_version = wp_get_theme()->get('Version');
    wp_enqueue_style('main-style.css', get_stylesheet_uri(), [], $theme_version);

    // Scripts
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.2.2.4.js', [], '2.2.4', true );
    wp_enqueue_script('jquery');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], '1.0', true);
    wp_enqueue_script('sidenav', get_template_directory_uri() . '/js/sidenav.js', ['jquery'], '1.0', true);
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', ['jquery'], '1.0', true);
    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', ['jquery'], time(), true);
}
add_action('wp_enqueue_scripts', 'gc_scripts');


/* -------------------------------------------------
 * Admin Media Uploader
 * ------------------------------------------------- */
add_action('admin_enqueue_scripts', function() {
    wp_enqueue_media();
    wp_enqueue_script(
        'gc-meta-box',
        get_template_directory_uri() . '/js/meta-box.js',
        ['jquery'],
        '1.0',
        true
    );
});


/* -------------------------------------------------
 * Theme Setup
 * ------------------------------------------------- */
add_action('after_setup_theme', 'gc_init');
function gc_init() {

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ]);
    add_theme_support('post-formats', [
        'aside',
        'image',
        'video',
        'quote',
        'link'
    ]);

    register_nav_menu('header_menu', __('Header Menu'));
    register_nav_menu('footer_menu', __('Footer Menu'));

    load_theme_textdomain('greencard', get_template_directory());

    // Elementor integration
    if (file_exists(__DIR__ . '/elementor/main.php')) {
        require_once __DIR__ . '/elementor/main.php';
    }
}


/* -------------------------------------------------
 * Footer 
 * ------------------------------------------------- */
function gc_register_menus() {
    register_nav_menus([
        'footer_menu'   => __('Footer Navigation', 'gc'),
        'footer_license'=> __('Footer License', 'gc'),
    ]);
}
add_action('after_setup_theme', 'gc_register_menus');

function gc_footer_customizer($wp_customize) {

    $wp_customize->add_section('gc_footer_section', [
        'title'    => __('Footer Settings', 'gc'),
        'priority' => 30,
    ]);

    // Footer Logo
    $wp_customize->add_setting('gc_footer_logo');
    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'gc_footer_logo',
            [
                'label'   => __('Footer Logo', 'gc'),
                'section' => 'gc_footer_section',
                'mime_type' => 'image',
            ]
        )
    );

    // Tagline
    $wp_customize->add_setting('gc_footer_tagline', ['default' => '']);
    $wp_customize->add_control('gc_footer_tagline', [
        'label'   => __('Footer Tagline', 'gc'),
        'section' => 'gc_footer_section',
        'type'    => 'text',
    ]);

    // Address
    $wp_customize->add_setting('gc_footer_address');
    $wp_customize->add_control('gc_footer_address', [
        'label'   => __('Address', 'gc'),
        'section' => 'gc_footer_section',
        'type'    => 'textarea',
    ]);

    // Email
    $wp_customize->add_setting('gc_footer_email');
    $wp_customize->add_control('gc_footer_email', [
        'label'   => __('Email', 'gc'),
        'section' => 'gc_footer_section',
        'type'    => 'email',
    ]);

    // Phone
    $wp_customize->add_setting('gc_footer_phone');
    $wp_customize->add_control('gc_footer_phone', [
        'label'   => __('Phone', 'gc'),
        'section' => 'gc_footer_section',
        'type'    => 'text',
    ]);

}
add_action('customize_register', 'gc_footer_customizer');


/* -------------------------------------------------
 * Custom Mega Menu Walker
 * ------------------------------------------------- */
// class Bootstrap_Mega_Menu_Walker extends Walker_Nav_Menu {

//     public function start_lvl( &$output, $depth = 0, $args = array() ) {
//         $indent = str_repeat("\t", $depth);

//         if ($depth == 0) {
//             $output .= "\n$indent<ul class=\"dropdown-menu mega-menu row\">\n";
//         } else {
//             $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
//         }
//     }

//     public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

//         $classes = empty($item->classes) ? array() : (array) $item->classes;

//         $is_mega = in_array('mega', $classes);

//         $class_names = implode(' ', $classes);

//         if ($depth == 1 && $is_mega) {
//             $output .= '<li class="col-md-3">';
//         } else {
//             $output .= '<li class="' . esc_attr($class_names) . '">';
//         }

//         $atts = '';
//         $atts .= ! empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
//         $atts .= ' class="menu-link"';

//         if (in_array('menu-item-has-children', $classes)) {
//             $atts .= ' data-toggle="dropdown" class="dropdown-toggle"';
//         }

//         $output .= '<a' . $atts . '>';
//         $output .= esc_html($item->title);
//         $output .= '</a>';
//     }
// }


/* -------------------------------------------------
 * Custom Post Types
 * ------------------------------------------------- */
require get_template_directory() . '/inc/cpt-case-study.php';
require get_template_directory() . '/inc/cpt-interactive-exp.php';
