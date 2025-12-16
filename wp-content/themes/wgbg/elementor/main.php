<?php

namespace MEPPlugin;

class MEPPluginElementor {
	
	private static $_instance = null;
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		
		return self::$_instance;
	}
	
	public function widget_scripts() {
		//wp_register_script( 'tour-booking-helper-script', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}
	
	public function add_widget_categories( $elements_manager ) {
		
		$elements_manager->add_category(
			'green-card-elementor-support',
			[
				'title' => __( 'Green Card Home Elementor ', 'greencard'),
				'icon'  => 'fa fa-plug',
			]
		);

		$elements_manager->add_category(
			'green-card-elementor-support-marchant',
			[
				'title' => __( 'Green Card Marchant Elementor ', 'greencard'),
				'icon'  => 'fa fa-plug',
			]
		);

		$elements_manager->add_category(
			'green-card-elementor-support-customer',
			[
				'title' => __( 'Green Card Customer Elementor ', 'greencard'),
				'icon'  => 'fa fa-plug',
			]
		);
		
	}
	
	private function include_widgets_files() {
		// Home Widgets
		require_once( __DIR__ . '/widget/banner.php' );		
		require_once( __DIR__ . '/widget/experimental-engine.php' );
		require_once( __DIR__ . '/widget/brand-choose.php'); 
		require_once( __DIR__ . '/widget/featured-digital-slider.php'); 
		require_once( __DIR__ . '/widget/engine-motion.php'); 
		require_once( __DIR__ . '/widget/the-people.php'); 
		require_once( __DIR__ . '/widget/form-ready-power.php'); 
		require_once( __DIR__ . '/widget/cta-footer.php'); 
		require_once( __DIR__ . '/widget/contact-banner.php'); 
		require_once( __DIR__ . '/widget/contact-us.php'); 
		require_once( __DIR__ . '/widget/our-work.php'); 
		require_once( __DIR__ . '/widget/slider.php' );		
		require_once( __DIR__ . '/widget/how-works.php' );	
		require_once( __DIR__ . '/widget/fast-transfer.php' );	
		require_once( __DIR__ . '/widget/quick.php' );	
		require_once( __DIR__ . '/widget/faq.php' );
		require_once( __DIR__ . '/widget/page.php' );
		
		// About us Page Widgets
		require_once( __DIR__ . '/widget/about-us/about-banner.php' );
		require_once( __DIR__ . '/widget/about-us/what-drives.php' );

		// Marchat Page Widgets
		require_once( __DIR__ . '/widget/marchant/banner.php' );
		require_once( __DIR__ . '/widget/marchant/content.php' );
		require_once( __DIR__ . '/widget/marchant/call_to_action.php' );
		require_once( __DIR__ . '/widget/marchant/video.php' );

		// Customer Page Widgets
		require_once( __DIR__ . '/widget/customer/banner.php' );
		require_once( __DIR__ . '/widget/customer/steps.php' );
		require_once( __DIR__ . '/widget/customer/book-demo.php' );
		require_once( __DIR__ . '/widget/customer/contact-us.php' );
	}
	
	public function register_widgets() {
		
		// Its is now safe to include Widgets files
		$this->include_widgets_files();
		
		// Register Home Widgets		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCBanner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCCardTiles() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCBrandChoose() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCFeaturedDigitalSlider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCEngineMotion() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCThePeople() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCFormReadyPower() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCCtaFooter() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCSlider() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCHw() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCFt() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCQk() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCFaq() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCPage() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCContactBanner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCContactUs() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCOurWork() );

		// Register About us Page Widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCAboutBanner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCWhatDrives() );


		// Register Marchats Page Widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCMBanner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCMContent() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCMCA() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCMVideo() );

		// Regster Customer Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCCBanner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCCSG() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCCBD() ); 
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\GCCCU() );
	}
	
	public function __construct() {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if ( \is_plugin_active( 'elementor/elementor.php' ) ) {
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_widget_categories' ] );
        }
	}
}


// Instantiate Plugin Class
MEPPluginElementor::instance();