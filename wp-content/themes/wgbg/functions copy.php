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

/**
 * Register Case Study custom post type.
 */
function gc_register_case_study_cpt() {
	$labels = array(
		'name'               => __( 'Case Studies', 'greencard' ),
		'singular_name'      => __( 'Case Study', 'greencard' ),
		'add_new'            => __( 'Add New', 'greencard' ),
		'add_new_item'       => __( 'Add New Case Study', 'greencard' ),
		'edit_item'          => __( 'Edit Case Study', 'greencard' ),
		'new_item'           => __( 'New Case Study', 'greencard' ),
		'all_items'          => __( 'All Case Studies', 'greencard' ),
		'view_item'          => __( 'View Case Study', 'greencard' ),
		'search_items'       => __( 'Search Case Studies', 'greencard' ),
		'not_found'          => __( 'No case studies found', 'greencard' ),
		'not_found_in_trash' => __( 'No case studies found in Trash', 'greencard' ),
		'menu_name'          => __( 'Case Studies', 'greencard' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'rewrite'            => array( 'slug' => 'case-study' ),
		'menu_position'      => 20,
	);

	register_post_type( 'case_study', $args );
}
add_action( 'init', 'gc_register_case_study_cpt' );

/**
 * Add meta boxes for Case Study fields.
 */
function gc_case_study_add_meta_boxes() {
	add_meta_box(
		'gc_case_study_hero',
		__( 'Case Study Hero', 'greencard' ),
		'gc_case_study_hero_meta_box_callback',
		'case_study',
		'normal',
		'high'
	);

	add_meta_box(
		'gc_case_study_details',
		__( 'Case Study Details (Year & Technology)', 'greencard' ),
		'gc_case_study_details_meta_box_callback',
		'case_study',
		'normal',
		'high'
	);

	add_meta_box(
		'gc_case_study_objective',
		__( 'Objective Section', 'greencard' ),
		'gc_case_study_objective_meta_box_callback',
		'case_study',
		'normal',
		'default'
	);

	add_meta_box(
		'gc_case_study_execution',
		__( 'Execution Section', 'greencard' ),
		'gc_case_study_execution_meta_box_callback',
		'case_study',
		'normal',
		'default'
	);

	add_meta_box(
		'gc_case_study_outcome',
		__( 'Outcome Section', 'greencard' ),
		'gc_case_study_outcome_meta_box_callback',
		'case_study',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'gc_case_study_add_meta_boxes' );

function gc_case_study_get_meta( $post_id, $key, $default = '' ) {
	$value = get_post_meta( $post_id, $key, true );
	return $value === '' ? $default : $value;
}

function gc_case_study_hero_meta_box_callback( $post ) {
	$card_bg_image  = gc_case_study_get_meta( $post->ID, '_cs_card_bg_image' );
	$banner_image   = gc_case_study_get_meta( $post->ID, '_cs_banner_image' );
	$main_image     = gc_case_study_get_meta( $post->ID, '_cs_main_image' );
	$heading_prefix = gc_case_study_get_meta( $post->ID, '_cs_heading_prefix', 'Target x MNUFC' );
	$heading_main   = gc_case_study_get_meta( $post->ID, '_cs_heading_main', 'Fan Challenge' );
	$intro_text     = gc_case_study_get_meta( $post->ID, '_cs_intro_text' );
	
	wp_nonce_field( 'gc_case_study_save_meta', 'gc_case_study_meta_nonce' );
	?>
	<p><label for="gc_cs_card_bg_image"><?php _e( 'Card background image URL (card bg.png)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_card_bg_image" name="gc_cs_card_bg_image" value="<?php echo esc_attr( $card_bg_image ); ?>" />

	<p><label for="gc_cs_banner_image"><?php _e( 'Banner background image URL (details-banner.png)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_banner_image" name="gc_cs_banner_image" value="<?php echo esc_attr( $banner_image ); ?>" />

	<p><label for="gc_cs_main_image"><?php _e( 'Main case study image URL (work image)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_main_image" name="gc_cs_main_image" value="<?php echo esc_attr( $main_image ); ?>" />

	<p><label for="gc_cs_heading_prefix"><?php _e( 'Heading prefix (inside <span>, e.g. client/brand)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_heading_prefix" name="gc_cs_heading_prefix" value="<?php echo esc_attr( $heading_prefix ); ?>" />

	<p><label for="gc_cs_heading_main"><?php _e( 'Main heading text', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_heading_main" name="gc_cs_heading_main" value="<?php echo esc_attr( $heading_main ); ?>" />

	<p><label for="gc_cs_intro_text"><?php _e( 'Intro paragraph under heading', 'greencard' ); ?></label></p>
	<textarea class="widefat" id="gc_cs_intro_text" name="gc_cs_intro_text" rows="4"><?php echo esc_textarea( $intro_text ); ?></textarea>
	<?php
}

function gc_case_study_details_meta_box_callback( $post ) {
	$year        = gc_case_study_get_meta( $post->ID, '_cs_year', '2025' );
	$technology  = gc_case_study_get_meta( $post->ID, '_cs_technology', 'R&D, IOS, Android' );
	?>
	<p><label for="gc_cs_year"><?php _e( 'Year', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_year" name="gc_cs_year" value="<?php echo esc_attr( $year ); ?>" />

	<p><label for="gc_cs_technology"><?php _e( 'Technology', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_technology" name="gc_cs_technology" value="<?php echo esc_attr( $technology ); ?>" />
	<?php
}

function gc_case_study_objective_meta_box_callback( $post ) {
	$objective_subtitle = gc_case_study_get_meta( $post->ID, '_cs_objective_subtitle', 'The Objective' );
	$objective_heading  = gc_case_study_get_meta( $post->ID, '_cs_objective_heading', 'A New Challenge For Us' );
	$objective_intro    = gc_case_study_get_meta( $post->ID, '_cs_objective_intro' );
	$objective_list     = gc_case_study_get_meta( $post->ID, '_cs_objective_list' );
	$objective_image    = gc_case_study_get_meta( $post->ID, '_cs_objective_image' );
	?>
	<p><label for="gc_cs_objective_subtitle"><?php _e( 'Objective subtitle (H3)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_objective_subtitle" name="gc_cs_objective_subtitle" value="<?php echo esc_attr( $objective_subtitle ); ?>" />

	<p><label for="gc_cs_objective_heading"><?php _e( 'Objective heading (H2)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_objective_heading" name="gc_cs_objective_heading" value="<?php echo esc_attr( $objective_heading ); ?>" />

	<p><label for="gc_cs_objective_intro"><?php _e( 'Objective intro paragraph', 'greencard' ); ?></label></p>
	<textarea class="widefat" id="gc_cs_objective_intro" name="gc_cs_objective_intro" rows="4"><?php echo esc_textarea( $objective_intro ); ?></textarea>

	<p><label for="gc_cs_objective_list"><?php _e( 'Objective bullet list (one item per line)', 'greencard' ); ?></label></p>
	<textarea class="widefat" id="gc_cs_objective_list" name="gc_cs_objective_list" rows="5"><?php echo esc_textarea( $objective_list ); ?></textarea>

	<p><label for="gc_cs_objective_image"><?php _e( 'Objective image URL (obj.png)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_objective_image" name="gc_cs_objective_image" value="<?php echo esc_attr( $objective_image ); ?>" />
	<?php
}

function gc_case_study_execution_meta_box_callback( $post ) {
	$execution_subtitle = gc_case_study_get_meta( $post->ID, '_cs_execution_subtitle', 'Execution' );
	$execution_heading  = gc_case_study_get_meta( $post->ID, '_cs_execution_heading', 'Our Solution' );
	$execution_text     = gc_case_study_get_meta( $post->ID, '_cs_execution_text' );
	$steps_list         = gc_case_study_get_meta( $post->ID, '_cs_steps_list' );
	$four_box_heading   = gc_case_study_get_meta( $post->ID, '_cs_four_box_heading', 'How We Exceeded Expectations' );
	$four_box_items     = gc_case_study_get_meta( $post->ID, '_cs_four_box_items' );
	?>
	<p><label for="gc_cs_execution_subtitle"><?php _e( 'Execution subtitle (H3)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_execution_subtitle" name="gc_cs_execution_subtitle" value="<?php echo esc_attr( $execution_subtitle ); ?>" />

	<p><label for="gc_cs_execution_heading"><?php _e( 'Execution heading (H2)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_execution_heading" name="gc_cs_execution_heading" value="<?php echo esc_attr( $execution_heading ); ?>" />

	<p><label for="gc_cs_execution_text"><?php _e( 'Execution paragraph', 'greencard' ); ?></label></p>
	<textarea class="widefat" id="gc_cs_execution_text" name="gc_cs_execution_text" rows="4"><?php echo esc_textarea( $execution_text ); ?></textarea>

	<p><label for="gc_cs_steps_list"><?php _e( 'Numbered steps (one per line)', 'greencard' ); ?></label></p>
	<textarea class="widefat" id="gc_cs_steps_list" name="gc_cs_steps_list" rows="4"><?php echo esc_textarea( $steps_list ); ?></textarea>

	<p><label for="gc_cs_four_box_heading"><?php _e( 'Four-box section heading (H2)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_four_box_heading" name="gc_cs_four_box_heading" value="<?php echo esc_attr( $four_box_heading ); ?>" />

	<p><label for="gc_cs_four_box_items"><?php _e( 'Four-box items (one paragraph per line)', 'greencard' ); ?></label></p>
	<textarea class="widefat" id="gc_cs_four_box_items" name="gc_cs_four_box_items" rows="4"><?php echo esc_textarea( $four_box_items ); ?></textarea>
	<?php
}

function gc_case_study_outcome_meta_box_callback( $post ) {
	$outcome_heading = gc_case_study_get_meta( $post->ID, '_cs_outcome_heading', 'The Outcome' );
	$outcome_text    = gc_case_study_get_meta( $post->ID, '_cs_outcome_text' );
	$video_url       = gc_case_study_get_meta( $post->ID, '_cs_video_url' );
	$video_thumb     = gc_case_study_get_meta( $post->ID, '_cs_video_thumbnail' );
	$large_image     = gc_case_study_get_meta( $post->ID, '_cs_large_image' );
	?>
	<p><label for="gc_cs_outcome_heading"><?php _e( 'Outcome heading (H2)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_outcome_heading" name="gc_cs_outcome_heading" value="<?php echo esc_attr( $outcome_heading ); ?>" />

	<p><label for="gc_cs_outcome_text"><?php _e( 'Outcome paragraph', 'greencard' ); ?></label></p>
	<textarea class="widefat" id="gc_cs_outcome_text" name="gc_cs_outcome_text" rows="4"><?php echo esc_textarea( $outcome_text ); ?></textarea>

	<p><label for="gc_cs_video_url"><?php _e( 'Video URL (YouTube/Vimeo or MP4 link)', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_video_url" name="gc_cs_video_url" value="<?php echo esc_attr( $video_url ); ?>" />

	<p><label for="gc_cs_video_thumbnail"><?php _e( 'Video thumbnail image URL', 'greencard' ); ?></label></p>
	<input type="text" class="widefat" id="gc_cs_video_thumbnail" name="gc_cs_video_thumbnail" value="<?php echo esc_attr( $video_thumb ); ?>" />

	<p><label for="gc_cs_large_image"><?php _e( 'Large image URLs (one per line for gallery below video)', 'greencard' ); ?></label></p>
	<textarea class="widefat" id="gc_cs_large_image" name="gc_cs_large_image" rows="4"><?php echo esc_textarea( $large_image ); ?></textarea>
	<?php
}

/**
 * Save Case Study meta fields.
 */
function gc_case_study_save_meta( $post_id ) {
	if ( ! isset( $_POST['gc_case_study_meta_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['gc_case_study_meta_nonce'], 'gc_case_study_save_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && 'case_study' === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	$fields = array(
		'gc_cs_card_bg_image'      => '_cs_card_bg_image',
		'gc_cs_banner_image'        => '_cs_banner_image',
		'gc_cs_main_image'          => '_cs_main_image',
		'gc_cs_heading_prefix'      => '_cs_heading_prefix',
		'gc_cs_heading_main'        => '_cs_heading_main',
		'gc_cs_intro_text'          => '_cs_intro_text',
		'gc_cs_year'                => '_cs_year',
		'gc_cs_technology'          => '_cs_technology',
		'gc_cs_objective_subtitle'  => '_cs_objective_subtitle',
		'gc_cs_objective_heading'   => '_cs_objective_heading',
		'gc_cs_objective_intro'     => '_cs_objective_intro',
		'gc_cs_objective_list'      => '_cs_objective_list',
		'gc_cs_objective_image'     => '_cs_objective_image',
		'gc_cs_execution_subtitle'  => '_cs_execution_subtitle',
		'gc_cs_execution_heading'   => '_cs_execution_heading',
		'gc_cs_execution_text'      => '_cs_execution_text',
		'gc_cs_steps_list'          => '_cs_steps_list',
		'gc_cs_four_box_heading'    => '_cs_four_box_heading',
		'gc_cs_four_box_items'      => '_cs_four_box_items',
		'gc_cs_outcome_heading'     => '_cs_outcome_heading',
		'gc_cs_outcome_text'        => '_cs_outcome_text',
		'gc_cs_video_url'           => '_cs_video_url',
		'gc_cs_video_thumbnail'     => '_cs_video_thumbnail',
		'gc_cs_large_image'         => '_cs_large_image',
	);

	foreach ( $fields as $field => $meta_key ) {
		if ( isset( $_POST[ $field ] ) ) {
			$value = $_POST[ $field ];
			if ( is_array( $value ) ) {
				$value = array_map( 'sanitize_text_field', $value );
			} else {
				$value = wp_kses_post( $value );
			}
			update_post_meta( $post_id, $meta_key, $value );
		}
	}
}
add_action( 'save_post_case_study', 'gc_case_study_save_meta' );
