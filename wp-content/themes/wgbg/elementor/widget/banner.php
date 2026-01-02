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
class GCBanner extends Widget_Base {

	public function get_name() {
		return 'green-card-banner-wg';
	}

	public function get_title() {
		return __( 'Banner', 'mage-eventpress' );
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
				'label' => __( 'Banner Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gc_title_text_1',
			[
				'label' => __( 'Title Text 1st Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gc_title_text_2',
			[
				'label' => __( 'Title Text 2nd Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gc_title_text_3',
			[
				'label' => __( 'Title Text 3rd Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);



        $this->add_control(
            'gc_details_text',
            [
                'label' => __( 'Details Text', 'plugin-name' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Default Text', 'plugin-name' ),
                'placeholder' => __( 'Enter your text here', 'plugin-name' ),
                'rows' => 5, // Sets the number of rows
            ]
        );
        $this->add_control(
            'gc_details_text_two',
            [
                'label' => __( 'Details Text two', 'plugin-name' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Default Text two', 'plugin-name' ),
                'placeholder' => __( 'Enter your text here', 'plugin-name' ),
                'rows' => 5, // Sets the number of rows
            ]
        );
       // Add Image Control
    //    $this->add_control(
    //     'main_image',
    //     [
    //         'label' => __( 'Main Image', 'text-domain' ),
    //         'type' => \Elementor\Controls_Manager::MEDIA,
    //         'default' => [
    //             'url' => \Elementor\Utils::get_placeholder_image_src(),
    //         ],
    //     ]
    // );

    $this->add_control(
        'appstore_url',
        [
            'label' => __( 'First button Link', 'text-domain' ),
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
        'playstore_url',
        [
            'label' => __( 'Second button Link', 'text-domain' ),
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
        'gc_vimeo_id',
        [
            'label' => __( 'Vimeo Video ID', 'mage-eventpress' ),
            'type' => Controls_Manager::TEXT,
            'default' => '703934354',
            'placeholder' => 'Enter Vimeo Video ID',
        ]
    );



    $this->end_controls_section();
	
	}

	protected function render() {
        global $post;
        $settings           = $this->get_settings_for_display();
        $title_1            = $settings['gc_title_text_1'];    
        $title_2            = $settings['gc_title_text_2'];    
        $title_3            = $settings['gc_title_text_3'];    		        				
        $details_text       = $settings['gc_details_text'];   
        $details_text_two   = $settings['gc_details_text_two'];   
        // $main_image         = $settings['main_image']['url'];
        $appstore_url       = $settings['appstore_url']['url'];
        $playstore_url      = $settings['playstore_url']['url'];
        $vimeo_id = $settings['gc_vimeo_id'];
        
        ?>

<div class="banner">
    <div id="bannerSlider" class="banner__slider">
        <div class="banner__video-wrap">
            <iframe
            class="banner__video"
            src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>?background=1&autoplay=1&loop=1&muted=1&controls=0"
            frameborder="0"
            allow="autoplay; fullscreen"
            ></iframe>

            <div class="banner__content">
                <div class="container">
                    <div class="row banner-row video-bg-content">
                        <div class="col-sm-12 text-center">
                            <div class="banner__content-main">
                                <h1 class="banner__content-title"><?php echo $title_1; ?></h1>
                                <h2><?php echo $title_2; ?></h2>
                                <p class="banner__content-description"><?php echo $details_text; ?></p>
                                <p class="banner__content-description2"><?php echo $details_text_two; ?></p>
                                <div class="banner__content-logo">
                                    <ul class="list-unstyled">
                                        <li><a href="<?php echo esc_url($appstore_url); ?>" class="btn btn-primary">Start a Conversation</a></li>
                                        <li><a href="<?php echo esc_url($playstore_url); ?>" class="btn btn-success">See Our Work</a></li>
                                    </ul>
                                </div>
                            </div>
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