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
class GCFt extends Widget_Base {

	public function get_name() {
		return 'green-card-ft-wg';
	}

	public function get_title() {
		return __( 'Fast Transfer', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'gc_banner_settings',
			[
				'label' => __( 'Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gc_ft_title_text_1',
			[
				'label' => __( 'Title Text 1st Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gc_ft_title_text_2',
			[
				'label' => __( 'Title Text 2nd Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);




        $this->add_control(
            'gc_ft_details_text',
            [
                'label' => __( 'Details Text', 'plugin-name' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Default Text', 'plugin-name' ),
                'placeholder' => __( 'Enter your text here', 'plugin-name' ),
                'rows' => 5, // Sets the number of rows
            ]
        );
       // Add Image Control
       $this->add_control(
        'ft_main_image',
        [
            'label' => __( 'Main Image', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]
    );

    $this->add_control(
        'ft_btn_url',
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
        $settings           = $this->get_settings_for_display();
        $title_1            = $settings['gc_ft_title_text_1'];    
        $title_2            = $settings['gc_ft_title_text_2'];      		        				
        $details_text       = $settings['gc_ft_details_text'];   
        $main_image         = $settings['ft_main_image']['url'];
        $btn_url       = $settings['ft_btn_url']['url'];
		?>	
   <section class="fast-transfers">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="fast-transfers-image">
            <img src="<?php echo $main_image; ?>" alt="">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="fast-transfers-copy">
            <h3><?php echo $title_1; ?> <span><?php echo $title_2; ?></span></h3>
            <p><?php echo $details_text; ?></p>

            <a href="<?php echo $btn_url; ?>" class="btn btn-primary"><span>Learn More</span><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/Arrow-right.png" alt=""> </a>
          </div>
        </div>
      </div>
    </div>
   </section>
		<?php
	}
}