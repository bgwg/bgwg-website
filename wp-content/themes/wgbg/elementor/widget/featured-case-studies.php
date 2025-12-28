<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCFeaturedCaseStudies extends Widget_Base {

	public function get_name() {
		return 'gc-featured-case-studies';
	}

	public function get_title() {
		return __( 'Featured Case Studies (Dynamic)', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function register_controls() {

		/* =====================
		 * HEADER
		 * ===================== */
		$this->start_controls_section(
			'header_section',
			[
				'label' => __( 'Section Header', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label'   => __( 'Heading', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Featured <span> Case Studies</span>',
			]
		);

		$this->end_controls_section();


		/* =====================
		 * QUERY
		 * ===================== */
		$this->start_controls_section(
			'query_section',
			[
				'label' => __( 'Query Settings', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Number of Case Studies', 'mage-eventpress' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
			]
		);

		$this->end_controls_section();

    /* =====================
    * CTA BUTTONS
    * ===================== */
    $this->start_controls_section(
      'cta_section',
      [
        'label' => __( 'CTA Buttons', 'mage-eventpress' ),
      ]
    );

    $this->add_control(
      'btn_1_text',
      [
        'label'   => __( 'Button 1 Text', 'mage-eventpress' ),
        'type'    => Controls_Manager::TEXT,
        'default' => 'Start a Conversation',
      ]
    );

    $this->add_control(
      'btn_1_url',
      [
        'label'       => __( 'Button 1 URL', 'mage-eventpress' ),
        'type'        => Controls_Manager::URL,
        'placeholder' => '/book-a-call/',
        'default'     => [
          'url' => '/book-a-call/',
        ],
      ]
    );

    $this->add_control(
      'btn_2_text',
      [
        'label'   => __( 'Button 2 Text', 'mage-eventpress' ),
        'type'    => Controls_Manager::TEXT,
        'default' => 'See Our Work',
      ]
    );

    $this->add_control(
      'btn_2_url',
      [
        'label'       => __( 'Button 2 URL', 'mage-eventpress' ),
        'type'        => Controls_Manager::URL,
        'placeholder' => '/our-work/',
        'default'     => [
          'url' => '/our-work/',
        ],
      ]
    );

    $this->end_controls_section();

	}

	protected function render() {

		$s = $this->get_settings_for_display();

		$query = new WP_Query([
			'post_type'      => 'case_study',
			'posts_per_page' => intval( $s['posts_per_page'] ),
			'post_status'    => 'publish',
		]);
		?>

		<section class="features-case">
			<div class="container">

				<div class="section-header width-full with-black">
					<div class="title">
						<h2><?php echo wp_kses_post( $s['heading'] ); ?></h2>
					</div>
				</div>

				<?php if ( $query->have_posts() ) : ?>
					<div class="row">
						<div class="col-md-12">
							<div class="features-slider">

								<?php while ( $query->have_posts() ) : $query->the_post();

									$post_id = get_the_ID();

									/* 🔥 MAIN IMAGE FROM META */
                  // $feature_image = get_post_meta(get_the_ID(), '_cs_feature_image', true);

                // if ($feature_image) {
                //     echo '<img src="'.esc_url($feature_image).'" alt="'.esc_attr(get_the_title()).'" class="case-study-feature-img">';
                // }

									$image = get_post_meta( $post_id, '_cs_feature_image', true );

									/* Fallback: featured image */
									if ( empty( $image ) && has_post_thumbnail() ) {
										$image = get_the_post_thumbnail_url( $post_id, 'full' );
									}

									/* Final fallback */
									if ( empty( $image ) ) {
										$image = get_template_directory_uri() . '/images/work1.png';
									}
									?>

									<div class="feature-item">
										<a href="<?php the_permalink(); ?>">
											<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title_attribute(); ?>">
										</a>
									</div>

								<?php endwhile; wp_reset_postdata(); ?>

							</div>
						</div>
					</div>
				<?php endif; ?>
        <div class="row">
          <div class="col-md-12">
            <?php if ( ! empty( $s['btn_1_text'] ) || ! empty( $s['btn_2_text'] ) ) : ?>
							<div class="banner__content-logo ">
								<ul class="list-unstyled">
									
									<?php if ( ! empty( $s['btn_1_text'] ) ) : ?>
										<li>
											<a 
												href="<?php echo esc_url( $s['btn_1_url']['url'] ); ?>" 
												class="btn btn-primary"
												<?php echo $s['btn_1_url']['is_external'] ? 'target="_blank"' : ''; ?>
											>
												<?php echo esc_html( $s['btn_1_text'] ); ?>
											</a>
										</li>
									<?php endif; ?>

									<?php if ( ! empty( $s['btn_2_text'] ) ) : ?>
										<li>
											<a 
												href="<?php echo esc_url( $s['btn_2_url']['url'] ); ?>" 
												class="btn btn-success btn-grt-text"
												<?php echo $s['btn_2_url']['is_external'] ? 'target="_blank"' : ''; ?>
											>
												<span><?php echo esc_html( $s['btn_2_text'] ); ?></span>
											</a>
										</li>
									<?php endif; ?>

								</ul>
							</div>
						<?php endif; ?>

          </div>
        </div>

			</div>
		</section>

		<?php
	}
}
