<?php
/**
 * Single Case Study Template
 * 
 * @package WGBG
 * @version 2.0.0
 */

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();

        $post_id = get_the_ID();
        $template_dir = get_template_directory_uri();

        // ============================================
        // GET ALL META DATA
        // ============================================
        
        // Card & Hero
        $card_bg_image = get_post_meta($post_id, '_cs_card_bg_image', true);
        $banner_image = get_post_meta($post_id, '_cs_banner_image', true);
        $main_image = get_post_meta($post_id, '_cs_main_image', true);
        $banner_logo = get_post_meta($post_id, '_cs_banner_logo', true);
        $heading_prefix = get_post_meta($post_id, '_cs_heading_prefix', true);
        $heading_main = get_post_meta($post_id, '_cs_heading_main', true);
        $intro_text = get_post_meta($post_id, '_cs_intro_text', true);
        
        // Details
        $year = get_post_meta($post_id, '_cs_year', true);
        $technology = get_post_meta($post_id, '_cs_technology', true);
        
        // Objective
        $objective_sub = get_post_meta($post_id, '_cs_objective_subtitle', true);
        $objective_intro = get_post_meta($post_id, '_cs_objective_intro', true);
        $objective_list = get_post_meta($post_id, '_cs_objective_list', true);
        $objective_img = get_post_meta($post_id, '_cs_objective_image', true);
        $objective_extra_text = get_post_meta($post_id, '_cs_objective_extra_text', true);
        
        // Execution - Common
        $exec_sub = get_post_meta($post_id, '_cs_execution_subtitle', true);
        $use_extended_layout = get_post_meta($post_id, '_cs_use_extended_layout', true);
        
        // Execution - Extended Layout
        $solution_ext_title = get_post_meta($post_id, '_cs_solution_extended_title', true);
        $solution_ext_text = get_post_meta($post_id, '_cs_solution_extended_text', true);
        $solution_ext_img = get_post_meta($post_id, '_cs_solution_extended_image', true);
        
        // Execution - Box Layout
        $exec_head = get_post_meta($post_id, '_cs_execution_heading', true);
        $exec_text = get_post_meta($post_id, '_cs_execution_text', true);
        $step_items = get_post_meta($post_id, '_cs_steps_items', true);
        $four_head = get_post_meta($post_id, '_cs_four_box_heading', true);
        $four_items = get_post_meta($post_id, '_cs_four_box_items', true);
        
        // Outcome
        $outcome_head = get_post_meta($post_id, '_cs_outcome_heading', true);
        $outcome_text = get_post_meta($post_id, '_cs_outcome_text', true);
        $video_url = get_post_meta($post_id, '_cs_video_url', true);
        $video_thumb = get_post_meta($post_id, '_cs_video_thumbnail', true);
        $large_images = get_post_meta($post_id, '_cs_large_image', true);

        // ============================================
        // SET DEFAULT IMAGES
        // ============================================
        
        if (empty($card_bg_image)) {
            $card_bg_image = $template_dir . '/images/work-bg.png';
        }
        if (empty($banner_image)) {
            $banner_image = $template_dir . '/images/details-banner.png';
        }
        if (empty($main_image)) {
            $main_image = $template_dir . '/images/work1.png';
        }
        if (empty($objective_img)) {
            $objective_img = $template_dir . '/images/obj.png';
        }

        // ============================================
        // PROCESS DATA
        // ============================================
        
        // Process objective list (string to array)
        $objective_items = array_filter(array_map('trim', explode("\n", (string) $objective_list)));
        
        // Ensure step_items is an array
        if (!is_array($step_items)) {
            $step_items = [];
        }
        
        // Ensure four_items is an array
        if (!is_array($four_items)) {
            $four_items = [];
        }
        
        // Ensure large_images is an array
        if (!is_array($large_images)) {
            $large_images = [];
        }

        // ============================================
        // CHECK CONTENT AVAILABILITY
        // ============================================
        
        $has_box_layout_content = (
            !empty($exec_text) ||
            !empty($step_items) ||
            !empty($four_items)
        );

        $has_extended_layout_content = (
            !empty($solution_ext_title) ||
            !empty($solution_ext_text) ||
            !empty($solution_ext_img)
        );
        ?>

        <!-- ============================================ -->
        <!-- HERO BANNER SECTION -->
        <!-- ============================================ -->
        <div class="banner">
            <div id="bannerSlider" class="banner__slider">
                <div class="banner__content" style="background: url(<?php echo esc_url($banner_image); ?>) center center repeat; background-size: cover;">
                    <div class="container">
                        <div class="row banner-row">
                            <div class="col-md-12">
                                <div class="work-inner-details">
                                    <div class="work-photo">
                                        <img src="<?php echo esc_url($main_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                    </div>

                                    <div class="content-copy">
                                        <?php if ($banner_logo) : ?>
                                            <div class="banner-logo">
                                                <img src="<?php echo esc_url($banner_logo); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                            </div>
                                        <?php endif; ?>
                                        
                                        <h1>
                                            <?php if ($heading_prefix) : ?>
                                                <span><?php echo esc_html($heading_prefix); ?></span>
                                            <?php endif; ?>
                                            <?php echo esc_html($heading_main ? $heading_main : get_the_title()); ?>
                                        </h1>
                                        
                                        <?php if ($intro_text) : ?>
                                            <p><?php echo wp_kses_post(nl2br($intro_text)); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- DETAILS SECTION -->
        <!-- ============================================ -->
        <section class="details-content">
            <div class="container">
                <div class="date-year">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="details-col">
                                <p class="year-title"><?php _e('Year', 'wgbg'); ?></p>
                                <h6 class="year-date"><?php echo esc_html($year ? $year : date('Y')); ?></h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="details-col">
                                <p class="year-title"><?php _e('Technology', 'wgbg'); ?></p>
                                <h6 class="year-date"><?php echo esc_html($technology ? $technology : 'Custom Development'); ?></h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="details-col text-right">
                                <p class="year-title"><?php _e('Have a Project?', 'wgbg'); ?></p>
                                <h6 class="year-date">
                                    <a href="/contact">
                                        <span><?php _e('Build It With Us', 'wgbg'); ?></span>
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================ -->
                <!-- OBJECTIVE SECTION -->
                <!-- ============================================ -->
                <div class="objective-area">
                    <?php if ($objective_sub) : ?>
                        <h3><?php echo esc_html($objective_sub); ?></h3>
                    <?php endif; ?>
                    <h2><?php _e('A', 'wgbg'); ?> <span><?php _e('New Challenge', 'wgbg'); ?></span> <?php _e('For Us', 'wgbg'); ?></h2>
                    <?php if ($objective_intro) : ?>
                        <p><?php echo wp_kses_post(nl2br($objective_intro)); ?></p>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="objective-copy">
                            <?php if (!empty($objective_items)) : ?>
                                <ul>
                                    <?php foreach ($objective_items as $item) : ?>
                                        <li><?php echo esc_html($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            
                            <?php if ($objective_extra_text) : ?>
                                <p><?php echo wp_kses_post(nl2br($objective_extra_text)); ?></p>
                            <?php endif; ?>
                            
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="objective-img-box">
                            <img src="<?php echo esc_url($objective_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- EXECUTION SECTION (CONDITIONAL LAYOUT) -->
            <!-- ============================================ -->
            <div class="our-solutions">
                <div class="container">

                    <?php if ($use_extended_layout === '1' && $has_extended_layout_content) : ?>
                        
                        <!-- ============================================ -->
                        <!-- EXTENDED LAYOUT -->
                        <!-- ============================================ -->
                        <div class="area-with-img-box">
                            <div class="objective-area">
                                <?php if ($exec_sub) : ?>
                                    <h3><?php echo esc_html($exec_sub); ?></h3>
                                <?php endif; ?>
                                <h2><?php _e('Our', 'wgbg'); ?> <span><?php _e('Solution', 'wgbg'); ?></span></h2>
                                
                                <?php if ($solution_ext_title) : ?>
                                    <h4 class="extended-copy"><?php echo esc_html($solution_ext_title); ?></h4>
                                <?php endif; ?>

                                <?php if ($solution_ext_text) : ?>
                                    <p><?php echo wp_kses_post(nl2br($solution_ext_text)); ?></p>
                                <?php endif; ?>
                            </div>

                            <?php if ($solution_ext_img) : ?>
                                <div class="our-solution-extended">
                                    <div class="project-photo">
                                        <img src="<?php echo esc_url($solution_ext_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php elseif ($has_box_layout_content) : ?>
                        
                        <!-- ============================================ -->
                        <!-- BOX LAYOUT -->
                        <!-- ============================================ -->
                        <div class="area-with-box">
                            <div class="objective-area">
                                <?php if ($exec_sub) : ?>
                                    <h3><?php echo esc_html($exec_sub); ?></h3>
                                <?php endif; ?>
                                <h2><?php _e('Our', 'wgbg'); ?> <span><?php _e('Solution', 'wgbg'); ?></span></h2>

                                <?php if ($exec_text) : ?>
                                    <p><?php echo wp_kses_post(nl2br($exec_text)); ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- SOLUTION STEPS -->
                            <?php if (!empty($step_items)) : ?>
                                <div class="solution-box">
                                    <?php 
                                    $step_index = 1;
                                    foreach ($step_items as $step) :
                                        $title = isset($step['title']) ? trim($step['title']) : '';
                                        $desc = isset($step['desc']) ? trim($step['desc']) : '';

                                        // Skip if no title
                                        if (empty($title)) {
                                            continue;
                                        }
                                    ?>
                                        <div class="single-box">
                                            <span><?php echo esc_html($step_index); ?></span>
                                            <h2><?php echo esc_html($title); ?></h2>
                                            
                                            <div class="solution-box-hover">
                                                <h3><?php echo esc_html($title); ?></h3>
                                                <?php if (!empty($desc)) : ?>
                                                    <p><?php echo wp_kses_post($desc); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php 
                                        $step_index++;
                                    endforeach; 
                                    ?>
                                </div>
                            <?php endif; ?>

                            <!-- FOUR BOXES -->
                            <?php if (!empty($four_items)) : ?>
                                <div class="objective-area">
                                    <h2>
                                        <?php echo $four_head ? esc_html($four_head) : __('How We', 'wgbg'); ?> 
                                        <span><?php _e('Exceeded Expectations', 'wgbg'); ?></span>
                                    </h2>
                                </div>

                                <div class="four-boxs">
                                    <?php foreach ($four_items as $four_item) : ?>
                                        <?php if (!empty($four_item)) : ?>
                                            <div class="each-four">
                                                <p><?php echo wp_kses_post(nl2br($four_item)); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                </div>
            </div>

            <!-- ============================================ -->
            <!-- OUTCOME SECTION -->
            <!-- ============================================ -->
            <?php if ($outcome_text || ($video_url && $video_thumb)) : ?>
                <div class="the-outcome">
                    <div class="container">
                        <div class="objective-area">
                            <h2><?php _e('The', 'wgbg'); ?> <span><?php _e('Outcome', 'wgbg'); ?></span></h2>
                            <?php if ($outcome_text) : ?>
                                <p><?php echo wp_kses_post(nl2br($outcome_text)); ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- VIDEO PLAYER -->
                        <?php if ($video_url && $video_thumb) : ?>
                            <div class="video-section">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="video-container" id="videoContainer">
                                                <div class="video-thum" id="videoThumb">
                                                    <img class="thumbnails" src="<?php echo esc_url($video_thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                                </div>
                                                
                                                <!-- Play Button -->
                                                <button class="play-button" id="playButton">
                                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/play-icon.png" alt="<?php _e('Play', 'wgbg'); ?>">
                                                </button>

                                                <?php
                                                // YouTube Video
                                                if (preg_match('/(youtube\.com|youtu\.be)/i', $video_url)) {
                                                    preg_match('/(youtu\.be\/|v=|embed\/)([^&\?]+)/', $video_url, $matches);
                                                    $video_id = $matches[2] ?? '';
                                                    if ($video_id) :
                                                ?>
                                                    <iframe
                                                        class="video iframe-video"
                                                        data-src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?autoplay=1"
                                                        frameborder="0"
                                                        allow="autoplay; encrypted-media"
                                                        allowfullscreen>
                                                    </iframe>
                                                <?php
                                                    endif;
                                                // Vimeo Video
                                                } elseif (preg_match('/vimeo\.com/i', $video_url)) {
                                                    preg_match('/vimeo\.com\/(\d+)/', $video_url, $matches);
                                                    $video_id = $matches[1] ?? '';
                                                    if ($video_id) :
                                                ?>
                                                    <iframe
                                                        class="video iframe-video"
                                                        data-src="https://player.vimeo.com/video/<?php echo esc_attr($video_id); ?>?autoplay=1"
                                                        frameborder="0"
                                                        allow="autoplay; fullscreen"
                                                        allowfullscreen>
                                                    </iframe>
                                                <?php
                                                    endif;
                                                // Direct Video File
                                                } else {
                                                ?>
                                                    <video class="video html-video" preload="metadata" controls>
                                                        <source src="<?php echo esc_url($video_url); ?>">
                                                        <?php _e('Your browser does not support the video tag.', 'wgbg'); ?>
                                                    </video>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ============================================ -->
            <!-- IMAGE GALLERY SLIDER -->
            <!-- ============================================ -->
            <?php if (!empty($large_images)) : ?>
                <section class="gallary-photo">
                    <div id="gallarySlider" class="gallary-slider">
                        <?php foreach ($large_images as $img) : ?>
                            <div class="gallary-slide">
                                <div class="each-gallry">
                                    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- ============================================ -->
            <!-- PREV/NEXT NAVIGATION -->
            <!-- ============================================ -->
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            
            if ($prev_post || $next_post) :
            ?>
                <section class="next-prev-arrow">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-10 col-md-offset-1">
                                <div class="next-prev-inner">
                                    <div class="prev-case">
                                        <?php if ($prev_post) : ?>
                                            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="arrow-text d-flex align-items-center">
                                                <i class="fa-solid fa-arrow-left-long"></i>
                                                <span class="uner-line"><?php _e('Prev Case', 'wgbg'); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="next-case">
                                        <?php if ($next_post) : ?>
                                            <a href="<?php echo get_permalink($next_post->ID); ?>" class="arrow-text d-flex align-items-center case-nav-next">
                                                <span class="uner-line"><?php _e('Next Case', 'wgbg'); ?></span>
                                                <i class="fa-solid fa-arrow-right-long"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

        </section>

        <!-- ============================================ -->
        <!-- CTA FOOTER -->
        <!-- ============================================ -->
        <div class="cta-footer">
            <div class="container">
                <div class="cta-footer-inner">
                    <div class="cta-content">
                        <h3><?php _e('Need help with a project?', 'wgbg'); ?> <span><?php _e("LET'S TALK!", 'wgbg'); ?></span></h3>
                        <p><?php _e('Every great project begins with a conversation. Share your vision with us, and together we\'ll turn your ideas into something remarkable.', 'wgbg'); ?></p>
                        <a href="/book-a-call/" class="btn btn-primary" style="padding-left: 15px; padding-right: 15px;">
                            <?php _e("Let's Discuss Your Project", 'wgbg'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
    endwhile;
endif;
?>

<!-- ============================================ -->
<!-- JAVASCRIPT -->
<!-- ============================================ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // VIDEO PLAYER FUNCTIONALITY
    // ============================================
    const playButton = document.getElementById('playButton');
    const videoThumb = document.getElementById('videoThumb');
    const videoContainer = document.getElementById('videoContainer');

    if (playButton && videoContainer) {
        playButton.addEventListener('click', function() {
            const iframe = videoContainer.querySelector('.iframe-video');
            const htmlVideo = videoContainer.querySelector('.html-video');

            if (iframe) {
                // Load iframe source and start autoplay
                iframe.src = iframe.getAttribute('data-src');
                videoThumb.style.display = 'none';
                playButton.style.display = 'none';
                iframe.style.display = 'block';
            } else if (htmlVideo) {
                // Play HTML5 video
                htmlVideo.play();
                videoThumb.style.display = 'none';
                playButton.style.display = 'none';
                htmlVideo.style.display = 'block';
            }
        });
    }

    // ============================================
    // SLICK SLIDER FOR GALLERY
    // ============================================
    // if (window.jQuery && jQuery.fn.slick) {
    //     jQuery('#gallarySlider').slick({
    //         arrows: true,
    //         dots: true,
    //         infinite: true,
    //         slidesToShow: 1,
    //         slidesToScroll: 1,
    //         adaptiveHeight: true,
    //         autoplay: false,
    //         prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
    //         nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
    //         responsive: [
    //             {
    //                 breakpoint: 768,
    //                 settings: {
    //                     arrows: false,
    //                     dots: true
    //                 }
    //             }
    //         ]
    //     });
    // }
});
</script>

<?php
get_footer();