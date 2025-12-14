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
class GCCSG extends Widget_Base {

	public function get_name() {
		return 'green-card-customer-sp-wg';
	}

	public function get_title() {
		return __( 'Signup Process', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
        return [ 'green-card-elementor-support-customer' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'gcc_sp_settings',
			[
				'label' => __( 'Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);










// Step 1
		$this->add_control(
			'gcc_sp_number_text_p1',
			[
				'label' => __( 'Number Text 1st Step', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gcc_sp_title_text_p1',
			[
				'label' => __( 'Title Text 1st Step', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
        $this->add_control(
            'gcc_sp_details_text_p1',
            [
                'label' => __( 'Details Text 1st Step', 'plugin-name' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Default Text', 'plugin-name' ),
                'placeholder' => __( 'Enter your text here', 'plugin-name' ),
                'rows' => 5, // Sets the number of rows
            ]
        );
		$this->add_control(
			'gcc_sp_btn_text_p1',
			[
				'label' => __( 'Button Text 1st Step', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
        $this->add_control(
            'gcc_sp_btn_url',
            [
                'label' => __( 'Button Link 1st Step', 'text-domain' ),
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
        'gcc_sp_image_p1',
        [
            'label' => __( 'Image 1st Step', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]
    );

// Step 2
$this->add_control(
    'gcc_sp_number_text_p2',
    [
        'label' => __( 'Number Text 2nd Step', 'mage-eventpress' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'mage-eventpress' ),
    ]
);
$this->add_control(
    'gcc_sp_title_text_p2',
    [
        'label' => __( 'Title Text 2nd Step', 'mage-eventpress' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'mage-eventpress' ),
    ]
);
$this->add_control(
    'gcc_sp_details_text_p2',
    [
        'label' => __( 'Details Text 2nd Step', 'plugin-name' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( 'Default Text', 'plugin-name' ),
        'placeholder' => __( 'Enter your text here', 'plugin-name' ),
        'rows' => 5, // Sets the number of rows
    ]
);
$this->add_control(
    'gcc_sp_btn_text_p2',
    [
        'label' => __( 'Button Text 2nd Step', 'mage-eventpress' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'mage-eventpress' ),
    ]
);
$this->add_control(
    'gcc_sp_btn_url_2',
    [
        'label' => __( 'Button Link 2nd Step', 'text-domain' ),
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
'gcc_sp_image_p2',
[
    'label' => __( 'Image 2nd Step', 'text-domain' ),
    'type' => \Elementor\Controls_Manager::MEDIA,
    'default' => [
        'url' => \Elementor\Utils::get_placeholder_image_src(),
    ],
]
);


// Step 3
$this->add_control(
    'gcc_sp_number_text_p3',
    [
        'label' => __( 'Number Text 3rd Step', 'mage-eventpress' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'mage-eventpress' ),
    ]
);
$this->add_control(
    'gcc_sp_title_text_p3',
    [
        'label' => __( 'Title Text 3rd Step', 'mage-eventpress' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'mage-eventpress' ),
    ]
);
$this->add_control(
    'gcc_sp_details_text_p3',
    [
        'label' => __( 'Details Text 3rd Step', 'plugin-name' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( 'Default Text', 'plugin-name' ),
        'placeholder' => __( 'Enter your text here', 'plugin-name' ),
        'rows' => 5, // Sets the number of rows
    ]
);
$this->add_control(
    'gcc_sp_btn_text_p3',
    [
        'label' => __( 'Button Text 3rd Step', 'mage-eventpress' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'mage-eventpress' ),
    ]
);
$this->add_control(
    'gcc_sp_btn_url_3',
    [
        'label' => __( 'Button Link 3rd Step', 'text-domain' ),
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
'gcc_sp_image_p3',
[
    'label' => __( 'Image 3rd Step', 'text-domain' ),
    'type' => \Elementor\Controls_Manager::MEDIA,
    'default' => [
        'url' => \Elementor\Utils::get_placeholder_image_src(),
    ],
]
);



// Step 4
$this->add_control(
    'gcc_sp_number_text_p4',
    [
        'label' => __( 'Number Text 4th Step', 'mage-eventpress' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'mage-eventpress' ),
    ]
);
$this->add_control(
    'gcc_sp_title_text_p4',
    [
        'label' => __( 'Title Text 4th Step', 'mage-eventpress' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'mage-eventpress' ),
    ]
);
$this->add_control(
    'gcc_sp_details_text_p4',
    [
        'label' => __( 'Details Text 4th Step', 'plugin-name' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( 'Default Text', 'plugin-name' ),
        'placeholder' => __( 'Enter your text here', 'plugin-name' ),
        'rows' => 5, // Sets the number of rows
    ]
);
// Add Image Control
$this->add_control(
'gcc_sp_image_p4',
[
    'label' => __( 'Image 4th Step', 'text-domain' ),
    'type' => \Elementor\Controls_Manager::MEDIA,
    'default' => [
        'url' => \Elementor\Utils::get_placeholder_image_src(),
    ],
]
);




$this->add_control(
    'gcc_sp_appstore_btn_url',
    [
        'label' => __( 'Appstore Link', 'text-domain' ),
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
    'gcc_sp_playstore_btn_url',
    [
        'label' => __( 'Playstore Link', 'text-domain' ),
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


        $gcc_sp_number_text_p1          = $settings['gcc_sp_number_text_p1']; 
        $gcc_sp_title_text_p1           = $settings['gcc_sp_title_text_p1']; 
        $gcc_sp_details_text_p1         = $settings['gcc_sp_details_text_p1'];
        $gc_hw_image_p1                 = $settings['gcc_sp_image_p1']['url'];
        $gcc_sp_btn_text_p1             = $settings['gcc_sp_btn_text_p1'];
        $gcc_sp_btn_url_1               = $settings['gcc_sp_btn_url_1']['url'];
        

        $gcc_sp_number_text_p2          = $settings['gcc_sp_number_text_p2']; 
        $gcc_sp_title_text_p2           = $settings['gcc_sp_title_text_p2']; 
        $gcc_sp_details_text_p2         = $settings['gcc_sp_details_text_p2'];
        $gc_hw_image_p2                 = $settings['gcc_sp_image_p2']['url'];
        $gcc_sp_btn_text_p2             = $settings['gcc_sp_btn_text_p2'];
        $gcc_sp_btn_url_2               = $settings['gcc_sp_btn_url_2']['url'];


        $gcc_sp_number_text_p3          = $settings['gcc_sp_number_text_p3']; 
        $gcc_sp_title_text_p3           = $settings['gcc_sp_title_text_p3']; 
        $gcc_sp_details_text_p3         = $settings['gcc_sp_details_text_p3'];
        $gc_hw_image_p3                 = $settings['gcc_sp_image_p3']['url'];
        $gcc_sp_btn_text_p3             = $settings['gcc_sp_btn_text_p3'];
        $gcc_sp_btn_url_3               = $settings['gcc_sp_btn_url_3']['url'];



        $gcc_sp_number_text_p4          = $settings['gcc_sp_number_text_p4']; 
        $gcc_sp_title_text_p4           = $settings['gcc_sp_title_text_p4']; 
        $gcc_sp_details_text_p4         = $settings['gcc_sp_details_text_p4'];
        $gc_hw_image_p4                 = $settings['gcc_sp_image_p4']['url'];

        $gcc_sp_appstore_btn_url               = $settings['gcc_sp_appstore_btn_url']['url'];
        $gcc_sp_playstore_btn_url               = $settings['gcc_sp_playstore_btn_url']['url'];

		?>	


<section class="signup-process">
      <div class="section-header-wrapper">
        <div class="container">
          
          <div class="signup-process-contents">
            <div class="left-bar"></div>
            <div class="row">

              <div class="col-sm-6">
                <div class="right-copy">
                  <span class="number"><?php echo $gcc_sp_number_text_p1; ?></span>
                  <h2><?php echo $gcc_sp_title_text_p1; ?></h2>
                  <p><?php echo $gcc_sp_details_text_p1; ?></p>
                  <a href="<?php echo $gcc_sp_btn_url_1; ?>" class="btn btn-primary"><?php echo $gcc_sp_btn_text_p1; ?></a>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="left-image">
                  <img src="<?php echo $gc_hw_image_p1; ?>" alt="">
                </div>
              </div>
              <div class="col-sm-6 col-sm-push-6">
                <div class="right-copy">
                  <span class="number"><?php echo $gcc_sp_number_text_p2; ?></span>
                  <h2><?php echo $gcc_sp_title_text_p2; ?></h2>
                  <p><?php echo $gcc_sp_details_text_p2; ?></p>
                  <a href="<?php echo $gcc_sp_btn_url_2; ?>" class="btn btn-primary"><?php echo $gcc_sp_btn_text_p2; ?></a>
                </div>
              </div>
              <div class="col-sm-6 col-sm-pull-6">
                <div class="left-image">
                  <img src="<?php echo $gc_hw_image_p2; ?>" alt="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="right-copy">
                  <span class="number"><?php echo $gcc_sp_number_text_p3; ?></span>
                  <h2><?php echo $gcc_sp_title_text_p3; ?></h2>
                  <p><?php echo $gcc_sp_details_text_p3; ?></p>
                  <a href="<?php echo $gcc_sp_btn_url_3; ?>" class="btn btn-primary"><?php echo $gcc_sp_btn_text_p3; ?></a>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="left-image">
                  <img src="<?php echo $gc_hw_image_p3; ?>" alt="">
                </div>
              </div>
              <div class="col-sm-6 col-sm-push-6">
                <div class="right-copy">
                  <span class="number"><?php echo $gcc_sp_number_text_p4; ?></span>
                  <h2><?php echo $gcc_sp_title_text_p4; ?></h2>
                  <p><?php echo $gcc_sp_details_text_p4; ?></p>
                  <ul class="list-unstyled">
                    <li><a href="<?php echo $gcc_sp_appstore_btn_url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/apple-store.png" alt=""> </a></li>
                    <li><a href="<?php echo $gcc_sp_playstore_btn_url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/google-play.png" alt=""> </a></li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-sm-pull-6">
                <div class="left-image">
                  <img src="<?php echo $gc_hw_image_p4; ?>" alt="">
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