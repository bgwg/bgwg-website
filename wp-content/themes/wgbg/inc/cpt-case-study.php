<?php
/**
 * Register Case Study CPT
 */

if (!defined('ABSPATH')) exit;


function gc_register_case_study_cpt() {
    $labels = [
        'name' => __('Case Studies','wgbg'),
        'singular_name' => __('Case Study','wgbg'),
        'add_new' => __('Add New','wgbg'),
        'add_new_item' => __('Add New Case Study','wgbg'),
        'edit_item' => __('Edit Case Study','wgbg'),
        'new_item' => __('New Case Study','wgbg'),
        'all_items' => __('All Case Studies','wgbg'),
        'view_item' => __('View Case Study','wgbg'),
        'search_items' => __('Search Case Studies','wgbg'),
        'not_found' => __('No case studies found','wgbg'),
        'not_found_in_trash' => __('No case studies found in Trash','wgbg'),
        'menu_name' => __('Case Studies','wgbg')
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
        __('Case Study Card','wgbg'),
        'gc_case_study_card_meta_box_callback',
        'case_study',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gc_case_study_hero',
        __('Case Study Hero','wgbg'),
        'gc_case_study_hero_meta_box_callback',
        'case_study',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gc_case_study_details',
        __('Case Study Details (Year & Technology)','wgbg'),
        'gc_case_study_details_meta_box_callback',
        'case_study',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gc_case_study_objective',
        __('Objective Section','wgbg'),
        'gc_case_study_objective_meta_box_callback',
        'case_study',
        'normal',
        'default'
    );
    
    add_meta_box(
        'gc_case_study_execution',
        __('Execution Section','wgbg'),
        'gc_case_study_execution_meta_box_callback',
        'case_study',
        'normal',
        'default'
    );
    
    add_meta_box(
        'gc_case_study_outcome',
        __('Outcome Section','wgbg'),
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
    $feature_image = gc_case_study_get_meta($post->ID,'_cs_feature_image');

    ?>

    <p>
        <label>Card Background Image</label><br>
        <img id="gc_card_bg_preview" src="<?php echo esc_url($card_bg_image); ?>" style="max-width:150px; display:block; margin-bottom:5px;" />
        <input type="hidden" name="gc_cs_card_bg_image" id="gc_cs_card_bg_image" value="<?php echo esc_attr($card_bg_image); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_card_bg_image" data-preview="gc_card_bg_preview">Upload / Select Image</button>
    </p>
    <p>
        <label><strong>Case Study Feature Image</strong></label><br>
        <img id="gc_feature_image_preview"
            src="<?php echo esc_url($feature_image); ?>"
            style="max-width:150px; display:block; margin-bottom:5px;" />

        <input type="hidden"
            name="gc_cs_feature_image"
            id="gc_cs_feature_image"
            value="<?php echo esc_attr($feature_image); ?>" />

        <button type="button"
                class="button gc-upload-btn"
                data-target="gc_cs_feature_image"
                data-preview="gc_feature_image_preview">
            Upload / Select Image
        </button>

        <br><small>This image will be used as the Case Study featured/thumbnail image.</small>
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
 * Execution Meta Box - UPDATED WITH CONDITIONAL FIELDS
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

    <style>
        .gc-field-group {
            background: #f9f9f9;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #2271b1;
        }
        .gc-extended-fields {
            display: none;
            background: #e7f5ff;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #0073aa;
        }
        .gc-extended-fields.active {
            display: block;
        }
        .gc-box-fields {
            display: block;
            background: #fff8e7;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #f0b323;
        }
        .gc-box-fields.hidden {
            display: none;
        }
    </style>

    <!-- CHECKBOX TO TOGGLE LAYOUT -->
    <p style="margin-top:20px; padding: 10px; background: #fff; border: 1px solid #ccc;">
        <label>
            <input type="checkbox" name="gc_cs_use_extended_layout" id="gc_cs_use_extended_layout" value="1"
                <?php checked( $use_extended_layout, '1' ); ?> />
            <strong>Use Extended Layout (Image + Text)</strong>
        </label>
        <br>
        <small>
            If checked, the extended solution layout will be used. Otherwise, the box layout (Steps + Four Boxes) will be displayed.
        </small>
    </p>

    <!-- ALWAYS VISIBLE FIELD -->
    <div class="gc-field-group">
        <p><label><strong>Execution Subtitle</strong></label></p>
        <input type="text" class="widefat" name="gc_cs_execution_subtitle" value="<?php echo esc_attr($subtitle); ?>" />
        <small>This appears above "Our Solution" heading</small>
    </div>

    <!-- EXTENDED LAYOUT FIELDS - Show when checkbox is checked -->
    <div class="gc-extended-fields <?php echo ($use_extended_layout === '1') ? 'active' : ''; ?>" id="gc_extended_fields">
        <h3 style="margin-top: 0;">📝 Extended Layout Fields</h3>
        
        <div>
            <p><label><strong>Our Solution Third Title</strong></label></p>
            <input type="text" class="widefat" name="gc_cs_solution_extended_title" value="<?php echo esc_attr($solution_ext_title); ?>" />
            <small>Subtitle text that appears below "Our Solution"</small>
        </div>
        
        <div style="margin-top: 15px;">
            <p><label><strong>Our Solution Extra Text</strong></label></p>
            <textarea class="widefat" name="gc_cs_solution_extended_text" rows="5"><?php echo esc_textarea($solution_ext_text); ?></textarea>
            <small>Main description text for the solution</small>
        </div>
        
        <div style="margin-top: 15px;">
            <p><label><strong>Solution Big Photo</strong></label></p>
            <img id="solution_extended_image" src="<?php echo esc_url($solution_ext_img); ?>" style="max-width:150px; display:block; margin-bottom:5px;" />
            <input type="hidden" name="gc_cs_solution_extended_image" id="gc_cs_solution_extended_image" value="<?php echo esc_attr($solution_ext_img); ?>" />
            <button type="button" class="button gc-upload-btn" data-target="gc_cs_solution_extended_image" data-preview="solution_extended_image">Upload / Select Image</button>
            <br><small>Large image shown in the solution section</small>
        </div>
    </div>

    <!-- BOX LAYOUT FIELDS - Show when checkbox is NOT checked -->
    <div class="gc-box-fields <?php echo ($use_extended_layout === '1') ? 'hidden' : ''; ?>" id="gc_box_fields">
        <h3 style="margin-top: 0;">📦 Box Layout Fields</h3>
        
        <div>
            <p><label><strong>Execution Heading</strong></label></p>
            <input type="text" class="widefat" name="gc_cs_execution_heading" value="<?php echo esc_attr($heading); ?>" />
        </div>

        <div style="margin-top: 15px;">
            <p><label><strong>Execution Text</strong></label></p>
            <textarea class="widefat" name="gc_cs_execution_text" rows="4"><?php echo esc_textarea($text); ?></textarea>
        </div>

        <div style="margin-top: 15px;">
            <p><label><strong>Steps (one per line)</strong></label></p>
            <textarea class="widefat" name="gc_cs_steps_list" rows="4"><?php echo esc_textarea($steps); ?></textarea>
            <small>Enter each step on a new line. These will be numbered automatically.</small>
        </div>

        <div style="margin-top: 15px;">
            <p><label><strong>Four Box Heading</strong></label></p>
            <input type="text" class="widefat" name="gc_cs_four_box_heading" value="<?php echo esc_attr($four_head); ?>" />
        </div>

        <?php
        if (!is_array($four_items)) {
            // Convert string to array if needed
            $four_items = array_filter(array_map('trim', explode("\n", (string)$four_items)));
            // Ensure we have 4 slots
            $four_items = array_pad($four_items, 4, '');
        }
        ?>

        <div style="margin-top: 15px;">
            <p><strong>Four Boxes Content</strong></p>
            <?php for ($i = 0; $i < 4; $i++): ?>
                <p>
                    <label>Box <?php echo $i + 1; ?></label>
                    <textarea
                        class="widefat"
                        name="gc_cs_four_box_items[]"
                        rows="3"
                        placeholder="Enter content for box <?php echo $i + 1; ?>"><?php
                            echo esc_textarea($four_items[$i] ?? '');
                    ?></textarea>
                </p>
            <?php endfor; ?>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Toggle fields based on checkbox state
        $('#gc_cs_use_extended_layout').on('change', function() {
            if ($(this).is(':checked')) {
                $('#gc_extended_fields').addClass('active');
                $('#gc_box_fields').addClass('hidden');
            } else {
                $('#gc_extended_fields').removeClass('active');
                $('#gc_box_fields').removeClass('hidden');
            }
        });
    });
    </script>
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

    // FIX: Convert four box items array to newline-separated string
    if (isset($_POST['gc_cs_four_box_items']) && is_array($_POST['gc_cs_four_box_items'])) {
        $_POST['gc_cs_four_box_items'] = implode("\n", array_filter($_POST['gc_cs_four_box_items']));
    }

    $fields = [
        'gc_cs_card_bg_image' => '_cs_card_bg_image',
        'gc_cs_banner_image'  => '_cs_banner_image',
        'gc_cs_feature_image' => '_cs_feature_image',
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

