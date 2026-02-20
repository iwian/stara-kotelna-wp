<?php
namespace GrandRestaurantElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Portfolio Classic
 *
 * Elementor widget for portfolio posts
 *
 * @since 1.0.0
 */
class GrandRestaurant_Portfolio_Grid extends Widget_Base {

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
		return 'grandrestaurant-portfolio-grid';
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
		return __( 'Portfolio Grid', 'grandrestaurant-elementor' );
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
		return [ 'imagesloaded', 'grandrestaurant-elementor' ];
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
			'slide_link', [
				'label' => __( 'Link URL', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			]
		);
		
		$repeater->add_control(
			'slide_tag', [
				'label' => __( 'Tag', 'grandrestaurant-elementor' ),
				'description' => __( 'Enter tag for this item for filterable option (optional)', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
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
			'filterable',
			[
				'label' => __( 'Filterable', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
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
					'{{WRAPPER}} .portfolio-grid-content-wrapper .portfolio-grid-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'overlay_background',
				'label' => esc_html__( 'Overlay Background', 'grandrestaurant-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .portfolio-grid-wrapper:after',
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
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-grid-wrapper h3' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} div.portfolio-grid-wrapper h3',
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
		        'label' => __( 'Sub Title Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ebebeb',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-grid-wrapper .figcaption .portfolio-grid-subtitle' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => __( 'Sub Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .portfolio-grid-wrapper .figcaption div.portfolio-grid-subtitle',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_filterable_style',
			array(
				'label'      => esc_html__( 'Filterable', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'filterable_text_align',
			[
				'label' => __( 'Alignment', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
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
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
		            '{{WRAPPER}} .grandrestaurant-portfolio-filter-wrapper' => 'text-align: {{VALUE}}',
		        ],
			]
		);
		
		$this->add_control(
		    'filterable_color',
		    [
		        'label' => __( 'Filterable Title Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#666666',
		        'selectors' => [
		            '{{WRAPPER}} .grandrestaurant-portfolio-filter-wrapper a.filter-tag-btn' => 'color: {{VALUE}}',
		            '{{WRAPPER}} div.elementor-widget-container .grandrestaurant-portfolio-filter-wrapper a.filter-tag-btn' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'filterable_hover_color',
		    [
		        'label' => __( 'Filterable Title Hover Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .grandrestaurant-portfolio-filter-wrapper a.filter-tag-btn:hover' => 'color: {{VALUE}}',
		            '{{WRAPPER}} div.grandrestaurant-portfolio-filter-wrapper a.filter-tag-btn:hover' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'filterable_active_color',
		    [
		        'label' => __( 'Filterable Title Active Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} div.grandrestaurant-portfolio-filter-wrapper a.filter-tag-btn.active' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .grandrestaurant-portfolio-filter-wrapper .filter-tag-btn.active' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filterable_typography',
				'label' => __( 'Filterable Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} div.grandrestaurant-portfolio-filter-wrapper a.filter-tag-btn',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/portfolio-grid/index.php');
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
