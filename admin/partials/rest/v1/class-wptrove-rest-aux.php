<?php
/**
 * Auxilary classes for REST.
 *
 * @link       http://wptrove.com
 * @since      1.0.0
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 */

/**
 * Auxilary classes for REST.
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 * @author     wptrove <hello@wptrove.com>
 */
class Wptrove_REST_Aux {

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $schema    Schema for the REST.
	 */
	private $schema;

	/**
	 * Initiate the class.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {

	}

	/**
	 * Prepare data for output.
	 *
	 * @since 1.0.0
	 * @param array           $data       Data from the backend.
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function prepare( $data, $request ) {

		$post_data = array();

		$schema = $this->get_schema( $request );

		// We are also renaming the fields to more understandable names.
		if ( isset( $schema['properties']['result'] ) ) {
			$post_data['result'] = (bool) $data['result'];
		}

		if ( isset( $schema['properties']['data'] ) ) {
			$post_data['data'] = (array) $data['data'];
		}

		return rest_ensure_response( $post_data );

	}

	/**
	 * Schema for our output.
	 *
	 * @since 1.0.0
	 * @param WP_REST_Request $request Full data about the request.
	 */
	public function get_schema( $request ) {

		if ( $this->schema ) {
			// Since WordPress 5.3, the schema can be cached in the $schema property.
			return $this->schema;
		}

		$this->schema = array(
			// This tells the spec of JSON Schema we are using which is draft 4.
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			// The title property marks the identity of the resource.
			'title'      => esc_html__( 'Sample', 'wptrove' ),
			'type'       => 'object',
			// In JSON Schema you can specify object properties in the properties attribute.
			'properties' => array(

				'result' => array(
					'description' => esc_html__( 'Result', 'wptrove' ),
					'type'        => 'boolean',
					'context'     => array( 'view' ),
					'readonly'    => true,
					'default'     => false,
				),
				'data'   => array(
					'description' => esc_html__( 'Data', 'wptrove' ),
					'type'        => 'array',
					'context'     => array( 'view' ),
					'readonly'    => true,
					'default'     => '',
				),

			),
		);

		return $this->schema;
	}

	/**
	 * Schema for our output.
	 *
	 * @since 1.0.0
	 * @param mixed           $value Value we got from request.
	 * @param WP_REST_Request $request Full data about the request.
	 * @param string          $param Name of the parameter.
	 */
	public function validate_number( $value, $request, $param ) {

		$attributes = $request->get_attributes();

		if ( isset( $attributes['args'][ $param ] ) ) {
			$argument = $attributes['args'][ $param ];
			// Check to make sure our argument is a string.
			if ( 'number' === $argument['type'] && ! is_numeric( $value ) ) {
				/* Translators: %1 is value and %2 is string */
				return new WP_Error( 'rest_invalid_param', sprintf( esc_html__( '%1$s is not of type %2$s', 'wptrove' ), $param, 'number' ), array( 'status' => 400 ) );
			}
		}

		// If we got this far then the data is valid.
		return true;

	}

	/**
	 * Schema for our output.
	 *
	 * @since 1.0.0
	 * @param mixed           $value Value we got from request.
	 * @param WP_REST_Request $request Full data about the request.
	 * @param string          $param Name of the parameter.
	 */
	public function sanitize_number( $value, $request, $param ) {

		$attributes = $request->get_attributes();

		if ( isset( $attributes['args'][ $param ] ) ) {

			$argument = $attributes['args'][ $param ];
			// Check to make sure our argument is a integer.
			if ( 'number' === $argument['type'] ) {
				return absint( $value );
			}
		}

		// If we got this far then something went wrong don't use user input.
		return new WP_Error( 'rest_api_sad', esc_html__( 'Something went terribly wrong.', 'wptrove' ), array( 'status' => 500 ) );

	}

	/**
	 * Schema for our output.
	 *
	 * @since 1.0.0
	 * @param mixed           $value Value we got from request.
	 * @param WP_REST_Request $request Full data about the request.
	 * @param string          $param Name of the parameter.
	 */
	public function validate_string( $value, $request, $param ) {

		$attributes = $request->get_attributes();

		if ( isset( $attributes['args'][ $param ] ) ) {
			$argument = $attributes['args'][ $param ];
			// Check to make sure our argument is a string.
			if ( 'string' === $argument['type'] && ! is_string( $value ) ) {
				/* Translators: %1 is value and %2 is string */
				return new WP_Error( 'rest_invalid_param', sprintf( esc_html__( '%1$s is not of type %2$s', 'wptrove' ), $param, 'string' ), array( 'status' => 400 ) );
			}
		}

		// If we got this far then the data is valid.
		return true;

	}

	/**
	 * Schema for our output.
	 *
	 * @since 1.0.0
	 * @param mixed           $value Value we got from request.
	 * @param WP_REST_Request $request Full data about the request.
	 * @param string          $param Name of the parameter.
	 */
	public function sanitize_string( $value, $request, $param ) {

		$attributes = $request->get_attributes();

		if ( isset( $attributes['args'][ $param ] ) ) {

			$argument = $attributes['args'][ $param ];
			// Check to make sure our argument is a integer.
			if ( 'string' === $argument['type'] ) {
				return sanitize_text_field( $value );
			}
		}

		// If we got this far then something went wrong don't use user input.
		return new WP_Error( 'rest_api_sad', esc_html__( 'Something went terribly wrong.', 'wptrove' ), array( 'status' => 500 ) );

	}

	/**
	 * Schema for our output.
	 *
	 * @since 1.0.0
	 * @param mixed           $value Value we got from request.
	 * @param WP_REST_Request $request Full data about the request.
	 * @param string          $param Name of the parameter.
	 */
	public function validate_email( $value, $request, $param ) {

		$attributes = $request->get_attributes();

		if ( isset( $attributes['args'][ $param ] ) ) {
			$argument = $attributes['args'][ $param ];
			// Check to make sure our argument is a string.
			if ( 'email' === $argument['type'] && ! is_email( $value ) ) {
				/* Translators: %1 is value and %2 is string */
				return new WP_Error( 'rest_invalid_param', sprintf( esc_html__( '%1$s is not of type %2$s', 'wptrove' ), $param, 'string' ), array( 'status' => 400 ) );
			}
		}

		// If we got this far then the data is valid.
		return true;

	}

	/**
	 * Schema for our output.
	 *
	 * @since 1.0.0
	 * @param mixed           $value Value we got from request.
	 * @param WP_REST_Request $request Full data about the request.
	 * @param string          $param Name of the parameter.
	 */
	public function sanitize_email( $value, $request, $param ) {

		$attributes = $request->get_attributes();

		if ( isset( $attributes['args'][ $param ] ) ) {

			$argument = $attributes['args'][ $param ];
			// Check to make sure our argument is a integer.
			if ( 'email' === $argument['type'] ) {
				return sanitize_email( $value );
			}
		}

		// If we got this far then something went wrong don't use user input.
		return new WP_Error( 'rest_api_sad', esc_html__( 'Something went terribly wrong.', 'wptrove' ), array( 'status' => 500 ) );

	}

	/**
	 * Returns true if a user has admin capability.
	 *
	 * @return boolean
	 */
	public function role() {

		$output = false;

		$u              = new \WP_User( get_current_user_id() );
		$roles_and_caps = $u->get_role_caps();

		if ( isset( $roles_and_caps['manage_options'] ) && true === $roles_and_caps['manage_options'] ) {
			$output = true;
		}

		return $output;

	}

}
