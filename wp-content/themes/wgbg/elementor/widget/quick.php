<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class GCQk extends Widget_Base {

	public function get_name() {
		return 'green-card-qk-wg';
	}

	public function get_title() {
		return __( 'Call To Action', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'gc_qk_settings',
			[
				'label' => __( 'Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gc_qk_sub_title_text',
			[
				'label' => __( 'Subtitle Title Text', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gc_qk_title_text',
			[
				'label' => __( 'Title Text', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'gc_qk_btn_title_text',
			[
				'label' => __( 'Button Text', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);


    $this->add_control(
        'gc_qk_btn_url',
        [
            'label' => __( 'Button Link', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __( 'https://example.com', 'text-domain' ),
            'default' => [
                'url' => '',
                'is_external' => false, // Open in a new tab (default is false)
                'nofollow' => false,    // Add nofollow attribute (default is false)
            ],
            'label_block' => true, // Make the control take up the full width
        ]
    );	



        $this->end_controls_section();
	
	}

	protected function render() {
        global $post;
        $settings                   = $this->get_settings_for_display();

        $title_1                    = $settings['gc_qk_sub_title_text'];    
        $title_2                    = $settings['gc_qk_title_text'];             		      				
        $btn_text               = $settings['gc_qk_btn_title_text'];   
        $dl_btn_url_p3              = $settings['gc_qk_btn_url']['url'];


		?>	
   <section class="the-quick">
    <div class="bottom-shape"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="the-quick-copy">
            <p><?php echo  $title_1; ?></p>
            <h3><?php echo  $title_2; ?></h3>
            <a href="<?php echo  $dl_btn_url_p3; ?>" class="btn btn-demo"><?php echo  $btn_text; ?></a>
          </div>
        </div>
      </div>
    </div>
   </section>

		<?php
	}
}