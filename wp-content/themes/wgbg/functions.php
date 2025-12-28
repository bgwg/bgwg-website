<?php
/**
 * Theme functions
 */

// Enqueue scripts and styles
function gc_scripts() {
    // Styles
    wp_enqueue_style('flag-icon.min.css', get_template_directory_uri() . '/css/flag-icon.min.css', [], '01');
    wp_enqueue_style('font-awesome.min.css', get_template_directory_uri() . '/css/font-awesome.min.css', [], '01');
    wp_enqueue_style('bootstrap.min.css', get_template_directory_uri() . '/css/bootstrap.min.css', [], '01');
    wp_enqueue_style('sidenav.min.css', get_template_directory_uri() . '/css/sidenav.min.css', [], '01');
    wp_enqueue_style('slick.css', get_template_directory_uri() . '/css/slick.css', [], '01');
    wp_enqueue_style('slick-theme.css', get_template_directory_uri() . '/css/slick-theme.css', [], '01');
    wp_enqueue_style('style.css', get_template_directory_uri() . '/css/style.css', [], '01');
    // wp_enqueue_style('main-style.css', get_template_directory_uri() . '/style.css', [], time());
    $theme_version = wp_get_theme()->get('Version'); wp_enqueue_style('main-style.css', get_stylesheet_uri(), [], $theme_version);


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

// Admin: Enqueue Media Uploader
add_action('admin_enqueue_scripts', function() {
    wp_enqueue_media();
    wp_enqueue_script('gc-meta-box', get_template_directory_uri() . '/js/meta-box.js', ['jquery'], '1.0', true);
});

// Theme setup
add_action('after_setup_theme', 'gc_init');
function gc_init() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption']);
    add_theme_support('post-formats', ['aside','image','video','quote','link']);

    register_nav_menu('header_menu', __('Header Menu'));
    register_nav_menu('footer_menu', __('Footer Menu'));

    load_theme_textdomain('greencard', get_template_directory());

    // Elementor integration
    if (file_exists(__DIR__ . '/elementor/main.php')) {
        require_once(__DIR__ . '/elementor/main.php');
    }
}



/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/cpt-case-study.php';
require get_template_directory() . '/inc/cpt-interactive-exp.php';

?>