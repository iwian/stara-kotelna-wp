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
class GrandRestaurant_Slider_Horizontal extends Widget_Base {

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
		return 'grandrestaurant-slider-horizontal';
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
		return __( 'Horizontal Slider', 'grandrestaurant-elementor' );
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
		return 'eicon-post-slider';
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
		return [ 'flickity', 'grandrestaurant-elementor' ];
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
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'slide_image', [
				'label' => __( 'Images (max. 3)', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_title', [
				'label' => __( 'Title', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_subtitle', [
				'label' => __( 'Sub Title', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_description', [
				'label' => __( 'Description', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_link_title', [
				'label' => __( 'Link Title', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_link', [
				'label' => __( 'Link URL', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			]
		);
		
		$this->add_control(
			'slides',
			[
				'label' => __( 'Slides', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ slide_title }}}',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_options',
			[
				'label' => __( 'Options', 'grandrestaurant-elementor' ),
			]
		);
		
		$this->add_control(
			'image_size',
			[
				'label' => __( 'Image Size', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'large',
			    'options' => [
			     	'medium_large' => __( 'Medium (default 768px x 768px max)', 'grandrestaurant-elementor' ),
			     	'large' => __( 'Large (default 1024px x 1024px max)', 'grandrestaurant-elementor' ),
			     	'full' => __( 'Original image resolution', 'grandrestaurant-elementor' ),
			    ],
			]
		);
		
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Image Border Radius', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .horizontal-slider-wrapper .horizontal-slider-bg div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
		    'height',
		    [
		        'label' => __( 'Height (in px)', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 700,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 5,
		                'max' => 2000,
		                'step' => 5,
		            ]
		        ],
		        'size_units' => [ 'px' ]
		    ]
		);
		
		$this->add_control(
			'fullscreen',
			[
				'label' => __( 'Fullscreen', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
		    'spacing',
		    [
		        'label' => __( 'Spacing (in px)', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 40,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
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
				'default' => 'no',
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
			'loop',
			[
				'label' => __( 'Loop', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'navigation',
			[
				'label' => __( 'Show Navigation', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
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
		    'content_background_color',
		    [
		        'label' => __( 'Content Background Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => 'rgba(256,256,256,0)',
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-slider-wrapper .horizontal-slider-cell' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'content_width',
		    [
		        'label' => __( 'Content Width (in %)', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 30,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 5,
		                'max' => 100,
		                'step' => 5,
		            ],
		        ],
		        'size_units' => [ '%' ]
		    ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_title_style',
			array(
				'label'      => esc_html__( 'Title & Sub Title', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'content_title_color',
		    [
		        'label' => __( 'Title font Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-slide-content-title h2' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} div.horizontal-slide-content-title h2',
			]
		);
		
		
		$this->add_control(
			'content_sub_title_color',
			[
				'label' => __( 'Sub Title font Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .horizontal-slide-content-sub-title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'label' => __( 'Sub Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} div.horizontal-slide-content-sub-title',
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
		    'content_font_color',
		    [
		        'label' => __( 'Content font Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#444444',
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-slider-wrapper .horizontal-slider-content .horizontal-slider-content-wrap' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Content Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .horizontal-slider-wrapper .horizontal-slider-content .horizontal-slider-content-wrap',
			]
		);
		
		$this->add_control(
		    'content_link_color',
		    [
		        'label' => __( 'Link font Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-slider-content-cell .horizontal-slide-content-link' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .horizontal-slide-content-link' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_link_typography',
				'label' => __( 'Link Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .horizontal-slider-content-cell .horizontal-slide-content-link',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_navigation_style',
			array(
				'label'      => esc_html__( 'Navigation', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'nav_background_color',
		    [
		        'label' => __( 'Navigation Background Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => 'rgba(256,256,256,0)',
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-slider-wrapper .flickity-prev-next-button.next' => 'background: {{VALUE}}',
		            '{{WRAPPER}} .horizontal-slider-wrapper .flickity-prev-next-button.previous' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'nav_color',
		    [
		        'label' => __( 'Navigation Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-slider-wrapper .flickity-prev-next-button .arrow' => 'fill: {{VALUE}}',
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
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-slider-wrapper .flickity-page-dots .dot' => 'background: {{VALUE}}',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/slider-horizontal/index.php');
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
