<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCThePeople extends Widget_Base {

	public function get_name() {
		return 'green-card-the-people';
	}

	public function get_title() {
		return __( 'The People Section', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-person';
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
				'label'   => __( 'Heading Text', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '<span>The People </span>Behind the Engine.', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'We’re creative technologists, event producers, and big thinkers who love what we do — crafting experiences that bring brands and audiences together. From a single photo moment to a global event series, our team delivers with passion, precision, and purpose.', 'mage-eventpress' ),
				'rows'    => 5,
			]
		);

		$this->end_controls_section();


		/* ======================
		 * IMAGES
		 * ====================== */
		$this->start_controls_section(
			'gc_images_section',
			[
				'label' => __( 'Images', 'mage-eventpress' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image_1',
			[
				'label' => __( 'Image 1 (Top Left)', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'image_2',
			[
				'label' => __( 'Image 2 (Top Middle)', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'image_3',
			[
				'label' => __( 'Image 3 (Bottom Left)', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'image_4',
			[
				'label' => __( 'Image 4 (Bottom Right)', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();


		/* ======================
		 * CENTER TEXT
		 * ====================== */
		$this->start_controls_section(
			'gc_center_text_section',
			[
				'label' => __( 'Center Text', 'mage-eventpress' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'center_heading',
			[
				'label'   => __( 'Center Heading', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '<span>Bold ideas.</span> Buttoned-up delivery', 'mage-eventpress' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>

		<section class="the-people">
			<div class="container">

				<div class="section-header with-black">
					<div class="title">
						<h2><?php echo wp_kses_post( $settings['heading_text'] ); ?></h2>
						<p><?php echo esc_html( $settings['heading_description'] ); ?></p>
					</div>
				</div>

				<div class="the-people-content">

					<div class="first-row">
						<div class="people-image">
							<img src="<?php echo esc_url( $settings['image_1']['url'] ); ?>" alt="">
						</div>

						<div class="people-image">
							<img src="<?php echo esc_url( $settings['image_2']['url'] ); ?>" alt="">
						</div>

						<div class="people-copy">
							<h3><?php echo wp_kses_post( $settings['center_heading'] ); ?></h3>
						</div>
					</div>

					<div class="second-row">
						<div class="second-people-img">
							<img src="<?php echo esc_url( $settings['image_3']['url'] ); ?>" alt="">
						</div>

						<div class="second-people-img">
							<img src="<?php echo esc_url( $settings['image_4']['url'] ); ?>" alt="">
						</div>
					</div>

				</div>
			</div>
		</section>

		<?php
	}
}
