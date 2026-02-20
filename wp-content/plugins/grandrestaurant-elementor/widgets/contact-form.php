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
class GrandRestaurant_Contact_Form extends Widget_Base {

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
		return 'grandrestaurant-contact-form';
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
		return __( 'Contact Form 7', 'grandrestaurant-elementor' );
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
		return 'eicon-form-horizontal';
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
			'form_id',
			[
				'label' => __( 'Contact Form', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'options' => grandrestaurant_get_contact_forms(),
				'multiple' => false,
			]
		);
		
		$this->add_control(
			'form_layout',
			[
				'label' => __( 'Layout', 'grandrestaurant-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fullwidth',
				'options' => [
					'fullwidth'  => __( 'Fullwidth', 'grandrestaurant-elementor' ),
					'two_cols' => __( '2 Columns', 'grandrestaurant-elementor' ),
					'three_cols' => __( '3 Columns', 'grandrestaurant-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'alignment',
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
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_label_style',
			array(
				'label'      => esc_html__( 'Label', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'label_font_color',
			[
				'label' => __( 'Label Font Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper label' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => __( 'Label Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper label',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_field_style',
			array(
				'label'      => esc_html__( 'Fields', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'field_background',
			[
				'label' => __( 'Fields Background', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input, {{WRAPPER}} .grandrestaurant-contact-form-content-wrapper textarea, .grandrestaurant-contact-form-content-wrapper select' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'field_font_color',
			[
				'label' => __( 'Fields Font Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input, {{WRAPPER}} .grandrestaurant-contact-form-content-wrapper textarea, .grandrestaurant-contact-form-content-wrapper select' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'field_border_color',
			[
				'label' => __( 'Fields Border Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input, {{WRAPPER}} .grandrestaurant-contact-form-content-wrapper textarea, .grandrestaurant-contact-form-content-wrapper select' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'field_focus_color',
			[
				'label' => __( 'Fields Focus Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1C58F6',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input:focus, {{WRAPPER}} .grandrestaurant-contact-form-content-wrapper textarea:focus, .grandrestaurant-contact-form-content-wrapper select:focus' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'label' => __( 'Fields Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input, {{WRAPPER}} .grandrestaurant-contact-form-content-wrapper textarea, {{WRAPPER}} .grandrestaurant-contact-form-content-wrapper select',
			]
		);
		
		$this->add_responsive_control(
			'field_space',
			[
				'label' => __( 'Space Between', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper form > p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_button_style',
			array(
				'label'      => esc_html__( 'Button', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'button_background',
			[
				'label' => __( 'Button Background', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input[type=submit]' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_font_color',
			[
				'label' => __( 'Button Font Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input[type=submit]' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Button Border Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input[type=submit]' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_hover_background',
			[
				'label' => __( 'Button Hover Background', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input[type=submit]:hover' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_hover_font_color',
			[
				'label' => __( 'Button Hover Font Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input[type=submit]:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Button Hover Border Color', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input[type=submit]:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Button Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input[type=submit]',
			]
		);
		
		$this->add_responsive_control(
			'button_margin',
			[
				'label' => __( 'Margin', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .grandrestaurant-contact-form-content-wrapper input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/contact-form/index.php');
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
