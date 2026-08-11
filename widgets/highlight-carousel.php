<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Advance_Carousel_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'advance-highlight-carousel';
	}

	public function get_title() {
		return esc_html__( 'Advance Highlight Carousel', 'advance-carousel' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'general' ]; // You can change this to a custom category if needed
	}

	public function get_style_depends() {
		return [ 'advance-carousel-style' ];
	}

	public function get_script_depends() {
		return [ 'advance-carousel-script' ];
	}

	protected function register_controls() {
		// ==========================================
		// Content Tab
		// ==========================================
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Carousel Items', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_image',
			[
				'label' => esc_html__( 'Image', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Title (Admin Only)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Slide Title' , 'advance-carousel' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_desc',
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
			'transition_speed',
			[
				'label' => esc_html__( 'Transition Speed (ms)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 400,
				'selectors' => [
					'{{WRAPPER}} .advance-carousel-slide' => 'transition-duration: {{VALUE}}ms !important;',
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
			'remote_id',
			[
				'label' => esc_html__( 'Remote ID', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Connect this carousel with Animex Remote Arrows widget by matching this ID.', 'advance-carousel' ),
				'placeholder' => 'hero-carousel',
				'separator' => 'before',
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
					'{{WRAPPER}} .advance-highlight-carousel' => 'height: {{SIZE}}{{UNIT}};',
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
				'label' => esc_html__( 'Content Style', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_heading',
			[
				'label' => esc_html__( 'Description', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'desc_max_width',
			[
				'label' => esc_html__( 'Max Width', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'%' => [ 'min' => 10, 'max' => 100 ],
					'px' => [ 'min' => 100, 'max' => 1200 ],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .advance-carousel-desc' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__( 'Description Typography', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .advance-carousel-desc p, {{WRAPPER}} .advance-carousel-desc',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advance-carousel-desc p, {{WRAPPER}} .advance-carousel-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Button Style
		$this->start_controls_section(
			'style_button_section',
			[
				'label' => esc_html__( 'Button Style', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .advance-slide-link',
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label' => esc_html__( 'Button Width', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'%' => [ 'min' => 10, 'max' => 100 ],
					'px' => [ 'min' => 50, 'max' => 500 ],
				],
				'selectors' => [
					'{{WRAPPER}} .advance-carousel-action' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .advance-slide-link' => 'width: 100%; justify-content: center;',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'advance-carousel' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Text Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advance-slide-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advance-slide-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .advance-slide-link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'advance-carousel' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advance-slide-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .advance-slide-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .advance-slide-link:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .advance-slide-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; display: inline-block;',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .advance-slide-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$wrapper_classes = [ 'advance-carousel-wrapper' ];
		if ( ! empty( $settings['remote_id'] ) ) {
			$wrapper_classes[] = 'animex-elite-carousel-container';
		}

		$this->add_render_attribute( 'wrapper', 'class', $wrapper_classes );
		if ( ! empty( $settings['remote_id'] ) ) {
			$this->add_render_attribute( 'wrapper', 'data-remote-id', esc_attr( $settings['remote_id'] ) );
		}
		
		$this->add_render_attribute( 'wrapper', 'data-settings', wp_json_encode( [
			'autoplay' => $settings['autoplay'] === 'yes',
			'speed'    => $settings['autoplay_speed'],
		] ) );

		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			
			<?php if ( 'yes' === $settings['show_arrows'] ) : ?>
				<div class="advance-carousel-header">
					<div class="advance-carousel-nav">
						<div class="advance-carousel-nav-prev">
							<i class="eicon-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="advance-carousel-nav-next">
							<i class="eicon-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="advance-highlight-carousel">
				<?php 
                $total_slides = count( $settings['slides'] );
                foreach ( $settings['slides'] as $index => $item ) : 
					$desc = ! empty( $item['item_desc'] ) ? wp_kses_post( $item['item_desc'] ) : '';
					$link_url = ! empty( $item['item_link']['url'] ) ? esc_url( $item['item_link']['url'] ) : '#';
					$link_text = ! empty( $item['item_link_text'] ) ? esc_html( $item['item_link_text'] ) : 'Learn More';
					$is_external = ! empty( $item['item_link']['is_external'] ) ? 'true' : 'false';
                    
                    // Assign initial state classes
                    $state_class = '';
                    if ( $index === 0 ) {
                        $state_class = 'ac-state-active';
                    } elseif ( $index >= 1 && $index <= 6 ) {
                        $state_class = 'ac-state-' . $index;
                    } elseif ( $index === $total_slides - 1 ) {
                        $state_class = 'ac-state-hidden-left';
                    } else {
                        $state_class = 'ac-state-hidden-right';
                    }
				?>
					<div class="advance-carousel-slide <?php echo esc_attr( $state_class ); ?>" 
						data-title="<?php echo esc_attr( $item['item_title'] ); ?>"
						data-desc="<?php echo esc_attr( $desc ); ?>" 
						data-link="<?php echo esc_attr( $link_url ); ?>" 
						data-link-text="<?php echo esc_attr( $link_text ); ?>"
						data-external="<?php echo esc_attr( $is_external ); ?>">
						
						<div class="advance-slide-image-wrapper">
							<?php if ( ! empty( $item['item_image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $item['item_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['item_title'] ); ?>" class="advance-slide-bg">
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="advance-carousel-footer-content">
				<div class="advance-carousel-desc"></div>
				<div class="advance-carousel-action"></div>
			</div>
		</div>
		<?php
	}
}
