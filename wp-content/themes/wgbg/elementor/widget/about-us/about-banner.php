<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCAboutBanner extends Widget_Base {

	public function get_name() {
		return 'green-card-about-banner';
	}

	public function get_title() {
		return __( 'About Banner', 'mage-eventpress' );
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
				'type'    => Controls_Manager::TEXT,
				'default' => 'Bold ideas. Buttoned-up delivery.',
			]
		);

		$this->add_control(
			'heading_h3',
			[
				'label'   => __( 'Heading H3', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The People Behind',
			]
		);

		$this->add_control(
			'heading_h2',
			[
				'label'   => __( 'Heading H2', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Experiential Engine.',
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 6,
				'default' => 'We’re a team of creators, coders, and producers crafting impactful brand experiences — from gamified activations to immersive VR and digital campaigns.',
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


		/* =====================
		 * BUTTONS
		 * ===================== */
		$this->start_controls_section(
			'buttons_section',
			[
				'label' => __( 'Buttons', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'btn_one_text',
			[
				'label'   => __( 'Button 1 Text', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Meet the Team',
			]
		);

		$this->add_control(
			'btn_one_link',
			[
				'label' => __( 'Button 1 Link', 'mage-eventpress' ),
				'type'  => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'btn_two_text',
			[
				'label'   => __( 'Button 2 Text', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'See Our Work',
			]
		);

		$this->add_control(
			'btn_two_link',
			[
				'label' => __( 'Button 2 Link', 'mage-eventpress' ),
				'type'  => Controls_Manager::URL,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

	  $s = $this->get_settings_for_display();

    // Button visibility checks
    $show_btn_one = ! empty( $s['btn_one_link']['url'] );
    $show_btn_two = ! empty( $s['btn_two_link']['url'] );
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
                    <h3><?php echo esc_html( $s['heading_h3'] ); ?></h3>
                  <?php endif; ?>

                  <?php if ( ! empty( $s['heading_h2'] ) ) : ?>
                    <h2><?php echo esc_html( $s['heading_h2'] ); ?></h2>
                  <?php endif; ?>

                  <?php if ( ! empty( $s['description'] ) ) : ?>
                    <p class="banner__content-description">
                      <?php echo esc_html( $s['description'] ); ?>
                    </p>
                  <?php endif; ?>

                  <!-- BUTTONS -->
                  <?php if ( $show_btn_one || $show_btn_two ) : ?>
                    <div class="banner__content-logo">
                      <ul class="list-unstyled">

                        <?php if ( $show_btn_one ) : ?>
                          <li>
                            <a href="<?php echo esc_url( $s['btn_one_link']['url'] ); ?>" class="btn btn-primary">
                              <?php echo esc_html( $s['btn_one_text'] ); ?>
                            </a>
                          </li>
                        <?php endif; ?>

                        <?php if ( $show_btn_two ) : ?>
                          <li>
                            <a href="<?php echo esc_url( $s['btn_two_link']['url'] ); ?>" class="btn btn-success">
                              <span><?php echo esc_html( $s['btn_two_text'] ); ?></span>
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