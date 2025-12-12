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
class GCCBanner extends Widget_Base {

	public function get_name() {
		return 'green-card-customer-banner-wg';
	}

	public function get_title() {
		return __( 'Banner', 'mage-eventpress' );
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
				'label' => __( 'Banner Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gcc_title_text_1',
			[
				'label' => __( 'Title Text 1st Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gcc_title_text_2',
			[
				'label' => __( 'Title Text 2nd Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
	



        $this->add_control(
            'gcc_details_text',
            [
                'label' => __( 'Details Text', 'plugin-name' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Default Text', 'plugin-name' ),
                'placeholder' => __( 'Enter your text here', 'plugin-name' ),
                'rows' => 5, // Sets the number of rows
            ]
        );


        $this->add_control(
            'gcc_appstore_btn_url',
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
        $this->add_control(
            'gcc_playstore_btn_url',
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



       // Add Image Control
       $this->add_control(
        'gcc_main_image',
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
        $settings           = $this->get_settings_for_display();
        $title_1            = $settings['gcc_title_text_1'];    
        $title_2            = $settings['gcc_title_text_2'];    
        $appstore_btn_url   = $settings['gcc_appstore_btn_url']['url'];  
        $playstore_btn_url  = $settings['gcc_playstore_btn_url']['url'];  		        				
        $details_text       = $settings['gcc_details_text'];   
        $main_image         = $settings['gcc_main_image']['url'];        
		?>	
  <div class="banner customer-banner">
    <div class="banner__slider">
        <div class="banner__content" style="background: url(&quot;<?php echo get_template_directory_uri(); ?>/images/home-page/banner-bg.png&quot;) center center / cover repeat; margin: auto;">
            <div class="container">
              <div class="bredcarm">
                <ul class="list-unstyled">
                <li><a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name');  ?></a></li>
                <li><a class="active" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                </ul>
              </div>
                <div class="row banner-row">
                    <div class="col-sm-6">
                        <!-- <span class="banner__content-date">28 March 2022</span>  -->
                        <h1 class="banner__content-title">
                          <span class="color-main"><?php echo $title_1; ?></span> <?php echo $title_2; ?>
                        </h1>
                        <p class="banner__content-description">
                        <?php echo $details_text; ?>
                        </p>
                        <div class="banner__content-logo">
                          <ul class="list-unstyled">
                            <li><a href="<?php echo $appstore_btn_url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/apple-store.png" alt=""> </a></li>
                            <li><a href="<?php echo $playstore_btn_url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/google-play.png" alt=""> </a></li>
                          </ul>
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
		<?php
	}
}