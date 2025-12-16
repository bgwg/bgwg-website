<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCContactBanner extends Widget_Base {

	public function get_name() {
		return 'green-card-contact-banner';
	}

	public function get_title() {
		return __( 'Contact Banner', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		/* =====================
		 * CONTENT
		 * ===================== */
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'heading_h1',
			[
				'label'   => __( 'Heading H1', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Tell us your goals, your challenge, or your wildest idea — we’ll bring it to life.',
				'rows'    => 2,
			]
		);

		$this->add_control(
			'heading_h3',
			[
				'label'   => __( 'Heading H3', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Let\'s Build <span>Something Bold</span>',
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Whether you’re launching a tour, activating a brand, or designing a digital experience, we’ll plug in wherever you need us. Our process is fast, collaborative, and built for measurable results.',
				'rows'    => 4,
			]
		);

		$this->end_controls_section();


		/* =====================
		 * BACKGROUND
		 * ===================== */
		$this->start_controls_section(
			'background_section',
			[
				'label' => __( 'Background', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'background_image',
			[
				'label'   => __( 'Background Image', 'mage-eventpress' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$s = $this->get_settings_for_display();
		?>

		<div class="banner">
			<div class="banner__slider">
				<div class="banner__content"
					style="background: url('<?php echo esc_url( $s['background_image']['url'] ); ?>') center center repeat; background-size: cover;">
					<div class="container">
						<div class="row banner-row">
							<div class="col-sm-12 text-center">
								<div class="banner__content-main subpages">

									<?php if ( ! empty( $s['heading_h1'] ) ) : ?>
										<h1><?php echo esc_html( $s['heading_h1'] ); ?></h1>
									<?php endif; ?>

									<?php if ( ! empty( $s['heading_h3'] ) ) : ?>
										<h3><?php echo wp_kses_post( $s['heading_h3'] ); ?></h3>
									<?php endif; ?>

									<?php if ( ! empty( $s['description'] ) ) : ?>
										<p class="banner__content-description">
											<?php echo esc_html( $s['description'] ); ?>
										</p>
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
