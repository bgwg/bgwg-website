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
class GCHw extends Widget_Base {

	public function get_name() {
		return 'green-card-hw-wg';
	}

	public function get_title() {
		return __( 'How It Works', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'gc_hw_settings',
			[
				'label' => __( 'How It Works Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gc_hw_title_text_1',
			[
				'label' => __( 'Title Text 1st Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gc_hw_title_text_2',
			[
				'label' => __( 'Title Text 2nd Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);

        $this->add_control(
            'gc_hw_details_text',
            [
                'label'   => __( 'Content', 'text-domain' ),
                'type'    => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'Accordion Content Goes Here', 'text-domain' ),
            ]
        );




		$this->add_control(
			'gc_hw_title_text_p1',
			[
				'label' => __( 'Title Text 1st Step', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);



        $this->add_control(
            'gc_hw_details_text_p1',
            [
                'label' => __( 'Details Text 1st Step', 'plugin-name' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Default Text', 'plugin-name' ),
                'placeholder' => __( 'Enter your text here', 'plugin-name' ),
                'rows' => 5, // Sets the number of rows
            ]
        );

       // Add Image Control
       $this->add_control(
        'gc_hw_image_p1',
        [
            'label' => __( 'Image 1st Step', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]
    );

    $this->add_control(
        'gc_hw_appstore_url',
        [
            'label' => __( 'App Store Download Link', 'text-domain' ),
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
        'gc_hw_playstore_url',
        [
            'label' => __( 'Play Store Download Link', 'text-domain' ),
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
        'gc_hw_title_text_p2',
        [
            'label' => __( 'Title Text 2nd Step', 'mage-eventpress' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '', 'mage-eventpress' ),
        ]
    );



    $this->add_control(
        'gc_hw_details_text_p2',
        [
            'label' => __( 'Details Text 2nd Step', 'plugin-name' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( 'Default Text', 'plugin-name' ),
            'placeholder' => __( 'Enter your text here', 'plugin-name' ),
            'rows' => 5, // Sets the number of rows
        ]
    );

   // Add Image Control
   $this->add_control(
    'gc_hw_image_p2',
    [
        'label' => __( 'Image 2nd Step', 'text-domain' ),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_control(
    'gc_hw_btn_url_p2',
    [
        'label' => __('Download Link 2nd Step', 'text-domain' ),
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
    'gc_hw_title_text_p3',
    [
        'label' => __( 'Title Text 3rd Step', 'mage-eventpress' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'mage-eventpress' ),
    ]
);



$this->add_control(
    'gc_hw_details_text_p3',
    [
        'label' => __( 'Details Text 3rd Step', 'plugin-name' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( 'Default Text', 'plugin-name' ),
        'placeholder' => __( 'Enter your text here', 'plugin-name' ),
        'rows' => 5, // Sets the number of rows
    ]
);

// Add Image Control
$this->add_control(
'gc_hw_image_p3',
[
    'label' => __( 'Image 3rd Step', 'text-domain' ),
    'type' => \Elementor\Controls_Manager::MEDIA,
    'default' => [
        'url' => \Elementor\Utils::get_placeholder_image_src(),
    ],
]
);

$this->add_control(
'gc_hw_btn_url_p3',
[
    'label' => __('Download Link 3rd Step', 'text-domain' ),
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

        $title_1                    = $settings['gc_hw_title_text_1'];    
        $title_2                    = $settings['gc_hw_title_text_2'];             		      				
        $details_text               = $settings['gc_hw_details_text'];   

        $gc_hw_title_text_p1        = $settings['gc_hw_title_text_p1']; 
        $gc_hw_details_text_p1      = $settings['gc_hw_details_text_p1'];
        $gc_hw_image_p1             = $settings['gc_hw_image_p1']['url'];
        $appstore_url               = $settings['gc_hw_appstore_url']['url'];
        $playstore_url              = $settings['gc_hw_playstore_url']['url'];

        $gc_hw_title_text_p2        = $settings['gc_hw_title_text_p2']; 
        $gc_hw_details_text_p2      = $settings['gc_hw_details_text_p2'];
        $gc_hw_image_p2             = $settings['gc_hw_image_p2']['url'];
        $dl_btn_url_p2              = $settings['gc_hw_btn_url_p2']['url'];

        $gc_hw_title_text_p3        = $settings['gc_hw_title_text_p3']; 
        $gc_hw_details_text_p3      = $settings['gc_hw_details_text_p3'];
        $gc_hw_image_p3             = $settings['gc_hw_image_p3']['url'];
        $dl_btn_url_p3              = $settings['gc_hw_btn_url_p3']['url'];


		?>	
    <section class="how-it-works">
      <div class="section-header-wrapper">
        <div class="container">
          <div class="section-header">
            <div class="title">
              <h2><?php echo $title_1; ?> <span><?php echo $title_2; ?></span> </h2>
            </div>
          </div>
          <div class="sub-description">
          <?php echo $details_text; ?>
          </div>


          <div class="how-works-contents">
            <div class="left-bar"></div>
            <div class="row">

              <div class="col-sm-6">
                <div class="left-image">
                  <img src="<?php echo $gc_hw_image_p1; ?>" alt="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="right-copy">
                  <h2> <?php echo $gc_hw_title_text_p1; ?></h2>
                  <p><?php echo $gc_hw_details_text_p1; ?></p>
                  <ul class="list-unstyled">
                    <li><a href="<?php echo $appstore_url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/apple-store.png" alt=""> </a></li>
                    <li><a href="<?php echo $playstore_url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/google-play.png" alt=""> </a></li>
                  </ul>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="left-image">
                  <img src="<?php echo $gc_hw_image_p2; ?>" alt="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="right-copy">
                <h2> <?php echo $gc_hw_title_text_p2; ?></h2>
                <p><?php echo $gc_hw_details_text_p2; ?></p>
                  <a href="<?php echo $dl_btn_url_p2; ?>" class="btn btn-primary">Download Now!</a>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="left-image">
                  <img src="<?php echo $gc_hw_image_p3; ?>" alt="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="right-copy">
                <h2> <?php echo $gc_hw_title_text_p3; ?></h2>
                <p><?php echo $gc_hw_details_text_p3; ?></p>
                  <a href="<?php echo $dl_btn_url_p3; ?>" class="btn btn-primary">Download Now!</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>

		<?php
	}
}