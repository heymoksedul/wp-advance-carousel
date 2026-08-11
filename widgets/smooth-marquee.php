<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Smooth_Marquee_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'smooth-marquee-carousel';
	}

	public function get_title() {
		return esc_html__( 'Smooth Marquee Carousel', 'advance-carousel' );
	}

	public function get_icon() {
		return 'eicon-exchange';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function get_style_depends() {
		return [ 'advance-carousel-style' ];
	}

	protected function register_controls() {
		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Marquee Items', 'advance-carousel' ),
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
				'default' => esc_html__( 'Marquee Item' , 'advance-carousel' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'custom_width_enable',
			[
				'label' => esc_html__( 'Custom Item Width', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'advance-carousel' ),
				'label_off' => esc_html__( 'No', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$repeater->add_control(
			'custom_width',
			[
				'label' => esc_html__( 'Width', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [ 'min' => 100, 'max' => 1200 ],
				],
				'condition' => [
					'custom_width_enable' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-item{{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$repeater->add_control(
			'item_link_text',
			[
				'label' => esc_html__( 'Overlay Text', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Listen now', 'advance-carousel' ),
			]
		);

		$repeater->add_control(
			'item_icon',
			[
				'label' => esc_html__( 'Overlay Icon', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-play-circle',
					'library' => 'solid',
				],
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

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Carousel Items', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'item_title' => 'Item 1' ],
					[ 'item_title' => 'Item 2' ],
					[ 'item_title' => 'Item 3' ],
					[ 'item_title' => 'Item 4' ],
					[ 'item_title' => 'Item 5' ],
					[ 'item_title' => 'Item 6' ],
				],
				'title_field' => '{{{ item_title }}}',
			]
		);

		$this->end_controls_section();

		// Settings Tab
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Marquee Settings', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'rows',
			[
				'label' => esc_html__( 'Number of Rows', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 2,
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Animation Speed (seconds)', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 300,
				'step' => 1,
				'default' => 30,
			]
		);

		$this->add_control(
			'direction',
			[
				'label' => esc_html__( 'Base Direction', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal' => esc_html__( 'Right to Left', 'advance-carousel' ),
					'reverse' => esc_html__( 'Left to Right', 'advance-carousel' ),
				],
			]
		);

		$this->add_control(
			'alternate_direction',
			[
				'label' => esc_html__( 'Alternate Row Directions', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'advance-carousel' ),
				'label_off' => esc_html__( 'No', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'rows!' => 1,
				],
			]
		);
		
		$this->add_control(
			'row_stagger',
			[
				'label' => esc_html__( 'Row Alignment', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'Linear (Aligned)', 'advance-carousel' ),
					'odd' => esc_html__( 'Odd System (Staggered)', 'advance-carousel' ),
				],
				'condition' => [
					'rows!' => 1,
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
			]
		);

		$this->add_control(
			'global_play_pause',
			[
				'label' => esc_html__( 'Show Play/Pause Button', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'advance-carousel' ),
				'label_off' => esc_html__( 'No', 'advance-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'play_icon',
			[
				'label' => esc_html__( 'Play Icon', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-play',
					'library' => 'solid',
				],
				'condition' => [
					'global_play_pause' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_icon',
			[
				'label' => esc_html__( 'Pause Icon', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-pause',
					'library' => 'solid',
				],
				'condition' => [
					'global_play_pause' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'item_width',
			[
				'label' => esc_html__( 'Item Width', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [ 'min' => 100, 'max' => 800 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_height',
			[
				'label' => esc_html__( 'Item Height', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [ 'min' => 100, 'max' => 600 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 200,
				],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gap',
			[
				'label' => esc_html__( 'Gap Between Items', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-track' => 'gap: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .smooth-marquee-container' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Hover Button Style
		$this->start_controls_section(
			'style_overlay_btn_section',
			[
				'label' => esc_html__( 'Hover Button (Overlay)', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_overlay_btn_style' );

		$this->start_controls_tab(
			'tab_overlay_btn_normal',
			[
				'label' => esc_html__( 'Normal', 'advance-carousel' ),
			]
		);

		$this->add_control(
			'overlay_text_color',
			[
				'label' => esc_html__( 'Text Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#1d1d1f',
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-overlay-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overlay_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-overlay-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'overlay_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-overlay-btn .sm-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .smooth-marquee-overlay-btn .sm-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'overlay_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .smooth-marquee-overlay-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_overlay_btn_hover',
			[
				'label' => esc_html__( 'Hover', 'advance-carousel' ),
			]
		);

		$this->add_control(
			'overlay_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-item:hover .smooth-marquee-overlay-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overlay_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-item:hover .smooth-marquee-overlay-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'overlay_hover_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-item:hover .smooth-marquee-overlay-btn .sm-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .smooth-marquee-item:hover .smooth-marquee-overlay-btn .sm-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'overlay_hover_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .smooth-marquee-item:hover .smooth-marquee-overlay-btn',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control(
			'hr_overlay_1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'overlay_typography',
				'label' => esc_html__( 'Typography', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .smooth-marquee-overlay-btn',
			]
		);
		
		$this->add_responsive_control(
			'overlay_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-overlay-btn .sm-icon svg, {{WRAPPER}} .smooth-marquee-overlay-btn .sm-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'overlay_icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-overlay-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'overlay_padding',
			[
				'label' => esc_html__( 'Padding', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-overlay-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'overlay_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-overlay-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		// Play/Pause Button Style
		$this->start_controls_section(
			'style_play_pause_section',
			[
				'label' => esc_html__( 'Play/Pause Button', 'advance-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'global_play_pause' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_pp_btn_style' );

		$this->start_controls_tab(
			'tab_pp_btn_normal',
			[
				'label' => esc_html__( 'Normal', 'advance-carousel' ),
			]
		);
		
		$this->add_control(
			'pp_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#1d1d1f',
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-play-pause' => 'color: {{VALUE}};',
					'{{WRAPPER}} .smooth-marquee-play-pause svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pp_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-play-pause' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'pp_border_color',
			[
				'label' => esc_html__( 'Border Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#e5e7eb',
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-play-pause' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pp_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .smooth-marquee-play-pause',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_pp_btn_hover',
			[
				'label' => esc_html__( 'Hover', 'advance-carousel' ),
			]
		);
		
		$this->add_control(
			'pp_hover_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-play-pause:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .smooth-marquee-play-pause:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pp_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-play-pause:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'pp_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-play-pause:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pp_hover_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'advance-carousel' ),
				'selector' => '{{WRAPPER}} .smooth-marquee-play-pause:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control(
			'hr_pp_1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_responsive_control(
			'pp_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-play-pause svg, {{WRAPPER}} .smooth-marquee-play-pause i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'pp_btn_size',
			[
				'label' => esc_html__( 'Button Size', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-play-pause' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pp_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'advance-carousel' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .smooth-marquee-play-pause' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$items = $settings['items'];
		$num_rows = max( 1, intval( $settings['rows'] ) );
		$speed = max( 1, intval( $settings['speed'] ) );
		$base_dir = $settings['direction'];
		$alternate = $settings['alternate_direction'] === 'yes';
		$stagger = $settings['row_stagger'];
		
		// Split items into rows
		$row_items = array_fill( 0, $num_rows, [] );
		$current_row = 0;
		foreach ( $items as $item ) {
			$row_items[$current_row][] = $item;
			$current_row = ( $current_row + 1 ) % $num_rows;
		}

		$wrapper_classes = [ 'smooth-marquee-wrapper' ];
		if ( 'yes' === $settings['pause_on_hover'] ) {
			$wrapper_classes[] = 'sm-pause-on-hover';
		}
		
		$this->add_render_attribute( 'wrapper', 'class', $wrapper_classes );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="smooth-marquee-container">
				<?php 
				foreach ( $row_items as $index => $row_array ) : 
					if ( empty( $row_array ) ) continue;
					
					$dir = $base_dir;
					if ( $alternate && $index % 2 !== 0 ) {
						$dir = ( $base_dir === 'normal' ) ? 'reverse' : 'normal';
					}
					
					// Calculate how many times to repeat the items to ensure the track is wide enough
					$item_count = count( $row_array );
					$repeat_count = ceil( 12 / $item_count );
					
					$animation_delay = '0s';
					if ( $stagger === 'odd' && $index % 2 !== 0 ) {
						// Offset by 50% of the animation speed
						$animation_delay = '-' . ( $speed / 2 ) . 's';
					}
					
				?>
					<div class="smooth-marquee-row" style="--marquee-speed: <?php echo esc_attr( $speed ); ?>s; --marquee-direction: <?php echo esc_attr( $dir ); ?>; --marquee-delay: <?php echo esc_attr( $animation_delay ); ?>;">
						
						<div class="smooth-marquee-track">
							<?php 
							for ( $i = 0; $i < $repeat_count; $i++ ) {
								$this->render_row_items( $row_array ); 
							}
							?>
						</div>
						
						<div class="smooth-marquee-track" aria-hidden="true">
							<?php 
							for ( $i = 0; $i < $repeat_count; $i++ ) {
								$this->render_row_items( $row_array ); 
							}
							?>
						</div>
						
					</div>
				<?php endforeach; ?>
			</div>
			
			<?php if ( 'yes' === $settings['global_play_pause'] ) : ?>
				<div class="smooth-marquee-play-pause">
					<span class="sm-icon-pause">
						<?php \Elementor\Icons_Manager::render_icon( $settings['pause_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
					<span class="sm-icon-play" style="display: none;">
						<?php \Elementor\Icons_Manager::render_icon( $settings['play_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
	
	private function render_row_items( $items ) {
		$placeholder = \Elementor\Utils::get_placeholder_image_src();
		foreach ( $items as $item ) {
			$img_url = ! empty( $item['item_image']['url'] ) ? $item['item_image']['url'] : $placeholder;
			$link_url = ! empty( $item['item_link']['url'] ) ? esc_url( $item['item_link']['url'] ) : '';
			$link_target = ! empty( $item['item_link']['is_external'] ) ? ' target="_blank"' : '';
			$link_text = ! empty( $item['item_link_text'] ) ? esc_html( $item['item_link_text'] ) : '';
			
			$tag = $link_url ? 'a' : 'div';
			$href = $link_url ? ' href="' . $link_url . '"' . $link_target : '';
			$item_class = 'elementor-repeater-item-' . esc_attr( $item['_id'] );
			
			?>
			<<?php echo $tag . $href; ?> class="smooth-marquee-item <?php echo $item_class; ?>">
				<img src="<?php echo esc_url( $img_url ); ?>" alt="" class="smooth-marquee-bg">
				
				<?php if ( $link_text || ! empty( $item['item_icon']['value'] ) ) : ?>
					<div class="smooth-marquee-overlay">
						<div class="smooth-marquee-overlay-btn">
							<?php if ( ! empty( $item['item_icon']['value'] ) ) : ?>
								<span class="sm-icon">
									<?php \Elementor\Icons_Manager::render_icon( $item['item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</span>
							<?php endif; ?>

							<?php if ( $link_text ) : ?>
								<span class="sm-text"><?php echo $link_text; ?></span>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</<?php echo $tag; ?>>
			<?php
		}
	}
}
