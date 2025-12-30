<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$post_id = get_the_ID();

		$card_bg_image	= get_post_meta( $post_id, '_cs_card_bg_image', true );
		$banner_image   = get_post_meta( $post_id, '_cs_banner_image', true );
		$main_image     = get_post_meta( $post_id, '_cs_main_image', true );
		$banner_logo    = get_post_meta( $post_id, '_cs_banner_logo', true );
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
		$objective_extra_text = get_post_meta( $post_id, '_cs_objective_extra_text', true );
		
		$solution_ext_title = get_post_meta( $post_id, '_cs_solution_extended_title', true );
		$solution_ext_text  = get_post_meta( $post_id, '_cs_solution_extended_text', true );
		$solution_ext_img   = get_post_meta( $post_id, '_cs_solution_extended_image', true );
		$use_extended_layout = get_post_meta( $post_id, '_cs_use_extended_layout', true );


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

		// Process objective list
		$objective_items = array_filter( array_map( 'trim', explode( "\n", (string) $objective_list ) ) );
		
		// Process steps list
		$step_items = array_filter( array_map( 'trim', explode( "\n", (string) $steps_list ) ) );
		
		// Process four box items - FIXED SECTION
		if (is_array($four_items)) {
			// If it's already an array (repeater field)
			$four_box_items = array_filter($four_items);
		} else {
			// If it's a string, split by newlines
			$four_box_items = array_filter(
				array_map('trim', explode("\n", (string) $four_items))
			);
		}
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
										<div class="banner-logo">
											<img src="<?php echo esc_url( $banner_logo ); ?>" alt="">
										</div>
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
					<h2>A <span>New Challenge</span> For US</h2>
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
								<?php if ( ! empty( $objective_extra_text ) ) : ?>
										<p><?php echo wp_kses_post( nl2br( $objective_extra_text ) ); ?></p>
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

		<?php
		$has_area_with_box = (
			! empty( $exec_text ) ||
			! empty( $step_items ) ||
			! empty( $four_box_items )
		);

		$has_area_with_img_box = (
			! empty( $solution_ext_title ) ||
			! empty( $solution_ext_text ) ||
			! empty( $solution_ext_img )
		);
		?>

		<?php if ( $use_extended_layout === '1' && $has_area_with_img_box ) : ?>

			<!-- EXTENDED LAYOUT -->
			<div class="area-with-img-box">
				<div class="objective-area">
					<h3><?php echo esc_html( $exec_sub ); ?></h3>
					<h2>Our <span>Solution</span></h2>
					<?php if ( $solution_ext_title ) : ?>
						<h4 class="extended-copy"><?php echo esc_html( $solution_ext_title ); ?></h4>
					<?php endif; ?>

					<?php if ( $solution_ext_text ) : ?>
						<p><?php echo wp_kses_post( nl2br( $solution_ext_text ) ); ?></p>
					<?php endif; ?>
				</div>

				<div class="our-solution-extended">
					<?php if ( $solution_ext_img ) : ?>
						<div class="project-photo">
							<img src="<?php echo esc_url( $solution_ext_img ); ?>" alt="">
						</div>
					<?php endif; ?>
				</div>
			</div>

		<?php elseif ( $has_area_with_box ) : ?>

			<!-- BOX LAYOUT -->
			<div class="area-with-box">
				<div class="objective-area">
					<h3><?php echo esc_html( $exec_sub ); ?></h3>
					<h2>Our <span>Solution</span></h2>

					<?php if ( $exec_text ) : ?>
						<p><?php echo wp_kses_post( nl2br( $exec_text ) ); ?></p>
					<?php endif; ?>
				</div>

				<div class="solution-box">
					<?php $step_index = 1; ?>
					<?php foreach ( $step_items as $step ) : ?>
						<div class="single-box">
							<span><?php echo esc_html( $step_index ); ?></span>
							<p><?php echo esc_html( $step ); ?></p>
						</div>
						<?php $step_index++; ?>
					<?php endforeach; ?>
				</div>

				<?php if ( ! empty( $four_box_items ) ) : ?>
					<div class="objective-area">
							<h2>How We <span>Exceeded Expectations</span></h2>
					</div>

					<div class="four-boxs">
							<?php foreach ( $four_box_items as $four_item ) : ?>
									<?php 
									// Handle both array format and string format
									if (is_array($four_item)) {
										// If it's an array, try common key names
										$item_text = $four_item['text'] ?? $four_item['content'] ?? $four_item['value'] ?? '';
									} else {
										// If it's a string, use it directly
										$item_text = $four_item;
									}
									?>
									<?php if ( ! empty( $item_text ) ) : ?>
											<div class="each-four">
													<p><?php echo wp_kses_post( nl2br( $item_text ) ); ?></p>
											</div>
									<?php endif; ?>
							<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>

		<?php elseif ( $has_area_with_img_box ) : ?>

			<!-- FALLBACK EXTENDED -->
			<div class="area-with-img-box">
				<div class="objective-area">
					<h3><?php echo esc_html( $exec_sub ); ?></h3>
					<h2>Our <span>Solution</span></h2>
				</div>

				<div class="our-solution-extended">
					<?php if ( $solution_ext_title ) : ?>
						<h2><?php echo esc_html( $solution_ext_title ); ?></h2>
					<?php endif; ?>

					<?php if ( $solution_ext_text ) : ?>
						<p><?php echo wp_kses_post( nl2br( $solution_ext_text ) ); ?></p>
					<?php endif; ?>

					<?php if ( $solution_ext_img ) : ?>
						<div class="project-photo">
							<img src="<?php echo esc_url( $solution_ext_img ); ?>" alt="">
						</div>
					<?php endif; ?>
				</div>
			</div>

		<?php endif; ?>

	</div>
</div>

<?php if ( $outcome_text || ($video_url && $video_thumb) ) : ?>
	<div class="the-outcome">
		<div class="container">
			<div class="objective-area">
				<h2>The <span>Outcome</span></h2>
				<?php if ( $outcome_text ) : ?>
					<p><?php echo wp_kses_post( nl2br( $outcome_text ) ); ?></p>
				<?php endif; ?>
			</div>
			<?php if ( $video_url && $video_thumb ) : ?>
			<div class="video-section testes">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="video-container" id="videoContainer">
								<div class="video-thum" id="videoThumb">
									<img class="thumbnails" src="<?php echo esc_url( $video_thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
								</div>
								<!-- Play Button -->
								<button class="play-button" id="playButton">
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/play-icon.png" alt="Play">
								</button>

								<?php
									if ( preg_match( '/(youtube\.com|youtu\.be)/i', $video_url ) ) {
											preg_match( '/(youtu\.be\/|v=)([^&]+)/', $video_url, $matches );
											$video_id = $matches[2] ?? '';
											if ( $video_id ) :
									?>
										<iframe
											class="video iframe-video"
											data-src="https://www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?autoplay=1"
											frameborder="0"
											allow="autoplay; encrypted-media"
											allowfullscreen>
										</iframe>
									<?php
									endif;

									} elseif ( preg_match( '/vimeo\.com/i', $video_url ) ) {
										preg_match( '/vimeo\.com\/(\d+)/', $video_url, $matches );
										$video_id = $matches[1] ?? '';
										if ( $video_id ) :
									?>
									<iframe
										class="video iframe-video"
										data-src="https://player.vimeo.com/video/<?php echo esc_attr( $video_id ); ?>?autoplay=1"
										frameborder="0"
										allow="autoplay; fullscreen"
										allowfullscreen>
									</iframe>
										<?php
											endif;
										} else {
										?>
										<video class="video html-video" preload="metadata" controls>
											<source src="<?php echo esc_url( $video_url ); ?>">
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
		


	<?php $large_images = get_post_meta(get_the_ID(), '_cs_large_image', true);
	if (!empty($large_images) && is_array($large_images)): ?>
		<section class="gallary-photo">
			<div id="gallarySlider" class="gallary-slider">
				<?php foreach ($large_images as $img): ?>
					<div class="gallary-slider">
						<div class="each-gallry">
							<img src="<?php echo esc_url($img); ?>" alt="">
						</div>
					</div>
				<?php endforeach; ?> 
			</div>
		</section> 
	<?php endif; ?>


	<?php
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	$arrow_icon = get_template_directory_uri() . '/images/arrow.png';
	
	if ( $prev_post || $next_post ) :
?>
	<section class="next-prev-arrow">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
          <div class="next-prev-inner">
            <div class=" ">
							<?php if ( $prev_post ) : ?>
								<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="arrow-text d-flex align-items-center">
									<i class="fa-solid fa-arrow-left-long"></i>
									<!-- <img src="<?php //echo esc_url( $arrow_icon ); ?>" class="arrow-img rotate-arrow" alt="" style="margin-right: 8px;"> -->
									<span class="uner-line">Prev Case</span>
								</a>
							<?php endif; ?>
            </div>
            <div class=" ">
							<?php if ( $next_post ) : ?>
								<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="arrow-text d-flex align-items-center case-nav-next">
									<span class="uner-line">Next Case</span>
									<i class="fa-solid fa-arrow-right-long"></i>
									<!-- <img src="<?php //echo esc_url( $arrow_icon ); ?>" class="arrow-img" alt="" style="margin-left: 8px;"> -->
								</a>
							<?php endif; ?>
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
						<h3>Need help with a project?<span> LET'S TALK!</span></h3>
						<p>Every great project begins with a conversation. Share your vision with us, and together we'll turn your ideas into something remarkable.</b></p>
						<a href="/book-a-call/" class="btn btn-primary" style="padding-left: 15px; padding-right: 15px;">Let's Discuss Your Project</a>
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