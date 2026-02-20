<?php

/**
 * Class description
 *
 * @package   package_name
 * @author    ThemeG
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'GrandRestaurant_Ext' ) ) {

	/**
	 * Define GrandRestaurant_Ext class
	 */
	class GrandRestaurant_Ext {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * Init Handler
		 */
		public function init() {
			add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'widget_tab_advanced_add_section' ], 10, 2 );
			add_action( 'elementor/element/common/_section_style/after_section_end', array( $this, 'widget_tab_advanced_add_section' ), 10, 2 );
			
			add_action( 'elementor/element/section/section_background/after_section_end', [ $this, 'widget_tab_styled_add_section' ], 10, 2 );
			
			//Add support for container
			add_action( 'elementor/element/container/section_background/after_section_end', [ $this, 'widget_tab_styled_add_section' ], 10, 2 );
			add_action( 'elementor/element/container/section_layout/after_section_end', [ $this, 'widget_tab_advanced_add_section' ], 10, 2 );
		}
		
		public function widget_tab_styled_add_section( $element, $args ) {
			$element->start_controls_section(
				'grandrestaurant_ext_parallax_section',
				[
					'label' => esc_html__( 'Background Effect', 'grandrestaurant-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_is_background_parallax',
				[
					'label'        => esc_html__( 'Background Parallax', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add parallax scrolling effect to background image', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_is_background_parallax_speed',
			    [
			        'label' => __( 'Scroll Speed', 'grandrestaurant-elementor' ),
			        'description' => __( 'factor that control speed of scroll animation', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0.8,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 1,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_background_parallax' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandrestaurant_ext_is_background_backdrop',
				[
					'label'        => esc_html__( 'Backdrop Blur', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add a blur effect to the area behind an element:', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_is_background_backdrop_blur',
				[
					'label' => __( 'Blur Effect', 'grandrestaurant-elementor' ),
					'description' => __( 'Add factor that control a blur effect', 'grandrestaurant-elementor' ),
					'type' => Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 12,
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 30,
							'step' => 1,
						]
					],
					'size_units' => [ 'px' ],
					'condition' => [
						'grandrestaurant_ext_is_background_backdrop' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->end_controls_section();
			
			$element->start_controls_section(
				'grandrestaurant_ext_background_on_scroll_section',
				[
					'label' => esc_html__( 'Background On Scroll', 'grandrestaurant-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_is_background_on_scroll',
				[
					'label'        => esc_html__( 'Background On Scroll', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add background color change on scroll', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_background_on_scroll_color',
				[
					'label' => __( 'Background Color', 'grandrestaurant-elementor' ),
					'type' => Elementor\Controls_Manager::COLOR,
					'condition' => [
						'grandrestaurant_ext_is_background_on_scroll' => 'true',
					],
					'default' => '#000000',
					'frontend_available' => true,
				]
			);
			
			$element->end_controls_section();
		}

		/**
		 * [widget_tab_advanced_add_section description]
		 * @param  [type] $element [description]
		 * @param  [type] $args    [description]
		 * @return [type]          [description]
		 */
		public function widget_tab_advanced_add_section( $element, $args ) {
			
			$element->start_controls_section(
				'grandrestaurant_ext_link_section',
				[
					'label' => esc_html__( 'Link Options', 'grandrestaurant-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_link_reservation',
				[
					'label'        => esc_html__( 'Link to reservation popup', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add link to element to open reservation popup when clicking', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_link_sidemenu',
				[
					'label'        => esc_html__( 'Link to side menu', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add link to element to open side menu when clicking', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_link_fullmenu',
				[
					'label'        => esc_html__( 'Link to fullscreen menu', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add link to element to open fullscreen menu when clicking', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_link_closed_fullmenu',
				[
					'label'        => esc_html__( 'Link to closed fullscreen menu', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add link to element to close fullscreen menu when clicking', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->end_controls_section();

			$element->start_controls_section(
				'grandrestaurant_ext_animation_section',
				[
					'label' => esc_html__( 'Custom Animation', 'grandrestaurant-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
				]
			);

			$element->add_control(
				'grandrestaurant_ext_is_scrollme',
				[
					'label'        => esc_html__( 'Scroll Animation', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add animation to element when scrolling through page contents', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);

			$element->add_control(
				'grandrestaurant_ext_scrollme_disable',
				[
					'label'       => esc_html__( 'Disable for', 'grandrestaurant-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 'mobile',
				    'options' => [
				     	'none' => __( 'None', 'grandrestaurant-elementor' ),
				     	'tablet' => __( 'Mobile and Tablet', 'grandrestaurant-elementor' ),
				     	'mobile' => __( 'Mobile', 'grandrestaurant-elementor' ),
				    ],
					'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			/*$element->add_control(
				'grandrestaurant_ext_scrollme_easing',
				[
					'label'       => esc_html__( 'Easing', 'grandrestaurant-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 'swing',
				    'options' => [
					    'swing' => __( 'swing', 'grandrestaurant-elementor' ),
				     	'easeInQuad' => __( 'easeInQuad', 'grandrestaurant-elementor' ),
				     	'easeInCubic' => __( 'easeInCubic', 'grandrestaurant-elementor' ),
				     	'easeInQuart' => __( 'easeInQuart', 'grandrestaurant-elementor' ),
				     	'easeInQuint' => __( 'easeInQuint', 'grandrestaurant-elementor' ),
				     	'easeInSine' => __( 'easeInSine', 'grandrestaurant-elementor' ),
				     	'easeInExpo' => __( 'easeInExpo', 'grandrestaurant-elementor' ),
				     	'easeInCirc' => __( 'easeInCirc', 'grandrestaurant-elementor' ),
				     	'easeInBack' => __( 'easeInBack', 'grandrestaurant-elementor' ),
				     	'easeInElastic' => __( 'easeInElastic', 'grandrestaurant-elementor' ),
				     	'easeInBounce' => __( 'easeInBounce', 'grandrestaurant-elementor' ),
				     	'easeOutQuad' => __( 'easeOutQuad', 'grandrestaurant-elementor' ),
				     	'easeOutCubic' => __( 'easeOutCubic', 'grandrestaurant-elementor' ),
				     	'easeOutQuart' => __( 'easeOutQuart', 'grandrestaurant-elementor' ),
				     	'easeOutQuint' => __( 'easeOutQuint', 'grandrestaurant-elementor' ),
				     	'easeOutSine' => __( 'easeOutSine', 'grandrestaurant-elementor' ),
				     	'easeOutExpo' => __( 'easeOutExpo', 'grandrestaurant-elementor' ),
				     	'easeOutCirc' => __( 'easeOutCirc', 'grandrestaurant-elementor' ),
				     	'easeOutBack' => __( 'easeOutBack', 'grandrestaurant-elementor' ),
				     	'easeOutElastic' => __( 'easeOutElastic', 'grandrestaurant-elementor' ),
				     	'easeOutBounce' => __( 'easeOutBounce', 'grandrestaurant-elementor' ),
				     	'easeInOutQuad' => __( 'easeInOutQuad', 'grandrestaurant-elementor' ),
				     	'easeInOutCubic' => __( 'easeInOutCubic', 'grandrestaurant-elementor' ),
				     	'easeInOutQuart' => __( 'easeInOutQuart', 'grandrestaurant-elementor' ),
				     	'easeInOutQuint' => __( 'easeInOutQuint', 'grandrestaurant-elementor' ),
				     	'easeInOutSine' => __( 'easeInOutSine', 'grandrestaurant-elementor' ),
				     	'easeInOutExpo' => __( 'easeInOutExpo', 'grandrestaurant-elementor' ),
				     	'easeInOutCirc' => __( 'easeInOutCirc', 'grandrestaurant-elementor' ),
				     	'easeInOutBack' => __( 'easeInOutBack', 'grandrestaurant-elementor' ),
				     	'easeInOutElastic' => __( 'easeInOutElastic', 'grandrestaurant-elementor' ),
				     	'easeInOutBounce' => __( 'easeInOutBounce', 'grandrestaurant-elementor' ),
				    ],
					'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
				]
			);*/
			
			$element->add_control(
			    'grandrestaurant_ext_scrollme_smoothness',
			    [
			        'label' => __( 'Smoothness', 'grandrestaurant-elementor' ),
			        'description' => __( 'factor that slowdown the animation, the more the smoothier', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 30,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0,
			                'max' => 100,
			                'step' => 5,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			/*$element->add_control(
				'grandrestaurant_ext_scrollme_duration',
				[
					'label' => __( 'Animation Duration (ms)', 'grandrestaurant-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 5,
					'max' => 5000,
					'step' => 5,
					'default' => 400,
					'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => false,
					'selectors' => [
			            '.elementor-widget.elementor-element-{{ID}}' => 'transition-duration: {{VALUE}}ms !important',
			        ],
				]
			);*/
			
			$element->add_control(
			    'grandrestaurant_ext_scrollme_scalex',
			    [
			        'label' => __( 'Scale X', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_scrollme_scaley',
			    [
			        'label' => __( 'Scale Y', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_scrollme_scalez',
			    [
			        'label' => __( 'Scale Z', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
		
			$element->add_control(
			    'grandrestaurant_ext_scrollme_rotatex',
			    [
			        'label' => __( 'Rotate X', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_scrollme_rotatey',
			    [
			        'label' => __( 'Rotate Y', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_scrollme_rotatez',
			    [
			        'label' => __( 'Rotate Z', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_scrollme_translatex',
			    [
			        'label' => __( 'Translate X', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_scrollme_translatey',
			    [
			        'label' => __( 'Translate Y', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_scrollme_translatez',
			    [
			        'label' => __( 'Translate Z', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandrestaurant_ext_is_smoove',
				[
					'label'        => esc_html__( 'Entrance Animation', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add custom entrance animation to element', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);

			$element->add_control(
				'grandrestaurant_ext_smoove_disable',
				[
					'label'       => esc_html__( 'Disable for', 'grandrestaurant-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 1,
				    'options' => [
				     	1 => __( 'None', 'grandrestaurant-elementor' ),
				     	769 => __( 'Mobile and Tablet', 'grandrestaurant-elementor' ),
				     	415 => __( 'Mobile', 'grandrestaurant-elementor' ),
				    ],
					'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_smoove_easing',
				[
					'label'       => esc_html__( 'Easing', 'grandrestaurant-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => '0.250, 0.250, 0.750, 0.750',
				    'options' => [
					    '0.250, 0.250, 0.750, 0.750' => __( 'linear', 'grandrestaurant-elementor' ),
				     	'0.250, 0.100, 0.250, 1.000' => __( 'ease', 'grandrestaurant-elementor' ),
				     	'0.420, 0.000, 1.000, 1.000' => __( 'ease-in', 'grandrestaurant-elementor' ),
				     	'0.000, 0.000, 0.580, 1.000' => __( 'ease-out', 'grandrestaurant-elementor' ),
				     	'0.420, 0.000, 0.580, 1.000' => __( 'ease-in-out', 'grandrestaurant-elementor' ),
				     	'0.550, 0.085, 0.680, 0.530' => __( 'easeInQuad', 'grandrestaurant-elementor' ),
				     	'0.550, 0.055, 0.675, 0.190' => __( 'easeInCubic', 'grandrestaurant-elementor' ),
				     	'0.895, 0.030, 0.685, 0.220' => __( 'easeInQuart', 'grandrestaurant-elementor' ),
				     	'0.755, 0.050, 0.855, 0.060' => __( 'easeInQuint', 'grandrestaurant-elementor' ),
				     	'0.470, 0.000, 0.745, 0.715' => __( 'easeInSine', 'grandrestaurant-elementor' ),
				     	'0.950, 0.050, 0.795, 0.035' => __( 'easeInExpo', 'grandrestaurant-elementor' ),
				     	'0.600, 0.040, 0.980, 0.335' => __( 'easeInCirc', 'grandrestaurant-elementor' ),
				     	'0.600, -0.280, 0.735, 0.045' => __( 'easeInBack', 'grandrestaurant-elementor' ),
				     	'0.250, 0.460, 0.450, 0.940' => __( 'easeOutQuad', 'grandrestaurant-elementor' ),
				     	'0.215, 0.610, 0.355, 1.000' => __( 'easeOutCubic', 'grandrestaurant-elementor' ),
				     	'0.165, 0.840, 0.440, 1.000' => __( 'easeOutQuart', 'grandrestaurant-elementor' ),
				     	'0.230, 1.000, 0.320, 1.000' => __( 'easeOutQuint', 'grandrestaurant-elementor' ),
				     	'0.390, 0.575, 0.565, 1.000' => __( 'easeOutSine', 'grandrestaurant-elementor' ),
				     	'0.190, 1.000, 0.220, 1.000' => __( 'easeOutExpo', 'grandrestaurant-elementor' ),
				     	'0.075, 0.820, 0.165, 1.000' => __( 'easeOutCirc', 'grandrestaurant-elementor' ),
				     	'0.175, 0.885, 0.320, 1.275' => __( 'easeOutBack', 'grandrestaurant-elementor' ),
				     	'0.455, 0.030, 0.515, 0.955' => __( 'easeInOutQuad', 'grandrestaurant-elementor' ),
				     	'0.645, 0.045, 0.355, 1.000' => __( 'easeInOutCubic', 'grandrestaurant-elementor' ),
				     	'0.770, 0.000, 0.175, 1.000' => __( 'easeInOutQuart', 'grandrestaurant-elementor' ),
				     	'0.860, 0.000, 0.070, 1.000' => __( 'easeInOutQuint', 'grandrestaurant-elementor' ),
				     	'0.445, 0.050, 0.550, 0.950' => __( 'easeInOutSine', 'grandrestaurant-elementor' ),
				     	'1.000, 0.000, 0.000, 1.000' => __( 'easeInOutExpo', 'grandrestaurant-elementor' ),
				     	'0.785, 0.135, 0.150, 0.860' => __( 'easeInOutCirc', 'grandrestaurant-elementor' ),
				     	'0.680, -0.550, 0.265, 1.550' => __( 'easeInOutBack', 'grandrestaurant-elementor' ),
				    ],
					'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => false,
					'selectors' => [
			            '.elementor-element.elementor-element-{{ID}}' => 'transition-timing-function: cubic-bezier({{VALUE}}) !important',
			        ],
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_smoove_delay',
				[
					'label' => __( 'Animation Delay (ms)', 'grandrestaurant-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 0,
					'max' => 5000,
					'step' => 5,
					'default' => 0,
					'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => false,
					'selectors' => [
			            '.elementor-element.elementor-element-{{ID}}' => 'transition-delay: {{VALUE}}ms !important',
			        ],
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_smoove_duration',
				[
					'label' => __( 'Animation Duration (ms)', 'grandrestaurant-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 5,
					'max' => 5000,
					'step' => 5,
					'default' => 400,
					'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
					/*'selectors' => [
			            '.elementor-widget.elementor-element-{{ID}}' => 'transition-duration: {{VALUE}}ms !important',
			        ],*/
				]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_opacity',
			    [
			        'label' => __( 'Opacity', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0,
			                'max' => 1,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => false,
					'selectors' => [
			            '.elementor-widget.elementor-element-{{ID}}' => 'opacity: {{SIZE}}',
			        ],
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_scalex',
			    [
			        'label' => __( 'Scale X', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_scaley',
			    [
			        'label' => __( 'Scale Y', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_rotatex',
			    [
			        'label' => __( 'Rotate X', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_rotatey',
			    [
			        'label' => __( 'Rotate Y', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_rotatez',
			    [
			        'label' => __( 'Rotate Z', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_translatex',
			    [
			        'label' => __( 'Translate X', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_translatey',
			    [
			        'label' => __( 'Translate Y', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_translatez',
			    [
			        'label' => __( 'Translate Z', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_skewx',
			    [
			        'label' => __( 'Skew X', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_skewy',
			    [
			        'label' => __( 'Skew Y', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_smoove_perspective',
			    [
			        'label' => __( 'Perspective', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1000,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 5,
			                'max' => 4000,
			                'step' => 5,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandrestaurant_ext_is_parallax_mouse',
				[
					'label'        => esc_html__( 'Mouse Parallax', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add parallax to element when moving mouse position', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_is_parallax_mouse_depth',
			    [
			        'label' => __( 'Depth', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0.2,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.05,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_parallax_mouse' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandrestaurant_ext_is_infinite',
				[
					'label'        => esc_html__( 'Infinite Animation', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add custom infinite animation to element', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_infinite_animation',
				[
					'label'       => esc_html__( 'Easing', 'grandrestaurant-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 'if_bounce',
				    'options' => [
					    'if_swing1' => __( 'Swing 1', 'grandrestaurant-elementor' ),
					    'if_swing2' => __( 'Swing 2', 'grandrestaurant-elementor' ),
				     	'if_wave' 	=> __( 'Wave', 'grandrestaurant-elementor' ),
				     	'if_tilt' 	=> __( 'Tilt', 'grandrestaurant-elementor' ),
				     	'if_bounce' => __( 'Bounce', 'grandrestaurant-elementor' ),
				     	'if_scale' 	=> __( 'Scale', 'grandrestaurant-elementor' ),
				     	'if_spin' 	=> __( 'Spin', 'grandrestaurant-elementor' ),
				    ],
					'condition' => [
						'grandrestaurant_ext_is_infinite' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_infinite_easing',
				[
					'label'       => esc_html__( 'Easing', 'grandrestaurant-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => '0.250, 0.250, 0.750, 0.750',
				    'options' => [
					    '0.250, 0.250, 0.750, 0.750' => __( 'linear', 'grandrestaurant-elementor' ),
				     	'0.250, 0.100, 0.250, 1.000' => __( 'ease', 'grandrestaurant-elementor' ),
				     	'0.420, 0.000, 1.000, 1.000' => __( 'ease-in', 'grandrestaurant-elementor' ),
				     	'0.000, 0.000, 0.580, 1.000' => __( 'ease-out', 'grandrestaurant-elementor' ),
				     	'0.420, 0.000, 0.580, 1.000' => __( 'ease-in-out', 'grandrestaurant-elementor' ),
				     	'0.550, 0.085, 0.680, 0.530' => __( 'easeInQuad', 'grandrestaurant-elementor' ),
				     	'0.550, 0.055, 0.675, 0.190' => __( 'easeInCubic', 'grandrestaurant-elementor' ),
				     	'0.895, 0.030, 0.685, 0.220' => __( 'easeInQuart', 'grandrestaurant-elementor' ),
				     	'0.755, 0.050, 0.855, 0.060' => __( 'easeInQuint', 'grandrestaurant-elementor' ),
				     	'0.470, 0.000, 0.745, 0.715' => __( 'easeInSine', 'grandrestaurant-elementor' ),
				     	'0.950, 0.050, 0.795, 0.035' => __( 'easeInExpo', 'grandrestaurant-elementor' ),
				     	'0.600, 0.040, 0.980, 0.335' => __( 'easeInCirc', 'grandrestaurant-elementor' ),
				     	'0.600, -0.280, 0.735, 0.045' => __( 'easeInBack', 'grandrestaurant-elementor' ),
				     	'0.250, 0.460, 0.450, 0.940' => __( 'easeOutQuad', 'grandrestaurant-elementor' ),
				     	'0.215, 0.610, 0.355, 1.000' => __( 'easeOutCubic', 'grandrestaurant-elementor' ),
				     	'0.165, 0.840, 0.440, 1.000' => __( 'easeOutQuart', 'grandrestaurant-elementor' ),
				     	'0.230, 1.000, 0.320, 1.000' => __( 'easeOutQuint', 'grandrestaurant-elementor' ),
				     	'0.390, 0.575, 0.565, 1.000' => __( 'easeOutSine', 'grandrestaurant-elementor' ),
				     	'0.190, 1.000, 0.220, 1.000' => __( 'easeOutExpo', 'grandrestaurant-elementor' ),
				     	'0.075, 0.820, 0.165, 1.000' => __( 'easeOutCirc', 'grandrestaurant-elementor' ),
				     	'0.175, 0.885, 0.320, 1.275' => __( 'easeOutBack', 'grandrestaurant-elementor' ),
				     	'0.455, 0.030, 0.515, 0.955' => __( 'easeInOutQuad', 'grandrestaurant-elementor' ),
				     	'0.645, 0.045, 0.355, 1.000' => __( 'easeInOutCubic', 'grandrestaurant-elementor' ),
				     	'0.770, 0.000, 0.175, 1.000' => __( 'easeInOutQuart', 'grandrestaurant-elementor' ),
				     	'0.860, 0.000, 0.070, 1.000' => __( 'easeInOutQuint', 'grandrestaurant-elementor' ),
				     	'0.445, 0.050, 0.550, 0.950' => __( 'easeInOutSine', 'grandrestaurant-elementor' ),
				     	'1.000, 0.000, 0.000, 1.000' => __( 'easeInOutExpo', 'grandrestaurant-elementor' ),
				     	'0.785, 0.135, 0.150, 0.860' => __( 'easeInOutCirc', 'grandrestaurant-elementor' ),
				     	'0.680, -0.550, 0.265, 1.550' => __( 'easeInOutBack', 'grandrestaurant-elementor' ),
				    ],
					'condition' => [
						'grandrestaurant_ext_is_infinite' => 'true',
					],
					'frontend_available' => true
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_infinite_duration',
				[
					'label' => __( 'Animation Duration (s)', 'grandrestaurant-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 100,
					'step' => 1,
					'default' => 4,
					'condition' => [
						'grandrestaurant_ext_is_infinite' => 'true',
					],
					'frontend_available' => true
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_is_fadeout_animation',
				[
					'label'        => esc_html__( 'FadeOut Animation', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Add fadeout animation  to element when scrolling', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
			    'grandrestaurant_ext_is_fadeout_animation_velocity',
			    [
			        'label' => __( 'Velocity', 'grandrestaurant-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0.7,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 1,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandrestaurant_ext_is_fadeout_animation' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandrestaurant_ext_is_fadeout_animation_direction',
				[
					'label'       => esc_html__( 'FadeOut Direction', 'grandrestaurant-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 'up',
				    'options' => [
					    'up' 		=> __( 'Up', 'grandrestaurant-elementor' ),
					    'down' 		=> __( 'Down', 'grandrestaurant-elementor' ),
				     	'still' 	=> __( 'Still', 'grandrestaurant-elementor' ),
				    ],
					'condition' => [
						'grandrestaurant_ext_is_fadeout_animation' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandrestaurant_ext_mobile_static',
				[
					'label'        => esc_html__( 'Display Static Position on Mobile', 'grandrestaurant-elementor' ),
					'description'  => esc_html__( 'Enbale this option to make the element display static position on mobile devices', 'grandrestaurant-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandrestaurant-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandrestaurant-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);

			$element->end_controls_section();
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

/**
 * Returns instance of GrandRestaurant_Ext
 *
 * @return object
 */
function grandrestaurant_ext() {
	return GrandRestaurant_Ext::get_instance();
}
