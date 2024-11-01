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
class Wptrove_Testimonials {

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
	public function add( $request ) {

		$data['result']        = false;
		$data['data']          = array();
		$data['data']['error'] = array();

		$data['data']['aux'] = array();

		$nonce                  = '';
		$name                   = '';
		$email                  = '';
		$company                = '';
		$designation            = '';
		$heading                = '';
		$testimonial            = '';
		$wptrove_files_dir      = wp_upload_dir();
		$wptrove_files_dir_path = trailingslashit( $wptrove_files_dir['path'] );
		$wptrove_logo_username  = 'wptrove-';

		$attach_id = '';

		if ( isset( $request['nonce'] ) ) {
			$nonce = $request['nonce'];
		}
		if ( isset( $request['name'] ) && '' !== $request['name'] ) {
			$name = $request['name'];
		} else {
			$data['data']['error']['name'] = esc_html__( 'Name is required', 'wptrove' );
		}
		if ( isset( $request['email'] ) && '' !== $request['email'] ) {
			$email = $request['email'];
		} else {
			$data['data']['error']['email'] = esc_html__( 'Email is required', 'wptrove' );
		}
		if ( isset( $request['company'] ) ) {
			$company = $request['company'];
		}
		if ( isset( $request['designation'] ) ) {
			$designation = $request['designation'];
		}
		if ( isset( $request['heading'] ) ) {
			$heading = $request['heading'];
		}
		if ( isset( $request['testimonial'] ) && '' !== $request['testimonial'] ) {
			$testimonial = $request['testimonial'];
		} else {
			$data['data']['error']['testimonial'] = esc_html__( 'Testimonial is required', 'wptrove' );
		}

		foreach ( $_FILES as $key => $value ) {

			if ( 'photo' === $key ) {

				$wptrove_logo_check = false;

				$wptrove_photo = $_FILES['photo'];

				$wptrove_photo_name = '';

				if ( is_array( $wptrove_photo ) && array_key_exists( 'name', $wptrove_photo ) ) {

					$wptrove_photo_name = sanitize_text_field( $wptrove_photo['name'] );

					$allowed_exts = array( 'gif', 'jpeg', 'jpg', 'png' );
					$temp         = explode( '.', $wptrove_photo_name );
					$extension    = end( $temp );

				}

				if (
					( is_array( $wptrove_photo ) && array_key_exists( 'type', $wptrove_photo ) && array_key_exists( 'name', $wptrove_photo ) && array_key_exists( 'error', $wptrove_photo ) ) &&
					(
						( 'image/gif' === $wptrove_photo['type'] )
						|| ( 'image/jpeg' === $wptrove_photo['type'] )
						|| ( 'image/jpg' === $wptrove_photo['type'] )
						|| ( 'image/pjpeg' === $wptrove_photo['type'] )
						|| ( 'image/x-png' === $wptrove_photo['type'] )
						|| ( 'image/png' === $wptrove_photo['type'] )
					)
					&& ( $wptrove_photo['size'] < 200000 )
					&& in_array( $extension, $allowed_exts, true )
				) {

					if ( 0 >= $wptrove_photo['error'] ) {

						$wptrove_logo_filename = $wptrove_logo_username . $wptrove_photo_name;

						if ( file_exists( $wptrove_files_dir_path . $wptrove_logo_filename ) ) {
							$wptrove_logo_filename = $wptrove_logo_username . wp_rand( 1, 99999 ) . $wptrove_photo_name;
						}

						if ( move_uploaded_file( $wptrove_photo['tmp_name'], $wptrove_files_dir_path . $wptrove_logo_filename ) ) {

							$filename       = $wptrove_files_dir_path . $wptrove_logo_filename;
							$parent_post_id = 0;
							$filetype       = wp_check_filetype( basename( $filename ), null );

							$wp_upload_dir = wp_upload_dir();

							$attachment = array(
								'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
								'post_mime_type' => $filetype['type'],
								'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
								'post_content'   => '',
								'post_status'    => 'inherit',
							);

							$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

							if ( is_wp_error( $attach_id ) ) {
								$attach_id = '';
							}
						}
					}
				}
			}
		}

		$data['data']['aux'][] = 'Name is : ' . $name;

		if ( $nonce && $name && $email && $testimonial ) :

			$title = esc_html__( 'New testimonial by' ) . ' ' . $name;

			$add_testimonial_args = array(
				'post_type'    => 'wptrove-testimonial',
				'post_title'   => $title,
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => get_current_user_id(),
				'meta_input'   => array(
					'wptrove-status'      => 'pending',
					'wptrove-name'        => $name,
					'wptrove-email'       => $email,
					'wptrove-company'     => $company,
					'wptrove-designation' => $designation,
					'wptrove-heading'     => $heading,
					'wptrove-testimonial' => $testimonial,
					'wptrove-photo'       => $attach_id,
				),
			);

			$add_testimonial_id = wp_insert_post( $add_testimonial_args );

			if ( ! is_wp_error( $add_testimonial_id ) ) {

				$data['result'] = true;

			} else {

				$data['data']['error']['reason'] = esc_html( $add_testimonial_id->get_error_message() );

			}

		else :

			$data['data']['error']['reason'] = esc_html__( 'unAuthorized', 'wptrove' );

		endif;

		$response = $this->aux->prepare( $data, $request );

		// Return all of our post response data.
		return $response;

	}

}
