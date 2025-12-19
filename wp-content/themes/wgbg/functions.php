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
    wp_enqueue_style('main-style.css', get_template_directory_uri() . '/style.css', [], time());

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
 * Register Case Study CPT
 */
function gc_register_case_study_cpt() {
    $labels = [
        'name' => __('Case Studies','greencard'),
        'singular_name' => __('Case Study','greencard'),
        'add_new' => __('Add New','greencard'),
        'add_new_item' => __('Add New Case Study','greencard'),
        'edit_item' => __('Edit Case Study','greencard'),
        'new_item' => __('New Case Study','greencard'),
        'all_items' => __('All Case Studies','greencard'),
        'view_item' => __('View Case Study','greencard'),
        'search_items' => __('Search Case Studies','greencard'),
        'not_found' => __('No case studies found','greencard'),
        'not_found_in_trash' => __('No case studies found in Trash','greencard'),
        'menu_name' => __('Case Studies','greencard')
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-portfolio',
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'rewrite' => ['slug' => 'case-study', 'with_front' => false],
    ];

    register_post_type('case_study', $args);
}
add_action('init', 'gc_register_case_study_cpt');

/**
 * Add Meta Boxes
 */
function gc_case_study_add_meta_boxes() {
    add_meta_box(
        'gc_case_study_card',
        __('Case Study Card','greencard'),
        'gc_case_study_card_meta_box_callback',
        'case_study',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gc_case_study_hero',
        __('Case Study Hero','greencard'),
        'gc_case_study_hero_meta_box_callback',
        'case_study',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gc_case_study_details',
        __('Case Study Details (Year & Technology)','greencard'),
        'gc_case_study_details_meta_box_callback',
        'case_study',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gc_case_study_objective',
        __('Objective Section','greencard'),
        'gc_case_study_objective_meta_box_callback',
        'case_study',
        'normal',
        'default'
    );
    
    add_meta_box(
        'gc_case_study_execution',
        __('Execution Section','greencard'),
        'gc_case_study_execution_meta_box_callback',
        'case_study',
        'normal',
        'default'
    );
    
    add_meta_box(
        'gc_case_study_outcome',
        __('Outcome Section','greencard'),
        'gc_case_study_outcome_meta_box_callback',
        'case_study',
        'normal',
        'default'
    );

}
add_action('add_meta_boxes', 'gc_case_study_add_meta_boxes');

/**
 * Get meta helper
 */
function gc_case_study_get_meta($post_id, $key, $default='') {
    $value = get_post_meta($post_id, $key, true);
    return $value === '' ? $default : $value;
}

/**
 * case study page card Meta Box
 */
function gc_case_study_card_meta_box_callback($post) {
    wp_nonce_field('gc_case_study_save_meta','gc_case_study_meta_nonce');

    $card_bg_image  = gc_case_study_get_meta($post->ID,'_cs_card_bg_image'); 
    ?>

    <p>
        <label>Card Background Image</label><br>
        <img id="gc_card_bg_preview" src="<?php echo esc_url($card_bg_image); ?>" style="max-width:150px; display:block; margin-bottom:5px;" />
        <input type="hidden" name="gc_cs_card_bg_image" id="gc_cs_card_bg_image" value="<?php echo esc_attr($card_bg_image); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_card_bg_image" data-preview="gc_card_bg_preview">Upload / Select Image</button>
    </p>
    <?php
}

/**
 * Hero Meta Box
 */
function gc_case_study_hero_meta_box_callback($post) {
    $banner_logo    = gc_case_study_get_meta($post->ID,'_cs_banner_logo');
    $banner_image   = gc_case_study_get_meta($post->ID,'_cs_banner_image');
    $main_image     = gc_case_study_get_meta($post->ID,'_cs_main_image');
    $heading_prefix = gc_case_study_get_meta($post->ID,'_cs_heading_prefix');
    $heading_main   = gc_case_study_get_meta($post->ID,'_cs_heading_main');
    $intro_text     = gc_case_study_get_meta($post->ID,'_cs_intro_text');
    ?>

    <p>
        <label>Banner Logo</label><br>
        <img id="gc_banner_logo" src="<?php echo esc_url($banner_logo); ?>" style="max-width:150px; display:block; margin-bottom:5px;" />
        <input type="hidden" name="gc_cs_banner_logo" id="gc_cs_banner_logo" value="<?php echo esc_attr($banner_logo); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_banner_logo" data-preview="gc_banner_logo">Upload / Select Image</button>
    </p>

    <p>
        <label>Banner Image</label><br>
        <img id="gc_banner_preview" src="<?php echo esc_url($banner_image); ?>" style="max-width:150px; display:block; margin-bottom:5px;" />
        <input type="hidden" name="gc_cs_banner_image" id="gc_cs_banner_image" value="<?php echo esc_attr($banner_image); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_banner_image" data-preview="gc_banner_preview">Upload / Select Image</button>
    </p>

    <p>
        <label>Main Image</label><br>
        <img id="gc_main_image_preview" src="<?php echo esc_url($main_image); ?>" style="max-width:150px; display:block; margin-bottom:5px;" />
        <input type="hidden" name="gc_cs_main_image" id="gc_cs_main_image" value="<?php echo esc_attr($main_image); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_main_image" data-preview="gc_main_image_preview">Upload / Select Image</button>
    </p>

    <p><label>Heading Prefix</label></p>
    <input type="text" class="widefat" name="gc_cs_heading_prefix" value="<?php echo esc_attr($heading_prefix); ?>" />

    <p><label>Main Heading</label></p>
    <input type="text" class="widefat" name="gc_cs_heading_main" value="<?php echo esc_attr($heading_main); ?>" />

    <p><label>Intro Text</label></p>
    <textarea class="widefat" name="gc_cs_intro_text" rows="4"><?php echo esc_textarea($intro_text); ?></textarea>
    <?php
}

/**
 * Details Meta Box
 */
function gc_case_study_details_meta_box_callback($post) {
    $year = gc_case_study_get_meta($post->ID,'_cs_year');
    $technology = gc_case_study_get_meta($post->ID,'_cs_technology');
    ?>
    <p><label>Year</label></p>
    <input type="text" class="widefat" name="gc_cs_year" value="<?php echo esc_attr($year); ?>" />

    <p><label>Technology</label></p>
    <input type="text" class="widefat" name="gc_cs_technology" value="<?php echo esc_attr($technology); ?>" />
    <?php
}

/**
 * Objective Meta Box
 */
function gc_case_study_objective_meta_box_callback($post){
    $subtitle = gc_case_study_get_meta($post->ID,'_cs_objective_subtitle');
    $intro    = gc_case_study_get_meta($post->ID,'_cs_objective_intro');
    $list     = gc_case_study_get_meta($post->ID,'_cs_objective_list');
    $image    = gc_case_study_get_meta($post->ID,'_cs_objective_image');
    $extra_text = gc_case_study_get_meta($post->ID,'_cs_objective_extra_text');

    ?>
    <p><label>Objective Subtitle</label></p>
    <input type="text" class="widefat" name="gc_cs_objective_subtitle" value="<?php echo esc_attr($subtitle); ?>" />

    <p><label>Objective Intro</label></p>
    <textarea class="widefat" name="gc_cs_objective_intro" rows="4"><?php echo esc_textarea($intro); ?></textarea>

    <p><label>Objective List (one per line)</label></p>
    <textarea class="widefat" name="gc_cs_objective_list" rows="5"><?php echo esc_textarea($list); ?></textarea>

    <p><label>Objective Extra Text</label></p>
    <textarea class="widefat" name="gc_cs_objective_extra_text" rows="5"><?php echo esc_textarea($extra_text); ?></textarea>

    <p>
        <label>Objective Image</label><br>
        <img id="gc_objective_preview" src="<?php echo esc_url($image); ?>" style="max-width:150px; display:block; margin-bottom:5px;" />
        <input type="hidden" name="gc_cs_objective_image" id="gc_cs_objective_image" value="<?php echo esc_attr($image); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_objective_image" data-preview="gc_objective_preview">Upload / Select Image</button>
    </p>
    <?php
}

/**
 * Execution Meta Box
 */
function gc_case_study_execution_meta_box_callback($post){
    $subtitle = gc_case_study_get_meta($post->ID,'_cs_execution_subtitle');
    $heading  = gc_case_study_get_meta($post->ID,'_cs_execution_heading');
    $text     = gc_case_study_get_meta($post->ID,'_cs_execution_text');
    $steps    = gc_case_study_get_meta($post->ID,'_cs_steps_list');
    $four_head= gc_case_study_get_meta($post->ID,'_cs_four_box_heading');
    $four_items = gc_case_study_get_meta($post->ID,'_cs_four_box_items');

    $solution_ext_title = gc_case_study_get_meta($post->ID,'_cs_solution_extended_title');
    $solution_ext_text = gc_case_study_get_meta($post->ID,'_cs_solution_extended_text');
    $solution_ext_img = gc_case_study_get_meta($post->ID,'_cs_solution_extended_image');

    $use_extended_layout = gc_case_study_get_meta($post->ID, '_cs_use_extended_layout', '0');

    


    ?>

    <p style="margin-top:20px;">
        <label>
            <input type="checkbox" name="gc_cs_use_extended_layout" value="1"
                <?php checked( $use_extended_layout, '1' ); ?> />
            <strong>Use Extended Layout (Image + Text)</strong>
        </label>
        <br>
        <small>
            If checked, the extended solution layout will be used instead of the box layout.
        </small>
    </p>

    <p><label>Execution Subtitle</label></p>
    <input type="text" class="widefat" name="gc_cs_execution_subtitle" value="<?php echo esc_attr($subtitle); ?>" />

    <p><label>Execution Heading</label></p>
    <input type="text" class="widefat" name="gc_cs_execution_heading" value="<?php echo esc_attr($heading); ?>" />

    <p><label>Execution Text</label></p>
    <textarea class="widefat" name="gc_cs_execution_text" rows="4"><?php echo esc_textarea($text); ?></textarea>

    <p><label>Steps (one per line)</label></p>
    <textarea class="widefat" name="gc_cs_steps_list" rows="4"><?php echo esc_textarea($steps); ?></textarea>

    <p><label>Four Box Heading</label></p>
    <input type="text" class="widefat" name="gc_cs_four_box_heading" value="<?php echo esc_attr($four_head); ?>" />

    <?php
    if (!is_array($four_items)) {
        $four_items = ['', '', '', ''];
    }
    ?>

    <p><strong>Four Boxes Content</strong></p>

    <?php for ($i = 0; $i < 4; $i++): ?>
        <p>
            <label>Box <?php echo $i + 1; ?></label>
            <textarea
                class="widefat"
                name="gc_cs_four_box_items[]"
                rows="3"
                placeholder="<b>text copy</b> this is our main idea."><?php
                    echo esc_textarea($four_items[$i] ?? '');
            ?></textarea>
        </p>
    <?php endfor; ?>
    
    <div>
        <p><label>Our Solution third title</label></p>
        <input type="text" class="widefat" name="gc_cs_solution_extended_title" value="<?php echo esc_attr($solution_ext_title); ?>" />
    </div>
    <div>
        <p><label>Our Solution Extra text</label></p>
        <textarea type="text" class="widefat" name="gc_cs_solution_extended_text" value="<?php echo esc_textarea($solution_ext_text); ?>"></textarea>
    </div>
    <div>
        <label>Solution Big Photo</label><br>
        <img id="solution_extended_image" src="<?php echo esc_url($solution_ext_img); ?>" style="max-width:150px; display:block; margin-bottom:5px;" />
        <input type="hidden" name="gc_cs_solution_extended_image" id="gc_cs_solution_extended_image" value="<?php echo esc_attr($solution_ext_img); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_solution_extended_image" data-preview="solution_extended_image">Upload / Select Image</button>
    </div>
 

    <?php
}

/**
 * Outcome Meta Box
 */
function gc_case_study_outcome_meta_box_callback($post){
    $heading = gc_case_study_get_meta($post->ID,'_cs_outcome_heading');
    $text    = gc_case_study_get_meta($post->ID,'_cs_outcome_text');
    $video   = gc_case_study_get_meta($post->ID,'_cs_video_url');
    $thumb   = gc_case_study_get_meta($post->ID,'_cs_video_thumbnail');
    $large   = gc_case_study_get_meta($post->ID,'_cs_large_image');
    ?>
    <p><label>Outcome Heading</label></p>
    <input type="text" class="widefat" name="gc_cs_outcome_heading" value="<?php echo esc_attr($heading); ?>" />

    <p><label>Outcome Text</label></p>
    <textarea class="widefat" name="gc_cs_outcome_text" rows="4"><?php echo esc_textarea($text); ?></textarea>

    <p>
        <label>Video Thumbnail</label><br>
        <img id="gc_video_thumb_preview" src="<?php echo esc_url($thumb); ?>" style="max-width:150px; display:block; margin-bottom:5px;" />
        <input type="hidden" name="gc_cs_video_thumbnail" id="gc_cs_video_thumbnail" value="<?php echo esc_attr($thumb); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_video_thumbnail" data-preview="gc_video_thumb_preview">Upload / Select Image</button>
    </p>

    <p><label>Video URL</label></p>
    <input type="text" class="widefat" name="gc_cs_video_url" value="<?php echo esc_attr($video); ?>" />

    <p>
        <label>Large Images (Gallery for Slick Slider)</label><br>
        <div id="gc_large_images_container">
            <?php
            $large_images = gc_case_study_get_meta($post->ID,'_cs_large_image');
            if (!empty($large_images) && is_array($large_images)) {
                foreach ($large_images as $img) {
                    echo '<div class="gc-large-image-item" style="margin-bottom:5px;">
                            <img src="'.esc_url($img).'" style="max-width:150px; display:block; margin-bottom:2px;">
                            <input type="hidden" name="gc_cs_large_image[]" value="'.esc_url($img).'">
                            <button type="button" class="button gc-remove-image-btn">Remove</button>
                          </div>';
                }
            }
            ?>
        </div>
        <button type="button" class="button" id="gc_add_large_image_btn">Add Images</button>
    </p>

    <?php
}

/**
 * Save Meta
 */
function gc_case_study_save_meta($post_id){
    // Security checks
    if (!isset($_POST['gc_case_study_meta_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['gc_case_study_meta_nonce'], 'gc_case_study_save_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    // SAVE EXTENDED LAYOUT CHECKBOX
    $use_extended = isset($_POST['gc_cs_use_extended_layout']) ? '1' : '0';
    update_post_meta($post_id, '_cs_use_extended_layout', $use_extended);

    $fields = [
        'gc_cs_card_bg_image' => '_cs_card_bg_image',
        'gc_cs_banner_image'  => '_cs_banner_image',
        'gc_cs_banner_logo'   => '_cs_banner_logo',
        'gc_cs_main_image'    => '_cs_main_image',
        'gc_cs_heading_prefix'=> '_cs_heading_prefix',
        'gc_cs_heading_main'  => '_cs_heading_main',
        'gc_cs_intro_text'    => '_cs_intro_text',
        'gc_cs_year'          => '_cs_year',
        'gc_cs_technology'    => '_cs_technology',
        'gc_cs_objective_subtitle'=> '_cs_objective_subtitle',
        'gc_cs_objective_heading' => '_cs_objective_heading',
        'gc_cs_objective_intro'   => '_cs_objective_intro',
        'gc_cs_objective_list'    => '_cs_objective_list',
        'gc_cs_objective_image'   => '_cs_objective_image',
        'gc_cs_execution_subtitle'=> '_cs_execution_subtitle',
        'gc_cs_execution_heading' => '_cs_execution_heading',
        'gc_cs_execution_text'    => '_cs_execution_text',
        'gc_cs_steps_list'        => '_cs_steps_list',
        'gc_cs_four_box_heading'  => '_cs_four_box_heading',
        'gc_cs_four_box_items'    => '_cs_four_box_items',
        'gc_cs_outcome_heading'   => '_cs_outcome_heading',
        'gc_cs_outcome_text'      => '_cs_outcome_text',
        'gc_cs_video_url'         => '_cs_video_url',
        'gc_cs_video_thumbnail'   => '_cs_video_thumbnail',
        'gc_cs_large_image'       => '_cs_large_image',
        'gc_cs_objective_extra_text' => '_cs_objective_extra_text',

        'gc_cs_solution_extended_title' => '_cs_solution_extended_title',
        'gc_cs_solution_extended_text'  => '_cs_solution_extended_text',
        'gc_cs_solution_extended_image' => '_cs_solution_extended_image',


        
    ];

    foreach ($fields as $field => $meta_key) {
        if (!isset($_POST[$field])) {
            continue;
        }

        $value = $_POST[$field];

        // Array fields (four boxes, gallery, lists)
        if (is_array($value)) {
            $value = array_map('wp_kses_post', $value);
        }
        // URL fields
        elseif (strpos($field, 'image') !== false || strpos($field, 'url') !== false) {
            $value = esc_url_raw($value);
        }
        // Text / HTML fields
        else {
            $value = wp_kses_post($value);
        }

        update_post_meta($post_id, $meta_key, $value);
    }
}
add_action('save_post_case_study', 'gc_case_study_save_meta');