<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCEngineMotion extends Widget_Base {

	public function get_name() {
		return 'green-card-engine-motion';
	}

	public function get_title() {
		return __( 'Engine in Motion', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-slider-video';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		/* ======================
		 * SECTION HEADING
		 * ====================== */
		$this->start_controls_section(
			'gc_heading_section',
			[
				'label' => __( 'Section Heading', 'mage-eventpress' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading_text',
			[
				'label'   => __( 'Heading', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'See the <span>Engine in Motion.</span>', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Real results, real reactions, real smiles. Every activation tells a story — here’s how we bring brands to life through creative tech and flawless delivery.', 'mage-eventpress' ),
				'rows'    => 4,
			]
		);

		$this->end_controls_section();


		/* ======================
		 * SLIDES
		 * ====================== */
		$this->start_controls_section(
			'gc_slides_section',
			[
				'label' => __( 'Slides', 'mage-eventpress' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'thumb_image',
			[
				'label' => __( 'Thumbnail Image', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'main_image',
			[
				'label' => __( 'Main Image', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Title', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Mars “Trick or Treat”', 'mage-eventpress' ),
			]
		);

		$repeater->add_control(
			'subtitle',
			[
				'label'   => __( 'Subtitle', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Activation', 'mage-eventpress' ),
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'mage-eventpress' ),
				'type'  => Controls_Manager::TEXTAREA,
				'rows'  => 4,
			]
		);

		$repeater->add_control(
			'icons',
			[
				'label' => __( 'Icons (Add Multiple)', 'mage-eventpress' ),
				'type'  => Controls_Manager::GALLERY,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label'   => __( 'Button Text', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Watch the Reel', 'mage-eventpress' ),
			]
		);

		$repeater->add_control(
			'button_url',
			[
				'label' => __( 'Button Link', 'mage-eventpress' ),
				'type'  => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'slides',
			[
				'label'       => __( 'Slides', 'mage-eventpress' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field'=> '{{{ title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>

		<section class="engine-motion">
			<div class="container">

				<div class="section-header with-black">
					<div class="title">
						<h2><?php echo wp_kses_post( $settings['heading_text'] ); ?></h2>
						<p><?php echo esc_html( $settings['heading_description'] ); ?></p>
					</div>
				</div>

				<div class="vertical-slider">

					<!-- THUMB SLIDER -->
					<div class="thumb-slider">
						<?php foreach ( $settings['slides'] as $slide ) : ?>
							<div>
								<div class="thumb-inner">
									<img src="<?php echo esc_url( $slide['thumb_image']['url'] ); ?>" alt="">
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<!-- MAIN SLIDER -->
					<div class="main-slider">
						<?php foreach ( $settings['slides'] as $slide ) : ?>
							<div class="item-div">
								<div class="row">
									<div class="col-md-6">
										<div class="details-img">
											<img src="<?php echo esc_url( $slide['main_image']['url'] ); ?>" alt="">
										</div>
									</div>
									<div class="col-md-6">
										<div class="img-content">
											<h3><?php echo esc_html( $slide['title'] ); ?></h3>
											<span><?php echo esc_html( $slide['subtitle'] ); ?></span>

											<p><?php echo esc_html( $slide['description'] ); ?></p>

											<?php if ( ! empty( $slide['icons'] ) ) : ?>
												<ul>
													<?php foreach ( $slide['icons'] as $icon ) : ?>
														<li><img src="<?php echo esc_url( $icon['url'] ); ?>" alt=""></li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>

											<?php if ( ! empty( $slide['button_text'] ) ) : ?>
												<a href="<?php echo esc_url( $slide['button_url']['url'] ); ?>" class="btn btn-success">
													<span><?php echo esc_html( $slide['button_text'] ); ?></span>
												</a>
											<?php endif; ?>

										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

				</div>
			</div>
		</section>

		<?php
	}
}
