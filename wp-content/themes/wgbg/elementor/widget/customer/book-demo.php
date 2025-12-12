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
class GCCBD extends Widget_Base {

	public function get_name() {
		return 'green-card-customer-bd-wg';
	}

	public function get_title() {
		return __( 'Book a Demo', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support-customer' ];
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
                'label' => __( 'Details Text', 'plugin-name' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Default Text', 'plugin-name' ),
                'placeholder' => __( 'Enter your text here', 'plugin-name' ),
                'rows' => 5, // Sets the number of rows
            ]
        );
		$this->add_control(
			'gcbc_form',
			[
				'label' => __( 'Form Shortcode', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
       // Add Image Control
       $this->add_control(
        'gcbc_main_image',
        [
            'label' => __( 'Main Image', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
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
        $gcbc_form                  = $settings['gcbc_form'];   
        $main_image                 = $settings['gcbc_main_image']['url'];        
		?>	
    <div class="banner book-demo-banner">
        <div class="banner__slider">
            <div class="banner__content">
                <div class="container">
                  <div class="bredcarm">
                    <ul class="list-unstyled">
                    <li><a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name');  ?></a></li>
                    <li><a class="active" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                    </ul>
                  </div>
                  <div class="banner-content-inner">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="section-header">
                          <div class="title">
                            <h2><?php echo $title_1; ?> <span><?php echo $title_2; ?></span></h2>
                            <p><?php echo $gcbc_details_text; ?></p>
                          </div>
                        </div>
                      </div>
                        <div class="col-sm-6">
                          <div class="signup-form">
                           <?php if($gcbc_form){ echo do_shortcode($gcbc_form); } ?>
                          </div> 
                         
                        </div>
                        <div class="col-sm-6">
                          <img src="<?php echo $main_image; ?>" alt="">
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