<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sproutient.com
 * @since      1.0.0
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 * @author     Sproutient <dev@sproutient.com>
 */
class Wptrove_Admin {

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
	 * Data for admin page.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $admin_variables    JS Variables.
	 */
	private $admin_settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name    = $plugin_name;
		$this->version        = $version;
		$this->admin_settings = new Wptrove_Settings_Control();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook current page.
	 */
	public function enqueue_styles( $hook ) {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wptrove.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook current page.
	 */
	public function enqueue_scripts( $hook ) {

		if ( ( 'toplevel_page_wptrove' !== $hook ) ) {
			return;
		}

		$this->admin_variables['userLoggedIn'] = false;
		$this->admin_variables['nonce']        = '';
		$this->admin_variables['wpRestNonce']  = '';
		$this->admin_variables['api']          = array();
		$this->admin_variables['api']['admin'] = array();

		$this->admin_variables['labels']           = array();
		$this->admin_variables['labels']['prev']   = esc_html__( 'Prev', 'wptrove' );
		$this->admin_variables['labels']['next']   = esc_html__( 'Next', 'wptrove' );
		$this->admin_variables['labels']['wait']   = esc_html__( 'Please wait...', 'wptrove' );
		$this->admin_variables['labels']['error']  = esc_html__( 'Something went wrong, Please try again.', 'wptrove' );
		$this->admin_variables['labels']['errory'] = esc_html__( 'Error.', 'wptrove' );
		$this->admin_variables['labels']['add']    = esc_html__( 'Add', 'wptrove' );
		$this->admin_variables['labels']['remove'] = esc_html__( 'Remove', 'wptrove' );
		$this->admin_variables['labels']['upload'] = esc_html__( 'Upload', 'wptrove' );

		$this->admin_variables['labels']['testimonials']                = array();
		$this->admin_variables['labels']['testimonials']['name']        = esc_html__( 'Name', 'wptrove' );
		$this->admin_variables['labels']['testimonials']['company']     = esc_html__( 'Company', 'wptrove' );
		$this->admin_variables['labels']['testimonials']['designation'] = esc_html__( 'Designation', 'wptrove' );
		$this->admin_variables['labels']['testimonials']['email']       = esc_html__( 'Email', 'wptrove' );

		if ( is_user_logged_in() && current_user_can( 'administrator' ) ) {

			$this->admin_variables['userLoggedIn'] = true;
			$this->admin_variables['nonce']        = esc_html( wp_create_nonce( 'wptrove' ) );
			$this->admin_variables['wpRestNonce']  = esc_html( wp_create_nonce( 'wp_rest' ) );

			$this->admin_variables['api']['admin']['fetch']    = get_rest_url( null, 'wptrove/v1/fetch-posts' );
			$this->admin_variables['api']['admin']['moderate'] = get_rest_url( null, 'wptrove/v1/moderate-posts' );

		}

		wp_enqueue_media();
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wptrove.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'wptroveJsVariables', $this->admin_variables );
		wp_enqueue_script( $this->plugin_name );

	}

	/**
	 * Register the JavaScript/CSS for the block controls in editor.
	 *
	 * @since    1.0.0
	 */
	public function admin_block_assets() {

		$this->editor_variables['pluginUrl'] = esc_url( WPTROVE_PLUGIN_URL );
		$this->editor_variables['postId']    = '';
		if ( isset( $_GET['post'] ) && $_GET['post'] ) {
			$this->editor_variables['postId'] = (int) sanitize_text_field( wp_unslash( $_GET['post'] ) );
		}

		wp_enqueue_style( $this->plugin_name . '-editor', plugin_dir_url( __FILE__ ) . 'css/wptrove-blocks.css', array(), $this->version, 'all' );

		wp_register_script( $this->plugin_name . '-editor', esc_url( WPTROVE_PLUGIN_URL ) . '/admin/js/wptrove-blocks.js', array( 'jquery', 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components' ), $this->version, true );
		wp_localize_script( $this->plugin_name . '-editor', 'wptroveEditorVariables', $this->editor_variables );
		wp_enqueue_script( $this->plugin_name . '-editor' );
		wp_enqueue_script( $this->plugin_name . '-editor-assist', esc_url( WPTROVE_PLUGIN_URL ) . '/admin/js/wptrove-blocks-assist.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Create admin pages.
	 *
	 * @since    1.0.0
	 */
	public function create_admin_pages() {

		if ( ! array_key_exists( 'wptrove', $GLOBALS['admin_page_hooks'] ) ) {

			add_menu_page(
				__( 'WPtrove', 'wptrove' ),
				__( 'WPtrove', 'wptrove' ),
				'manage_options',
				'wptrove',
				array( $this, 'admin_page_display' ),
				'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGFyaWEtaGlkZGVuPSJ0cnVlIiByb2xlPSJpbWciIHdpZHRoPSIxZW0iIGhlaWdodD0iMWVtIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCBtZWV0IiB2aWV3Qm94PSIwIDAgMTYgMTYiPjxwYXRoIGZpbGw9ImN1cnJlbnRDb2xvciIgZD0iTTguMTg2IDEuMTEzYS41LjUgMCAwIDAtLjM3MiAwTDEuODQ2IDMuNWwyLjQwNC45NjFMMTAuNDA0IDJsLTIuMjE4LS44ODd6bTMuNTY0IDEuNDI2TDUuNTk2IDVMOCA1Ljk2MUwxNC4xNTQgMy41bC0yLjQwNC0uOTYxem0zLjI1IDEuN2wtNi41IDIuNnY3LjkyMmw2LjUtMi42VjQuMjR6TTcuNSAxNC43NjJWNi44MzhMMSA0LjIzOXY3LjkyM2w2LjUgMi42ek03LjQ0My4xODRhMS41IDEuNSAwIDAgMSAxLjExNCAwbDcuMTI5IDIuODUyQS41LjUgMCAwIDEgMTYgMy41djguNjYyYTEgMSAwIDAgMS0uNjI5LjkyOGwtNy4xODUgMi44NzRhLjUuNSAwIDAgMS0uMzcyIDBMLjYzIDEzLjA5YTEgMSAwIDAgMS0uNjMtLjkyOFYzLjVhLjUuNSAwIDAgMSAuMzE0LS40NjRMNy40NDMuMTg0eiIvPjwvc3ZnPg==',
				20
			);

		}

	}

	/**
	 * Display admin pagecontent.
	 *
	 * @since    1.0.0
	 */
	public function admin_page_display() {

		$admin_options            = array();
		$admin_options['general'] = array(
			'title'    => __( 'General', 'wptrove' ),
			'sections' => array(
				'testimonials' => array(
					'title'    => __( 'Testimonials', 'wptrove' ),
					'callback' => array( $this->admin_settings, 'testimonial_settings' ),
				),
			),
		);

		$wptrove_options = apply_filters( 'wptrove_options', $admin_options );
		include WPTROVE_PLUGIN_PATH . 'admin/partials/wptrove.php';

	}

	/**
	 * Add body classes to admin pages.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param string $classes The admin file name of this plugin.
	 */
	public function add_body_class( $classes ) {

		$screen = get_current_screen();

		if ( is_object( $screen ) && 'toplevel_page_wptrove' !== $screen->base
		) {
			return;
		}

		$classes .= ' wptrove ';
		return $classes;

	}

}
