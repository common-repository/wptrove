<?php
/**
 * Add REST.
 *
 * @link       http://wptrove.com
 * @since      1.0.0
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 */

/**
 * Add REST.
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 * @author     wptrove <hello@wptrove.com>
 */
class Wptrove_REST_V1 {

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
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $aux    Auxilary class for the REST.
	 */
	private $aux;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $sample    Sample class for the REST.
	 */
	private $sample;

	/**
	 * Testimonials.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $testimonials    Class to add testimonials.
	 */
	private $testimonials;

	/**
	 * Fetch posts.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $fetch_posts    Class to fetch posts.
	 */
	private $fetch_posts;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name       The name of this plugin.
	 * @param string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name    = $plugin_name;
		$this->version        = $version;
		$this->namespace      = 'wptrove/v1';
		$this->aux            = new Wptrove_REST_Aux();
		$this->testimonials   = new Wptrove_Testimonials();
		$this->fetch_posts    = new Wptrove_Fetch_Posts();
		$this->moderate_posts = new Wptrove_Moderate_Posts();

	}

	/**
	 * Register meta box(es).
	 */
	public function register_routes() {

		register_rest_route(
			$this->namespace,
			'/add-testimonial',
			array(

				// Here we register the readable endpoint for collections.
				array(
					'methods'             => 'GET, POST',
					'callback'            => array( $this->testimonials, 'add' ),
					'args'                => array(
						'name'        => array(
							'description'       => esc_html__( 'Name.', 'wptrove' ),
							'type'              => 'string',
							'validate_callback' => array( $this->aux, 'validate_string' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_string' ),
							'required'          => true,
							'default'           => '',
						),
						'email'       => array(
							'description'       => esc_html__( 'Email.', 'wptrove' ),
							'type'              => 'email',
							'validate_callback' => array( $this->aux, 'validate_email' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_email' ),
							'required'          => true,
							'default'           => '',
						),
						'company'     => array(
							'description'       => esc_html__( 'Company.', 'wptrove' ),
							'type'              => 'string',
							'validate_callback' => array( $this->aux, 'validate_string' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_string' ),
							'required'          => false,
							'default'           => '',
						),
						'designation' => array(
							'description'       => esc_html__( 'Designation.', 'wptrove' ),
							'type'              => 'string',
							'validate_callback' => array( $this->aux, 'validate_string' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_string' ),
							'required'          => false,
							'default'           => '',
						),
						'testimonial' => array(
							'description'       => esc_html__( 'Testimonial.', 'wptrove' ),
							'type'              => 'string',
							'validate_callback' => array( $this->aux, 'validate_string' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_string' ),
							'required'          => true,
							'default'           => '',
						),
						'nonce'       => array(
							'description'       => esc_html__( 'Nonce.', 'wptrove' ),
							'type'              => 'bool',
							'sanitize_callback' => function( $value ) {
								return (bool) $value;
							},
							'validate_callback' => function( $value ) {
								return wp_verify_nonce( $value, 'wptrove' );
							},
							'required'          => true,
							'default'           => false,
						),

					),
					'permission_callback' => '',
				),
				// Register our schema callback.
				'schema' => array( $this->aux, 'get_schema' ),

			)
		);

		register_rest_route(
			$this->namespace,
			'/fetch-posts',
			array(

				// Here we register the readable endpoint for collections.
				array(
					'methods'             => 'GET, POST',
					'callback'            => array( $this->fetch_posts, 'fetch' ),
					'args'                => array(
						'post_type' => array(
							'description'       => esc_html__( 'Post Type.', 'wptrove' ),
							'type'              => 'string',
							'validate_callback' => array( $this->aux, 'validate_string' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_string' ),
							'required'          => true,
							'default'           => '',
						),
						'count'     => array(
							'description'       => esc_html__( 'Count.', 'wptrove' ),
							'type'              => 'number',
							'validate_callback' => array( $this->aux, 'validate_number' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_number' ),
							'required'          => true,
							'default'           => '',
						),
						'offset'    => array(
							'description'       => esc_html__( 'Offset.', 'wptrove' ),
							'type'              => 'number',
							'validate_callback' => array( $this->aux, 'validate_number' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_number' ),
							'required'          => true,
							'default'           => '',
						),
						'status'    => array(
							'description'       => esc_html__( 'Status.', 'wptrove' ),
							'type'              => 'string',
							'validate_callback' => array( $this->aux, 'validate_string' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_string' ),
							'required'          => true,
							'default'           => 'any',
						),
						'nonce'     => array(
							'description'       => esc_html__( 'Nonce.', 'wptrove' ),
							'type'              => 'bool',
							'sanitize_callback' => function( $value ) {
								return (bool) $value;
							},
							'validate_callback' => function( $value ) {
								return wp_verify_nonce( $value, 'wptrove' );
							},
							'required'          => true,
							'default'           => false,
						),

					),
					'permission_callback' => '',
				),
				// Register our schema callback.
				'schema' => array( $this->aux, 'get_schema' ),

			)
		);

		register_rest_route(
			$this->namespace,
			'/moderate-posts',
			array(

				// Here we register the readable endpoint for collections.
				array(
					'methods'             => 'GET, POST',
					'callback'            => array( $this->moderate_posts, 'moderate' ),
					'args'                => array(
						'action' => array(
							'description'       => esc_html__( 'Post Type.', 'wptrove' ),
							'type'              => 'string',
							'validate_callback' => array( $this->aux, 'validate_string' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_string' ),
							'required'          => true,
							'default'           => '',
						),
						'id'     => array(
							'description'       => esc_html__( 'Count.', 'wptrove' ),
							'type'              => 'number',
							'validate_callback' => array( $this->aux, 'validate_number' ),
							'sanitize_callback' => array( $this->aux, 'sanitize_number' ),
							'required'          => true,
							'default'           => '',
						),
						'nonce'  => array(
							'description'       => esc_html__( 'Nonce.', 'wptrove' ),
							'type'              => 'bool',
							'sanitize_callback' => function( $value ) {
								return (bool) $value;
							},
							'validate_callback' => function( $value ) {
								return wp_verify_nonce( $value, 'wptrove' );
							},
							'required'          => true,
							'default'           => false,
						),

					),
					'permission_callback' => '',
				),
				// Register our schema callback.
				'schema' => array( $this->aux, 'get_schema' ),

			)
		);

	}

}
