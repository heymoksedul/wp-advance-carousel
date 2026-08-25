<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Interactive_Card_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'interactive-card-slider';
	}

	public function get_title() {
		return esc_html__( 'Interactive Card Slider', 'advance-carousel' );
	}

	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function get_style_depends() {
		return [ 'advance-carousel-style' ];
	}

	public function get_script_depends() {
		return [ 'advance-carousel-script' ];
	}

	protected function register_controls() {
		// ==========================================
		// Content Tab: Slides Repeater
		// ==========================================
		$this->start_controls_section(
			'section_slides',
			[
				'label' => esc_html__( 'Card Items', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( 'tabs_card_item_content' );

		// ====================
		// Tab 1: Default State
		// ====================
		$repeater->start_controls_tab(
			'tab_item_default',
			[
				'label' => esc_html__( 'Default', 'advance-carousel' ),
			]
		);
		$repeater->add_control(
			'card_theme',
			[
				'label' => esc_html__( 'Card Mode / Theme', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'light',
				'options' => [
					'light' => esc_html__( 'Light Mode', 'advance-carousel' ),
					'dark' => esc_html__( 'Dark Mode', 'advance-carousel' ),
					'custom' => esc_html__( 'Custom Colors', 'advance-carousel' ),
				],
			]
		);

		$repeater->add_control(
			'card_layout',
			[
				'label' => esc_html__( 'Card Image Style', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'inherit',
				'options' => [
					'inherit' => esc_html__( 'Global Default', 'advance-carousel' ),
					'standard' => esc_html__( 'Standard (Graphic in Body)', 'advance-carousel' ),
					'full_cover' => esc_html__( 'Full Card Cover (Image Fills Card)', 'advance-carousel' ),
				],
			]
		);

		$repeater->add_control(
			'custom_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-card-inner, {{WRAPPER}} {{CURRENT_ITEM}}.aic-card-inner' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'custom_border_color',
			[
				'label' => esc_html__( 'Border Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-card-inner, {{WRAPPER}} {{CURRENT_ITEM}}.aic-card-inner' => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'custom_title_color',
			[
				'label' => esc_html__( 'Title Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-title' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'custom_desc_color',
			[
				'label' => esc_html__( 'Description Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-desc' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'custom_btn_bg',
			[
				'label' => esc_html__( 'Button Background', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-btn' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'custom_btn_text',
			[
				'label' => esc_html__( 'Button Text Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-btn' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Outdated Website', 'advance-carousel' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Build trust with a high-converting website.', 'advance-carousel' ),
				'rows' => 3,
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'show_button',
			[
				'label' => esc_html__( 'Show Button', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'advance-carousel' ),
				'label_off' => esc_html__( 'No', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn More', 'advance-carousel' ),
				'placeholder' => esc_html__( 'e.g. Learn More', 'advance-carousel' ),
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link / URL', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'advance-carousel' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);

		$repeater->end_controls_tab();

		// ====================
		// Tab 2: Hover State
		// ====================
		$repeater->start_controls_tab(
			'tab_item_hover',
			[
				'label' => esc_html__( 'Hover', 'advance-carousel' ),
			]
		);

		$repeater->add_control(
			'enable_hover_content',
			[
				'label' => esc_html__( 'Enable Custom Hover State', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'advance-carousel' ),
				'label_off' => esc_html__( 'No', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater->add_control(
			'hover_card_theme',
			[
				'label' => esc_html__( 'Hover Card Mode', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'inherit',
				'options' => [
					'inherit' => esc_html__( 'Same as Default', 'advance-carousel' ),
					'light' => esc_html__( 'Light Mode', 'advance-carousel' ),
					'dark' => esc_html__( 'Dark Mode', 'advance-carousel' ),
					'custom' => esc_html__( 'Custom Colors', 'advance-carousel' ),
				],
				'condition' => [
					'enable_hover_content' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'hover_custom_bg',
			[
				'label' => esc_html__( 'Hover Background', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'enable_hover_content' => 'yes',
					'hover_card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-card-inner:hover, {{WRAPPER}} {{CURRENT_ITEM}}.aic-card-inner:hover' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-state-hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'hover_custom_border',
			[
				'label' => esc_html__( 'Hover Border Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'enable_hover_content' => 'yes',
					'hover_card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-card-inner:hover, {{WRAPPER}} {{CURRENT_ITEM}}.aic-card-inner:hover' => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'hover_custom_title',
			[
				'label' => esc_html__( 'Hover Title Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'enable_hover_content' => 'yes',
					'hover_card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-state-hover .aic-title' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'hover_custom_desc',
			[
				'label' => esc_html__( 'Hover Description Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'enable_hover_content' => 'yes',
					'hover_card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-state-hover .aic-desc' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'hover_custom_btn_bg',
			[
				'label' => esc_html__( 'Hover Button Background', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'enable_hover_content' => 'yes',
					'hover_card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-state-hover .aic-btn' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'hover_custom_btn_text',
			[
				'label' => esc_html__( 'Hover Button Text Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'enable_hover_content' => 'yes',
					'hover_card_theme' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .aic-state-hover .aic-btn' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$repeater->add_control(
			'hover_title',
			[
				'label' => esc_html__( 'Hover Title', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Modern Redesign', 'advance-carousel' ),
				'label_block' => true,
				'condition' => [
					'enable_hover_content' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'hover_description',
			[
				'label' => esc_html__( 'Hover Description', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Transform your brand with ultra-fast speed and sleek UI.', 'advance-carousel' ),
				'rows' => 3,
				'condition' => [
					'enable_hover_content' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'hover_image',
			[
				'label' => esc_html__( 'Hover Image', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => [
					'enable_hover_content' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'show_hover_button',
			[
				'label' => esc_html__( 'Show Hover Button', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'advance-carousel' ),
				'label_off' => esc_html__( 'No', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_hover_content' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'hover_button_text',
			[
				'label' => esc_html__( 'Hover Button Text', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Started', 'advance-carousel' ),
				'condition' => [
					'enable_hover_content' => 'yes',
					'show_hover_button' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'hover_button_link',
			[
				'label' => esc_html__( 'Hover Button Link', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'advance-carousel' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'enable_hover_content' => 'yes',
					'show_hover_button' => 'yes',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label' => esc_html__( 'Cards', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'card_theme' => 'light',
						'title' => esc_html__( 'Outdated Website', 'advance-carousel' ),
						'description' => esc_html__( 'Build trust with a high-converting website.', 'advance-carousel' ),
						'button_text' => '',
						'hover_title' => esc_html__( 'Modern Redesign', 'advance-carousel' ),
						'hover_description' => esc_html__( 'Get a stunning, high-converting modern website.', 'advance-carousel' ),
						'hover_button_text' => esc_html__( 'Fix Your Site', 'advance-carousel' ),
					],
					[
						'card_theme' => 'dark',
						'title' => esc_html__( 'Missing Customer Calls', 'advance-carousel' ),
						'description' => esc_html__( 'Never miss another opportunity again.', 'advance-carousel' ),
						'button_text' => '',
						'hover_title' => esc_html__( '24/7 AI Receptionist', 'advance-carousel' ),
						'hover_description' => esc_html__( 'Instant response automation that captures every lead.', 'advance-carousel' ),
						'hover_button_text' => esc_html__( 'Automate Calls', 'advance-carousel' ),
					],
					[
						'card_theme' => 'light',
						'title' => esc_html__( 'Slow Business Growth', 'advance-carousel' ),
						'description' => esc_html__( 'Grow your business with ease.', 'advance-carousel' ),
						'button_text' => '',
						'hover_title' => esc_html__( 'Rapid Scale Engine', 'advance-carousel' ),
						'hover_description' => esc_html__( 'Accelerate revenue with proven automated systems.', 'advance-carousel' ),
						'hover_button_text' => esc_html__( 'Scale Fast', 'advance-carousel' ),
					],
					[
						'card_theme' => 'dark',
						'title' => esc_html__( 'Hard to Get Reviews', 'advance-carousel' ),
						'description' => esc_html__( 'Earn more trusted social proof automatically.', 'advance-carousel' ),
						'button_text' => '',
						'hover_title' => esc_html__( 'Automated Reviews', 'advance-carousel' ),
						'hover_description' => esc_html__( 'Collect 5-star customer ratings on autopilot.', 'advance-carousel' ),
						'hover_button_text' => esc_html__( 'Get 5-Star Reviews', 'advance-carousel' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		// ==========================================
		// Content Tab: Carousel Settings
		// ==========================================
		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'global_card_layout',
			[
				'label' => esc_html__( 'Card Image Style', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => [
					'standard' => esc_html__( 'Standard (Graphic in Body)', 'advance-carousel' ),
					'full_cover' => esc_html__( 'Full Card Cover (Image Fills Card Background)', 'advance-carousel' ),
				],
			]
		);

		$this->add_responsive_control(
			'slides_per_view',
			[
				'label' => esc_html__( 'Columns (Slides Per View)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
						'step' => 0.1,
					],
				],
				'desktop_default' => [
					'size' => 3.5,
				],
				'tablet_default' => [
					'size' => 2.2,
				],
				'mobile_default' => [
					'size' => 1.2,
				],
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Gap Between Cards', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Infinite Loop', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'advance-carousel' ),
				'label_off' => esc_html__( 'No', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'advance-carousel' ),
				'label_off' => esc_html__( 'No', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__( 'Autoplay Speed (ms)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3500,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__( 'Pause on Hover', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'advance-carousel' ),
				'label_off' => esc_html__( 'No', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Animation Speed (ms)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 600,
			]
		);

		// Navigation Arrows
		$this->add_control(
			'show_arrows',
			[
				'label' => esc_html__( 'Navigation Arrows', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advance-carousel' ),
				'label_off' => esc_html__( 'Hide', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'arrow_prev_icon',
			[
				'label' => esc_html__( 'Prev Arrow Icon', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'solid',
				],
				'condition' => [
					'show_arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_next_icon',
			[
				'label' => esc_html__( 'Next Arrow Icon', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'condition' => [
					'show_arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_position',
			[
				'label' => esc_html__( 'Arrow Position', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'top_right',
				'options' => [
					'top_right' => esc_html__( 'Top Right (Header)', 'advance-carousel' ),
					'bottom_center' => esc_html__( 'Bottom Center', 'advance-carousel' ),
					'center_sides' => esc_html__( 'Center Sides (Floating)', 'advance-carousel' ),
				],
				'condition' => [
					'show_arrows' => 'yes',
				],
				'prefix_class' => 'aic-arrows-',
			]
		);

		// Pagination
		$this->add_control(
			'show_pagination',
			[
				'label' => esc_html__( 'Pagination', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advance-carousel' ),
				'label_off' => esc_html__( 'Hide', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label' => esc_html__( 'Pagination Type', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [
					'bullets' => esc_html__( 'Bullets / Dots', 'advance-carousel' ),
					'fraction' => esc_html__( 'Fraction (1 / 4)', 'advance-carousel' ),
					'progressbar' => esc_html__( 'Progress Bar', 'advance-carousel' ),
				],
				'condition' => [
					'show_pagination' => 'yes',
				],
			]
		);

		// Remote Navigation Integration
		$this->add_control(
			'remote_id',
			[
				'label' => esc_html__( 'Remote Navigation ID', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Connect this carousel with Animex Remote Arrows or external buttons by matching this ID.', 'advance-carousel' ),
				'placeholder' => 'card-slider-1',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// ==========================================
		// Style Tab: Card Box
		// ==========================================
		$this->start_controls_section(
			'section_style_card',
			[
				'label' => esc_html__( 'Card Box', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_height',
			[
				'label' => esc_html__( 'Card Height', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 900,
					],
					'vh' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 440,
				],
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_max_height',
			[
				'label' => esc_html__( 'Max Height', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_min_height',
			[
				'label' => esc_html__( 'Min Height', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_content_valign',
			[
				'label' => esc_html__( 'Vertical Content Position', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'space-between',
				'options' => [
					'space-between' => esc_html__( 'Space Between (Top & Bottom)', 'advance-carousel' ),
					'flex-start' => esc_html__( 'Top', 'advance-carousel' ),
					'center' => esc_html__( 'Center', 'advance-carousel' ),
					'flex-end' => esc_html__( 'Bottom', 'advance-carousel' ),
				],
				'selectors' => [
					'{{WRAPPER}} .aic-card-content' => 'justify-content: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__( 'Padding', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '32',
					'right' => '28',
					'bottom' => '28',
					'left' => '28',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .aic-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'card_overflow',
			[
				'label' => esc_html__( 'Overflow', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'hidden',
				'options' => [
					'hidden' => esc_html__( 'Hidden (Clip to Border Radius)', 'advance-carousel' ),
					'visible' => esc_html__( 'Visible', 'advance-carousel' ),
				],
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner' => 'overflow: {{VALUE}} !important;',
					'{{WRAPPER}} .aic-card-content' => 'overflow: {{VALUE}} !important;',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_card_box_style' );

		$this->start_controls_tab(
			'tab_card_normal',
			[
				'label' => esc_html__( 'Normal', 'advance-carousel' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'card_background',
				'label' => esc_html__( 'Background', 'advance-carousel' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom)',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#ffffff',
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .aic-card-inner',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'unit' => 'px',
							'isLinked' => true,
						],
					],
					'color' => [
						'default' => '#ebeef2',
					],
				],
			]
		);

		$this->add_control(
			'card_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '24',
					'right' => '24',
					'bottom' => '24',
					'left' => '24',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .aic-card-inner',
				'fields_options' => [
					'box_shadow_type' => [
						'default' => 'yes',
					],
					'box_shadow' => [
						'default' => [
							'horizontal' => 0,
							'vertical' => 4,
							'blur' => 20,
							'spread' => 0,
							'color' => 'rgba(0, 0, 0, 0.04)',
						],
					],
				],
			]
		);

		$this->add_control(
			'heading_card_overlay',
			[
				'label' => esc_html__( 'Cover Overlay (Optional)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'card_overlay_bg',
				'label' => esc_html__( 'Overlay Background', 'advance-carousel' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aic-card-overlay',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_card_hover',
			[
				'label' => esc_html__( 'Hover', 'advance-carousel' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'card_hover_background',
				'label' => esc_html__( 'Hover Background', 'advance-carousel' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aic-card-inner:hover',
			]
		);

		$this->add_control(
			'card_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#d0d5dd',
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_hover_box_shadow',
				'selector' => '{{WRAPPER}} .aic-card-inner:hover',
				'fields_options' => [
					'box_shadow_type' => [
						'default' => 'yes',
					],
					'box_shadow' => [
						'default' => [
							'horizontal' => 0,
							'vertical' => 12,
							'blur' => 32,
							'spread' => 0,
							'color' => 'rgba(0, 0, 0, 0.08)',
						],
					],
				],
			]
		);

		$this->add_control(
			'heading_card_hover_overlay',
			[
				'label' => esc_html__( 'Hover Cover Overlay (Optional)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'card_hover_overlay_bg',
				'label' => esc_html__( 'Hover Overlay Background', 'advance-carousel' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aic-card-inner:hover .aic-card-overlay',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// ==========================================
		// Style Tab: Default State Typography & Style
		// ==========================================
		$this->start_controls_section(
			'section_style_default_content',
			[
				'label' => esc_html__( 'Default State Content', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_align',
			[
				'label' => esc_html__( 'Alignment', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'advance-carousel' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'advance-carousel' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'advance-carousel' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .aic-header-content' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .aic-state-default .aic-action' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_default_title',
			[
				'label' => esc_html__( 'Title', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#0f172a',
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom) .aic-state-default .aic-title' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom) .aic-title' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .aic-state-default .aic-title',
			]
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label' => esc_html__( 'Margin Bottom', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 40 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .aic-state-default .aic-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_default_desc',
			[
				'label' => esc_html__( 'Description', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#64748b',
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom) .aic-state-default .aic-desc' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom) .aic-state-default .aic-desc *' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom) .aic-desc' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom) .aic-desc *' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .aic-state-default .aic-desc',
			]
		);

		$this->add_control(
			'heading_default_image',
			[
				'label' => esc_html__( 'Image Sizing & Style', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_mode',
			[
				'label' => esc_html__( 'Image Display Mode', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => [
					'inline' => esc_html__( 'Inline Graphic (Body Image)', 'advance-carousel' ),
					'cover' => esc_html__( 'Full Card Cover (Whole Card Background)', 'advance-carousel' ),
				],
				'prefix_class' => 'aic-display-mode-',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'cover_overlay_background',
				'label' => esc_html__( 'Cover Overlay (Optional)', 'advance-carousel' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aic-card-overlay',
				'condition' => [
					'image_mode' => 'cover',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Image Container Height', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range' => [
					'px' => [ 'min' => 50, 'max' => 500 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 200,
				],
				'condition' => [
					'image_mode' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .aic-image-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Image Width', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [ 'min' => 50, 'max' => 500 ],
					'%' => [ 'min' => 10, 'max' => 100 ],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'condition' => [
					'image_mode' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .aic-image-wrap img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_fit',
			[
				'label' => esc_html__( 'Object Fit', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'contain',
				'options' => [
					'contain' => esc_html__( 'Contain (Fit proportionally)', 'advance-carousel' ),
					'cover' => esc_html__( 'Cover (Fill area)', 'advance-carousel' ),
					'fill' => esc_html__( 'Fill (Stretch)', 'advance-carousel' ),
					'scale-down' => esc_html__( 'Scale Down', 'advance-carousel' ),
					'none' => esc_html__( 'Original Size', 'advance-carousel' ),
				],
				'condition' => [
					'image_mode' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .aic-image-wrap img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_align',
			[
				'label' => esc_html__( 'Image Alignment', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'advance-carousel' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'advance-carousel' ),
						'icon' => 'eicon-h-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'advance-carousel' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'center',
				'condition' => [
					'image_mode' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .aic-image-wrap' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label' => esc_html__( 'Image Margin', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'condition' => [
					'image_mode' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .aic-image-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Image Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'image_mode' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .aic-image-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// ==========================================
		// Style Tab: Hover State Typography & Button
		// ==========================================
		$this->start_controls_section(
			'section_style_hover_content',
			[
				'label' => esc_html__( 'Hover State Content & Button', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_title_color',
			[
				'label' => esc_html__( 'Hover Title Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#0f172a',
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner:not(.aic-hover-theme-dark):not(.aic-theme-custom) .aic-state-hover .aic-title' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'hover_desc_color',
			[
				'label' => esc_html__( 'Hover Description Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#475569',
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner:not(.aic-hover-theme-dark):not(.aic-theme-custom) .aic-state-hover .aic-desc' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .aic-card-inner:not(.aic-hover-theme-dark):not(.aic-theme-custom) .aic-state-hover .aic-desc *' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'heading_hover_btn',
			[
				'label' => esc_html__( 'Button Styling', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .aic-btn',
			]
		);

		$this->start_controls_tabs( 'tabs_btn_style' );

		$this->start_controls_tab(
			'tab_btn_normal',
			[
				'label' => esc_html__( 'Normal', 'advance-carousel' ),
			]
		);

		$this->add_control(
			'btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom) .aic-btn' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom) .aic-btn *' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#0f172a',
				'selectors' => [
					'{{WRAPPER}} .aic-card-inner:not(.aic-theme-dark):not(.aic-theme-custom) .aic-btn' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'selector' => '{{WRAPPER}} .aic-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => esc_html__( 'Hover', 'advance-carousel' ),
			]
		);

		$this->add_control(
			'btn_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aic-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2563eb',
				'selectors' => [
					'{{WRAPPER}} .aic-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'btn_hover_border',
				'selector' => '{{WRAPPER}} .aic-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => esc_html__( 'Button Padding', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '20',
					'bottom' => '10',
					'left' => '20',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .aic-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'btn_border_radius',
			[
				'label' => esc_html__( 'Button Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .aic-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_hover_image',
			[
				'label' => esc_html__( 'Hover Image Sizing', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'hover_image_height',
			[
				'label' => esc_html__( 'Hover Image Height', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range' => [
					'px' => [ 'min' => 50, 'max' => 500 ],
				],
				'selectors' => [
					'{{WRAPPER}} .aic-state-hover .aic-image-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'hover_image_fit',
			[
				'label' => esc_html__( 'Hover Object Fit', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'contain',
				'options' => [
					'contain' => esc_html__( 'Contain', 'advance-carousel' ),
					'cover' => esc_html__( 'Cover', 'advance-carousel' ),
					'fill' => esc_html__( 'Fill', 'advance-carousel' ),
					'scale-down' => esc_html__( 'Scale Down', 'advance-carousel' ),
					'none' => esc_html__( 'Original Size', 'advance-carousel' ),
				],
				'selectors' => [
					'{{WRAPPER}} .aic-state-hover .aic-image-wrap img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// ==========================================
		// Style Tab: Navigation Arrows & Pagination
		// ==========================================
		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => esc_html__( 'Navigation & Pagination', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_nav_arrows',
			[
				'label' => esc_html__( 'Arrows', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'arrow_size',
			[
				'label' => esc_html__( 'Arrow Button Size', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 24, 'max' => 80 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 44,
				],
				'selectors' => [
					'{{WRAPPER}} .aic-arrow-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'arrow_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#0f172a',
				'selectors' => [
					'{{WRAPPER}} .aic-arrow-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aic-arrow-btn svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f1f5f9',
				'selectors' => [
					'{{WRAPPER}} .aic-arrow-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_hover_icon_color',
			[
				'label' => esc_html__( 'Hover Icon Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aic-arrow-btn:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aic-arrow-btn:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_hover_bg_color',
			[
				'label' => esc_html__( 'Hover Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#0f172a',
				'selectors' => [
					'{{WRAPPER}} .aic-arrow-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_border_radius',
			[
				'label' => esc_html__( 'Arrow Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'unit' => '%',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .aic-arrow-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_nav_pagination',
			[
				'label' => esc_html__( 'Pagination', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'bullet_color',
			[
				'label' => esc_html__( 'Dot Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#cbd5e1',
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bullet_active_color',
			[
				'label' => esc_html__( 'Active Dot Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#0f172a',
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-progressbar-fill' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['slides'] ) ) {
			return;
		}

		$show_arrows = 'yes' === $settings['show_arrows'];
		$arrow_pos = $settings['arrow_position'];
		$show_pagination = 'yes' === $settings['show_pagination'];
		$remote_id = ! empty( $settings['remote_id'] ) ? esc_attr( $settings['remote_id'] ) : '';

		// Swiper data configuration
		$slider_config = [
			'loop'            => 'yes' === $settings['loop'],
			'speed'           => ! empty( $settings['speed'] ) ? intval( $settings['speed'] ) : 600,
			'autoplay'        => 'yes' === $settings['autoplay'] ? [
				'delay'                => ! empty( $settings['autoplay_speed'] ) ? intval( $settings['autoplay_speed'] ) : 3500,
				'disableOnInteraction' => false,
				'pauseOnMouseEnter'    => 'yes' === $settings['pause_on_hover'],
			] : false,
			'slidesPerView'   => ! empty( $settings['slides_per_view']['size'] ) ? floatval( $settings['slides_per_view']['size'] ) : 3.5,
			'spaceBetween'    => ! empty( $settings['space_between']['size'] ) ? intval( $settings['space_between']['size'] ) : 24,
			'paginationType'  => $settings['pagination_type'],
			'breakpoints'     => [
				320 => [
					'slidesPerView' => ! empty( $settings['slides_per_view_mobile']['size'] ) ? floatval( $settings['slides_per_view_mobile']['size'] ) : 1.2,
					'spaceBetween'  => ! empty( $settings['space_between_mobile']['size'] ) ? intval( $settings['space_between_mobile']['size'] ) : 16,
				],
				768 => [
					'slidesPerView' => ! empty( $settings['slides_per_view_tablet']['size'] ) ? floatval( $settings['slides_per_view_tablet']['size'] ) : 2.2,
					'spaceBetween'  => ! empty( $settings['space_between_tablet']['size'] ) ? intval( $settings['space_between_tablet']['size'] ) : 20,
				],
				1025 => [
					'slidesPerView' => ! empty( $settings['slides_per_view']['size'] ) ? floatval( $settings['slides_per_view']['size'] ) : 3.5,
					'spaceBetween'  => ! empty( $settings['space_between']['size'] ) ? intval( $settings['space_between']['size'] ) : 24,
				],
			],
		];

		$wrapper_classes = [ 'aic-card-slider-wrapper' ];
		if ( $remote_id ) {
			$wrapper_classes[] = 'animex-elite-carousel-container';
		}

		$this->add_render_attribute( 'wrapper', 'class', $wrapper_classes );
		if ( $remote_id ) {
			$this->add_render_attribute( 'wrapper', 'data-remote-id', $remote_id );
		}
		$this->add_render_attribute( 'wrapper', 'data-slider-config', wp_json_encode( $slider_config ) );
		?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			
			<?php if ( $show_arrows && 'top_right' === $arrow_pos ) : ?>
				<div class="aic-header-nav">
					<button type="button" class="aic-arrow-btn aic-btn-prev" aria-label="<?php esc_attr_e( 'Previous', 'advance-carousel' ); ?>">
						<?php \Elementor\Icons_Manager::render_icon( $settings['arrow_prev_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</button>
					<button type="button" class="aic-arrow-btn aic-btn-next" aria-label="<?php esc_attr_e( 'Next', 'advance-carousel' ); ?>">
						<?php \Elementor\Icons_Manager::render_icon( $settings['arrow_next_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</button>
				</div>
			<?php endif; ?>

			<div class="swiper aic-swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ( $settings['slides'] as $index => $item ) : 
						$has_hover = 'yes' === $item['enable_hover_content'];
						$default_img = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';
						$hover_img = ! empty( $item['hover_image']['url'] ) ? $item['hover_image']['url'] : $default_img;
						
						$btn_link = ! empty( $item['button_link']['url'] ) ? esc_url( $item['button_link']['url'] ) : '';
						$btn_target = ! empty( $item['button_link']['is_external'] ) ? ' target="_blank"' : '';
						$btn_nofollow = ! empty( $item['button_link']['nofollow'] ) ? ' rel="nofollow"' : '';
						
						$hover_btn_link = ! empty( $item['hover_button_link']['url'] ) ? esc_url( $item['hover_button_link']['url'] ) : $btn_link;
						$hover_btn_target = ! empty( $item['hover_button_link']['is_external'] ) ? ' target="_blank"' : $btn_target;
						$hover_btn_nofollow = ! empty( $item['hover_button_link']['nofollow'] ) ? ' rel="nofollow"' : $btn_nofollow;

						$item_theme = ! empty( $item['card_theme'] ) ? $item['card_theme'] : 'light';
						$hover_theme = ! empty( $item['hover_card_theme'] ) ? $item['hover_card_theme'] : 'inherit';

						$global_layout = ! empty( $settings['global_card_layout'] ) ? $settings['global_card_layout'] : 'standard';
						$item_layout = ( ! empty( $item['card_layout'] ) && 'inherit' !== $item['card_layout'] ) ? $item['card_layout'] : $global_layout;

						$card_classes = [
							'aic-card-inner',
							'elementor-repeater-item-' . esc_attr( $item['_id'] ),
							'aic-theme-' . esc_attr( $item_theme ),
						];
						if ( 'full_cover' === $item_layout ) {
							$card_classes[] = 'aic-card-cover';
						}
						if ( $has_hover ) {
							$card_classes[] = 'aic-has-hover';
							if ( 'inherit' !== $hover_theme ) {
								$card_classes[] = 'aic-hover-theme-' . esc_attr( $hover_theme );
							}
						}
					?>
						<div class="swiper-slide aic-slide">
							<div class="<?php echo esc_attr( implode( ' ', $card_classes ) ); ?>">
								
								<!-- Background Layers (for Full Cover Mode) -->
								<?php if ( $default_img ) : ?>
									<div class="aic-card-bg-layer aic-bg-default">
										<img src="<?php echo esc_url( $default_img ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
									</div>
								<?php endif; ?>

								<?php if ( $has_hover && ! empty( $item['hover_image']['url'] ) ) : ?>
									<div class="aic-card-bg-layer aic-bg-hover">
										<img src="<?php echo esc_url( $item['hover_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['hover_title'] ); ?>" loading="lazy">
									</div>
								<?php endif; ?>

								<!-- Dark Overlay Layer -->
								<div class="aic-card-overlay"></div>

								<!-- Default State Content -->
								<div class="aic-card-content aic-state-default">
									<div class="aic-header-content">
										<?php if ( ! empty( $item['title'] ) ) : ?>
											<h3 class="aic-title"><?php echo esc_html( $item['title'] ); ?></h3>
										<?php endif; ?>

										<?php if ( ! empty( $item['description'] ) ) : ?>
											<div class="aic-desc"><?php echo wp_kses_post( $item['description'] ); ?></div>
										<?php endif; ?>
									</div>

									<!-- Inline Graphic (Standard Mode) -->
									<?php if ( $default_img ) : ?>
										<div class="aic-image-wrap aic-inline-graphic">
											<img src="<?php echo esc_url( $default_img ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
										</div>
									<?php endif; ?>

									<?php 
									$show_btn = 'yes' === ( ! empty( $item['show_button'] ) ? $item['show_button'] : '' );
									if ( $show_btn && ! empty( $item['button_text'] ) && $btn_link ) : 
									?>
										<div class="aic-action">
											<a href="<?php echo $btn_link; ?>" class="aic-btn" <?php echo $btn_target . $btn_nofollow; ?>>
												<?php echo esc_html( $item['button_text'] ); ?>
											</a>
										</div>
									<?php endif; ?>
								</div>

								<!-- Hover State Content -->
								<?php if ( $has_hover ) : ?>
									<div class="aic-card-content aic-state-hover">
										<div class="aic-header-content">
											<?php if ( ! empty( $item['hover_title'] ) ) : ?>
												<h3 class="aic-title"><?php echo esc_html( $item['hover_title'] ); ?></h3>
											<?php endif; ?>

											<?php if ( ! empty( $item['hover_description'] ) ) : ?>
												<div class="aic-desc"><?php echo wp_kses_post( $item['hover_description'] ); ?></div>
											<?php endif; ?>
										</div>

										<!-- Inline Graphic (Standard Mode) -->
										<?php if ( $hover_img ) : ?>
											<div class="aic-image-wrap aic-inline-graphic">
												<img src="<?php echo esc_url( $hover_img ); ?>" alt="<?php echo esc_attr( $item['hover_title'] ); ?>" loading="lazy">
											</div>
										<?php endif; ?>

										<?php 
										$show_hover_btn = ! isset( $item['show_hover_button'] ) || 'yes' === $item['show_hover_button'];
										if ( $show_hover_btn && ! empty( $item['hover_button_text'] ) ) : 
										?>
											<div class="aic-action">
												<a href="<?php echo $hover_btn_link ? $hover_btn_link : 'javascript:void(0)'; ?>" class="aic-btn aic-btn-hover" <?php echo $hover_btn_target . $hover_btn_nofollow; ?>>
													<?php echo esc_html( $item['hover_button_text'] ); ?>
												</a>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<?php if ( $show_arrows && 'center_sides' === $arrow_pos ) : ?>
					<button type="button" class="aic-arrow-btn aic-btn-prev aic-floating-prev" aria-label="<?php esc_attr_e( 'Previous', 'advance-carousel' ); ?>">
						<?php \Elementor\Icons_Manager::render_icon( $settings['arrow_prev_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</button>
					<button type="button" class="aic-arrow-btn aic-btn-next aic-floating-next" aria-label="<?php esc_attr_e( 'Next', 'advance-carousel' ); ?>">
						<?php \Elementor\Icons_Manager::render_icon( $settings['arrow_next_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</button>
				<?php endif; ?>
			</div>

			<!-- Footer: Pagination & Bottom Center Arrows -->
			<?php if ( $show_pagination || ( $show_arrows && 'bottom_center' === $arrow_pos ) ) : ?>
				<div class="aic-footer-nav">
					<?php if ( $show_arrows && 'bottom_center' === $arrow_pos ) : ?>
						<button type="button" class="aic-arrow-btn aic-btn-prev" aria-label="<?php esc_attr_e( 'Previous', 'advance-carousel' ); ?>">
							<?php \Elementor\Icons_Manager::render_icon( $settings['arrow_prev_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</button>
					<?php endif; ?>

					<?php if ( $show_pagination ) : ?>
						<div class="swiper-pagination aic-pagination"></div>
					<?php endif; ?>

					<?php if ( $show_arrows && 'bottom_center' === $arrow_pos ) : ?>
						<button type="button" class="aic-arrow-btn aic-btn-next" aria-label="<?php esc_attr_e( 'Next', 'advance-carousel' ); ?>">
							<?php \Elementor\Icons_Manager::render_icon( $settings['arrow_next_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</button>
					<?php endif; ?>
				</div>
			<?php endif; ?>

		</div>
		<?php
	}
}
