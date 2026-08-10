<?php
/**
 * Plugin Name: Advance Carousel
 * Description: A custom Elementor addon for an advanced, highly customizable carousel widget.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://elementor.com/
 * Text Domain: advance-carousel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Advance Carousel Class
 */
final class Advance_Carousel_Extension {

	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';
	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Register scripts & styles
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_styles' ] );

		// Register Widget
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
	}

	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'advance-carousel' ),
			'<strong>' . esc_html__( 'Advance Carousel', 'advance-carousel' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'advance-carousel' ) . '</strong>'
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'advance-carousel' ),
			'<strong>' . esc_html__( 'Advance Carousel', 'advance-carousel' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'advance-carousel' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'advance-carousel' ),
			'<strong>' . esc_html__( 'Advance Carousel', 'advance-carousel' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'advance-carousel' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function register_scripts() {
		// Register the script so it can be depended on by widgets
		wp_register_script(
			'advance-carousel-script',
			plugins_url( 'assets/js/script.js', __FILE__ ),
			[ 'jquery', 'elementor-frontend' ],
			self::VERSION,
			true
		);
	}

	public function register_styles() {
		// Register the style so it can be depended on by widgets
		wp_register_style(
			'advance-carousel-style',
			plugins_url( 'assets/css/style.css', __FILE__ ),
			[],
			self::VERSION
		);
	}

	public function init_widgets( $widgets_manager ) {
		// Include Widget files
		require_once( __DIR__ . '/widgets/highlight-carousel.php' );

		// Register widget
		$widgets_manager->register( new \Advance_Carousel_Widget() );
	}

}

Advance_Carousel_Extension::instance();
