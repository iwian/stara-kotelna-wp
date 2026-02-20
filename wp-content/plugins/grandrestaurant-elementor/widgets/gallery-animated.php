<?php
namespace GrandRestaurantElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Blog Posts
 *
 * Elementor widget for blog posts
 *
 * @since 1.0.0
 */
class GrandRestaurant_Gallery_Animated extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'grandrestaurant-gallery-animated';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Animated Gallery', 'grandrestaurant-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'grandrestaurant-theme-widgets-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'modernizr', 'gridrotator', 'grandrestaurant-elementor' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'grandrestaurant-elementor' ),
			]
		);
		
		$this->add_control(
			'gallery_content_type',
			[
				'label' => __( 'Gallery Content Type', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'media_library',
				'options' => [
					 'media_library' => __( 'Media Library', 'grandrestaurant-elementor' ),
					 'gallery_post' => __( 'Gallery Post Type', 'grandrestaurant-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'gallery',
			 [
				'label' => __( 'Add Images', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'condition' => [
					'gallery_content_type' => 'media_library',
				],
			]
		);
		
		$this->add_control(
			'gallery_id',
			[
				'label' => __( 'Gallery', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'options' => grandrestaurant_get_galleries(),
				'multiple' => false,
				'condition' => [
					'gallery_content_type' => 'gallery_post',
				],
			]
		);
		
		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Images Sorting', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'drag',
				'options' => [
					 'drag' => __( 'Default Gallery Images', 'grandrestaurant-elementor' ),
					 'post_date' => __( 'Newest', 'grandrestaurant-elementor' ),
					 'post_date_old' => __( 'Oldest', 'grandrestaurant-elementor' ),
					 'rand' => __( 'Random', 'grandrestaurant-elementor' ),
					 'title' => __( 'Title', 'grandrestaurant-elementor' ),
				],
				'condition' => [
					'gallery_content_type' => 'gallery_post',
				],
			]
		);

		$this->add_control(
		    'columns',
		    [
		        'label' => __( 'Columns', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 7,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 15,
		                'step' => 1,
		            ]
		        ],
		    ]
		);
		
		$this->add_control(
			'rows',
			[
				'label' => __( 'Rows', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 30,
						'step' => 1,
					]
				],
			]
		);
		
		$this->add_control(
			'image_dimension',
			[
				'label'       => esc_html__( 'Image Dimension', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grandrestaurant-gallery-list',
			    'options' => [
			     	'grandrestaurant-gallery-list' => __( 'Square', 'grandrestaurant-elementor' ),
					 'medium_large' => __( 'Original', 'grandrestaurant-elementor' ),
			    ]
			]
		);
		
		$this->add_control(
			'animation_type',
			[
				'label'       => esc_html__( 'Animation Type', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'random',
				'options' => [
					 'random' => __( 'Random', 'grandrestaurant-elementor' ),
					 'showHide' => __( 'Show Hide', 'grandrestaurant-elementor' ),
					 'fadeInOut' => __( 'Fade In/Out', 'grandrestaurant-elementor' ),
					 'slideLeft' => __( 'Slide Left', 'grandrestaurant-elementor' ),
					 'slideRight' => __( 'Slide Right', 'grandrestaurant-elementor' ),
					 'slideTop' => __( 'Slide Top', 'grandrestaurant-elementor' ),
					 'slideBottom' => __( 'Slide Bottom', 'grandrestaurant-elementor' ),
					 'rotateLeft' => __( 'Rotate Left', 'grandrestaurant-elementor' ),
					 'rotateRight' => __( 'Rotate Right', 'grandrestaurant-elementor' ),
					 'rotateTop' => __( 'Rotate Top', 'grandrestaurant-elementor' ),
					 'rotateBottom' => __( 'Rotate Bottom', 'grandrestaurant-elementor' ),
					 'scale' => __( 'Scale', 'grandrestaurant-elementor' ),
					 'rotate3d' => __( 'Rotate 3D', 'grandrestaurant-elementor' ),
					 'rotateLeftScale' => __( 'Rotate Left Scale', 'grandrestaurant-elementor' ),
					 'rotateRightScale' => __( 'Rotate Right Scale', 'grandrestaurant-elementor' ),
					 'rotateTopScale' => __( 'Rotate Top Scale', 'grandrestaurant-elementor' ),
					 'rotateBottomScale' => __( 'Rotate Bottom Scale', 'grandrestaurant-elementor' ),
				]
			]
		);
		
		$this->add_control(
			'animation_speed',
			[
				'label' => __( 'Animation Speed (in milliseconds)', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 8000,
						'step' => 100,
					]
				],
				'size_units' => [ 'px' ],

			]
		);
		
		$this->add_control(
			'interval_time',
			[
				'label' => __( 'Interval Time (in milliseconds)', 'grandrestaurant-elementor' ),
				'description' => __( 'Images will be replaced every selected interval time', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 3000,
				],
				'range' => [
					'px' => [
						'min' => 500,
						'max' => 20000,
						'step' => 100,
					]
				],
				'size_units' => [ 'px' ],

			]
		);
		
		$this->add_control(
		    'background_color',
		    [
		        'label' => __( 'Background Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .grandrestaurant-gallery-animated-content-wrapper.ri-grid ul li a, {{WRAPPER}} .grandrestaurant-gallery-animated-content-wrapper.ri-grid ul li' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/gallery-animated/index.php');
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		return '';
	}
}
