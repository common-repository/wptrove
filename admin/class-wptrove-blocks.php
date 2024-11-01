<?php
/**
 * Blocks for the plugin.
 *
 * @link       wptrove.com
 * @since      1.0.0
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 */

/**
 * Blocks for the plugin.
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 * @author     wptrove <hello@wptrove.com>
 */
class Wptrove_Blocks {

	/**
	 * Include all necessary files.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->load_dependencies();

	}

	/**
	 * Load the required dependencies for blocks.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Load the partials.
		 */

	}

	/**
	 * Register blocks.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_blocks() {

		$plugin_testimonials = new Wptrove_Testimonial_Blocks();

		register_block_type(
			WPTROVE_PLUGIN_PATH . 'admin/js/src/blocks/testimonials/add/block.json',
			array(
				'render_callback' => array( $plugin_testimonials, 'add_testimonials_render' ),
			)
		);

		register_block_type(
			WPTROVE_PLUGIN_PATH . 'admin/js/src/blocks/testimonials/display/block.json',
			array(
				'render_callback' => array( $plugin_testimonials, 'testimonials_render' ),
			)
		);

	}

}
