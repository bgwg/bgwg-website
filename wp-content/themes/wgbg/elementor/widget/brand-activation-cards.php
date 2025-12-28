<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class GCBrandActivationCards extends Widget_Base {

    public function get_name() {
        return 'gc_brand_activation_cards';
    }

    public function get_title() {
        return __('Brand Activation Cards','greencard');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['green-card-elementor-support'];
    }

    protected function render() {

        $query = new \WP_Query([
            'post_type'      => 'interactive_exp',
            'posts_per_page' => 5,
            'post_status'    => 'publish',
        ]);

        if (!$query->have_posts()) return;

        echo '<section class="experiental-engine"><div class="container"><div class="section-header">
            <div class="title">
              <h2>The <span>Experiential Engine</span> in Action.</h2>
              <p>Every activation, campaign, and platform we build runs on the same power source — bold ideas, seamless technology, and human connection.</p>
            </div>
          </div><div class="row">';

        $count = 0;
        while ($query->have_posts()) : $query->the_post();
            $count++;
            $post_id = get_the_ID();
            $img     = get_the_post_thumbnail_url($post_id, 'medium');
            $intro   = get_post_meta($post_id, '_exp_intro', true);

            // Determine column class for layout
            if ($count <= 2) {
                $col_class = 'col-md-6 col-sm-6';
            } else {
                $col_class = 'col-md-4 col-sm-6';
            }
            ?>

            <div class="<?php echo esc_attr($col_class); ?>">
                <div class="card-tile">
                    <div class="card-tile-img">
                        <?php if ($img) : ?>
                            <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                    </div>

                    <p class="brand-card-title"><?php the_title(); ?></p>

                    <p class="brand-card-des">
                      <?php 
                        $intro_trimmed = wp_trim_words($intro, 22); 
                        echo esc_html($intro_trimmed); 
                      ?>
                    </p>

                    <div class="btn-part">
                        <a href="<?php the_permalink(); ?>" class="btn btn-success btn-grt-text">
                            <span>Explore activations</span>
                        </a>
                    </div>
                </div>
            </div>

            <?php
        endwhile;

        echo '</div></div></section>';

        wp_reset_postdata();
    }
}
