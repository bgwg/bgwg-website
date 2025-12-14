<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCCardTiles extends Widget_Base {

	public function get_name() {
		return 'green-card-tiles-wg';
	}

	public function get_title() {
		return __( 'Card Tiles', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
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
				'default' => __( 'The <span>Experiential Engine</span> in Action.', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label'   => __( 'Description Text', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Every activation, campaign, and platform we build runs on the same power source — bold ideas, seamless technology, and human connection.', 'mage-eventpress' ),
				'rows'    => 4,
			]
		);

		$this->end_controls_section();


		/* ======================
		 * CARD TILES
		 * ====================== */
		$this->start_controls_section(
			'gc_card_tiles_section',
			[
				'label' => __( 'Card Tiles', 'mage-eventpress' ),
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

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Title', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Card Title', 'mage-eventpress' ),
			]
		);

		$repeater->add_control(
			'column',
			[
				'label'   => __( 'Column Width', 'mage-eventpress' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'col-md-4 col-sm-4',
				'options' => [
					'col-md-6 col-sm-6' => __( '2 Columns', 'mage-eventpress' ),
					'col-md-4 col-sm-4' => __( '3 Columns', 'mage-eventpress' ),
				],
			]
		);

		$this->add_control(
			'tiles',
			[
				'label'       => __( 'Tiles', 'mage-eventpress' ),
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

		<section class="experiental-engine">
			<div class="container">

				<?php if ( ! empty( $settings['heading_text'] ) ) : ?>
					<div class="section-header">
						<div class="title">
							<h2><?php echo wp_kses_post( $settings['heading_text'] ); ?></h2>

							<?php if ( ! empty( $settings['heading_description'] ) ) : ?>
								<p><?php echo esc_html( $settings['heading_description'] ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="row">
					<?php foreach ( $settings['tiles'] as $tile ) : ?>
						<div class="<?php echo esc_attr( $tile['column'] ); ?>">
							<div class="card-tile">
								<div class="card-tile-img">
									<img src="<?php echo esc_url( $tile['image']['url'] ); ?>" alt="">
								</div>
								<p><?php echo esc_html( $tile['title'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</section>

		<?php
	}
}
