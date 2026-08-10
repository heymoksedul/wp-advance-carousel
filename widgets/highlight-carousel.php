<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Advance_Carousel_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'advance_highlight_carousel';
	}

	public function get_title() {
		return esc_html__( 'Highlight Carousel', 'advance-carousel' );
	}

	public function get_icon() {
		return 'eicon-image-carousel';
	}

	public function get_categories() {
		return [ 'general' ]; // Or a custom category if you created one
	}

	public function get_script_depends() {
		// Elementor already registers 'swiper', we also register our own script
		return [ 'swiper', 'advance-carousel-script' ];
	}

	public function get_style_depends() {
		return [ 'e-swiper', 'advance-carousel-style' ];
	}

	protected function register_controls() {

		// ==========================================
		// Content Tab
		// ==========================================
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Slides', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_title', [
				'label' => esc_html__( 'Title', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Slide Title' , 'advance-carousel' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_image',
			[
				'label' => esc_html__( 'Choose Image', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'item_description',
			[
				'label' => esc_html__( 'Description (Bottom Text)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Slide description text goes here.' , 'advance-carousel' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'item_link',
			[
				'label' => esc_html__( 'Link', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'advance-carousel' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$repeater->add_control(
			'item_link_text',
			[
				'label' => esc_html__( 'Link Text', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Read more', 'advance-carousel' ),
			]
		);

		$this->add_control(
			'slides',
			[
				'label' => esc_html__( 'Carousel Items', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'item_title' => esc_html__( 'Agentic Commerce Protocol', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Make your products shoppable through AI platforms. Find out how the Agentic Commerce Protocol (ACP) allows any business to accept purchases from AI platforms.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'Read more', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Global Expansion', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Expand your business globally with our new cross-border payment solutions and infrastructure.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'Learn more', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Annual Letter 2025', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Businesses generated $1.9T in 2025. Our annual letter explores the trends shaping the future of commerce.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'Read letter', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32b7?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Developer Tools', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Build faster with our new suite of developer tools, designed for maximum efficiency and scale.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'Explore tools', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Checkout Optimization', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Increase conversion rates by 15% with our new optimized checkout flows.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'View guide', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1531538512164-9155989d891c?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Fraud Prevention', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Advanced machine learning models to detect and prevent fraud before it happens.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'Learn how', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Subscription Billing', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Manage recurring revenue easily with our powerful subscription billing engine.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'Get started', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Startup Guide', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Everything you need to know about starting and scaling an internet business.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'Read guide', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1491336477066-31156b5e4f35?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Platform Updates', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Check out the latest features and updates released this month.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'See updates', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Financial Services', 'advance-carousel' ),
						'item_desc' => esc_html__( 'Offer banking and financial services directly to your customers.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'Learn more', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1563986768494-4dee2763ff3f?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Customer Success', 'advance-carousel' ),
						'item_desc' => esc_html__( 'How top brands are using our platform to drive growth and retention.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'Read stories', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=800&auto=format&fit=crop' ],
					],
					[
						'item_title' => esc_html__( 'Join the Team', 'advance-carousel' ),
						'item_desc' => esc_html__( 'We are hiring! Check out our open roles and join us in building the future.', 'advance-carousel' ),
						'item_link_text' => esc_html__( 'View careers', 'advance-carousel' ),
						'item_link' => [ 'url' => '#' ],
						'item_image' => [ 'url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=800&auto=format&fit=crop' ],
					],
				],
				'title_field' => '{{{ item_title }}}',
			]
		);

		$this->end_controls_section();

		// ==========================================
		// Settings Section
		// ==========================================
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Slider Settings', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
				'default' => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_arrows',
			[
				'label' => esc_html__( 'Show Arrows', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advance-carousel' ),
				'label_off' => esc_html__( 'Hide', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'arrow_position',
			[
				'label' => esc_html__( 'Arrow Position', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'top_right',
				'options' => [
					'top_right' => esc_html__( 'Top Right', 'advance-carousel' ),
					'center_sides' => esc_html__( 'Center Sides', 'advance-carousel' ),
					'bottom_right' => esc_html__( 'Bottom Right', 'advance-carousel' ),
				],
				'condition' => [
					'show_arrows' => 'yes',
				],
				'prefix_class' => 'ac-arrow-pos-',
			]
		);
		
		$this->add_control(
			'gap',
			[
				'label' => esc_html__( 'Space Between Slides', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 20,
			]
		);

		$this->end_controls_section();

		// ==========================================
		// Style Tab
		// ==========================================
		$this->start_controls_section(
			'style_image_section',
			[
				'label' => esc_html__( 'Image Layout', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Height', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 450,
				],
				'selectors' => [
					'{{WRAPPER}} .advance-slide-image-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .advance-slide-image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Typography & Colors
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => esc_html__( 'Content', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advance-slide-title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .advance-slide-title',
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advance-slide-desc' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__( 'Description Typography', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .advance-slide-desc',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['slides'] ) ) {
			return;
		}

		// Pass settings to frontend via data attributes
		$swiper_settings = [
			'autoplay' => ( 'yes' === $settings['autoplay'] ) ? [ 'delay' => $settings['autoplay_speed'] ] : false,
			'spaceBetween' => $settings['gap'],
		];
		
		$this->add_render_attribute( 'wrapper', 'class', 'advance-carousel-wrapper' );
		$this->add_render_attribute( 'wrapper', 'data-swiper-settings', wp_json_encode( $swiper_settings ) );

		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			
			<div class="swiper advance-highlight-swiper">
				<div class="swiper-wrapper">
					<?php foreach ( $settings['slides'] as $index => $item ) : 
						$desc = wp_kses_post( $item['item_description'] );
						$link_url = esc_url( $item['item_link']['url'] );
						$link_text = esc_html( $item['item_link_text'] );
						$is_external = $item['item_link']['is_external'] ? 'target="_blank"' : '';
					?>
						<div class="swiper-slide" 
							data-desc="<?php echo esc_attr( $desc ); ?>" 
							data-link="<?php echo esc_attr( $link_url ); ?>" 
							data-link-text="<?php echo esc_attr( $link_text ); ?>"
							data-external="<?php echo esc_attr( $is_external ); ?>">
							
							<div class="advance-slide-image-wrapper">
								<?php if ( ! empty( $item['item_image']['url'] ) ) : ?>
									<img src="<?php echo esc_url( $item['item_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['item_title'] ); ?>" class="advance-slide-bg">
								<?php endif; ?>
								
								<?php if ( ! empty( $item['item_title'] ) ) : ?>
									<h3 class="advance-slide-title"><?php echo esc_html( $item['item_title'] ); ?></h3>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Full width bottom content area -->
			<div class="advance-carousel-bottom-content">
				<div class="advance-slide-desc-area">
					<div class="advance-slide-desc js-dynamic-desc">
						<!-- Content injected by JS -->
					</div>
					<div class="advance-slide-action js-dynamic-action">
						<!-- Content injected by JS -->
					</div>
				</div>
			</div>

			<?php if ( 'yes' === $settings['show_arrows'] ) : ?>
			<div class="advance-carousel-nav-container">
				<div class="advance-swiper-button-prev">
					<i class="eicon-chevron-left" aria-hidden="true"></i>
				</div>
				<div class="advance-swiper-button-next">
					<i class="eicon-chevron-right" aria-hidden="true"></i>
				</div>
			</div>
			<?php endif; ?>

		</div>
		<?php
	}
}
