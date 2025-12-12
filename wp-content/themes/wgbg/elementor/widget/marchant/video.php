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
class GCMVideo extends Widget_Base {

	public function get_name() {
		return 'green-card-video-ca-wg';
	}

	public function get_title() {
		return __( 'Video', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support-marchant' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'gcm_video_settings',
			[
				'label' => __( 'Settings', 'mage-eventpress' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

       // Add Image Control
       $this->add_control(
        'gcm_video_main_image',
        [
            'label' => __( 'Video Thumbnail Image', 'text-domain' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]
    );

    $this->add_control(
        'gcm_video_url',
        [
            'label'       => __('Video URL', 'text-domain'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'input_type'  => 'url',
            'placeholder' => __('https://www.youtube.com/watch?v=example', 'text-domain'),
        ]
    );   


        $this->end_controls_section();
	
	}

	protected function render() {
        global $post;
        $settings           = $this->get_settings_for_display();
 
        $gcm_video_main_image          = $settings['gcm_video_main_image']['url']; 
        $gcm_video_url                 = $settings['gcm_video_url'];
		?>	
  <div class="video-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="video-container" id="videoContainer">
            <img src="<?php echo $gcm_video_main_image; ?>" alt="Video Thumbnail" class="thumbnails" id="thumbnail">
            <button class="play-button" id="playButton">▶</button>
            <video class="video" id="video" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1333547/toystory_1.mp4"></video>
          </div> 
        </div>
      </div>
    </div>
  </div>

		<?php
	}
}