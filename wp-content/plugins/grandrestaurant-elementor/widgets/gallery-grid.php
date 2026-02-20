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
class GrandRestaurant_Gallery_Grid extends Widget_Base {

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
		return 'grandrestaurant-gallery-grid';
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
		return __( 'Grid Gallery', 'grandrestaurant-elementor' );
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
		return [ 'tilt', 'grandrestaurant-elementor' ];
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
			    'label' => __( 'Add Images', 'craftcoffee-elementor' ),
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
		    'columns',
		    [
		        'label' => __( 'Columns', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 3,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 5,
		                'step' => 1,
		            ]
		        ],
		    ]
		);
		
		$this->add_control(
			'spacing',
			[
				'label' => __( 'Column Spacing', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'image_dimension',
			[
				'label'       => esc_html__( 'Image Dimension', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grandrestaurant-gallery-grid',
			    'options' => [
			     	'grandrestaurant-gallery-grid' => __( 'Landscape', 'grandrestaurant-elementor' ),
			     	'grandrestaurant-gallery-list' => __( 'Square', 'grandrestaurant-elementor' ),
			     	'grandrestaurant-album-grid' => __( 'Portrait', 'grandrestaurant-elementor' ),
			    ]
			]
		);
		
		$this->add_control(
		    'border',
		    [
		        'label' => __( 'Border Width', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 0,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 40,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .grandrestaurant-gallery-grid-content-wrapper .gallery-grid-item' => 'border-width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'border_color',
		    [
		        'label' => __( 'Border Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .grandrestaurant-gallery-grid-content-wrapper div.gallery-grid-item' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-gallery-grid-content-wrapper div.gallery-grid-item' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Title on Hover', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'lightbox',
			[
				'label' => __( 'Image Lightbox', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'lightbox_content',
			[
				'label' => __( 'Lightbox Content', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'title',
			    'options' => [
			     	'title' => __( 'Title', 'grandrestaurant-elementor' ),
			     	'title_caption' => __( 'Title and Caption', 'grandrestaurant-elementor' ),
			     	'none' 	=> __( 'None', 'grandrestaurant-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
			'entrance_animation',
			[
				'label'       => esc_html__( 'Entrance Animation', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide-up',
			    'options' => [
			     	'slide-up' => __( 'Slide Up', 'grandrestaurant-elementor' ),
			     	'popout' => __( 'Popout', 'grandrestaurant-elementor' ),
			     	'fade-in' => __( 'Fade In', 'grandrestaurant-elementor' ),
			    ]
			]
		);
		
		$this->add_control(
			'disable_animation',
			[
				'label'       => esc_html__( 'Disable entrance animation for', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'tablet',
			    'options' => [
			     	'none' => __( 'None', 'grandrestaurant-elementor' ),
			     	'tablet' => __( 'Mobile and Tablet', 'grandrestaurant-elementor' ),
			     	'mobile' => __( 'Mobile', 'grandrestaurant-elementor' ),
			     	'all' => __( 'Disable All', 'grandrestaurant-elementor' ),
			    ]
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_style',
			array(
				'label'      => esc_html__( 'Content', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'background_overlay',
		    [
		        'label' => __( 'Background Overlay', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => 'rgba(0,0,0,0.2)',
		        'selectors' => [
		            '{{WRAPPER}} .grandrestaurant-gallery-grid-content-wrapper .gallery-grid-item:hover .bg-overlay' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .grandrestaurant-gallery-grid-content-wrapper .gallery-grid-item:hover .gallery-grid-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .grandrestaurant-gallery-grid-content-wrapper .gallery-grid-item .gallery-grid-title',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/gallery-grid/index.php');
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
