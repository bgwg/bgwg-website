<?php
/**
 * Case Study Custom Post Type
 * Production Ready Version
 * 
 * @package WGBG
 * @version 2.0.0
 */

if (!defined('ABSPATH')) exit;

/**
 * Register Case Study CPT
 */
function gc_register_case_study_cpt() {
    $labels = [
        'name' => __('Case Studies', 'wgbg'),
        'singular_name' => __('Case Study', 'wgbg'),
        'add_new' => __('Add New', 'wgbg'),
        'add_new_item' => __('Add New Case Study', 'wgbg'),
        'edit_item' => __('Edit Case Study', 'wgbg'),
        'new_item' => __('New Case Study', 'wgbg'),
        'all_items' => __('All Case Studies', 'wgbg'),
        'view_item' => __('View Case Study', 'wgbg'),
        'search_items' => __('Search Case Studies', 'wgbg'),
        'not_found' => __('No case studies found', 'wgbg'),
        'not_found_in_trash' => __('No case studies found in Trash', 'wgbg'),
        'menu_name' => __('Case Studies', 'wgbg')
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
        __('Case Study Card', 'wgbg'),
        'gc_case_study_card_meta_box_callback',
        'case_study',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gc_case_study_hero',
        __('Case Study Hero', 'wgbg'),
        'gc_case_study_hero_meta_box_callback',
        'case_study',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gc_case_study_details',
        __('Case Study Details (Year & Technology)', 'wgbg'),
        'gc_case_study_details_meta_box_callback',
        'case_study',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gc_case_study_objective',
        __('Objective Section', 'wgbg'),
        'gc_case_study_objective_meta_box_callback',
        'case_study',
        'normal',
        'default'
    );
    
    add_meta_box(
        'gc_case_study_execution',
        __('Execution Section', 'wgbg'),
        'gc_case_study_execution_meta_box_callback',
        'case_study',
        'normal',
        'default'
    );
    
    add_meta_box(
        'gc_case_study_outcome',
        __('Outcome Section', 'wgbg'),
        'gc_case_study_outcome_meta_box_callback',
        'case_study',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'gc_case_study_add_meta_boxes');

/**
 * Enqueue Admin Scripts
 */
function gc_case_study_admin_scripts($hook) {
    global $post_type;
    
    if (('post.php' === $hook || 'post-new.php' === $hook) && 'case_study' === $post_type) {
        wp_enqueue_media();
        wp_enqueue_script(
            'gc-case-study-admin',
            get_template_directory_uri() . '/js/admin/case-study-meta.js',
            ['jquery'],
            '2.0.0',
            true
        );
        
        wp_enqueue_style(
            'gc-case-study-admin',
            get_template_directory_uri() . '/css/admin/case-study-meta.css',
            [],
            '2.0.0'
        );
    }
}
add_action('admin_enqueue_scripts', 'gc_case_study_admin_scripts');

/**
 * Get meta helper with default value
 */
function gc_case_study_get_meta($post_id, $key, $default = '') {
    $value = get_post_meta($post_id, $key, true);
    return ($value === '' || $value === false) ? $default : $value;
}

/**
 * Case Study Card Meta Box
 */
function gc_case_study_card_meta_box_callback($post) {
    wp_nonce_field('gc_case_study_save_meta', 'gc_case_study_meta_nonce');

    $card_bg_image = gc_case_study_get_meta($post->ID, '_cs_card_bg_image'); 
    $feature_image = gc_case_study_get_meta($post->ID, '_cs_feature_image');
    ?>

    <div class="gc-meta-field">
        <label><strong><?php _e('Card Background Image', 'wgbg'); ?></strong></label>
        <div class="gc-image-preview-wrapper">
            <img id="gc_card_bg_preview" 
                 src="<?php echo esc_url($card_bg_image); ?>" 
                 style="<?php echo $card_bg_image ? '' : 'display:none;'; ?> max-width:150px; margin:10px 0;" />
        </div>
        <input type="hidden" 
               name="gc_cs_card_bg_image" 
               id="gc_cs_card_bg_image" 
               value="<?php echo esc_attr($card_bg_image); ?>" />
        <button type="button" 
                class="button gc-upload-btn" 
                data-target="gc_cs_card_bg_image" 
                data-preview="gc_card_bg_preview">
            <?php _e('Upload / Select Image', 'wgbg'); ?>
        </button>
        <?php if ($card_bg_image): ?>
            <button type="button" 
                    class="button gc-remove-single-image" 
                    data-target="gc_cs_card_bg_image" 
                    data-preview="gc_card_bg_preview">
                <?php _e('Remove Image', 'wgbg'); ?>
            </button>
        <?php endif; ?>
        <p class="description"><?php _e('Background image for the case study card on archive pages.', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Case Study Feature Image', 'wgbg'); ?></strong></label>
        <div class="gc-image-preview-wrapper">
            <img id="gc_feature_image_preview"
                 src="<?php echo esc_url($feature_image); ?>"
                 style="<?php echo $feature_image ? '' : 'display:none;'; ?> max-width:150px; margin:10px 0;" />
        </div>
        <input type="hidden"
               name="gc_cs_feature_image"
               id="gc_cs_feature_image"
               value="<?php echo esc_attr($feature_image); ?>" />
        <button type="button"
                class="button gc-upload-btn"
                data-target="gc_cs_feature_image"
                data-preview="gc_feature_image_preview">
            <?php _e('Upload / Select Image', 'wgbg'); ?>
        </button>
        <?php if ($feature_image): ?>
            <button type="button" 
                    class="button gc-remove-single-image" 
                    data-target="gc_cs_feature_image" 
                    data-preview="gc_feature_image_preview">
                <?php _e('Remove Image', 'wgbg'); ?>
            </button>
        <?php endif; ?>
        <p class="description"><?php _e('This image will be used as the case study thumbnail.', 'wgbg'); ?></p>
    </div>
    <?php
}

/**
 * Hero Meta Box
 */
function gc_case_study_hero_meta_box_callback($post) {
    $banner_logo = gc_case_study_get_meta($post->ID, '_cs_banner_logo');
    $banner_image = gc_case_study_get_meta($post->ID, '_cs_banner_image');
    $main_image = gc_case_study_get_meta($post->ID, '_cs_main_image');
    $heading_prefix = gc_case_study_get_meta($post->ID, '_cs_heading_prefix');
    $heading_main = gc_case_study_get_meta($post->ID, '_cs_heading_main');
    $intro_text = gc_case_study_get_meta($post->ID, '_cs_intro_text');
    ?>

    <div class="gc-meta-field">
        <label><strong><?php _e('Banner Logo', 'wgbg'); ?></strong></label>
        <div class="gc-image-preview-wrapper">
            <img id="gc_banner_logo_preview" 
                 src="<?php echo esc_url($banner_logo); ?>" 
                 style="<?php echo $banner_logo ? '' : 'display:none;'; ?> max-width:150px; margin:10px 0;" />
        </div>
        <input type="hidden" name="gc_cs_banner_logo" id="gc_cs_banner_logo" value="<?php echo esc_attr($banner_logo); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_banner_logo" data-preview="gc_banner_logo_preview">
            <?php _e('Upload / Select Image', 'wgbg'); ?>
        </button>
        <?php if ($banner_logo): ?>
            <button type="button" class="button gc-remove-single-image" data-target="gc_cs_banner_logo" data-preview="gc_banner_logo_preview">
                <?php _e('Remove Image', 'wgbg'); ?>
            </button>
        <?php endif; ?>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Banner Background Image', 'wgbg'); ?></strong></label>
        <div class="gc-image-preview-wrapper">
            <img id="gc_banner_preview" 
                 src="<?php echo esc_url($banner_image); ?>" 
                 style="<?php echo $banner_image ? '' : 'display:none;'; ?> max-width:150px; margin:10px 0;" />
        </div>
        <input type="hidden" name="gc_cs_banner_image" id="gc_cs_banner_image" value="<?php echo esc_attr($banner_image); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_banner_image" data-preview="gc_banner_preview">
            <?php _e('Upload / Select Image', 'wgbg'); ?>
        </button>
        <?php if ($banner_image): ?>
            <button type="button" class="button gc-remove-single-image" data-target="gc_cs_banner_image" data-preview="gc_banner_preview">
                <?php _e('Remove Image', 'wgbg'); ?>
            </button>
        <?php endif; ?>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Main Hero Image', 'wgbg'); ?></strong></label>
        <div class="gc-image-preview-wrapper">
            <img id="gc_main_image_preview" 
                 src="<?php echo esc_url($main_image); ?>" 
                 style="<?php echo $main_image ? '' : 'display:none;'; ?> max-width:150px; margin:10px 0;" />
        </div>
        <input type="hidden" name="gc_cs_main_image" id="gc_cs_main_image" value="<?php echo esc_attr($main_image); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_main_image" data-preview="gc_main_image_preview">
            <?php _e('Upload / Select Image', 'wgbg'); ?>
        </button>
        <?php if ($main_image): ?>
            <button type="button" class="button gc-remove-single-image" data-target="gc_cs_main_image" data-preview="gc_main_image_preview">
                <?php _e('Remove Image', 'wgbg'); ?>
            </button>
        <?php endif; ?>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Heading Prefix', 'wgbg'); ?></strong></label>
        <input type="text" class="widefat" name="gc_cs_heading_prefix" value="<?php echo esc_attr($heading_prefix); ?>" />
        <p class="description"><?php _e('Small text above the main heading (e.g., "Featured Project")', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Main Heading', 'wgbg'); ?></strong></label>
        <input type="text" class="widefat" name="gc_cs_heading_main" value="<?php echo esc_attr($heading_main); ?>" />
        <p class="description"><?php _e('Primary hero heading text', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Intro Text', 'wgbg'); ?></strong></label>
        <textarea class="widefat" name="gc_cs_intro_text" rows="4"><?php echo esc_textarea($intro_text); ?></textarea>
        <p class="description"><?php _e('Introduction paragraph for the case study', 'wgbg'); ?></p>
    </div>
    <?php
}

/**
 * Details Meta Box
 */
function gc_case_study_details_meta_box_callback($post) {
    $year = gc_case_study_get_meta($post->ID, '_cs_year');
    $technology = gc_case_study_get_meta($post->ID, '_cs_technology');
    ?>
    <div class="gc-meta-field">
        <label><strong><?php _e('Year', 'wgbg'); ?></strong></label>
        <input type="text" class="widefat" name="gc_cs_year" value="<?php echo esc_attr($year); ?>" placeholder="2024" />
        <p class="description"><?php _e('Year the project was completed', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Technology', 'wgbg'); ?></strong></label>
        <input type="text" class="widefat" name="gc_cs_technology" value="<?php echo esc_attr($technology); ?>" placeholder="React, Node.js, AWS" />
        <p class="description"><?php _e('Technologies used in the project (comma-separated)', 'wgbg'); ?></p>
    </div>
    <?php
}

/**
 * Objective Meta Box
 */
function gc_case_study_objective_meta_box_callback($post) {
    $subtitle = gc_case_study_get_meta($post->ID, '_cs_objective_subtitle');
    $intro = gc_case_study_get_meta($post->ID, '_cs_objective_intro');
    $list = gc_case_study_get_meta($post->ID, '_cs_objective_list');
    $image = gc_case_study_get_meta($post->ID, '_cs_objective_image');
    $extra_text = gc_case_study_get_meta($post->ID, '_cs_objective_extra_text');
    ?>

    <div class="gc-meta-field">
        <label><strong><?php _e('Objective Subtitle', 'wgbg'); ?></strong></label>
        <input type="text" class="widefat" name="gc_cs_objective_subtitle" value="<?php echo esc_attr($subtitle); ?>" />
        <p class="description"><?php _e('Subtitle for the objective section', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Objective Introduction', 'wgbg'); ?></strong></label>
        <textarea class="widefat" name="gc_cs_objective_intro" rows="4"><?php echo esc_textarea($intro); ?></textarea>
        <p class="description"><?php _e('Main introduction text for the objective', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Objective List', 'wgbg'); ?></strong></label>
        <textarea class="widefat" name="gc_cs_objective_list" rows="5"><?php echo esc_textarea($list); ?></textarea>
        <p class="description"><?php _e('Key objectives - one per line', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Additional Context', 'wgbg'); ?></strong></label>
        <textarea class="widefat" name="gc_cs_objective_extra_text" rows="5"><?php echo esc_textarea($extra_text); ?></textarea>
        <p class="description"><?php _e('Extra text to provide more context about the objective', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Objective Image', 'wgbg'); ?></strong></label>
        <div class="gc-image-preview-wrapper">
            <img id="gc_objective_preview" 
                 src="<?php echo esc_url($image); ?>" 
                 style="<?php echo $image ? '' : 'display:none;'; ?> max-width:150px; margin:10px 0;" />
        </div>
        <input type="hidden" name="gc_cs_objective_image" id="gc_cs_objective_image" value="<?php echo esc_attr($image); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_objective_image" data-preview="gc_objective_preview">
            <?php _e('Upload / Select Image', 'wgbg'); ?>
        </button>
        <?php if ($image): ?>
            <button type="button" class="button gc-remove-single-image" data-target="gc_cs_objective_image" data-preview="gc_objective_preview">
                <?php _e('Remove Image', 'wgbg'); ?>
            </button>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Execution Meta Box
 */
function gc_case_study_execution_meta_box_callback($post) {
    $subtitle = gc_case_study_get_meta($post->ID, '_cs_execution_subtitle');
    $heading = gc_case_study_get_meta($post->ID, '_cs_execution_heading');
    $text = gc_case_study_get_meta($post->ID, '_cs_execution_text');
    $four_head = gc_case_study_get_meta($post->ID, '_cs_four_box_heading');
    $four_items = gc_case_study_get_meta($post->ID, '_cs_four_box_items', []);
    
    $solution_ext_title = gc_case_study_get_meta($post->ID, '_cs_solution_extended_title');
    $solution_ext_text = gc_case_study_get_meta($post->ID, '_cs_solution_extended_text');
    $solution_ext_img = gc_case_study_get_meta($post->ID, '_cs_solution_extended_image');
    
    $step_items = gc_case_study_get_meta($post->ID, '_cs_steps_items', []);
    $use_extended_layout = gc_case_study_get_meta($post->ID, '_cs_use_extended_layout', '0');
    
    // Ensure arrays
    if (!is_array($four_items)) {
        $four_items = [];
    }
    if (!is_array($step_items)) {
        $step_items = [];
    }
    
    // Pad arrays
    $four_items = array_pad($four_items, 4, '');
    $step_items = array_pad($step_items, 5, ['title' => '', 'desc' => '']);
    ?>

    <div class="gc-layout-toggle">
        <label>
            <input type="checkbox" 
                   name="gc_cs_use_extended_layout" 
                   id="gc_cs_use_extended_layout" 
                   value="1"
                   <?php checked($use_extended_layout, '1'); ?> />
            <strong><?php _e('Use Extended Layout (Image + Text)', 'wgbg'); ?></strong>
        </label>
        <p class="description">
            <?php _e('If checked, the extended solution layout will be used. Otherwise, the box layout (Steps + Four Boxes) will be displayed.', 'wgbg'); ?>
        </p>
    </div>

    <div class="gc-meta-field gc-field-group">
        <label><strong><?php _e('Execution Subtitle', 'wgbg'); ?></strong></label>
        <input type="text" class="widefat" name="gc_cs_execution_subtitle" value="<?php echo esc_attr($subtitle); ?>" />
        <p class="description"><?php _e('This appears above "Our Solution" heading', 'wgbg'); ?></p>
    </div>

    <div class="gc-extended-fields <?php echo ($use_extended_layout === '1') ? 'active' : ''; ?>" id="gc_extended_fields">
        <h3><?php _e('📝 Extended Layout Fields', 'wgbg'); ?></h3>
        
        <div class="gc-meta-field">
            <label><strong><?php _e('Solution Third Title', 'wgbg'); ?></strong></label>
            <input type="text" class="widefat" name="gc_cs_solution_extended_title" value="<?php echo esc_attr($solution_ext_title); ?>" />
            <p class="description"><?php _e('Subtitle text that appears below "Our Solution"', 'wgbg'); ?></p>
        </div>
        
        <div class="gc-meta-field">
            <label><strong><?php _e('Solution Description', 'wgbg'); ?></strong></label>
            <textarea class="widefat" name="gc_cs_solution_extended_text" rows="5"><?php echo esc_textarea($solution_ext_text); ?></textarea>
            <p class="description"><?php _e('Main description text for the solution', 'wgbg'); ?></p>
        </div>
        
        <div class="gc-meta-field">
            <label><strong><?php _e('Solution Image', 'wgbg'); ?></strong></label>
            <div class="gc-image-preview-wrapper">
                <img id="solution_extended_image_preview" 
                     src="<?php echo esc_url($solution_ext_img); ?>" 
                     style="<?php echo $solution_ext_img ? '' : 'display:none;'; ?> max-width:150px; margin:10px 0;" />
            </div>
            <input type="hidden" name="gc_cs_solution_extended_image" id="gc_cs_solution_extended_image" value="<?php echo esc_attr($solution_ext_img); ?>" />
            <button type="button" class="button gc-upload-btn" data-target="gc_cs_solution_extended_image" data-preview="solution_extended_image_preview">
                <?php _e('Upload / Select Image', 'wgbg'); ?>
            </button>
            <?php if ($solution_ext_img): ?>
                <button type="button" class="button gc-remove-single-image" data-target="gc_cs_solution_extended_image" data-preview="solution_extended_image_preview">
                    <?php _e('Remove Image', 'wgbg'); ?>
                </button>
            <?php endif; ?>
            <p class="description"><?php _e('Large image shown in the solution section', 'wgbg'); ?></p>
        </div>
    </div>

    <div class="gc-box-fields <?php echo ($use_extended_layout === '1') ? 'hidden' : ''; ?>" id="gc_box_fields">
        <h3><?php _e('📦 Box Layout Fields', 'wgbg'); ?></h3>
        
        <div class="gc-meta-field">
            <label><strong><?php _e('Execution Heading', 'wgbg'); ?></strong></label>
            <input type="text" class="widefat" name="gc_cs_execution_heading" value="<?php echo esc_attr($heading); ?>" />
        </div>

        <div class="gc-meta-field">
            <label><strong><?php _e('Execution Text', 'wgbg'); ?></strong></label>
            <textarea class="widefat" name="gc_cs_execution_text" rows="4"><?php echo esc_textarea($text); ?></textarea>
        </div>

        <div class="gc-meta-field">
            <label><strong><?php _e('Solution Steps', 'wgbg'); ?></strong></label>
            <p class="description"><?php _e('Define up to 5 steps with titles and hover descriptions', 'wgbg'); ?></p>
            
            <?php for ($i = 0; $i < 5; $i++): ?>
                <div class="gc-step-item">
                    <h4><?php printf(__('Step %d', 'wgbg'), $i + 1); ?></h4>
                    
                    <p>
                        <label><?php _e('Step Title', 'wgbg'); ?></label>
                        <input type="text" 
                               class="widefat" 
                               name="gc_cs_steps_items[<?php echo $i; ?>][title]"
                               value="<?php echo esc_attr($step_items[$i]['title'] ?? ''); ?>"
                               placeholder="<?php _e('Step title', 'wgbg'); ?>">
                    </p>

                    <p>
                        <label><?php _e('Step Description (Hover)', 'wgbg'); ?></label>
                        <textarea class="widefat"
                                  name="gc_cs_steps_items[<?php echo $i; ?>][desc]"
                                  rows="3"
                                  placeholder="<?php _e('Step description shown on hover', 'wgbg'); ?>"><?php echo esc_textarea($step_items[$i]['desc'] ?? ''); ?></textarea>
                    </p>
                </div>
            <?php endfor; ?>
        </div>

        <div class="gc-meta-field">
            <label><strong><?php _e('Four Box Heading', 'wgbg'); ?></strong></label>
            <input type="text" class="widefat" name="gc_cs_four_box_heading" value="<?php echo esc_attr($four_head); ?>" />
            <p class="description"><?php _e('Heading above the four content boxes', 'wgbg'); ?></p>
        </div>

        <div class="gc-meta-field">
            <label><strong><?php _e('Four Boxes Content', 'wgbg'); ?></strong></label>
            <?php for ($i = 0; $i < 4; $i++): ?>
                <p>
                    <label><?php printf(__('Box %d Content', 'wgbg'), $i + 1); ?></label>
                    <textarea class="widefat"
                              name="gc_cs_four_box_items[]"
                              rows="3"
                              placeholder="<?php printf(__('Enter content for box %d', 'wgbg'), $i + 1); ?>"><?php echo esc_textarea($four_items[$i] ?? ''); ?></textarea>
                </p>
            <?php endfor; ?>
        </div>
    </div>
    <?php
}

/**
 * Outcome Meta Box
 */
function gc_case_study_outcome_meta_box_callback($post) {
    $heading = gc_case_study_get_meta($post->ID, '_cs_outcome_heading');
    $text = gc_case_study_get_meta($post->ID, '_cs_outcome_text');
    $video = gc_case_study_get_meta($post->ID, '_cs_video_url');
    $thumb = gc_case_study_get_meta($post->ID, '_cs_video_thumbnail');
    $large = gc_case_study_get_meta($post->ID, '_cs_large_image', []);
    
    if (!is_array($large)) {
        $large = [];
    }
    ?>

    <div class="gc-meta-field">
        <label><strong><?php _e('Outcome Heading', 'wgbg'); ?></strong></label>
        <input type="text" class="widefat" name="gc_cs_outcome_heading" value="<?php echo esc_attr($heading); ?>" />
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Outcome Text', 'wgbg'); ?></strong></label>
        <textarea class="widefat" name="gc_cs_outcome_text" rows="4"><?php echo esc_textarea($text); ?></textarea>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Video Thumbnail', 'wgbg'); ?></strong></label>
        <div class="gc-image-preview-wrapper">
            <img id="gc_video_thumb_preview" 
                 src="<?php echo esc_url($thumb); ?>" 
                 style="<?php echo $thumb ? '' : 'display:none;'; ?> max-width:150px; margin:10px 0;" />
        </div>
        <input type="hidden" name="gc_cs_video_thumbnail" id="gc_cs_video_thumbnail" value="<?php echo esc_attr($thumb); ?>" />
        <button type="button" class="button gc-upload-btn" data-target="gc_cs_video_thumbnail" data-preview="gc_video_thumb_preview">
            <?php _e('Upload / Select Image', 'wgbg'); ?>
        </button>
        <?php if ($thumb): ?>
            <button type="button" class="button gc-remove-single-image" data-target="gc_cs_video_thumbnail" data-preview="gc_video_thumb_preview">
                <?php _e('Remove Image', 'wgbg'); ?>
            </button>
        <?php endif; ?>
        <p class="description"><?php _e('Thumbnail for the video player', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Video URL', 'wgbg'); ?></strong></label>
        <input type="url" class="widefat" name="gc_cs_video_url" value="<?php echo esc_attr($video); ?>" placeholder="https://www.youtube.com/watch?v=..." />
        <p class="description"><?php _e('YouTube or Vimeo video URL', 'wgbg'); ?></p>
    </div>

    <div class="gc-meta-field">
        <label><strong><?php _e('Large Images (Gallery)', 'wgbg'); ?></strong></label>
        <p class="description"><?php _e('Add multiple images for a slider/gallery', 'wgbg'); ?></p>
        
        <div id="gc_large_images_container" class="gc-gallery-container">
            <?php if (!empty($large)): ?>
                <?php foreach ($large as $img_url): ?>
                    <div class="gc-gallery-item">
                        <img src="<?php echo esc_url($img_url); ?>" style="max-width:100px;">
                        <input type="hidden" name="gc_cs_large_image[]" value="<?php echo esc_url($img_url); ?>">
                        <button type="button" class="button button-small gc-remove-gallery-image">
                            <?php _e('Remove', 'wgbg'); ?>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <button type="button" class="button" id="gc_add_large_image_btn">
            <?php _e('Add Images', 'wgbg'); ?>
        </button>
    </div>
    <?php
}

/**
 * Save Meta
 */
function gc_case_study_save_meta($post_id) {
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
    
    // Save extended layout checkbox
    $use_extended = isset($_POST['gc_cs_use_extended_layout']) ? '1' : '0';
    update_post_meta($post_id, '_cs_use_extended_layout', $use_extended);

    // Handle steps items with proper sanitization
    if (isset($_POST['gc_cs_steps_items']) && is_array($_POST['gc_cs_steps_items'])) {
        $steps = [];
        foreach ($_POST['gc_cs_steps_items'] as $step) {
            $steps[] = [
                'title' => sanitize_text_field($step['title'] ?? ''),
                'desc'  => wp_kses_post($step['desc'] ?? '')
            ];
        }
        update_post_meta($post_id, '_cs_steps_items', $steps);
    }

    // Handle four box items as array
    if (isset($_POST['gc_cs_four_box_items']) && is_array($_POST['gc_cs_four_box_items'])) {
        $four_items = array_map('wp_kses_post', $_POST['gc_cs_four_box_items']);
        update_post_meta($post_id, '_cs_four_box_items', $four_items);
    }

    // Handle gallery images
    if (isset($_POST['gc_cs_large_image']) && is_array($_POST['gc_cs_large_image'])) {
        $gallery = array_map('esc_url_raw', $_POST['gc_cs_large_image']);
        update_post_meta($post_id, '_cs_large_image', $gallery);
    } else {
        delete_post_meta($post_id, '_cs_large_image');
    }

    // Define field mappings
    $fields = [
        'gc_cs_card_bg_image'              => '_cs_card_bg_image',
        'gc_cs_banner_image'               => '_cs_banner_image',
        'gc_cs_feature_image'              => '_cs_feature_image',
        'gc_cs_banner_logo'                => '_cs_banner_logo',
        'gc_cs_main_image'                 => '_cs_main_image',
        'gc_cs_heading_prefix'             => '_cs_heading_prefix',
        'gc_cs_heading_main'               => '_cs_heading_main',
        'gc_cs_intro_text'                 => '_cs_intro_text',
        'gc_cs_year'                       => '_cs_year',
        'gc_cs_technology'                 => '_cs_technology',
        'gc_cs_objective_subtitle'         => '_cs_objective_subtitle',
        'gc_cs_objective_intro'            => '_cs_objective_intro',
        'gc_cs_objective_list'             => '_cs_objective_list',
        'gc_cs_objective_image'            => '_cs_objective_image',
        'gc_cs_objective_extra_text'       => '_cs_objective_extra_text',
        'gc_cs_execution_subtitle'         => '_cs_execution_subtitle',
        'gc_cs_execution_heading'          => '_cs_execution_heading',
        'gc_cs_execution_text'             => '_cs_execution_text',
        'gc_cs_four_box_heading'           => '_cs_four_box_heading',
        'gc_cs_outcome_heading'            => '_cs_outcome_heading',
        'gc_cs_outcome_text'               => '_cs_outcome_text',
        'gc_cs_video_url'                  => '_cs_video_url',
        'gc_cs_video_thumbnail'            => '_cs_video_thumbnail',
        'gc_cs_solution_extended_title'    => '_cs_solution_extended_title',
        'gc_cs_solution_extended_text'     => '_cs_solution_extended_text',
        'gc_cs_solution_extended_image'    => '_cs_solution_extended_image',
    ];

    // Save individual fields
    foreach ($fields as $field => $meta_key) {
        if (!isset($_POST[$field])) {
            continue;
        }

        $value = $_POST[$field];

        // Sanitize based on field type
        if (strpos($field, 'image') !== false || strpos($field, 'url') !== false) {
            // URL fields
            $value = esc_url_raw($value);
        } elseif (strpos($field, 'text') !== false || strpos($field, 'intro') !== false || strpos($field, 'list') !== false) {
            // Text/HTML fields
            $value = wp_kses_post($value);
        } else {
            // Regular text fields
            $value = sanitize_text_field($value);
        }

        update_post_meta($post_id, $meta_key, $value);
    }
}
add_action('save_post_case_study', 'gc_case_study_save_meta');