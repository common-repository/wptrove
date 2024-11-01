<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sproutient.com
 * @since      1.0.0
 *
 * @package    Wptrove
 * @subpackage Wptrove/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wptrove
 * @subpackage Wptrove/public
 * @author     Sproutient <dev@sproutient.com>
 */
class Wptrove_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the JavaScript/CSS for the blocks.
	 *
	 * @since    1.0.0
	 */
	public function block_assets() {

		$this->block_variables                          = array();
		$this->block_variables['text']                  = array();
		$this->block_variables['api']                   = array();
		$this->block_variables['api']['base']           = get_rest_url();
		$this->block_variables['api']['addTestimonial'] = get_rest_url( null, 'wptrove/v1/add-testimonial' );

		$this->block_variables['nonce']       = esc_html( wp_create_nonce( 'wptrove' ) );
		$this->block_variables['wpRestNonce'] = esc_html( wp_create_nonce( 'wp_rest' ) );

		$this->block_variables['text']['testimonials']            = array();
		$this->block_variables['text']['testimonials']['success'] = esc_html__( 'Thank you for your testimonial', 'wptrove' );
		$this->block_variables['text']['testimonials']['failed']  = esc_html__( 'Something went wrong, Please try again...', 'wptrove' );

		wp_enqueue_style( $this->plugin_name . '-blocks-css', esc_url( WPTROVE_PLUGIN_URL ) . '/public/css/wptrove-blocks.css', array(), $this->version, 'all' );

		wp_enqueue_script( $this->plugin_name . '-owl', esc_url( WPTROVE_PLUGIN_URL ) . '/public/js/owl-carousel.js', array( 'jquery' ), $this->version, false );
		wp_register_script( $this->plugin_name . '-blocks', esc_url( WPTROVE_PLUGIN_URL ) . '/public/js/wptrove-blocks.js', array( 'jquery', 'wp-blocks', 'wp-polyfill' ), $this->version, true );
		wp_localize_script( $this->plugin_name . '-blocks', 'wptroveBlockVariables', $this->block_variables );
		wp_enqueue_script( $this->plugin_name . '-blocks' );

	}

}
