<?php
namespace GrandRestaurantElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Blog Posts
 *
 * Elementor widget
 *
 * @since 1.0.0
 */
class GrandRestaurant_Hover_Background_Menu_Effect extends Widget_Base {

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
		return 'grandrestaurant-background-menu-effect';
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
		return __( 'Background Menu Effect', 'grandrestaurant-elementor' );
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
		return 'eicon-bullet-list';
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
		
		/**
		*
		*	Begin slides repeat list
		*
		**/
		
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
		
		/**
		*
		*	End slides repeat list
		*
		**/
		
		$this->add_control(
			'display_default',
			[
				'label' => __( 'Display Default Image', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandrestaurant-elementor' ),
				'label_off' => __( 'No', 'grandrestaurant-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'mouseover_effect',
			[
				'label' => __( 'Mouseover Effect', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					 'zoom' => __( 'Zoom', 'grandrestaurant-elementor' ),
					 'fade' => __( 'Fade', 'grandrestaurant-elementor' ),
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
		            '{{WRAPPER}} .themegoods-background-menu .themegoods-background-menu__item-link' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .themegoods-background-menu .themegoods-background-menu__item-link',
			]
		);
		
		$this->add_responsive_control(
			'title_alignment',
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
					'{{WRAPPER}} .themegoods-background-menu' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_width',
			[
				'label' => __( 'Width', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fullwidth',
				'options' => [
					 'fullwidth' => __( 'Fullwidth', 'grandrestaurant-elementor' ),
					 'inline' => __( 'Inline', 'grandrestaurant-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .themegoods-background-menu .themegoods-background-menu__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_background_style',
			array(
				'label'      => esc_html__( 'Background', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_responsive_control(
			'background_image_width',
			[
				'label' => __( 'Background Image Width', 'grandtour-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
					'unit' => 'vw',
				],
				'range' => [
					'vw' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => 5,
						'max' => 2000,
						'step' => 5,
					],
				],
				'size_units' => [ 'px', 'vw' ],
				'selectors' => [
					'{{WRAPPER}} .themegoods-background-menu__item .themegoods-background-menu__item-image' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);
		
		$this->add_control(
			'background_color',
			[
				'label' => __( 'Default Background', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .themegoods-background-menu-default' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'background_overlay',
			[
				'label' => __( 'Background Overlay', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.2)',
				'selectors' => [
					'{{WRAPPER}} .themegoods-background-menu__item-image:after' => 'background: {{VALUE}}',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/background-menu-effect/index.php');
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
