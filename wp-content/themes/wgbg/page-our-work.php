<?php
/*
Template Name: Our Work
*/

the_post();
get_header();
?>

<div class="banner">
    <div id="bannerSlider" class="banner__slider">
        <div class="banner__content" style="background: url(<?php echo get_template_directory_uri(); ?>/images/banner.png) center center repeat; background-size: cover;">
            <div class="container">
                <div class="row banner-row">
                    <div class="col-sm-12 text-center">
                        <div class="banner__content-main subpages">
                            <h1>Every project carries a purpose and we bring that purpose to life.</h1>
                            <h3>
                                Stories Told Through<span> Our Work</span>
                            </h3>
                            <p class="banner__content-description">
                                Here are some of the featured projects we’ve been working on. Contact us to get more information about our other work and previous clients.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="our-works">
    <div class="container">
        <div class="row">
            <?php
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'post_type'      => 'case_study',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'paged'          => $paged,
            );
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();
                    $post_id      = get_the_ID();
                    $template_dir = get_template_directory_uri();
                    // $card_bg      = get_the_post_thumbnail_url( $post_id, 'large' );
                    $card_image   = get_the_post_thumbnail_url( $post_id, 'large' );
                    if ( ! $card_image ) {
                        $card_image = $template_dir . '/images/work.png';
                    }
                    $heading_prefix = get_post_meta( $post_id, '_cs_heading_prefix', true );
                    $heading_main   = get_post_meta( $post_id, '_cs_heading_main', true );
                    $intro_text     = get_post_meta( $post_id, '_cs_intro_text', true );
                    $card_bg_image  = get_post_meta( $post_id, '_cs_card_bg_image', true );
                    ?>
                    <div class="col-md-12 mb-4">
                        <div class="work-inner" style="background: url(<?php echo esc_url( $card_bg_image ); ?>)">
                            <div class="work-photo">
                                <img src="<?php echo esc_url( $card_image ); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                            <div class="content-copy">
                                <h1>
                                    <?php if ( $heading_prefix ) : ?>
                                        <span><?php echo esc_html( $heading_prefix ); ?></span>
                                    <?php endif; ?>
                                    <?php echo esc_html( $heading_main ? $heading_main : get_the_title() ); ?>
                                </h1>
                                <p>
                                    <?php
                                    if ( has_excerpt() ) {
                                        the_excerpt();
                                    } elseif ( $intro_text ) {
                                        echo wp_kses_post( wp_trim_words( $intro_text, 30 ) );
                                    } else {
                                        echo wp_kses_post( wp_trim_words( get_the_content(), 30 ) );
                                    }
                                    ?>
                                </p>
                                <ul>
                                    <li><img src="<?php echo esc_url( $template_dir . '/images/wicon2.png' ); ?>" alt=""></li>
                                    <li><img src="<?php echo esc_url( $template_dir . '/images/wicon1.png' ); ?>" alt=""></li>
                                </ul>
                                <a href="<?php the_permalink(); ?>" class="btn btn-info">View Case Study</a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                // Pagination
                $big = 999999999; // need an unlikely integer
                $pagination_links = paginate_links( array(
                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, $paged ),
                    'total'     => $query->max_num_pages,
                    'type'      => 'list',
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ) );

                if ( $pagination_links ) :
                    ?>
                    <div class="col-md-12">
                        <nav class="pagination-wrapper">
                            <?php echo $pagination_links; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </nav>
                    </div>
                    <?php
                endif;

                wp_reset_postdata();
            else :
                ?>
                <p><?php esc_html_e( 'No case studies found.', 'greencard' ); ?></p>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>

<section class="make-digital-wrapper">
    <div class="container">
        <p>We are a full-service digital agency that builds immersive user experience. Our team creates an exceptional visualization and thought-out functionality.</p>
        <div class="row">
            <div class="col-md-12">
                <div class="featured-digital-slider">
                    <div class="featured-digital-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/fr1.png" alt="">
                    </div>
                    <div class="featured-digital-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/fr2.png" alt="">
                    </div>
                    <div class="featured-digital-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/fr3.png" alt="">
                    </div>
                    <div class="featured-digital-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/fr4.png" alt="">
                    </div>
                    <div class="featured-digital-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/fr5.png" alt="">
                    </div>
                    <div class="featured-digital-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/fr2.png" alt="">
                    </div>
                    <div class="featured-digital-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/fr4.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="cta-footer">
    <div class="container">
        <div class="cta-footer-inner">
            <div class="cta-content">
                <h3><span>Stay connected</span> to the Engine.</h3>
                <p>Follow BGWG for a behind-the-scenes look at how experiences are made. <b>Reels. Stories. Insights.</b></p>
                <ul>
                    <li><a href=""><i class="fa-brands fa-linkedin"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href=""><i class="fa-regular fa-envelope"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
