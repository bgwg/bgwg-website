<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$post_id = get_the_ID();

		$card_bg_image	= get_post_meta( $post_id, '_cs_card_bg_image', true );
		$banner_image   = get_post_meta( $post_id, '_cs_banner_image', true );
		$main_image     = get_post_meta( $post_id, '_cs_main_image', true );
		$heading_prefix = get_post_meta( $post_id, '_cs_heading_prefix', true );
		$heading_main   = get_post_meta( $post_id, '_cs_heading_main', true );
		$intro_text     = get_post_meta( $post_id, '_cs_intro_text', true );
		$year           = get_post_meta( $post_id, '_cs_year', true );
		$technology     = get_post_meta( $post_id, '_cs_technology', true );
		$objective_sub  = get_post_meta( $post_id, '_cs_objective_subtitle', true );
		$objective_head = get_post_meta( $post_id, '_cs_objective_heading', true );
		$objective_intro= get_post_meta( $post_id, '_cs_objective_intro', true );
		$objective_list = get_post_meta( $post_id, '_cs_objective_list', true );
		$objective_img  = get_post_meta( $post_id, '_cs_objective_image', true );
		$exec_sub       = get_post_meta( $post_id, '_cs_execution_subtitle', true );
		$exec_head      = get_post_meta( $post_id, '_cs_execution_heading', true );
		$exec_text      = get_post_meta( $post_id, '_cs_execution_text', true );
		$steps_list     = get_post_meta( $post_id, '_cs_steps_list', true );
		$four_head      = get_post_meta( $post_id, '_cs_four_box_heading', true );
		$four_items     = get_post_meta( $post_id, '_cs_four_box_items', true );
		$outcome_head   = get_post_meta( $post_id, '_cs_outcome_heading', true );
		$outcome_text   = get_post_meta( $post_id, '_cs_outcome_text', true );
		$video_url      = get_post_meta( $post_id, '_cs_video_url', true );
		$video_thumb    = get_post_meta( $post_id, '_cs_video_thumbnail', true );
		$large_image    = get_post_meta( $post_id, '_cs_large_image', true );

		$template_dir = get_template_directory_uri();

		if ( empty( $card_bg_image ) ) {
			$card_bg_image = $template_dir . '/images/work-bg.png';
		}
		if ( empty( $banner_image ) ) {
			$banner_image = $template_dir . '/images/details-banner.png';
		}

		if ( empty( $main_image ) ) {
			$main_image = $template_dir . '/images/work1.png';
		}

		if ( empty( $objective_img ) ) {
			$objective_img = $template_dir . '/images/obj.png';
		}

		$objective_items = array_filter( array_map( 'trim', explode( "\n", (string) $objective_list ) ) );
		$step_items      = array_filter( array_map( 'trim', explode( "\n", (string) $steps_list ) ) );
		$four_box_items  = array_filter( array_map( 'trim', explode( "\n", (string) $four_items ) ) );
		?>

		<div class="banner">
			<div id="bannerSlider" class="banner__slider">
				<div class="banner__content" style="background: url(<?php echo esc_url( $banner_image ); ?>) center center repeat; background-size: cover;">
					<div class="container">
						<div class="row banner-row">
							<div class="col-md-12 ">
								<div class="work-inner-details ">
									<div class="work-photo">
										<img src="<?php echo esc_url( $main_image ); ?>" alt="">
									</div>

									<div class="content-copy">
										<h1>
											<?php if ( $heading_prefix ) : ?>
												<span><?php echo esc_html( $heading_prefix ); ?></span>
											<?php endif; ?>
											<?php echo esc_html( $heading_main ); ?>
										</h1>
										<?php if ( $intro_text ) : ?>
											<p><?php echo wp_kses_post( nl2br( $intro_text ) ); ?></p>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<section class="details-content">
			<div class="container">
				<div class="date-year">
					<div class="row">
						<div class="col-lg-4 col-12">
							<div class="details-col">
								<p class="year-title">Year</p>
								<h6 class="year-date"><?php echo esc_html( $year ); ?></h6>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="details-col ">
								<p class="year-title">Technology</p>
								<h6 class="year-date"><?php echo esc_html( $technology ); ?></h6>
							</div>
						</div>
						<div class="col-lg-4 col-12 ">
							<div class="details-col text-right">
								<p class="year-title">Have a Project?</p>
								<h6 class="year-date">
									<a href="/contact">Build It With Us <span>
										<img src="https://www.bigwigmonster.com/wp-content/themes/bigwigmonster/assets/images/arrow.svg" class="arrow-img" alt="">
									</span></a>
								</h6>
							</div>
						</div>
					</div>
				</div>

				<div class="objective-area">
					<h3><?php echo esc_html( $objective_sub ); ?></h3>
					<h2><?php echo wp_kses_post( $objective_head ); ?></h2>
					<?php if ( $objective_intro ) : ?>
						<p><?php echo wp_kses_post( nl2br( $objective_intro ) ); ?></p>
					<?php endif; ?>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="objective-copy">
							<?php if ( ! empty( $objective_items ) ) : ?>
								<ul>
									<?php foreach ( $objective_items as $item ) : ?>
										<li><?php echo esc_html( $item ); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							<?php the_content(); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="objective-img-box">
							<img src="<?php echo esc_url( $objective_img ); ?>" alt="">
						</div>
					</div>
				</div>
			</div>

			<div class="our-solutions">
				<div class="container">
					<div class="objective-area">
						<h3><?php echo esc_html( $exec_sub ); ?></h3>
						<h2><?php echo wp_kses_post( $exec_head ); ?></h2>
						<?php if ( $exec_text ) : ?>
							<p><?php echo wp_kses_post( nl2br( $exec_text ) ); ?></p>
						<?php endif; ?>
					</div>
					<div class="solution-box">
						<?php
						$step_index = 1;
						foreach ( $step_items as $step ) :
							?>
							<div class="single-box">
								<span><?php echo esc_html( $step_index ); ?></span>
								<p><?php echo esc_html( $step ); ?></p>
							</div>
							<?php
							$step_index++;
						endforeach;
						?>
					</div>
					<div class="objective-area">
						<h2><?php echo wp_kses_post( $four_head ); ?></h2>
					</div>
					<div class="four-boxs">
						<?php foreach ( $four_box_items as $four_item ) : ?>
							<div class="each-four">
								<p><?php echo wp_kses_post( $four_item ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

			<div class="the-outcome">
				<div class="container">
					<div class="objective-area">
						<h2><?php echo wp_kses_post( $outcome_head ); ?></h2>
						<?php if ( $outcome_text ) : ?>
							<p><?php echo wp_kses_post( nl2br( $outcome_text ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>

	<?php if ( $video_url && $video_thumb ) : ?>
		<div class="video-section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="video-container" id="videoContainer">
							<div class="video-thum">
								<img class="thumbnails" id="thumbnail" src="<?php echo esc_url( $video_thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
							</div>
							<button class="play-button" id="playButton">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/play-icon.png" alt="">
							</button>
							<video class="video" id="video" src="<?php echo esc_url( $video_url ); ?>"></video>
						</div> 
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php $large_images = array_filter( array_map( 'trim', preg_split( '/\r?\n/', (string) $large_image ) ) );
		if ( ! empty( $large_images ) ) :
	?>
	<section class="gallary-photo">
    <div id="gallarySlider" class="gallary-slider">
    	<?php foreach ( $large_images as $img_url ) : ?>  
			<div class="each-gallry">
        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
      </div>
			<?php endforeach; ?>
    </div>
  </section>
	<?php endif; ?>

<?php
	$prev_link = get_previous_post_link( '%link', '&larr; Prev Case' );
	$next_link = get_next_post_link( '%link', 'Next Case &rarr;' );
	if ( $prev_link || $next_link ) :
?>
	<section class="next-prev-arrow">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
          <div class="next-prev-inner">
            <div class=" ">
							<?php if ( $prev_link ) : ?>
							<b><?php echo $prev_link; ?></b>
							<?php endif; ?>
              <!-- <a href="#" class="arrow-text d-flex align-items-center">
                <img src="https://www.bigwigmonster.com/wp-content/themes/bigwigmonster/assets/images/arrow.svg" class="arrow-next rotate-arrow" alt="">
                <span class="uner-line"> Prev Case</span>
              </a> -->
            </div>
            <div class=" ">
							<?php if ( $next_link ) : ?>
								<b class="case-nav-next"><?php echo $next_link;?></b>
							<?php endif; ?>
              <!-- <a href="https://www.bigwigmonster.com/case_study/timberwolves/" class="arrow-text d-flex align-items-center">
                <span class="uner-line"> Next Case</span>
                <img src="https://www.bigwigmonster.com/wp-content/themes/bigwigmonster/assets/images/arrow.svg" class="arrow-next" alt="">
              </a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
	<?php	endif; ?>

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
	endwhile;
endif;
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
	var link = document.querySelector('.case-video-link');
	if (link) {
		link.addEventListener('click', function (e) {
			e.preventDefault();
			var url = this.getAttribute('data-video-url');
			var embedContainer = document.querySelector('.case-video-embed');
			if (!url || !embedContainer) return;
			// If already loaded, do nothing
			if (embedContainer.dataset.loaded === '1') return;
			var iframe = document.createElement('iframe');
			iframe.src = url;
			iframe.width = '100%';
			iframe.height = '450';
			iframe.frameBorder = '0';
			iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
			iframe.allowFullscreen = true;
			embedContainer.innerHTML = '';
			embedContainer.appendChild(iframe);
			embedContainer.dataset.loaded = '1';
		});
	}

	// Init Slick slider for large image gallery if available
	if (window.jQuery && jQuery.fn.slick) {
		jQuery('.case-large-slider').slick({
			arrows: false,
			dots: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: true,
		});
	}
});
</script>
<?php

get_footer();
