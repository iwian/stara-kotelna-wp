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
class GrandRestaurant_Blog_Posts extends Widget_Base {

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
		return 'grandrestaurant-blog-posts';
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
		return __( 'Blog Posts', 'grandrestaurant-elementor' );
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
		return 'eicon-post-list';
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
		return [ 'sticky-kit', 'masonry', 'grandrestaurant-elementor' ];
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
			'layout',
			[
				'label' => __( 'Layout', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'classic',
			    'options' => [
			     	'classic'  			=> __( 'Classic', 'grandrestaurant-elementor' ),
			     	'grid' 				=> __( 'Grid', 'grandrestaurant-elementor' ),
			     	'grid_no_space' 	=> __( 'Grid No Space', 'grandrestaurant-elementor' ),
			     	'masonry' 			=> __( 'Masonry', 'grandrestaurant-elementor' ),
			     	'list'   			=> __( 'List', 'grandrestaurant-elementor' ),
			     	'metro'   			=> __( 'Metro', 'grandrestaurant-elementor' ),
			     	'metro_no_space'   	=> __( 'Metro No Space', 'grandrestaurant-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
		    'posts_per_page',
		    [
		        'label' => __( 'Posts Per Page', 'grandrestaurant-elementor' ),
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
			'show_pagination',
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
		    'text_align',
		    [
		        'label' => __( 'Text Alignment', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'left'    => [
		                'title' => __( 'Left', 'grandrestaurant-elementor' ),
		                'icon' => 'eicon-text-align-left',
		            ],
		            'center' => [
		                'title' => __( 'Center', 'grandrestaurant-elementor' ),
		                'icon' => 'eicon-text-align-center',
		            ],
		            'right' => [
		                'title' => __( 'Right', 'grandrestaurant-elementor' ),
		                'icon' => 'eicon-text-align-right',
		            ],
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
			'section_title_style',
			array(
				'label'      => esc_html__( 'Title', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .post-header h5 a' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .post-header h5',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_cat_style',
			array(
				'label'      => esc_html__( 'Categories', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'cat_color',
		    [
		        'label' => __( 'Categories Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .post-info-cat a' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .post-detail.single-post',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_excerpt_style',
			array(
				'label'      => esc_html__( 'Excerpt', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'excerpt_color',
		    [
		        'label' => __( 'Excerpt Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .post-header-wrapper > p' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => __( 'Excerpt Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .post-header-wrapper > p',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_link_style',
			array(
				'label'      => esc_html__( 'Link', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'link_color',
		    [
		        'label' => __( 'Link Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} a.continue-reading' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'label' => __( 'Link Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} a.continue-reading',
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
		
		$this->add_control(
		    'date_bg_color',
		    [
		        'label' => __( 'Date & Month Background Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => 'rgba(0,0,0,0)',
		        'selectors' => [
		            '{{WRAPPER}} .post-featured-date-wrapper' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => __( 'Date Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .post-featured-date',
			]
		);
		
		$this->add_control(
		    'date_color',
		    [
		        'label' => __( 'Date Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .post-featured-date' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'month_typography',
				'label' => __( 'Month Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .post-featured-month',
			]
		);
		
		$this->add_control(
		    'month_color',
		    [
		        'label' => __( 'Month Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/blog-posts/index.php');
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
