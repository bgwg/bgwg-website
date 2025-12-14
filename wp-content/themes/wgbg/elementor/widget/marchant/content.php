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
class GCMContent extends Widget_Base {

	public function get_name() {
		return 'green-card-marchant-content-wg';
	}

	public function get_title() {
		return __( 'Content', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support-marchant' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'gcm_instore_settings',
			[
				'label' => __( 'Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gcm_title_text_1',
			[
				'label' => __( 'Title Text 1', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);

        $this->add_control(
            'gcm_details_text_1',
            [
                'label' => __( 'Details Text 1', 'plugin-name' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Default Text', 'plugin-name' ),
                'placeholder' => __( 'Enter your text here', 'plugin-name' ),
                'rows' => 5, // Sets the number of rows
            ]
        );



		$this->add_control(
			'gcm_btn_text_1',
			[
				'label' => __( 'Button Text 1', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
	
        $this->add_control(
            'gcm_btn_url_1',
            [
                'label' => __( 'Button Link 1', 'text-domain' ),
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

       // Add Image Control
       $this->add_control(
        'gcm_main_image_1',
        [
            'label' => __( 'Main Image 1', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]
    );





    $this->add_control(
        'gcm_title_text_2',
        [
            'label' => __( 'Title Text 2', 'mage-eventpress' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '', 'mage-eventpress' ),
        ]
    );

    $this->add_control(
        'gcm_details_text_2',
        [
            'label' => __( 'Details Text 2', 'plugin-name' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( 'Default Text', 'plugin-name' ),
            'placeholder' => __( 'Enter your text here', 'plugin-name' ),
            'rows' => 5, // Sets the number of rows
        ]
    );



    $this->add_control(
        'gcm_btn_text_2',
        [
            'label' => __( 'Button Text 2', 'mage-eventpress' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '', 'mage-eventpress' ),
        ]
    );

    $this->add_control(
        'gcm_btn_url_2',
        [
            'label' => __( 'Button Link 2', 'text-domain' ),
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

   // Add Image Control
   $this->add_control(
    'gcm_main_image_2',
    [
        'label' => __( 'Main Image 2', 'text-domain' ),
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
        $settings           = $this->get_settings_for_display();

        $gcm_title_text_1              = $settings['gcm_title_text_1'];    
        $gcm_details_text_1             = $settings['gcm_details_text_1'];    
        $gcm_btn_text_1                 = $settings['gcm_btn_text_1'];  		        				
        $gcm_btn_url_1                  = $settings['gcm_btn_url_1']['url'];   
        $gcm_main_image_1               = $settings['gcm_main_image_1']['url'];

        $gcm_title_text_2               = $settings['gcm_title_text_2'];    
        $gcm_details_text_2             = $settings['gcm_details_text_2'];    
        $gcm_btn_text_2                 = $settings['gcm_btn_text_2'];  		        				
        $gcm_btn_url_2                  = $settings['gcm_btn_url_2']['url'];   
        $gcm_main_image_2               = $settings['gcm_main_image_2']['url'];
        


		?>	


<section class="instore">
      <div class="container">
        <div class="instore-contents">
          <div class="row">
            <div class="col-sm-6">
              <div class="right-copy">
                <h2><?php echo $gcm_title_text_1; ?></h2>
                <p><?php echo $gcm_details_text_1; ?></p>
                <a href="<?php echo $gcm_btn_url_1; ?>" class="btn btn-primary"><span><?php echo $gcm_btn_text_1; ?></span><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/Arrow-right.png" alt=""> </a>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="left-image">
                <img src="<?php echo $gcm_main_image_1; ?>" alt="">
              </div>
            </div>
            <div class="col-sm-6 col-sm-push-6">
              <div class="right-copy">
                <h2><span><?php echo $gcm_title_text_2; ?></span></h2>
                <p><?php echo $gcm_details_text_2; ?></p>
               
                <a href="<?php echo $gcm_btn_url_2; ?>" class="btn btn-primary"><span><?php echo $gcm_btn_text_2; ?></span><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/Arrow-right.png" alt=""> </a>
              </div>
            </div>
            <div class="col-sm-6 col-sm-pull-6">
              <div class="left-image">
                <img src="<?php echo $gcm_main_image_2; ?>" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>




		<?php
	}
}