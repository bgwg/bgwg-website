<?php
/**
 * Interactive Experience CPT
 * Fixed version - no white screen
 */

if (!defined('ABSPATH')) exit;

/*--------------------------------------------------------------
# Register Custom Post Type
--------------------------------------------------------------*/
function gc_register_interactive_exp_cpt() {

    $labels = [
        'name'               => __('Interactive Experiences','greencard'),
        'singular_name'      => __('Interactive Experience','greencard'),
        'menu_name'          => __('Experiences','greencard'),
        'add_new'            => __('Add New','greencard'),
        'add_new_item'       => __('Add New Interactive Experience','greencard'),
        'edit_item'          => __('Edit Interactive Experience','greencard'),
        'new_item'           => __('New Interactive Experience','greencard'),
        'all_items'          => __('All Experiences','greencard'),
        'view_item'          => __('View Experience','greencard'),
        'search_items'       => __('Search Experiences','greencard'),
        'not_found'          => __('No experiences found','greencard'),
        'not_found_in_trash' => __('No experiences found in Trash','greencard'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'show_in_nav_menus'  => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-lightbulb',
        'supports'           => ['title','editor','thumbnail'],
        'has_archive'        => true,
        'rewrite'            => ['slug'=>'experience','with_front'=>false],
        'menu_position'      => 21,
        'capability_type'    => 'post',
    ];

    register_post_type('interactive_exp', $args);
}
add_action('init','gc_register_interactive_exp_cpt');

/*--------------------------------------------------------------
# Add Meta Boxes
--------------------------------------------------------------*/
function gc_exp_add_meta_boxes() {

    add_meta_box(
        'gc_exp_hero',
        __('Banner Section','greencard'),
        'gc_exp_hero_callback',
        'interactive_exp',
        'normal',
        'high'
    );

    add_meta_box(
        'gc_exp_deploy',
        __('What We Deploy','greencard'),
        'gc_exp_deploy_callback',
        'interactive_exp',
        'normal',
        'default'
    );

    add_meta_box(
        'gc_exp_why',
        __('Why It Works','greencard'),
        'gc_exp_why_callback',
        'interactive_exp',
        'normal',
        'default'
    );

    add_meta_box(
        'gc_exp_cta',
        __('CTA Footer','greencard'),
        'gc_exp_cta_callback',
        'interactive_exp',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'gc_exp_add_meta_boxes');

/*--------------------------------------------------------------
# Helper function to safely get meta
--------------------------------------------------------------*/
function gc_exp_get_meta($post_id, $key, $default = '') {
    $value = get_post_meta($post_id, $key, true);
    return $value === '' ? $default : $value;
}

/*--------------------------------------------------------------
# Banner / Hero Meta Box
--------------------------------------------------------------*/
function gc_exp_hero_callback($post) {

    wp_nonce_field('gc_exp_save','gc_exp_nonce');

    $bg   = gc_exp_get_meta($post->ID,'_exp_banner_bg');
    $h1   = gc_exp_get_meta($post->ID,'_exp_h1');
    $h3   = gc_exp_get_meta($post->ID,'_exp_h3');
    $text = gc_exp_get_meta($post->ID,'_exp_intro');
    $btn  = gc_exp_get_meta($post->ID,'_exp_btn_text');
    $url  = gc_exp_get_meta($post->ID,'_exp_btn_url');
    $btn2  = gc_exp_get_meta($post->ID,'_exp_btn_text2');
    $url2  = gc_exp_get_meta($post->ID,'_exp_btn_url2');

    $shorttext = gc_exp_get_meta($post->ID,'_exp_shorttext');
    ?>

    <p><strong>Banner Background Image</strong></p>
    <img id="exp_bg_preview" src="<?php echo esc_url($bg); ?>" style="max-width:150px;display:block;margin-bottom:5px;">
    <input type="hidden" name="exp_banner_bg" id="exp_banner_bg" value="<?php echo esc_url($bg); ?>">
    <button type="button" class="button gc-upload-btn" data-target="exp_banner_bg" data-preview="exp_bg_preview">Upload Image</button>

    <p><label>Heading (H1)</label></p>
    <input type="text" class="widefat" name="exp_h1" value="<?php echo esc_attr($h1); ?>">

    <p><label>Card Short Description</label></p>
    <textarea class="widefat" name="exp_shorttext" rows="4"><?php echo esc_textarea($shorttext); ?></textarea>

    <p><label>Sub Heading (H3)</label></p>
    <textarea class="widefat" name="exp_h3" rows="3" placeholder="<span>type highlighted text</span> other test"><?php echo esc_textarea($h3); ?></textarea>
    <!-- <input type="text" class="widefat" name="exp_h3" value="<?php //echo esc_attr($h3); ?>"> -->

    <p><label>Description</label></p>
    <textarea class="widefat" name="exp_intro" rows="4"><?php echo esc_textarea($text); ?></textarea>

    <p><label>Button Text</label></p>
    <input type="text" class="widefat" name="exp_btn_text" value="<?php echo esc_attr($btn); ?>">

    <p><label>Button URL</label></p>
    <input type="text" class="widefat" name="exp_btn_url" value="<?php echo esc_url($url); ?>">

    <p><label>Second Button Text</label></p>
    <input type="text" class="widefat" name="exp_btn_text2" value="<?php echo esc_attr($btn2); ?>">

    <p><label>Second Button URL</label></p>
    <input type="text" class="widefat" name="exp_btn_url2" value="<?php echo esc_url($url2); ?>">
<?php }

/*--------------------------------------------------------------
# What We Deploy (5 Cards)
--------------------------------------------------------------*/
function gc_exp_deploy_callback($post) {
    /* ===== Section Header Fields ===== */
    $section_title    = gc_exp_get_meta($post->ID, '_exp_deploy_title');
    $section_subtitle = gc_exp_get_meta($post->ID, '_exp_deploy_subtitle');


    $items = get_post_meta($post->ID,'_exp_deploy_items',true);
    
    if (!is_array($items)) {
        $items = [];
    }
    
    $items = array_pad($items, 5, ['icon'=>'','title'=>'','text'=>'']);
    ?>

    <!-- SECTION HEADER -->
    <div style="border:2px dashed #999;padding:12px;margin-bottom:20px;background:#fff;">
        <h3 style="margin-top:0;">Section Header</h3>

        <p>
            <label><strong>Section Title</strong></label>
        </p>
        <input type="text"
               class="widefat"
               name="exp_deploy_title"
               value="<?php echo esc_attr($section_title); ?>"
               placeholder='Why it <span>works</span>'>

        <p>
            <label><strong>Section Subtitle</strong></label>
        </p>
        <textarea class="widefat"
                  name="exp_deploy_subtitle"
                  rows="3"
                  placeholder="Simple to launch, built to engage, designed to convert."><?php
            echo esc_textarea($section_subtitle);
        ?></textarea>
    </div>
    <?php for ($i=0; $i<5; $i++): 
        $icon = isset($items[$i]['icon']) ? $items[$i]['icon'] : '';
        $title = isset($items[$i]['title']) ? $items[$i]['title'] : '';
        $text_val = isset($items[$i]['text']) ? $items[$i]['text'] : '';
    ?>
        <div style="border:1px solid #ccc;padding:10px;margin-bottom:10px;background:#f9f9f9;">
            <h4>Card <?php echo $i+1; ?></h4>

            <p><strong>Icon Image</strong></p>
            <img id="exp_deploy_preview_<?php echo $i; ?>" src="<?php echo esc_url($icon); ?>" style="max-width:80px;display:block;margin-bottom:5px;">
            
            <input type="hidden" name="exp_deploy_items[<?php echo $i; ?>][icon]" id="exp_deploy_icon_<?php echo $i; ?>" value="<?php echo esc_url($icon); ?>">

            <button type="button" class="button gc-upload-btn" data-target="exp_deploy_icon_<?php echo $i; ?>" data-preview="exp_deploy_preview_<?php echo $i; ?>">Upload Icon</button>

            <p><label>Title</label></p>
            <input type="text" class="widefat" name="exp_deploy_items[<?php echo $i; ?>][title]" placeholder="Card Title" value="<?php echo esc_attr($title); ?>">

            <p><label>Description</label></p>
            <textarea class="widefat" name="exp_deploy_items[<?php echo $i; ?>][text]" rows="3" placeholder="Card Description"><?php echo esc_textarea($text_val); ?></textarea>
        </div>
    <?php endfor; ?>
<?php }
/*--------------------------------------------------------------
# Why It Works
--------------------------------------------------------------*/
function gc_exp_why_callback($post) {

    // Section heading + subtitle
    $section_title_why    = get_post_meta($post->ID, '_exp_why_title', true); 
    $section_subtitle_why = get_post_meta($post->ID, '_exp_why_subtitle', true);

    // Why items
    $items = get_post_meta($post->ID,'_exp_why_items',true);
    if (!is_array($items)) {
        $items = [];
    }
    $items = array_pad($items, 4, '');

    // CTA button text + url
    $btn_text = get_post_meta($post->ID,'_exp_why_btn', true);
    $btn_url  = get_post_meta($post->ID,'_exp_why_btn_url', true);
    ?>

    <!-- SECTION HEADER -->
    <div style="border:1px solid #ddd;padding:12px;margin-bottom:15px;background:#f9f9f9;">
        <h4>Section Header</h4>

        <p><label>Section Title (H2)</label></p>
        <input
            type="text"
            class="widefat"
            name="exp_why_title"
            value="<?php echo esc_attr($section_title_why); ?>"
            placeholder='Why it <span>works</span>'>

        <p><label>Section Subtitle</label></p>
        <textarea
            class="widefat"
            name="exp_why_subtitle"
            rows="2"
            placeholder="Simple to launch, built to engage, designed to convert."><?php
                echo esc_textarea($section_subtitle_why);
            ?></textarea>
    </div>

    <!-- WHY IT WORKS POINTS -->
    <div style="border:1px solid #ccc;padding:12px;background:#fafafa;">
        <h4>Why It Works Points</h4>

        <?php for ($i=0; $i<4; $i++): ?>
            <p><label>Point <?php echo $i+1; ?></label></p>
            <input
                type="text"
                class="widefat"
                name="exp_why_items[]"
                value="<?php echo esc_attr($items[$i]); ?>"
                placeholder="Why it works point <?php echo $i+1; ?>">
        <?php endfor; ?>
    </div>

    <!-- CTA BUTTON -->
    <div style="margin-top:15px;border:1px solid #e1e1e1;padding-top:12px;background:#fafafa;">
        <h4>CTA Button</h4>

        <p><label>Button Text</label></p>
        <input
            type="text"
            class="widefat"
            name="exp_why_btn"
            value="<?php echo esc_attr($btn_text); ?>"
            placeholder="See Activations in Action">

        <p><label>Button URL</label></p>
        <input
            type="text"
            class="widefat"
            name="exp_why_btn_url"
            value="<?php echo esc_url($btn_url); ?>"
            placeholder="https://example.com/our-work">
    </div>

<?php }

/*--------------------------------------------------------------
# CTA Footer
--------------------------------------------------------------*/
function gc_exp_cta_callback($post) {

    $heading = gc_exp_get_meta($post->ID,'_exp_cta_heading');
    $text    = gc_exp_get_meta($post->ID,'_exp_cta_text');
    $linkedin= gc_exp_get_meta($post->ID,'_exp_linkedin');
    $instagram = gc_exp_get_meta($post->ID,'_exp_instagram');
    $youtube = gc_exp_get_meta($post->ID,'_exp_youtube');
    $email = gc_exp_get_meta($post->ID,'_exp_email');
    ?>

    <p><label>CTA Heading</label></p>
    <input type="text" class="widefat" name="exp_cta_heading" value="<?php echo esc_attr($heading); ?>" placeholder="Stay connected to the Engine.">

    <p><label>CTA Text</label></p>
    <textarea class="widefat" name="exp_cta_text" rows="3" placeholder="Follow BGWG for a behind-the-scenes look..."><?php echo esc_textarea($text); ?></textarea>

    <p><label>LinkedIn URL</label></p>
    <input type="text" class="widefat" name="exp_linkedin" value="<?php echo esc_url($linkedin); ?>" placeholder="https://linkedin.com/...">

    <p><label>Instagram URL</label></p>
    <input type="text" class="widefat" name="exp_instagram" value="<?php echo esc_url($instagram); ?>" placeholder="https://instagram.com/...">

    <p><label>Vimeo URL</label></p>
    <input type="text" class="widefat" name="exp_youtube" value="<?php echo esc_url($youtube); ?>" placeholder="https://vimeo.com/...">

    <p><label>Twitter URL</label></p>
    <input type="text" class="widefat" name="exp_email" value="<?php echo esc_attr($email); ?>" placeholder="x.com/...">
<?php }

/*--------------------------------------------------------------
# Save Meta
--------------------------------------------------------------*/
function gc_exp_save($post_id) {

    // Security checks
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (!isset($_POST['gc_exp_nonce']) || !wp_verify_nonce($_POST['gc_exp_nonce'],'gc_exp_save')) {
        return;
    }

    $fields = [
        'exp_deploy_title'    => '_exp_deploy_title',
        'exp_deploy_subtitle' => '_exp_deploy_subtitle',
        'exp_why_title'       => '_exp_why_title',
        'exp_why_subtitle'    => '_exp_why_subtitle',
        // 'exp_why_btn_text'     => '_exp_why_btn_text',

        'exp_banner_bg'    => '_exp_banner_bg',
        'exp_h1'           => '_exp_h1',
        'exp_h3'           => '_exp_h3',
        'exp_intro'        => '_exp_intro',
        'exp_shorttext'    => '_exp_shorttext',

        'exp_btn_text'     => '_exp_btn_text',
        'exp_btn_url'      => '_exp_btn_url',
        'exp_btn_text2'     => '_exp_btn_text2',
        'exp_btn_url2'      => '_exp_btn_url2',

        'exp_deploy_items' => '_exp_deploy_items',
        'exp_why_items'    => '_exp_why_items',
        'exp_why_btn'      => '_exp_why_btn',
        'exp_why_btn_url'  => '_exp_why_btn_url',

        'exp_cta_heading'  => '_exp_cta_heading',
        'exp_cta_text'     => '_exp_cta_text',
        'exp_linkedin'     => '_exp_linkedin',
        'exp_instagram'    => '_exp_instagram',
        'exp_youtube'      => '_exp_youtube',
        'exp_email'        => '_exp_email',
    ];

    foreach ($fields as $form => $meta) {
        if (!isset($_POST[$form])) {
            continue;
        }

        $value = $_POST[$form];

        // Handle arrays (deploy items, why items)
        if (is_array($value)) {
            $value = array_map(function($item) {
                if (is_array($item)) {
                    return array_map('wp_kses_post', $item);
                }
                return wp_kses_post($item);
            }, $value);
        } 
        // Handle URL fields
        elseif (strpos($form,'url') !== false || strpos($form,'linkedin') !== false || strpos($form,'instagram') !== false || strpos($form,'youtube') !== false || strpos($form,'bg') !== false) {
            $value = esc_url_raw($value);
        } 
        // Handle text fields
        else {
            $value = wp_kses_post($value);
        }

        update_post_meta($post_id, $meta, $value);
    }
}
add_action('save_post_interactive_exp', 'gc_exp_save');