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
class GCSlider extends Widget_Base {

	public function get_name() {
		return 'green-card-slider-wg';
	}

	public function get_title() {
		return __( 'Slider', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'gc_slider_settings',
			[
				'label' => __( 'Slider Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gc_slider_title_text_1',
			[
				'label' => __( 'Title Text 1st Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gc_slider_title_text_2',
			[
				'label' => __( 'Title Text 2nd Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gc_slider_title_text_3',
			[
				'label' => __( 'Title Text 3rd Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);


                // Use a Repeater to Add Multiple Accordion Items
                $repeater = new \Elementor\Repeater();

                // Accordion Title
                $repeater->add_control(
                    'title',
                    [
                        'label'   => __( 'Title', 'text-domain' ),
                        'type'    => \Elementor\Controls_Manager::TEXT,
                        'default' => __( 'Slider Title', 'text-domain' ),
                    ]
                );
        
                // Accordion Content
                $repeater->add_control(
                    'content',
                    [
                    'label' => __( 'Details Text', 'plugin-name' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __( 'Default Text', 'plugin-name' ),
                    'placeholder' => __( 'Enter your text here', 'plugin-name' ),
                    'rows' => 5, // Sets the number of rows
                    ]
                );

                $repeater->add_control(
                    'main_image',
                    [
                        'label' => __( 'Image', 'text-domain' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                );

        // Add the Repeater to the Controls
        $this->add_control(
            'slider_items',
            [
                'label'       => __( 'Slider Items', 'text-domain' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'   => __( 'INDUSTRY-BEST SECURITY', 'text-domain' ),
                        'content' => __( 'Using 2048-bit encryption, your data, and your money, is secure at every point in your Greencard transaction. Buy with confidence!', 'text-domain' ),
                    ]
                ],
                'title_field' => '{{{ title }}}', // Display the title in the Repeater
            ]
        );
        $this->end_controls_section();
	}

	protected function render() {
        global $post;
        $settings           = $this->get_settings_for_display();
        $title_1            = $settings['gc_slider_title_text_1'];    
        $title_2            = $settings['gc_slider_title_text_2'];    
        $title_3            = $settings['gc_slider_title_text_3'];    		        				
        $slider_item        = $settings['slider_items'];
?>	
    <section class="make-digital-wrapper">
        <div class="section-header-wrapper">
          <div class="container">
            <div class="section-header">
              <div class="title">
                <h2><?php echo $title_1; if($title_2){ ?> <span><?php echo $title_2; ?></span> <?php } echo $title_3; ?></h2>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="featured-digital-slider">

                    <?php  if ( ! empty( $slider_item ) ) { 
                                   foreach ( $slider_item as $index => $item ) {
                                    $accordion_id = 'accordion-' . $this->get_id() . '-' . $index;
                                    $title = $item['title'];
                                    $content = $item['content'];
                                    $img = $item['main_image']['url'];
                        ?> 

                        <div class="featured-digital-item">
                          <div class="card-contents">
                            <div class="card-contents-copy">
                              <h3><?php echo $title; ?></h3>
                              <p><?php echo $content; ?></p>
                            </div>
                            <div class="icon">
                              <img src="<?php echo $img; ?>" alt="">
                            </div>
                          </div>
                        </div>  
                        <?php } } ?>                        
                    </div>
                    <!-- <span class="pagingInfo"></span> -->
                </div>
            </div>
        </div>
    </section>
		<?php
	}
}