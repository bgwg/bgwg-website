<?php
namespace MEPPlugin\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCFeaturedCaseStudiesBanner extends Widget_Base {

	public function get_name() {
		return 'case_study_banner';
	}

	public function get_title() {
		return __( 'Case Study Banner', 'textdomain' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {

		/* ===================
		 * CONTENT
		 * =================== */
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'textdomain' ),
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label' => __( 'Background Image', 'textdomain' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => __( 'Main Title (H1)', 'textdomain' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Real builds. Real results. Real people smiling.',
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label'   => __( 'Sub Title Text', 'textdomain' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'See the Engine',
			]
		);

		$this->add_control(
			'sub_title_highlight',
			[
				'label'   => __( 'Highlighted Text', 'textdomain' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'in Motion',
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'textdomain' ),
				'type'  => Controls_Manager::TEXTAREA,
				'rows'  => 5,
				'default' => 'We believe the best proof of creativity is performance. Here’s a glimpse at how The Experiential Engine brings brand stories to life — through immersive tech, bold ideas, and precise execution.',
			]
		);

		$this->end_controls_section();

		/* ===================
		 * BUTTONS
		 * =================== */
		$this->start_controls_section(
			'buttons_section',
			[
				'label' => __( 'Buttons', 'textdomain' ),
			]
		);

		$this->add_control(
			'btn1_text',
			[
				'label'   => __( 'Button 1 Text', 'textdomain' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Watch the Reel',
			]
		);

		$this->add_control(
			'btn1_url',
			[
				'label' => __( 'Button 1 URL', 'textdomain' ),
				'type'  => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'btn2_text',
			[
				'label'   => __( 'Button 2 Text', 'textdomain' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Start a Project',
			]
		);

		$this->add_control(
			'btn2_url',
			[
				'label' => __( 'Button 2 URL', 'textdomain' ),
				'type'  => Controls_Manager::URL,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$s = $this->get_settings_for_display();
		$bg = ! empty( $s['bg_image']['url'] ) ? $s['bg_image']['url'] : '';
		?>

		<div class="banner">
			<div class="banner__slider">
				<div class="banner__content" style="background:url('<?php echo esc_url( $bg ); ?>') center center repeat; background-size:cover;">
					<div class="container">
						<div class="row banner-row">
							<div class="col-sm-12 text-center">
								<div class="banner__content-main subpages">

									<?php if ( $s['title'] ) : ?>
										<h1><?php echo esc_html( $s['title'] ); ?></h1>
									<?php endif; ?>

									<?php if ( $s['sub_title'] || $s['sub_title_highlight'] ) : ?>
										<h3>
											<?php echo esc_html( $s['sub_title'] ); ?>
											<span> <?php echo esc_html( $s['sub_title_highlight'] ); ?></span>
										</h3>
									<?php endif; ?>

									<?php if ( $s['description'] ) : ?>
										<p class="banner__content-description">
											<?php echo esc_html( $s['description'] ); ?>
										</p>
									<?php endif; ?>

									<?php if ( $s['btn1_text'] || $s['btn2_text'] ) : ?>
										<div class="banner__content-logo">
											<ul class="list-unstyled">

												<?php if ( $s['btn1_text'] ) : ?>
													<li>
														<a href="<?php echo esc_url( $s['btn1_url']['url'] ); ?>" class="btn btn-primary">
															<?php echo esc_html( $s['btn1_text'] ); ?>
														</a>
													</li>
												<?php endif; ?>

												<?php if ( $s['btn2_text'] ) : ?>
													<li>
														<a href="<?php echo esc_url( $s['btn2_url']['url'] ); ?>" class="btn btn-success">
															<span><?php echo esc_html( $s['btn2_text'] ); ?></span>
														</a>
													</li>
												<?php endif; ?>

											</ul>
										</div>
									<?php endif; ?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}
