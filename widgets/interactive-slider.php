<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Interactive_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'interactive-slider-carousel';
	}

	public function get_title() {
		return esc_html__( 'Interactive Center Slider', 'advance-carousel' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
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
		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Slider Items', 'advance-carousel' ),
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
				'label' => esc_html__( 'Title', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Slider Title' , 'advance-carousel' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'item_desc',
			[
				'label' => esc_html__( 'Description', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Enter your description here' , 'advance-carousel' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Slider Items', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'item_title' => 'Email marketing', 'item_desc' => 'Create, send and track polished email campaigns effortlessly.' ],
					[ 'item_title' => 'Social Media', 'item_desc' => 'Connect to audiences across all social platforms.' ],
					[ 'item_title' => 'SEO Tools', 'item_desc' => 'Optimize your site and rank higher.' ],
				],
				'title_field' => '{{{ item_title }}}',
			]
		);

		$this->end_controls_section();

		// Settings Tab
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Slider Settings', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_responsive_control(
			'item_width',
			[
				'label' => esc_html__( 'Item Width', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [ 'min' => 200, 'max' => 1200 ],
					'%' => [ 'min' => 10, 'max' => 100 ],
				],
				'default' => [
					'unit' => '%',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .is-slider-wrapper' => '--slide-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'item_gap',
			[
				'label' => esc_html__( 'Gap Between Items', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'vw' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 200 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
			]
		);
		
		$this->add_control(
			'hr_settings_1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'inactive_scale',
			[
				'label' => esc_html__( 'Inactive Item Scale', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0.1, 'max' => 1, 'step' => 0.05 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0.8,
				],
				'selectors' => [
					'{{WRAPPER}} .is-slider-wrapper' => '--inactive-scale: {{SIZE}};',
				],
			]
		);
		
		$this->add_control(
			'inactive_opacity',
			[
				'label' => esc_html__( 'Inactive Item Opacity', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 1, 'step' => 0.1 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0.5,
				],
				'selectors' => [
					'{{WRAPPER}} .is-slider-slide' => 'opacity: {{SIZE}};',
				],
			]
		);
		

		$this->add_control(
			'active_scale',
			[
				'label' => esc_html__( 'Active Item Scale', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0.1, 'max' => 1.5, 'step' => 0.05 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1.0,
				],
				'selectors' => [
					'{{WRAPPER}} .is-slider-wrapper' => '--active-scale: {{SIZE}};',
				],
			]
		);
		
		$this->add_control(
			'transition_duration',
			[
				'label' => esc_html__( 'Transition Duration (ms)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 3000,
				'step' => 100,
				'default' => 600,
				'selectors' => [
					'{{WRAPPER}} .is-slider-wrapper' => '--transition-duration: {{VALUE}}ms;',
				],
			]
		);

		$this->add_control(
			'active_opacity',
			[
				'label' => esc_html__( 'Active Item Opacity', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 1, 'step' => 0.1 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1.0,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide-active.is-slider-slide' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Style Tab: Images
		$this->start_controls_section(
			'style_image_section',
			[
				'label' => esc_html__( 'Images', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .is-slider-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .is-slider-image',
			]
		);
		
		$this->end_controls_section();
		
		// Style Tab: Content
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => esc_html__( 'Content', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .is-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .is-slider-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .is-slider-title',
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .is-slider-desc' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__( 'Description Typography', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .is-slider-desc',
			]
		);

		$this->end_controls_section();
		
		// Style Tab: Custom Cursor
		$this->start_controls_section(
			'style_cursor_section',
			[
				'label' => esc_html__( 'Custom Cursor', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'cursor_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				'selectors' => [
					'{{WRAPPER}} .is-custom-cursor' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'cursor_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .is-custom-cursor i' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'cursor_size',
			[
				'label' => esc_html__( 'Cursor Size', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 20, 'max' => 120 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .is-custom-cursor' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'cursor_border',
				'label' => esc_html__( 'Border', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .is-custom-cursor',
			]
		);
		
		$this->add_control(
			'cursor_backdrop_blur',
			[
				'label' => esc_html__( 'Backdrop Blur (px)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .is-custom-cursor' => '-webkit-backdrop-filter: blur({{SIZE}}{{UNIT}}); backdrop-filter: blur({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['items'] ) ) {
			return;
		}
		
		$placeholder = \Elementor\Utils::get_placeholder_image_src();

		$this->add_render_attribute( 'wrapper', 'class', 'is-slider-wrapper' );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?> class="swiper-container swiper">
			
			<div class="is-custom-cursor">
				<i class="fas fa-arrow-left is-cursor-left"></i>
				<i class="fas fa-arrow-right is-cursor-right"></i>
			</div>

			<div class="swiper-wrapper is-slider-track">
				<?php foreach ( $settings['items'] as $index => $item ) : 
					$img_url = ! empty( $item['item_image']['url'] ) ? $item['item_image']['url'] : $placeholder;
				?>
					<div class="swiper-slide is-slider-slide">
						<div class="is-slider-item">
							<div class="is-slider-image">
								<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $item['item_title'] ); ?>">
							</div>
							<div class="is-slider-content">
								<?php if ( ! empty( $item['item_title'] ) ) : ?>
									<h3 class="is-slider-title"><?php echo wp_kses_post( $item['item_title'] ); ?></h3>
								<?php endif; ?>
								
								<?php if ( ! empty( $item['item_desc'] ) ) : ?>
									<div class="is-slider-desc"><?php echo wp_kses_post( $item['item_desc'] ); ?></div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
