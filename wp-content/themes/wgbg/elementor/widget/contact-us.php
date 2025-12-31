<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCContactUs extends Widget_Base {

	public function get_name() {
		return 'green-card-contact-us';
	}

	public function get_title() {
		return __( 'Contact Us Section', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
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

		$this->add_control( 'small_title', [
			'label' => __( 'Small Title', 'mage-eventpress' ),
			'type'  => Controls_Manager::TEXT,
			'default' => 'Contact Us',
		] );

		$this->add_control( 'heading_one', [
			'label' => __( 'Heading Line 1', 'mage-eventpress' ),
			'type'  => Controls_Manager::TEXT,
			'default' => 'We Turn Ideas Into',
		] );

		$this->add_control( 'heading_two', [
			'label' => __( 'Heading Line 2', 'mage-eventpress' ),
			'type'  => Controls_Manager::TEXT,
			'default' => 'Measurable Moments',
		] );

		$this->add_control( 'email', [
			'label' => __( 'Email', 'mage-eventpress' ),
			'type'  => Controls_Manager::TEXT,
			'default' => 'hello@bigwigmonster.com',
		] );

		$this->add_control( 'location', [
			'label' => __( 'Location', 'mage-eventpress' ),
			'type'  => Controls_Manager::TEXTAREA,
			'default' => '26391 Crown Valley Parkway Suite 240 Mission Viejo, CA 92691',
		] );

		$this->add_control( 'office_phone', [
			'label' => __( 'Office Phone', 'mage-eventpress' ),
			'type'  => Controls_Manager::TEXT,
			'default' => '9494075088',
		] );

		$this->add_control( 'fax', [
			'label' => __( 'FAX', 'mage-eventpress' ),
			'type'  => Controls_Manager::TEXT,
			'default' => '9494075088',
		] );

    $this->add_control('form_shortcode', [
        'label'       => __( 'Form Shortcode', 'mage-eventpress' ),
        'type'        => Controls_Manager::TEXTAREA,
        'rows'        => 3,
        'placeholder' => '[contact-form-7 id="123"]',
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

		<section class="contact-us"
			style="background: url('<?php echo esc_url( $s['background_image']['url'] ); ?>');
			background-repeat: no-repeat;
			background-position: top right;
			background-size: auto;">

			<div class="row">

				<div class="col-md-5 col-sm-5">
					<div class="contact-copy">
						<p><?php echo esc_html( $s['small_title'] ); ?></p>
						<h2><?php echo esc_html( $s['heading_one'] ); ?></h2>
						<h3><?php echo esc_html( $s['heading_two'] ); ?></h3>
					</div>

					<div class="email-div">
						<h4>Email</h4>
						<a href="mailto:<?php echo esc_attr( $s['email'] ); ?>">
							<?php echo esc_html( $s['email'] ); ?>
						</a>
					</div>

					<div class="email-div">
						<h4>Location</h4>
						<p><?php echo esc_html( $s['location'] ); ?></p>
					</div>

					<div class="email-div">
						<h4>Contact</h4>
						<p>Office: <?php echo esc_html( $s['office_phone'] ); ?></p>
						<p>Fax: <?php echo esc_html( $s['fax'] ); ?></p>
					</div>
				</div>

				<div class="col-md-7 col-sm-7">
					<div class="contact-form-inner">
						<h3>Let's Talk</h3>

            <?php if ( ! empty( $s['form_shortcode'] ) ) : ?>
              <?php echo do_shortcode( $s['form_shortcode'] ); ?>
            <?php endif; ?>


					</div>
				</div>

			</div>
		</section>

		<?php
	}
}
