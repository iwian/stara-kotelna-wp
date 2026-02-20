<?php
namespace GrandRestaurantElementor;

use GrandRestaurantElementor\Widgets\GrandRestaurant_Navigation_Menu;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Background_Menu_Effect;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Blog_Posts;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Gallery_Grid;
//use GrandRestaurantElementor\Widgets\GrandRestaurant_Gallery_Masonry;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Gallery_Justified;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Gallery_Horizontal;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Gallery_Fullscreen;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Gallery_Preview;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Gallery_Animated;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Album_Grid;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Distortion_Grid;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Vertical_Parallax;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Horizontal;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Animated_Frame;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Room;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Multi_Layouts;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Velo;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Split_Carousel;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Popout;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Clip_Path;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Split_Slick;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Transitions;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Property_Clip;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Slice;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Flip;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Parallax;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Animated;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Fade_UP;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Motion_Reveal;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Image_Carousel;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Synchronized_Carousel;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Zoom;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Mouse_Drive_Vertical_Carousel;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Slider_Glitch_Slideshow;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Horizontal_Timeline;
/*use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_Classic;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_Contain;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_Grid;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_Grid_Overlay;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_3D_Overlay;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_Masonry;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_Masonry_Grid;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_Timeline;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_Timeline_Vertical;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Portfolio_Coverflow;*/
use GrandRestaurantElementor\Widgets\GrandRestaurant_Background_List;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Testimonial_Card;
//use GrandRestaurantElementor\Widgets\GrandRestaurant_Testimonial_Carousel;
/*use GrandRestaurantElementor\Widgets\GrandRestaurant_Video_Grid;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Music_Player;*/
use GrandRestaurantElementor\Widgets\GrandRestaurant_Flip_Box;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Search;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Search_Form;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Team_Grid;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Service_Grid;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Pricing_Table;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Food_Menu;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Timeline;
use GrandRestaurantElementor\Widgets\GrandRestaurant_WooCommerce_Grid;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Animated_Text;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Animated_Headline;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Food_Carousel;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Blog_Carousel;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Hover_Background_Menu_Effect;

use GrandRestaurantElementor\Widgets\GrandRestaurant_Classic_Food_Menu;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Classic_Food_Menu_Grid;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Classic_Food_Menu_Grid_Image;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Classic_Food_Menu_Slider;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Classic_Team_Column;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Classic_Team_Card;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Cart_Icon;
use GrandRestaurantElementor\Widgets\GrandRestaurant_Contact_Form;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class GrandRestaurant_Elementor {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
		
		add_action( 'init', array( $this, 'init' ), -999 );
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/init', [ $this, 'on_elementor_init' ] );
		add_action( 'elementor/widgets/register', [ $this, 'on_widgets_registered' ] );

		//Enqueue javascript files
		add_action( 'elementor/frontend/after_register_scripts', function() {
			
			//Check if enable lazy load image
			//wp_enqueue_script('masonry');
			wp_enqueue_script('lazy', plugins_url( '/grandrestaurant-elementor/assets/js/jquery.lazy.js' ), array(), false, true );
			wp_enqueue_script('modulobox', plugins_url( '/grandrestaurant-elementor/assets/js/modulobox.js' ), array(), false, true );
			wp_enqueue_script('parallax-scroll', plugins_url( '/grandrestaurant-elementor/assets/js/jquery.parallax-scroll.js' ), array(), false, true );
			wp_enqueue_script('smoove', plugins_url( '/grandrestaurant-elementor/assets/js/jquery.smoove.js' ), array(), false, true );
			wp_enqueue_script('parallax', plugins_url( '/grandrestaurant-elementor/assets/js/parallax.js' ), array(), false, true );
			wp_enqueue_script('blast', plugins_url( '/grandrestaurant-elementor/assets/js/jquery.blast.js' ), array(), false, true );
			
			//Add parallax script effect
			//wp_enqueue_script('parallaxator', plugins_url().'/grandrestaurant-elementor/assets/js/parallaxator.js', false, '', true);
			wp_enqueue_script('jarallax', plugins_url().'/grandrestaurant-elementor/assets/js/jarallax.js', false, '', true);
			
			//Registered scripts
			wp_register_script('lodash', plugins_url( '/grandrestaurant-elementor/assets/js/lodash.core.min.js' ), array(), false, true );
			wp_register_script('anime', plugins_url( '/grandrestaurant-elementor/assets/js/anime.min.js' ), array(), false, true );
			wp_register_script('hover', plugins_url( '/grandrestaurant-elementor/assets/js/hover.js' ), array(), false, true );
			wp_register_script('three', plugins_url( '/grandrestaurant-elementor/assets/js/three.min.js' ), array(), false, true );
			wp_register_script('mls', plugins_url( '/grandrestaurant-elementor/assets/js/mls.js' ), array(), false, true );
			wp_register_script('velocity', plugins_url( '/grandrestaurant-elementor/assets/js/velocity.js' ), array(), false, true );
			wp_register_script('velocity-ui', plugins_url( '/grandrestaurant-elementor/assets/js/velocity.ui.js' ), array(), false, true );
			wp_register_script('slick', plugins_url( '/grandrestaurant-elementor/assets/js/slick.min.js' ), array(), false, true );
			wp_register_script('mousewheel', plugins_url( '/grandrestaurant-elementor/assets/js/jquery.mousewheel.min.js' ), array(), false, true );
			wp_register_script('tweenmax', plugins_url( '/grandrestaurant-elementor/assets/js/tweenmax.min.js' ), array(), false, true );
			wp_register_script('flickity', plugins_url( '/grandrestaurant-elementor/assets/js/flickity.pkgd.js' ), array(), false, true );
			wp_register_script('tilt', plugins_url( '/grandrestaurant-elementor/assets/js/tilt.jquery.js' ), array(), false, true );
			wp_register_script('grandrestaurant-album-tilt', plugins_url( '/grandrestaurant-elementor/assets/js/album-tilt.js' ), array(), false, true );
			wp_register_script('justifiedGallery', plugins_url( '/grandrestaurant-elementor/assets/js/justifiedGallery.js' ), array(), false, true );
			wp_register_script('sticky-kit', plugins_url( '/grandrestaurant-elementor/assets/js/jquery.sticky-kit.min.js' ), array(), false, true );
			wp_register_script('touchSwipe', plugins_url( '/grandrestaurant-elementor/assets/js/jquery.touchSwipe.js' ), array(), false, true );
			wp_register_script('momentum-slider', plugins_url( '/grandrestaurant-elementor/assets/js/momentum-slider.js' ), array(), false, true );
			wp_register_script('animatedheadline', plugins_url( '/grandrestaurant-elementor/assets/js/jquery.animatedheadline.js' ), array(), false, true );
			wp_register_script('owl-carousel', plugins_url( '/grandrestaurant-elementor/assets/js/owl.carousel.min.js' ), array(), false, true );
			wp_register_script('switchery', plugins_url( '/grandrestaurant-elementor/assets/js/switchery.js' ), array(), false, true );
			wp_register_script('modernizr', plugins_url( '/grandrestaurant-elementor/assets/js/modernizr.js' ), array(), false, true );
			wp_register_script('gridrotator', plugins_url( '/grandrestaurant-elementor/assets/js/jquery.gridrotator.js' ), array(), false, true );
			wp_register_script('grandrestaurant-elementor', plugins_url( '/grandrestaurant-elementor/assets/js/grandrestaurant-elementor.js' ), array('sticky-kit'), false, true );
			
			$params = array(
			  'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
			  'ajax_nonce' => wp_create_nonce('grandrestaurant-post-contact-nonce'),
			);
			
			wp_localize_script("grandrestaurant-elementor", 'tgAjax', $params );
			
			wp_enqueue_script('grandrestaurant-elementor', plugins_url( '/grandrestaurant-elementor/assets/js/grandrestaurant-elementor.js' ), array('sticky-kit'), false, true );
			
			//Register script for all classic widgets
			wp_register_script("flexslider-js", get_template_directory_uri()."/js/flexslider/jquery.flexslider-min.js", false, THEMEVERSION, true);
			wp_register_script("script-portfolio-flexslider", get_template_directory_uri()."/templates/script-portfolio-flexslider.php", false, THEMEVERSION, true);
		} );
		
		//Enqueue CSS style files
		add_action( 'elementor/frontend/after_enqueue_styles', function() {
			wp_enqueue_style('modulobox', plugins_url( '/grandrestaurant-elementor/assets/css/modulobox.css' ), false, false, 'all' );
			wp_enqueue_style('swiper', plugins_url( '/grandrestaurant-elementor/assets/css/swiper.css' ), false, false, 'all' );
			wp_enqueue_style('animatedheadline', plugins_url( '/grandrestaurant-elementor/assets/css/animatedheadline.css' ), false, false, 'all' );
			wp_enqueue_style('justifiedGallery', plugins_url( '/grandrestaurant-elementor/assets/css/justifiedGallery.css' ), false, false, 'all' );
			wp_enqueue_style('flickity', plugins_url( '/grandrestaurant-elementor/assets/css/flickity.css' ), false, false, 'all' );
			wp_enqueue_style('owl-carousel-theme', plugins_url( '/grandrestaurant-elementor/assets/css/owl.theme.default.min.css' ), false, false, 'all' );
			wp_enqueue_style('switchery', plugins_url( '/grandrestaurant-elementor/assets/css/switchery.css' ), false, false, 'all' );
			wp_enqueue_style('grandrestaurant-elementor', plugins_url( '/grandrestaurant-elementor/assets/css/grandrestaurant-elementor.css' ), false, false, 'all' );
			wp_enqueue_style('grandrestaurant-elementor-responsive', plugins_url( '/grandrestaurant-elementor/assets/css/grandrestaurant-elementor-responsive.css' ), false, false, 'all' );
		});
	}
	
	/**
	 * Manually init required modules.
	 *
	 * @return void
	 */
	public function init() {
		
		grandrestaurant_templates_manager()->init();
		$this->register_extension();

	}
	
	/**
	 * On Elementor Init
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_elementor_init() {
		$this->register_category();
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		require __DIR__ . '/widgets/navigation-menu.php';
		require __DIR__ . '/widgets/menu-image-hover-parallax.php';
		require __DIR__ . '/widgets/blog-posts.php';
		require __DIR__ . '/widgets/gallery-grid.php';
		//require __DIR__ . '/widgets/gallery-masonry.php';
		require __DIR__ . '/widgets/gallery-justified.php';
		require __DIR__ . '/widgets/gallery-fullscreen.php';
		require __DIR__ . '/widgets/gallery-horizontal.php';
		require __DIR__ . '/widgets/gallery-preview.php';
		require __DIR__ . '/widgets/gallery-animated.php';
		require __DIR__ . '/widgets/album-grid.php';
		require __DIR__ . '/widgets/distortion-grid.php';
		require __DIR__ . '/widgets/slider-vertical-parallax.php';
		require __DIR__ . '/widgets/slider-horizontal.php';
		require __DIR__ . '/widgets/slider-animated-frame.php';
		require __DIR__ . '/widgets/slider-room.php';
		require __DIR__ . '/widgets/slider-multi-layouts.php';
		require __DIR__ . '/widgets/slider-velo.php';
		require __DIR__ . '/widgets/slider-split-carousel.php';
		require __DIR__ . '/widgets/mouse-driven-vertical-carousel.php';
		require __DIR__ . '/widgets/slider-popout.php';
		require __DIR__ . '/widgets/slider-clip-path.php';
		require __DIR__ . '/widgets/slider-split-slick.php';
		require __DIR__ . '/widgets/slider-transitions.php';
		require __DIR__ . '/widgets/slider-property-clip.php';
		require __DIR__ . '/widgets/slider-slice.php';
		require __DIR__ . '/widgets/slider-flip.php';
		require __DIR__ . '/widgets/slider-parallax.php';
		require __DIR__ . '/widgets/slider-animated.php';
		require __DIR__ . '/widgets/slider-fade-up.php';
		require __DIR__ . '/widgets/slider-motion-reveal.php';
		require __DIR__ . '/widgets/slider-image-carousel.php';
		require __DIR__ . '/widgets/slider-synchronized-carousel.php';
		require __DIR__ . '/widgets/slider-glitch-slideshow.php';
		require __DIR__ . '/widgets/slider-zoom.php';
		require __DIR__ . '/widgets/horizontal-timeline.php';
		/*require __DIR__ . '/widgets/portfolio-classic.php';
		require __DIR__ . '/widgets/portfolio-contain.php';
		require __DIR__ . '/widgets/portfolio-grid.php';
		require __DIR__ . '/widgets/portfolio-grid-overlay.php';
		require __DIR__ . '/widgets/portfolio-3d-overlay.php';
		require __DIR__ . '/widgets/portfolio-masonry.php';
		require __DIR__ . '/widgets/portfolio-masonry-grid.php';
		require __DIR__ . '/widgets/portfolio-timeline.php';
		require __DIR__ . '/widgets/portfolio-timeline-vertical.php';
		require __DIR__ . '/widgets/portfolio-coverflow.php';*/
		require __DIR__ . '/widgets/background-list.php';
		require __DIR__ . '/widgets/testimonial-card.php';
		//require __DIR__ . '/widgets/testimonial-carousel.php';
		/*require __DIR__ . '/widgets/video-grid.php';
		require __DIR__ . '/widgets/music-player.php';*/
		require __DIR__ . '/widgets/flip-box.php';
		require __DIR__ . '/widgets/search.php';
		require __DIR__ . '/widgets/search-form.php';
		require __DIR__ . '/widgets/team-grid.php';
		require __DIR__ . '/widgets/service-grid.php';
		require __DIR__ . '/widgets/pricing-table.php';
		require __DIR__ . '/widgets/food-menu.php';
		require __DIR__ . '/widgets/timeline.php';
		require __DIR__ . '/widgets/woocommerce-grid.php';
		require __DIR__ . '/widgets/animated-headline.php';
		require __DIR__ . '/widgets/animated-text.php';
		require __DIR__ . '/widgets/contact-form.php';
		require __DIR__ . '/widgets/food-carousel.php';
		require __DIR__ . '/widgets/blog-carousel.php';
		require __DIR__ . '/widgets/background-menu-effect.php';
		
		//Theme content builder classic widgets
		require __DIR__ . '/widgets/classic-food-menu.php';
		require __DIR__ . '/widgets/classic-food-menu-grid.php';
		require __DIR__ . '/widgets/classic-food-menu-grid-image.php';
		require __DIR__ . '/widgets/classic-food-menu-slider.php';
		require __DIR__ . '/widgets/classic-team-column.php';
		require __DIR__ . '/widgets/classic-team-card.php';
		require __DIR__ . '/widgets/cart-icon.php';
	}
	
	/**
	 * Register Category
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_category() {
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'grandrestaurant-theme-widgets-category-fullscreen',
			array(
				'title' => 'Theme Fullscreen Elements',
				'icon'  => 'fonts',
			),
			1
		);
		
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'grandrestaurant-theme-widgets-category',
			array(
				'title' => 'Theme General Elements',
				'icon'  => 'fonts',
			),
			2
		);
		
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'grandrestaurant-theme-classic-widgets-category',
			array(
				'title' => 'Theme Classic Elements',
				'icon'  => 'fonts',
			),
			2
		);
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Navigation_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Background_Menu_Effect() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Blog_Posts() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Gallery_Grid() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Gallery_Masonry() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Gallery_Justified() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Gallery_Fullscreen() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Gallery_Preview() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Gallery_Horizontal() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Gallery_Animated() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Album_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Distortion_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Vertical_Parallax() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Horizontal() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Animated_Frame() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Room() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Multi_Layouts() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Velo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Split_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Mouse_Drive_Vertical_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Popout() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Clip_Path() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Split_Slick() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Transitions() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Property_Clip() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Slice() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Flip() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Parallax() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Animated() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Motion_Reveal() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Fade_UP() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Image_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Synchronized_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Glitch_Slideshow() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Slider_Zoom() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Horizontal_Timeline() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Background_list() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Testimonial_Card() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Flip_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Search() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Search_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Team_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Service_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Pricing_Table() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Food_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Timeline() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_WooCommerce_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Animated_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Animated_Headline() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Hover_Background_Menu_Effect() );
		
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Classic_Food_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Classic_Food_Menu_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Classic_Food_Menu_Grid_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Classic_Food_Menu_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Classic_Team_Column() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Classic_Team_Card() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Cart_Icon() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Contact_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Food_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandRestaurant_Blog_Carousel() );
	}
	
	/**
	 * Register Extension
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_extension() {
		//Custom Elementor extensions
		require __DIR__ . '/extensions.php';
		
		grandrestaurant_ext()->init();
	}
}

new GrandRestaurant_Elementor();
