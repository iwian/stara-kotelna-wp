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
class GrandRestaurant_Food_Menu extends Widget_Base {

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
		return 'grandrestaurant-food-menu';
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
		return __( 'Food Menu', 'grandrestaurant-elementor' );
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
		    'items',
		    [
		        'label' => __( 'Items', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 5,
		        ],
		        'range' => [
		            'px' => [
		                'min' => -1,
		                'max' => 500,
		                'step' => 1,
		            ]
		        ],
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
		
		$this->add_control(
			'show_image',
			[
				'label' => __( 'Show Food Image', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_responsive_control(
			'food_item_padding',
			[
				'label' => __( 'Padding', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .food-menu-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'food_item_margin',
			[
				'label' => __( 'Margin', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .food-menu-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		        'label' => __( 'Title Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .food-menu-content-title-holder h3, {{WRAPPER}} .food-menu-content-title-holder h3 a, {{WRAPPER}} h5.menu_post .menu_title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .food-menu-content-title-holder h3, {{WRAPPER}} h5.menu_post .menu_title',
			]
		);
		
		$this->add_control(
		    'title_dotted_color',
		    [
		        'label' => __( 'Title Dotted Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .food-menu-content-title-line' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
			'show_divider',
			[
				'label' => __( 'Show Divider', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Divider Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'show_divider' => 'yes',
				],
				'default' => '#999999',
				'frontend_available' => true,
				'selectors' => [
					'{{WRAPPER}} .food-menu-content' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_description_style',
			array(
				'label'      => esc_html__( 'Description', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'description_color',
		    [
		        'label' => __( 'Description Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .food-menu-desc' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Description Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .food-menu-desc',
			]
		);
		
		$this->add_responsive_control(
			'description_padding',
			[
				'label' => __( 'Padding', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .food-menu-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_price_style',
			array(
				'label'      => esc_html__( 'Price', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'price_color',
		    [
		        'label' => __( 'Price Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .food-menu-content-price-holder .food-menu-content-price-normal, {{WRAPPER}} h5.menu_post .menu_price' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'sale_price_color',
		    [
		        'label' => __( 'Sale Price Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#989898',
		        'selectors' => [
		            '{{WRAPPER}} .food-menu-content-price-holder .food-menu-content-price-sale' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __( 'Price Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .food-menu-content-price-holder, {{WRAPPER}} h5.menu_post .menu_price',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_special_tag_style',
			array(
				'label'      => esc_html__( 'Special Tag', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'special_tag_color',
		    [
		        'label' => __( 'Special Tag Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .food-menu-content-highlight-holder h4' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'special_tag_bg_color',
		    [
		        'label' => __( 'Special Tag Background Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .food-menu-content-highlight-holder' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'special_tag_border_color',
		    [
		        'label' => __( 'Special Tag Border Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .food-menu-highlight' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'special_tag_typography',
				'label' => __( 'Special Tag Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .food-menu-content-highlight-holder h4',
			]
		);
		
		$this->add_control(
			'special_tag_border_radius',
			[
				'label' => __( 'Special Tag Border Radius', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .food-menu-content-highlight-holder, {{WRAPPER}} .food-menu-highlight' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_nutrition_style',
			array(
				'label'      => esc_html__( 'Nutrition', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'special_nutrition_color',
		    [
		        'label' => __( 'Nutrition Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            'body .tooltipster-sidetip.tooltipster-shadow .tooltipster-content' => 'color: {{VALUE}}',
		            'body .tooltipster-sidetip.tooltipster-shadow .tooltipster-content h5' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'special_nutrition_bg_color',
		    [
		        'label' => __( 'Nutrition Background Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            'body .tooltipster-sidetip.tooltipster-shadow .tooltipster-content, body .tooltipster-sidetip.tooltipster-shadow .tooltipster-box' => 'background: {{VALUE}}',
					'.tooltipster-sidetip.tooltipster-shadow.tooltipster-right .tooltipster-arrow-border' => 'border-right-color: {{VALUE}}',
					'.tooltipster-sidetip.tooltipster-shadow.tooltipster-left .tooltipster-arrow-border' => 'border-left-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'special_nutrition_title_typography',
				'label' => __( 'Nutrition Title Typography', 'grandrestaurant-elementor' ),
				'selector' => 'body.elementor-page .tooltipster-sidetip.tooltipster-shadow .tooltipster-content h5',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'special_nutrition_content_typography',
				'label' => __( 'Nutrition Content Typography', 'grandrestaurant-elementor' ),
				'selector' => 'body.elementor-page .tooltipster-sidetip.tooltipster-shadow .tooltipster-content',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/food-menu/index.php');
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
