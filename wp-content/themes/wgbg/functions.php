<?php
function gc_scripts() {
    // Theme Styles
    wp_enqueue_style( 'flag-icon.min.css','https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css', array(), '0.8.2', false );
    wp_enqueue_style( 'bootstrap-select.min','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css', array(), '1.6.2', false );
    wp_enqueue_style( 'font-awesome.min.css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '01', false );
    wp_enqueue_style( 'bootstrap.min.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '01', false );
    wp_enqueue_style( 'sidenav.min.css', get_template_directory_uri() . '/css/sidenav.min.css', array(), '01', false );
    wp_enqueue_style( 'slick.css', get_template_directory_uri() . '/css/slick.css', array(), '01', false );
    wp_enqueue_style( 'slick-theme.css', get_template_directory_uri() . '/css/slick-theme.css', array(), '01', false );
    wp_enqueue_style( 'style.css', get_template_directory_uri() . '/css/style.css', array(), '01', false );
    wp_enqueue_style( 'main-style.css', get_template_directory_uri() . '/style.css', array(), time(), false );

// Theme Scripts
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, null);
    wp_enqueue_script('jquery');
	wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '01', true );
    wp_enqueue_script( 'sidenav.js', get_template_directory_uri() . '/js/sidenav.js', array(), '01', true );
    wp_enqueue_script( 'slick.min.js', get_template_directory_uri() . '/js/slick.min.js', array(), '01', true );
    wp_enqueue_script( 'scripts.js', get_template_directory_uri() . '/js/scripts.js', array(), time(), true );

    }

add_action( 'wp_enqueue_scripts', 'gc_scripts' );

add_action('after_setup_theme','gc_int');
function gc_int(){
	require_once( __DIR__ . '/elementor/main.php' );	
    add_theme_support( 'title-tag' );
    add_theme_support('post-thumbnails');
    add_theme_support('automatic_feed_links');


    register_nav_menu( 'header_menu', __( 'Header Menu') );
    register_nav_menu( 'footer_menu', __( 'Footer Menu') );

    load_theme_textdomain('greencard', get_template_directory());


  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
) );
add_theme_support( 'post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
) );

}
