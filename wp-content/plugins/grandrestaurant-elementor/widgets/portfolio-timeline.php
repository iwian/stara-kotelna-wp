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
class GrandRestaurant_Portfolio_Timeline extends Widget_Base {

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
		return 'grandrestaurant-portfolio-timeline';
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
		return __( 'Portfolio Timeline Horizontal', 'grandrestaurant-elementor' );
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
		return [ 'grandrestaurant-elementor' ];
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
				'label' => __( 'Image', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_date', [
				'label' => __( 'Date', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'default' => __( '2018' , 'grandrestaurant-elementor' ),
				'picker_options' => [
					'enableTime' => false,
					'allowInput' => true,
				],
			]
		);
		
		$repeater->add_control(
			'slide_date_format', [
				'label' => __( 'Display Date Format', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'Y',
				'options' => [
					 'Y' => __( 'Year Only', 'grandrestaurant-elementor' ),
					 'M' => __( 'Month Only', 'grandrestaurant-elementor' ),
					 'd M' => __( 'Date & Month', 'grandrestaurant-elementor' ),
					 'M Y' => __( 'Month & Year', 'grandrestaurant-elementor' ),
					 'd M Y' => __( 'Date & Month and Year', 'grandrestaurant-elementor' ),
				],
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
			'slide_sub_title', [
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
		
		$this->add_control(
		    'timeline_spacing',
		    [
		        'label' => __( 'Timeline Spacing', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 60,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 500,
		                'step' => 5,
		            ],
		        ],
		        'size_units' => [ 'px' ]
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
					'{{WRAPPER}} .portfolio-timeline-wrapper .portfolio-timeline-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
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
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title font Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .cd-horizontal-timeline .events-content h2' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} div.cd-horizontal-timeline .events-content h2',
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
		
		$this->add_control(
		    'subtitle_color',
		    [
		        'label' => __( 'Sub Title font Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#888888',
		        'selectors' => [
		            '{{WRAPPER}} div.cd-horizontal-timeline .events-content em' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => __( 'Sub Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .cd-horizontal-timeline .events-content em',
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
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .cd-horizontal-timeline .events-content li .events-content-desc' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Content Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} div.cd-horizontal-timeline .events-content li .events-content-desc',
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
		        'default' => '#B8B8B8',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-timeline-link' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .portfolio-timeline-link.continue-reading:before' => 'background: {{VALUE}}',
		            '{{WRAPPER}} .portfolio-timeline-link.continue-reading:after' => 'background: {{VALUE}}',
		            '{{WRAPPER}} .portfolio-timeline-link.continue-reading span:before' => 'background: {{VALUE}}',
		            '{{WRAPPER}} .portfolio-timeline-link.continue-reading span:after' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		/*$this->add_control(
		    'link_hover_color',
		    [
		        'label' => __( 'Link Hover Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-timeline-link:hover' => 'color: {{VALUE}}',
		        ],
		    ]
		);*/
		
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
		    'nav_color',
		    [
		        'label' => __( 'Navigation Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#e7e7e7',
		        'selectors' => [
		            '{{WRAPPER}} .cd-horizontal-timeline .events' => 'background: {{VALUE}}',
		            '{{WRAPPER}} .cd-horizontal-timeline .events a::after' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .cd-timeline-navigation a' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'nav_active_color',
		    [
		        'label' => __( 'Navigation Active Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .cd-horizontal-timeline .filling-line' => 'background-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-horizontal-timeline .events a.selected::after' => 'background-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-horizontal-timeline div.events a.selected::after' => 'border-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-horizontal-timeline .events a.older-event::after' => 'border-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-timeline-navigation a:hover' => 'border-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-timeline-navigation a.prev:hover:after' => 'color: {{VALUE}}',
		             '{{WRAPPER}} .cd-timeline-navigation a.next:hover:after' => 'color: {{VALUE}}',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/portfolio-timeline/index.php');
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
