<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCFeaturedDigitalSlider extends Widget_Base {

	public function get_name() {
		return 'green-card-featured-digital-slider';
	}

	public function get_title() {
		return __( 'Featured Digital Slider', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		/* ======================
		 * SLIDER ITEMS
		 * ====================== */
		$this->start_controls_section(
			'gc_slider_section',
			[
				'label' => __( 'Slider Images', 'mage-eventpress' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => __( 'Image', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'slides',
			[
				'label'       => __( 'Slides', 'mage-eventpress' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field'=> 'Slide',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>

		<section class="make-digital-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="featured-digital-slider">

							<?php foreach ( $settings['slides'] as $slide ) : ?>
								<div class="featured-digital-item">
									<img src="<?php echo esc_url( $slide['image']['url'] ); ?>" alt="">
								</div>
							<?php endforeach; ?>

						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
	}
}
