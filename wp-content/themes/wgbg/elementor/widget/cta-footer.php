<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCCtaFooter extends Widget_Base {

	public function get_name() {
		return 'green-card-cta-footer';
	}

	public function get_title() {
		return __( 'CTA Footer', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		/* ======================
		 * CONTENT
		 * ====================== */
		$this->start_controls_section(
			'cta_content',
			[
				'label' => __( 'Content', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label'   => __( 'Heading', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '<span>Stay connected</span> to the Engine.',
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => __( 'Description', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => 'Follow BGWG for a behind-the-scenes look at how experiences are made. <b>Reels. Stories. Insights.</b>',
			]
		);

		$this->end_controls_section();


		/* ======================
		 * BUTTONS
		 * ====================== */
		$this->start_controls_section(
			'cta_buttons',
			[
				'label' => __( 'Buttons', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'btn_one_text',
			[
				'label'   => __( 'Button 1 Text', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Explore Case Studies',
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
				'default' => 'Start a Conversation',
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


		/* ======================
		 * SOCIAL ICONS
		 * ====================== */
		$this->start_controls_section(
			'cta_socials',
			[
				'label' => __( 'Social Icons', 'mage-eventpress' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon_class',
			[
				'label'   => __( 'Icon Class', 'mage-eventpress' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'fa-brands fa-linkedin',
			]
		);

		$repeater->add_control(
			'icon_link',
			[
				'label' => __( 'Link', 'mage-eventpress' ),
				'type'  => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'social_items',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[ 'icon_class' => 'fa-brands fa-linkedin' ],
					[ 'icon_class' => 'fa-brands fa-instagram' ],
					[ 'icon_class' => 'fa-brands fa-youtube' ],
					[ 'icon_class' => 'fa-regular fa-envelope' ],
				],
				'title_field' => '{{{ icon_class }}}',
			]
		);

		$this->end_controls_section();
	}

  protected function render() {

    $s = $this->get_settings_for_display();

    // Button visibility
    $show_btn_one = ! empty( $s['btn_one_text'] ) && ! empty( $s['btn_one_link']['url'] );
    $show_btn_two = ! empty( $s['btn_two_text'] ) && ! empty( $s['btn_two_link']['url'] );

    // Check if at least one social icon has a link
    $has_socials = false;
    if ( ! empty( $s['social_items'] ) ) {
      foreach ( $s['social_items'] as $item ) {
        if ( ! empty( $item['icon_class'] ) && ! empty( $item['icon_link']['url'] ) ) {
          $has_socials = true;
          break;
        }
      }
    }
    ?>

    <div class="cta-footer">
      <div class="container">
        <div class="cta-footer-inner">
          <div class="cta-content">

            <?php if ( ! empty( $s['heading'] ) ) : ?>
              <h3><?php echo wp_kses_post( $s['heading'] ); ?></h3>
            <?php endif; ?>

            <?php if ( ! empty( $s['description'] ) ) : ?>
              <p><?php echo wp_kses_post( $s['description'] ); ?></p>
            <?php endif; ?>

            <!-- BUTTONS -->
            <?php if ( $show_btn_one || $show_btn_two ) : ?>
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
            <?php endif; ?>

            <!-- SOCIAL ICONS -->
            <?php if ( $has_socials ) : ?>
              <ul>
                <?php foreach ( $s['social_items'] as $item ) : ?>
                  <?php if ( empty( $item['icon_class'] ) || empty( $item['icon_link']['url'] ) ) continue; ?>
                  <li>
                    <a href="<?php echo esc_url( $item['icon_link']['url'] ); ?>" target="_blank">
                      <i class="<?php echo esc_attr( $item['icon_class'] ); ?>"></i>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>

    <?php
  }
}