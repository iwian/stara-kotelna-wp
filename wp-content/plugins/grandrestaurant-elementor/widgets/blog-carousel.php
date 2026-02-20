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
class GrandRestaurant_Blog_Carousel extends Widget_Base {

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
		return 'grandrestaurant-blog-carousel';
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
		return __( 'Blog Carousel', 'grandrestaurant-elementor' );
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
	 * Retrieve blog post categories
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Blog categories
	 */
	public function get_blog_categories() {
		//Get all categories
		$categories_arr = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );
		$tg_categories_select = array();
		
		foreach ($categories_arr as $cat) {
			$tg_categories_select[$cat->term_id] = $cat->name;
		}

		return $tg_categories_select;
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
			'posts_per_page',
			[
				'label' => __( 'All Items', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
				],
				'range' => [
					'px' => [
						'min' => -1,
						'max' => 100,
						'step' => 1,
					]
				],
			]
		);
		
		$this->add_control(
			'categories',
			[
				'label' => __( 'Categories', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_blog_categories(),
				'multiple' => true,
			]
		);
		
		$this->add_control(
			'show_categories',
			[
				'label' => __( 'Show Post Categories', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'show_featured_image',
			[
				'label' => __( 'Show Featured Image', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'show_date',
			[
				'label' => __( 'Show Post Date', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'text_display',
			[
				'label' => __( 'Text Display', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'excerpt',
				'options' => [
					 'excerpt' => __( 'Excerpt', 'grandrestaurant-elementor' ),
					 'full_content' => __( 'Full Content', 'grandrestaurant-elementor' ),
					 'no_text' => __( 'No text', 'grandrestaurant-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					]
				],
			]
		);
		
		$this->add_control(
			'strip_html',
			[
				'label' => __( 'Strip HTML from Post Content', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'show_continue',
			[
				'label' => __( 'Show Continue Reading', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
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
					 'medium_large' => __( 'Original', 'grandrestaurant-elementor' ),
				]
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_options',
			[
				'label' => __( 'Options', 'grandrestaurant-elementor' ),
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
		
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Image Border Radius', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .post-featured-image-hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'selector' => '{{WRAPPER}} .blog-carousel-wrapper .post-header h5',
			]
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#111111',
		        'selectors' => [
		            '{{WRAPPER}} .blog-carousel-wrapper .post-header h5 a' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_meta_style',
			array(
				'label'      => esc_html__( 'Post Meta', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __( 'Post Meta Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .blog-carousel-wrapper .post-detail.single-post',
			]
		);
		
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Post Meta Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#86868b',
				'selectors' => [
					'{{WRAPPER}} .blog-carousel-wrapper .post-detail.single-post a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_desc_style',
			array(
				'label'      => esc_html__( 'Excerpt', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Excerpt Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .blog-carousel-wrapper .post-header-wrapper',
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Excerpt Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#86868B',
				'selectors' => [
					'{{WRAPPER}} .blog-carousel-wrapper .post-header-wrapper' => 'color: {{VALUE}}',
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
		            '{{WRAPPER}} .blog-carousel-wrapper .owl-carousel .owl-dots .owl-dot span' => 'background: {{VALUE}}',
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
		            '{{WRAPPER}} .blog-carousel-wrapper .owl-carousel .owl-dots .owl-dot.active span' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_date_style',
			array(
				'label'      => esc_html__( 'Date & Month', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => __( 'Date Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .post-featured-date-wrapper .post-featured-date',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'month_typography',
				'label' => __( 'Month Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .post-featured-date-wrapper .post-featured-month',
			]
		);
		
		$this->add_responsive_control(
			'date_border_radius',
			[
				'label' => __( 'Date & Month Border Radius', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .post-featured-date-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'date_bg_color',
			[
				'label' => __( 'Date & Month Background Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .post-featured-date-wrapper' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'date_color',
			[
				'label' => __( 'Date Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .post-featured-date' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'month_color',
			[
				'label' => __( 'Month Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .post-featured-month' => 'color: {{VALUE}}',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/blog-carousel/index.php');
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
