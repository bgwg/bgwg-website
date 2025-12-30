<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCBrandChoose extends Widget_Base {

	public function get_name() {
		return 'green-card-brand-choose-wg';
	}

	public function get_title() {
		return __( 'Brand Choose Section', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-check-circle';
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
				'default' => __( 'Why brands choose <span>The Experiential Engine</span>', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'We don’t just build experiences — we engineer engagement. Our team of creative technologists, designers, and producers brings together strategy, storytelling, and scalable tech to deliver brand experiences that hit harder and last longer.', 'mage-eventpress' ),
				'rows'    => 5,
			]
		);

		$this->end_controls_section();


		/* ======================
		 * ICON CARDS
		 * ====================== */
		$this->start_controls_section(
			'gc_icon_cards_section',
			[
				'label' => __( 'Icon Cards', 'mage-eventpress' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon_image',
			[
				'label' => __( 'Icon Image', 'mage-eventpress' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Text', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Card Text', 'mage-eventpress' ),
			]
		);
		$repeater->add_control(
			'description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => __( 'Card description text here...', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'cards',
			[
				'label'       => __( 'Cards', 'mage-eventpress' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field'=> '{{{ title }}}',
			]
		);

		$this->end_controls_section();


		/* ======================
		 * BUTTON
		 * ====================== */
		$this->start_controls_section(
			'gc_button_section',
			[
				'label' => __( 'Button', 'mage-eventpress' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => __( 'Button Text', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'btn btn-success', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => __( 'Button Link', 'mage-eventpress' ),
				'type'  => Controls_Manager::URL,
				'default' => [
					'url' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>

		<section class="brand-choose">
			<div class="container">

				<div class="section-header width-full">
					<div class="title">
						<h2><?php echo wp_kses_post( $settings['heading_text'] ); ?></h2>
						<p><?php echo esc_html( $settings['heading_description'] ); ?></p>
					</div>
				</div>


				<div class="card-wrapper">
					<div class="row">

						<?php foreach ( $settings['cards'] as $card ) : ?>
							<div class="col-md-4 col-sm-4">
								<div class="icon-card">
									<div class="icon-box">
										<img src="<?php echo esc_url( $card['icon_image']['url'] ); ?>" alt="">
									</div>
									<h4 class="card-title"><?php echo esc_html( $card['title'] ); ?></h4>
									<p class="card-desc">
										<?php echo esc_html( $card['description'] ); ?>
									</p>
								</div>
							</div>
						<?php endforeach; ?>

		

					</div>
				</div>
				<?php if ( ! empty( $settings['button_text'] ) ) : ?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="btn-area text-center">
							<a href="<?php echo esc_url( $settings['button_url']['url'] ); ?>"
									class="btn btn-success">
								<span><?php echo esc_html( $settings['button_text'] ); ?></span>
							</a>
						</div>
					</div>
				</div>
				<?php endif; ?>

			</div>
		</section>

		<?php
	}
}
