<?php
/**
 * Single Template: Interactive Experience
 * Template for displaying single interactive_experience posts
 */

get_header();

while (have_posts()) : the_post();

$post_id = get_the_ID();

/* Banner Section */
$banner_bg   = get_post_meta($post_id, '_exp_banner_bg', true);
$h1          = get_post_meta($post_id, '_exp_h1', true);
$h3          = get_post_meta($post_id, '_exp_h3', true);
$intro       = get_post_meta($post_id, '_exp_intro', true);
$btn_text    = get_post_meta($post_id, '_exp_btn_text', true);
$btn_url     = get_post_meta($post_id, '_exp_btn_url', true);
$btn_text2   = get_post_meta($post_id, '_exp_btn_text2', true);
$btn_url2    = get_post_meta($post_id, '_exp_btn_url2', true);

/* What We Deploy Section */
$section_title    = get_post_meta($post_id, '_exp_deploy_title', true);
$section_subtitle = get_post_meta($post_id, '_exp_deploy_subtitle', true);
$deploy_items     = get_post_meta($post_id, '_exp_deploy_items', true);

/* Why It Works Section */
$section_title_why    = get_post_meta($post_id, '_exp_why_title', true);
$section_subtitle_why = get_post_meta($post_id, '_exp_why_subtitle', true);

$why_items   = get_post_meta($post_id, '_exp_why_items', true);
$why_btn     = get_post_meta($post_id, '_exp_why_btn', true);
$why_btn_url = get_post_meta($post_id, '_exp_why_btn_url', true);

/* CTA Footer Section */
$cta_heading = get_post_meta($post_id, '_exp_cta_heading', true);
$cta_text    = get_post_meta($post_id, '_exp_cta_text', true);
$linkedin    = get_post_meta($post_id, '_exp_linkedin', true);
$instagram   = get_post_meta($post_id, '_exp_instagram', true);
$youtube     = get_post_meta($post_id, '_exp_youtube', true);
$email       = get_post_meta($post_id, '_exp_email', true);

/* Fallback values */
if (empty($h1)) $h1 = get_the_title();
if (empty($h3)) $h3 = '<span>Custom Interactive</span> Experiences';
if (empty($intro)) $intro = 'Some ideas can\'t be templated. For those moments, we design and build custom interactive experiences that blend storytelling, technology, and emotion — crafted specifically for your brand, your audience, and your goals.';
if (empty($btn_text)) $btn_text = 'Book a Brainstorm';
if (empty($btn_url)) $btn_url = '/book-a-call/';
if (empty($btn_text2)) $btn_text2 = '';
if (empty($btn_url2)) $btn_url2 = '';
if (empty($why_btn)) $why_btn = 'See Activations in Action';
if (empty($cta_heading)) $cta_heading = '<span>Stay connected</span> to the Engine.';
if (empty($cta_text)) $cta_text = 'Follow BGWG for a behind-the-scenes look at how experiences are made. <b>Reels. Stories. Insights.</b>';

// Default banner background
if (empty($banner_bg)) {
    $banner_bg = get_template_directory_uri() . '/images/banner.png';
}
?>

<!-- Banner Section -->
<div class="banner">
    <div id="bannerSlider" class="banner__slider">
        <div class="banner__content" style="background: url(<?php echo esc_url($banner_bg); ?>) center center no-repeat; background-size: cover;">
            <div class="container">
                <div class="row banner-row">
                    <div class="col-sm-12 text-center">
                        <div class="banner__content-main subpages">
                            <h1><?php echo wp_kses_post($h1); ?></h1>
                            <h3><?php echo wp_kses_post($h3); ?></h3>
                            <p class="banner__content-description">
                                <?php echo wp_kses_post($intro); ?>
                            </p>
                            <div class="banner__content-logo">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="<?php echo esc_url($btn_url); ?>" class="btn btn-primary" tabindex="0">
                                            <?php echo esc_html($btn_text); ?>
                                        </a>
                                    </li>
                                    <?php if (!empty($btn_url2)) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($btn_url2); ?>" class="btn btn-success">
                                            <?php echo esc_html($btn_text2); ?>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- What We Deploy Section -->
<section class="action-terms">
    <div class="container">
        <!-- SECTION HEADER -->
        <?php if ($section_title || $section_subtitle): ?>
            <div class="section-header width-full with-black">
                <div class="title">
                    <?php if ($section_title): ?>
                        <h2><?php echo wp_kses_post($section_title); ?></h2>
                    <?php endif; ?>

                    <?php if ($section_subtitle): ?>
                        <p><?php echo esc_html($section_subtitle); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>


        <!-- <div class="section-header width-full with-black">
            <div class="title">
                <h2>What we <span>Deploy</span></h2>
                <p>Built for speed. Designed for scale. Proven in the field.</p>
            </div>
        </div> -->
        <div class="row-card">
            <?php 
            if (!empty($deploy_items) && is_array($deploy_items)): 
                foreach ($deploy_items as $item): 
                    // Skip empty items
                    if (empty($item['title']) && empty($item['text'])) continue;
            ?>
                <div class="row-card-inner">
                    <?php if (!empty($item['icon'])): ?>
                    <div class="card-inner-icon">
                        <img src="<?php echo esc_url($item['icon']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($item['title'])): ?>
                    <h3><?php echo esc_html($item['title']); ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($item['text'])): ?>
                    <p><?php echo wp_kses_post($item['text']); ?></p>
                    <?php endif; ?>
                </div>
            <?php 
                endforeach;
            else: 
                // Default cards if none are set
                $default_cards = [
                    ['title' => 'Sweepstakes & Prize Kiosks', 'text' => 'Gamified experiences with real-time CMS, prize control, and analytics.'],
                    ['title' => 'Interactive Photo Booths', 'text' => 'Custom branded photo experiences with instant social sharing.'],
                    ['title' => 'Touch Screen Activations', 'text' => 'Engaging digital experiences with intuitive interfaces.'],
                    ['title' => 'AR/VR Experiences', 'text' => 'Immersive brand storytelling through cutting-edge technology.'],
                    ['title' => 'Live Polling & Trivia', 'text' => 'Real-time audience engagement with dynamic leaderboards.'],
                ];
                
                foreach ($default_cards as $card):
            ?>
                <div class="row-card-inner">
                    <div class="card-inner-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/card-icon1.png" alt="">
                    </div>
                    <h3><?php echo esc_html($card['title']); ?></h3>
                    <p><?php echo esc_html($card['text']); ?></p>
                </div>
            <?php 
                endforeach;
            endif; 
            ?>
        </div>
    </div>
</section>

<!-- Why It Works Section -->
<section class="why-it-works">
    <div class="container">

        <?php if ($section_title_why || $section_subtitle_why): ?>
            <div class="section-header width-full with-black">
                <div class="title">
                    <?php if ($section_title_why): ?>
                        <h2><?php echo wp_kses_post($section_title_why); ?></h2>
                    <?php endif; ?>

                    <?php if ($section_subtitle_why): ?>
                        <p><?php echo esc_html($section_subtitle_why); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="work-box">
            <?php 
            if (!empty($why_items) && is_array($why_items)): 
                foreach ($why_items as $index => $text): 
                    // Skip empty items
                    if (empty($text)) continue;
            ?>
                <div class="single-box">
                    <span><?php echo ($index + 1); ?></span>
                    <p><?php echo wp_kses_post($text); ?></p>
                </div>
            <?php 
                endforeach;
            else:
                // Default benefits
                $default_benefits = [
                    '<b>Fast setup,</b> minimal&nbsp;staffing',
                    '<b>High dwell time</b> and repeat play',
                    '<b>Shareable moments</b> + first-party data',
                    '<b>Perfect add-ons</b> to vending, booths, tours, and pop-ups'
                ];
                
                foreach ($default_benefits as $index => $benefit):
            ?>
                <div class="single-box">
                    <span><?php echo ($index + 1); ?></span>
                    <p><?php echo wp_kses_post($benefit); ?></p>
                </div>
            <?php 
                endforeach;
            endif; 
            ?>
        </div>
        <div class="banner__content-logo">
            <ul class="list-unstyled">
                <li>
                    <a href="<?php echo esc_url($why_btn_url); ?>" class="btn btn-primary" tabindex="0">
                        <?php echo esc_html($why_btn); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Main Content Area (if post content exists) -->
<?php if (get_the_content()): ?>
<section class="experience-content">
    <div class="container">
        <div class="content-wrapper">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Footer Section -->
<div class="cta-footer">
    <div class="container">
        <div class="cta-footer-inner">
            <div class="cta-content">
                <h3><?php echo wp_kses_post($cta_heading); ?></h3>
                <p><?php echo wp_kses_post($cta_text); ?></p>
                
                <ul>
                    <?php if (!empty($linkedin)): ?>
                    <li>
                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if (!empty($instagram)): ?>
                    <li>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if (!empty($youtube)): ?>
                    <li>
                        <a href="<?php echo esc_url($youtube); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if (!empty($email)): ?>
                    <li>
                        <a href="mailto:<?php echo esc_attr($email); ?>" aria-label="Email">
                            <i class="fa-regular fa-envelope"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php 
                    // If no social links are set, show default empty links
                    if (empty($linkedin) && empty($instagram) && empty($youtube) && empty($email)): 
                    ?>
                    <li><a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a></li>
                    <li><a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="#" aria-label="Email"><i class="fa-regular fa-envelope"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>