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
class Wptrove_Fetch_Posts {

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
	public function fetch( $request ) {

		$data['result']         = false;
		$data['data']           = array();
		$data['data']['error']  = array();
		$data['data']['reason'] = '';

		$data['data']['data'] = array();

		$nonce     = '';
		$post_type = '';
		$count     = 10;
		$offset    = 0;
		$status    = array( 'pending', 'approved' );

		if ( isset( $request['nonce'] ) ) {
			$nonce = $request['nonce'];
		}
		if ( isset( $request['post_type'] ) ) {
			$post_type = $request['post_type'];
		}
		if ( isset( $request['count'] ) ) {
			$count = $request['count'];
		}
		if ( isset( $request['offset'] ) ) {
			$offset = $request['offset'];
		}
		if ( isset( $request['status'] ) ) {
			if ( in_array( $request['status'], $status, true ) ) {

				$status = $request['status'];

			}
		}

		$data['data']['status'][] = $status;

		if ( $nonce && $this->aux->role() && $post_type ) {

			$fetch_args_total = array(
				'post_type'      => $post_type,
				'posts_per_page' => -1,
			);

			$fetch_args = array(
				'post_type'      => $post_type,
				'posts_per_page' => $count,
				'offset'         => $offset,
				'orderby'        => 'date',
				'order'          => 'DESC',
			);

			if ( ! is_array( $status ) ) {

				$data['data']['status'][] = $status;

				$fetch_args_total['meta_query'] = array(
					array(
						'key'     => 'wptrove-status',
						'value'   => $status,
						'compare' => '=',
					),
				);

				$fetch_args['meta_query'] = array(
					array(
						'key'     => 'wptrove-status',
						'value'   => $status,
						'compare' => '=',
					),
				);

			}

			$data['data']['args'][] = $fetch_args_total;
			$data['data']['args'][] = $fetch_args;

			$data['data']['total'] = count( get_posts( $fetch_args_total ) );

			$fetch_posts = get_posts( $fetch_args );
			if ( ! empty( $fetch_posts ) && is_array( $fetch_posts ) ) {

				foreach ( $fetch_posts as $key => $value ) {

					$meta = get_post_meta( $value->ID );

					$data['data']['data'][ $key ]            = array();
					$data['data']['data'][ $key ]['id']      = esc_html( $value->ID );
					$data['data']['data'][ $key ]['title']   = esc_html( $value->post_title );
					$data['data']['data'][ $key ]['content'] = esc_html( $value->post_content );
					$data['data']['data'][ $key ]['meta']    = array();

					if ( array_key_exists( 'wptrove-heading', $meta ) ) {
						$data['data']['data'][ $key ]['meta']['wptrove-heading'] = esc_html( $meta['wptrove-heading'][0] );
					}

					if ( array_key_exists( 'wptrove-testimonial', $meta ) ) {
						$data['data']['data'][ $key ]['meta']['wptrove-testimonial'] = esc_html( $meta['wptrove-testimonial'][0] );
					}

					if ( array_key_exists( 'wptrove-name', $meta ) ) {
						$data['data']['data'][ $key ]['meta']['wptrove-name'] = esc_html( $meta['wptrove-name'][0] );
					}

					if ( array_key_exists( 'wptrove-company', $meta ) ) {
						$data['data']['data'][ $key ]['meta']['wptrove-company'] = esc_html( $meta['wptrove-company'][0] );
					}

					if ( array_key_exists( 'wptrove-designation', $meta ) ) {
						$data['data']['data'][ $key ]['meta']['wptrove-designation'] = esc_html( $meta['wptrove-designation'][0] );
					}

					if ( array_key_exists( 'wptrove-email', $meta ) ) {
						$data['data']['data'][ $key ]['meta']['wptrove-email'] = esc_html( $meta['wptrove-email'][0] );
					}

					if ( array_key_exists( 'wptrove-status', $meta ) ) {
						$data['data']['data'][ $key ]['meta']['wptrove-status'] = esc_html( $meta['wptrove-status'][0] );
					}
				}
			}

			$data['result'] = true;

		} else {

			$data['data']['reason'] = esc_html__( 'unAuthorized', 'wptrove' );

		}

		$response = $this->aux->prepare( $data, $request );

		// Return all of our post response data.
		return $response;

	}

}
