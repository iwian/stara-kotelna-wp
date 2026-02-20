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
class GrandRestaurant_Gallery_Preview extends Widget_Base {

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
		return 'grandrestaurant-gallery-preview';
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
		return __( 'Fullscreen Gallery Preview', 'grandrestaurant-elementor' );
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
		return 'eicon-slider-full-screen';
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
		return [ 'grandrestaurant-theme-widgets-category-fullscreen' ];
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
		return [ 'slick', 'tweenmax', 'grandrestaurant-elementor' ];
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
			'gallery_content_type',
			[
				'label' => __( 'Gallery Content Type', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'media_library',
			    'options' => [
			     	'media_library' => __( 'Media Library', 'grandrestaurant-elementor' ),
			     	'gallery_post' => __( 'Gallery Post Type', 'grandrestaurant-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
			'gallery',
			 [
			    'label' => __( 'Add Images', 'craftcoffee-elementor' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'condition' => [
					'gallery_content_type' => 'media_library',
				],
			]
		);
		
		$this->add_control(
			'gallery_id',
			[
				'label' => __( 'Gallery', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT2,
			    'options' => grandrestaurant_get_galleries(),
			    'multiple' => false,
				'condition' => [
					'gallery_content_type' => 'gallery_post',
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
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_image',
			array(
				'label'      => esc_html__( 'Image', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'size',
			[
				'label' => __( 'Image Size', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
			    'options' => [
			     	'contain' => __( 'Contain', 'grandrestaurant-elementor' ),
			     	'cover' => __( 'Cover', 'grandrestaurant-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
			'slideshow_content',
			[
				'label' => __( 'Image Content', 'grandrestaurant-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'title',
			    'options' => [
			     	'title' => __( 'Title', 'grandrestaurant-elementor' ),
			     	'caption' => __( 'Caption', 'grandrestaurant-elementor' ),
			     	'description' 	=> __( 'Description', 'grandrestaurant-elementor' ),
			    ],
			    'multiple' => true
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
		            '{{WRAPPER}} .fullscreen-gallery-preview-wrapper .gallery-fullscreen-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .fullscreen-gallery-preview-wrapper.slider-wrapper .gallery-fullscreen-title',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_caption_style',
			array(
				'label'      => esc_html__( 'Caption', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'caption_color',
		    [
		        'label' => __( 'Caption Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .fullscreen-gallery-preview-wrapper .gallery-fullscreen-caption' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'label' => __( 'Caption Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .fullscreen-gallery-preview-wrapper.slider-wrapper .gallery-fullscreen-caption',
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
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .fullscreen-gallery-preview-wrapper .gallery-fullscreen-description' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Description Typography', 'grandrestaurant-elementor' ),
				'selector' => '{{WRAPPER}} .fullscreen-gallery-preview-wrapper.slider-wrapper .gallery-fullscreen-description',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_pagination_navigation',
			array(
				'label'      => esc_html__( 'Pagination & Navigation', 'grandrestaurant-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
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
			'show_navigation',
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
		    'navigation_color',
		    [
		        'label' => __( 'Navigation Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .fullscreen-gallery-preview-wrapper .slick-arrow.slick-prev:before' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .fullscreen-gallery-preview-wrapper .slick-arrow.slick-next:before' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .fullscreen-gallery-preview-wrapper .slick-arrow:after' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'pagination_color',
		    [
		        'label' => __( 'Pagination Color', 'grandrestaurant-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .fullscreen-gallery-preview-wrapper .slick-dots li.slick-active button' => 'background-color: {{VALUE}}',
		            '{{WRAPPER}} .fullscreen-gallery-preview-wrapper .slick-dots li button' => 'border-color: {{VALUE}}',
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
		include(GRANDRESTAURANT_ELEMENTOR_PATH.'templates/gallery-preview/index.php');
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
