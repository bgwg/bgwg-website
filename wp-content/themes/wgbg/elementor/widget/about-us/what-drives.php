<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCWhatDrives extends Widget_Base {

	public function get_name() {
		return 'green-card-what-drives';
	}

	public function get_title() {
		return __( 'What Drives Us', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-favorite';
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
				'default' => 'What<span> Drives Us.</span>',
			]
		);

		$this->end_controls_section();


		/* =====================
		 * ICON CARDS
		 * ===================== */
		$this->start_controls_section(
			'icon_cards_section',
			[
				'label' => __( 'Icon Cards', 'mage-eventpress' ),
			]
		);

		$icon_repeater = new Repeater();

		$icon_repeater->add_control(
			'icon_image',
			[
				'label' => __( 'Icon Image', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$icon_repeater->add_control(
			'title',
			[
				'label'   => __( 'Title', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Creativity with purpose',
			]
		);

		$icon_repeater->add_control(
			'description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
			]
		);

		$this->add_control(
			'icon_cards',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $icon_repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();


		/* =====================
		 * IMAGE GRID
		 * ===================== */
		$this->start_controls_section(
			'image_grid_section',
			[
				'label' => __( 'Grid Images', 'mage-eventpress' ),
			]
		);

		$image_repeater = new Repeater();

		$image_repeater->add_control(
			'grid_image',
			[
				'label' => __( 'Image', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'grid_images',
			[
				'type'   => Controls_Manager::REPEATER,
				'fields'=> $image_repeater->get_controls(),
			]
		);

		$this->end_controls_section();


		/* =====================
		 * GRID TEXT BOX (NEW)
		 * ===================== */
		$this->start_controls_section(
			'grid_text_box',
			[
				'label' => __( 'Grid Text Box', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'grid_text_title',
			[
				'label'   => __( 'Title', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => "We don't chase trends",
			]
		);

		$this->add_control(
			'grid_text_subtitle',
			[
				'label'   => __( 'Subtitle', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'We Build',
			]
		);

		$this->add_control(
			'grid_text_description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'moments that last.',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$s = $this->get_settings_for_display();
		?>

		<section class="what-drives">
			<div class="container">

				<div class="section-header width-full with-black">
					<div class="title">
						<h2><?php echo wp_kses_post( $s['heading'] ); ?></h2>
					</div>
				</div>

				<div class="icon-card-area">
					<?php foreach ( $s['icon_cards'] as $card ) : ?>
						<div class="icon-card">
							<div class="icon-box">
								<?php if ( ! empty( $card['icon_image']['url'] ) ) : ?>
									<img src="<?php echo esc_url( $card['icon_image']['url'] ); ?>" alt="">
								<?php endif; ?>
							</div>
							<div class="icon-copy">
								<h2><?php echo esc_html( $card['title'] ); ?></h2>
								<p><?php echo esc_html( $card['description'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="grid-wrapper">
					<?php foreach ( $s['grid_images'] as $img ) : ?>
						<div class="ibox">
							<?php if ( ! empty( $img['grid_image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $img['grid_image']['url'] ); ?>" alt="">
							<?php endif; ?>
						</div>
					<?php endforeach; ?>

					<!-- Text Box -->
					<div class="ibox">
						<div class="ibox-inner">
							<h2><?php echo esc_html( $s['grid_text_title'] ); ?></h2>
							<h3><?php echo esc_html( $s['grid_text_subtitle'] ); ?></h3>
							<p><?php echo esc_html( $s['grid_text_description'] ); ?></p>
						</div>
					</div>
				</div>

			</div>
		</section>

		<?php
	}
}
