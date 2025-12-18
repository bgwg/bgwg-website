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
class GCPage extends Widget_Base {

	public function get_name() {
		return 'green-card-default-page-wg';
	}

	public function get_title() {
		return __( 'Page Content', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'gcc_banner_settings',
			[
				'label' => __( 'Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gcbc_title_text_1',
			[
				'label' => __( 'Title Text 1st Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gcbc_title_text_2',
			[
				'label' => __( 'Title Text 2nd Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
	
        $this->add_control(
            'gcbc_details_text',
            [
                'label'   => __( 'Content', 'text-domain' ),
                'type'    => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'Accordion Content Goes Here', 'text-domain' ),
            ]
        );

       
        $this->end_controls_section();
	
	}

	protected function render() {
        global $post;
        $settings                   = $this->get_settings_for_display();
        $title_1                    = $settings['gcbc_title_text_1'];    
        $title_2                    = $settings['gcbc_title_text_2'];    
        $gcbc_details_text          = $settings['gcbc_details_text'];   
		?>	
    <div class="page-template"> 
      <div class="menu-height-bg" style="background: #000; min-height: 90px;"></div>
      <div class="container">
        <div class="page-content-inner">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-content">
              <?php echo $gcbc_details_text; ?>
              </div>                          
            </div>
          </div> 
        </div>
      </div>
      <!-- <div class="footer-height-adjust" style="min-height: 180px; background: #fff;"></div> -->
    </div>
		<?php
	}
}