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
class GCFaq extends Widget_Base {

	public function get_name() {
		return 'green-card-faq';
	}

	public function get_title() {
		return __( 'FAQ', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'gc_faq_settings',
			[
				'label' => __( 'FAQ Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gc_faq_title_text_1',
			[
				'label' => __( 'Title Text 1st Part', 'mage-eventpress' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'mage-eventpress' ),
			]
		);
		$this->add_control(
			'gc_faq_title_text_2',
			[
				'label' => __( 'Title Text 2nd Part', 'mage-eventpress' ),
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

            

        // Add the Repeater to the Controls
        $this->add_control(
            'faq_items',
            [
                'label'       => __( 'FAQ Items', 'text-domain' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'   => __( 'Are you sure that my Greencard transactions are secure?', 'text-domain' ),
                        'content' => __( 'Absolutely! Every transaction through Greencard uses 2048-bit encryption and passes through our secured server. We use industry-best security measures, so you can shop with confidence.', 'text-domain' ),
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
        $title_1            = $settings['gc_faq_title_text_1'];    
        $title_2            = $settings['gc_faq_title_text_2'];    
 		        				
        $slider_item        = $settings['faq_items'];
?>	
  <section class="faq">
    <div class="section-header-wrapper">
      <div class="container">
        <div class="section-header">
          <div class="title">
            <h2><?php echo $title_1; ?> <span><?php echo $title_2; ?></span></h2>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="panel-group" id="accordion">


      <?php  if ( ! empty( $slider_item ) ) { 
                                   foreach ( $slider_item as $index => $item ) {
                                    $accordion_id = 'accordion-' . $this->get_id() . '-' . $index;
                                    $title = $item['title'];
                                    $content = $item['content'];
                                    // $img = $item['main_image']['url'];
                        ?> 
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $accordion_id; ?>" aria-expanded="false" aria-controls="collapseTwo">
                                <?php echo $title; ?>
                                </a>
                                </h4>
                            </div>
                            <div id="collapseTwo<?php echo $accordion_id; ?>" class="panel-collapse collapse">
                                <div class="panel-body"><?php echo $content; ?></div>
                            </div>
                        </div>
         <?php } } ?>
        </div>
    </div>
  </section>
		<?php
	}
}