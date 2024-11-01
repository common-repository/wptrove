<?php
/**
 * Add meta boxes.
 *
 * @link       http://wptrove.com
 * @since      1.0.0
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 * @author     wptrove <hello@wptrove.com>
 */
class Wptrove_Moderate_Posts {

	/**
	 * Variable to hold aux object.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $aux    Auxilary class for the REST.
	 */
	private $aux;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		require_once WPTROVE_PLUGIN_PATH . 'admin/partials/rest/v1/class-wptrove-rest-aux.php';

		$this->aux = new Wptrove_REST_Aux();

	}

	/**
	 * Get user details.
	 *
	 * @param WP_REST_Request $request Current request.
	 */
	public function moderate( $request ) {

		$data['result']         = false;
		$data['data']           = array();
		$data['data']['error']  = array();
		$data['data']['reason'] = '';

		$data['data']['data'] = array();

		$nonce       = '';
		$action      = '';
		$id          = 10;
		$update_post = '';
		$delete_post = '';

		if ( isset( $request['nonce'] ) ) {
			$nonce = $request['nonce'];
		}
		if ( isset( $request['action'] ) ) {
			$action = $request['action'];
		}
		if ( isset( $request['id'] ) ) {
			$id = $request['id'];
		}

		if ( $nonce && $this->aux->role() && $action && $id ) {

			if ( 'approve' === $action ) {

				$update_post = update_post_meta( $id, 'wptrove-status', 'approved' );

				if ( $update_post ) {

					$data['result'] = true;

				}
			}

			if ( 'delete' === $action ) {
				$delete_post            = wp_delete_post( $id, true );
				$data['data']['reason'] = $delete_post;
				if ( $delete_post ) {

					$data['result'] = true;

				}
			}
		} else {

			$data['data']['reason'] = esc_html__( 'unAuthorized', 'wptrove' );

		}

		$response = $this->aux->prepare( $data, $request );

		// Return all of our post response data.
		return $response;

	}

}
