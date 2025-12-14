<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCFormReadyPower extends Widget_Base {

	public function get_name() {
		return 'green-card-ready-power';
	}

	public function get_title() {
		return __( 'Ready to Power Section', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
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
				'default' => __( 'Ready to power your <span>big experience?</span>', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Tell us your goals, your challenge, or your wildest idea — and we’ll bring it to life.', 'mage-eventpress' ),
				'rows'    => 4,
			]
		);

		$this->end_controls_section();


		/* ======================
		 * LEFT IMAGE
		 * ====================== */
		$this->start_controls_section(
			'gc_image_section',
			[
				'label' => __( 'Left Image', 'mage-eventpress' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'left_image',
			[
				'label' => __( 'Image', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();


		/* ======================
		 * FORM
		 * ====================== */
		$this->start_controls_section(
			'gc_form_section',
			[
				'label' => __( 'Form', 'mage-eventpress' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_shortcode',
			[
				'label'       => __( 'Form Shortcode', 'mage-eventpress' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( '[contact-form-7 id="123"] or Elementor Form shortcode', 'mage-eventpress' ),
				'rows'        => 4,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>

		<section class="ready-power">
			<div class="container">

				<div class="section-header with-black width-full">
					<div class="title">
						<h2><?php echo wp_kses_post( $settings['heading_text'] ); ?></h2>
						<p><?php echo esc_html( $settings['heading_description'] ); ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-5 col-sm-6">
						<div class="ready-left-img">
							<img src="<?php echo esc_url( $settings['left_image']['url'] ); ?>" alt="">
						</div>
					</div>

					<div class="col-md-7 col-sm-6">
						<div class="ready-form">
							<?php
								if ( ! empty( $settings['form_shortcode'] ) ) {
									echo do_shortcode( $settings['form_shortcode'] );
								}
							?>
						</div>
					</div>
				</div>

			</div>
		</section>

		<?php
	}
}
