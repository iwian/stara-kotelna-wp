<?php
namespace GrandRestaurantElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Blog Posts
 *
 * Elementor widget for blog posts
 *
 * @since 1.0.0
 */
class GrandRestaurant_Food_Carousel extends Widget_Base {

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
		return 'grandrestaurant-food-carousel';
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
		return __( 'Food Menu Carousel', 'grandrestaurant-elementor' );
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
		return 'eicon-slider-3d';
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
		return [ 'owl-carousel', 'grandrestaurant-elementor' ];
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
			'menu_category',
			[
				'label' => __( 'Filter by Menu Category', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'options' => grandrestaurant_get_menu_categories(),
				'multiple' => false,
			]
		);
		
		$this->add_control(
			'order',
			[
				'label' => __( 'Order By', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => array(
					'default' 	=> __( 'Default', 'grandrestaurant-elementor' ),
					'newest'	=> __( 'Newest', 'grandrestaurant-elementor' ),
					'oldest'	=> __( 'Oldest', 'grandrestaurant-elementor' ),
					'title'		=> __( 'Title', 'grandrestaurant-elementor' ),
					'random'	=> __( 'Random', 'grandrestaurant-elementor' ),
				),
				'default' => 'default',
				'multiple' => false,
			]
		);
		
		$this->add_control(
			'items',
			[
				'label' => __( 'Items', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
						'step' => 1,
					]
				],
			]
		);
		
		$this->add_control(
			'ini_item',
			[
				'label' => __( 'Initials Items', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 5,
						'step' => 1,
					]
				],
				'size_units' => [ 'px' ]
			]
		);
		
		$this->add_control(
			'show_tooltip',
			[
				'label' => __( 'Show Tooltip', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_options',
			[
				'label' => __( 'Options', 'grandrestaurant-elementor' ),
			]
		);
		
		$this->add_responsive_control(
			'grid_height',
			[
				'label' => __( 'Height', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'selectors' => [
					'{{WRAPPER}} .food-carousel-wrapper.style2 .item' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'grid_style' => 'style2',
				],
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
					 'medium_large' => __( 'Original', 'grandrestaurant-elementor' ),
				]
			]
		);
		
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Image Border Radius', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .food-carousel-image .food-carousel-image-overflow img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .food-carousel-wrapper.style2 .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Auto Play', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
		    'timer',
		    [
		        'label' => __( 'Timer (in seconds)', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 8,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 60,
		                'step' => 1,
		            ]
		        ],
		        'size_units' => [ 'px' ]
		    ]
		);
		
		$this->add_control(
			'pagination',
			[
				'label' => __( 'Show Pagination', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'stage_padding',
			[
				'label' => __( 'Stage Padding', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					]
				],
				'size_units' => [ 'px' ]
			]
		);
		
		$this->add_control(
			'item_margin',
			[
				'label' => __( 'Item Margin', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					]
				],
				'size_units' => [ 'px' ]
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_title_style',
			array(
				'label'      => esc_html__( 'Title', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .food-carousel-wrapper .food-carousel-title',
			]
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .food-carousel-wrapper .food-carousel-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_subtitle_style',
			array(
				'label'      => esc_html__( 'Sub Title', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => __( 'Sub Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .food-carousel-wrapper .food-carousel-subtitle',
			]
		);
		
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Sub Title Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .food-carousel-wrapper .food-carousel-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_pricing_style',
			array(
				'label'      => esc_html__( 'Pricing', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_typography',
				'label' => __( 'Pricing Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .food-carousel-wrapper .food-menu-content-price-holder',
			]
		);
		
		$this->add_control(
			'pricing_color',
			[
				'label' => __( 'Pricing Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .food-carousel-wrapper .food-menu-content-price-holder' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'pricing_bg_color',
			[
				'label' => __( 'Pricing Background Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .food-carousel-wrapper .food-menu-content-price-holder' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'pricing_border_radius',
			[
				'label' => __( 'Pricing Border Radius', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .food-carousel-wrapper .food-menu-content-price-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sizing_typography',
				'label' => __( 'Sizing Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .food-carousel-wrapper .food-carousel-content h5.menu_post',
			]
		);
		
		$this->add_control(
			'sizing_color',
			[
				'label' => __( 'Sizing Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .food-carousel-wrapper .food-carousel-content h5.menu_post' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_pagination_style',
			array(
				'label'      => esc_html__( 'Pagination', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'pagination_color',
		    [
		        'label' => __( 'Pagination Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#cccccc',
		        'selectors' => [
		            '{{WRAPPER}} .food-carousel-wrapper .owl-carousel .owl-dots .owl-dot span' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'pagination_active_color',
		    [
		        'label' => __( 'Pagination Active Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .food-carousel-wrapper .owl-carousel .owl-dots .owl-dot.active span' => 'background: {{VALUE}}',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/food-carousel/index.php');
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
