<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       wptrove.com
 * @since      1.0.0
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wptrove-admin-container">

	<div class="wptrove-admin-heading">

		<h3 class="wptrove-admin-heading__logo"><img src="<?php echo esc_url( WPTROVE_PLUGIN_URL ) . '/admin/images/logo.png'; ?>" /></h3>

		<div class="wptrove-admin-main-select">
			<h3 class="wptrove-admin-main-select__heading"><?php esc_html_e( 'Home', 'wptrove' ); ?></h3>
			<span class="wptrove-admin-main-select__icon"></span>
			<div class="wptrove-admin-main-select-options">

				<h3 id="wptrove-home-settings" data-key="home" class="wptrove-admin-main-select-options__item"><?php esc_html_e( 'Home', 'wptrove' ); ?></h3>

				<?php
					$wptrove_admin_sections = array();
				if ( is_array( $wptrove_options ) ) :
					foreach ( $wptrove_options as $key => $value ) :
						?>

				<div class="wptrove-admin-main-select-group">

					<h3 class="wptrove-admin-main-select-group__heading"><?php echo esc_html( $value['title'] ); ?></h3>
					<span class="wptrove-admin-main-select-group__icon"></span>
					<div class="wptrove-admin-main-select-group-options">
						<?php
						if ( is_array( $value['sections'] ) ) :
							foreach ( $value['sections'] as $k => $v ) :
								$wptrove_admin_sections[ $k ] = array(
									'callback' => $v['callback'],
									'title'    => $v['title'],
								);
								?>
						<h3 id="wptrove-<?php echo esc_attr( $k ); ?>-settings" data-key="<?php echo esc_attr( $k ); ?>" class="wptrove-admin-main-select-group-options__item"><?php echo esc_html( $v['title'] ); ?></h3>
								<?php
							endforeach;
							endif;
						?>
					</div>

				</div>

						<?php
					endforeach;
					endif;
				?>

			</div>
		</div>

	</div>

	<div class="wptrove-admin-content">

		<div class="wptrove-admin-content-overlay">

			<div class="wptrove-admin-content-wait">
				<p class="wptrove-admin-content-wait__para"><span class="wptrove-admin-content-wait__spinner"></span></p>
				<p class="wptrove-admin-content-wait__message"><?php esc_html_e( 'Please Wait...' ); ?></p>
			</div>

			<div class="wptrove-admin-content-error">
				<p class="wptrove-admin-content-error__message"><?php esc_html_e( 'Something went wrong, Please try again...' ); ?></p>
				<span class="wptrove-admin-content-error__icon">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="2em" height="2em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10zm0-11.414L9.172 7.757L7.757 9.172L10.586 12l-2.829 2.828l1.415 1.415L12 13.414l2.828 2.829l1.415-1.415L13.414 12l2.829-2.828l-1.415-1.415L12 10.586z" fill="#fd4447"/></svg>
				</span>
			</div>            

		</div>

		<div class="wptrove-admin-content-inner">

			<?php
			if ( is_array( $wptrove_admin_sections ) ) :
				foreach ( $wptrove_admin_sections as $x => $y ) :
					$wptrove_section_container = 'wptrove-' . $x . '-container';
					if ( $y['callback'] ) :
						?>

				<div class="<?php echo esc_attr( $wptrove_section_container ); ?>">
					<div class="wptrove-admin-sub-heading">
						<h3 class="wptrove-admin-sub-heading__message"><?php echo esc_html( $y['title'] ); ?></h3>
					</div>
						<?php
						if ( is_array( $y['callback'] ) ) {

								call_user_func( array( $y['callback'][0], $y['callback'][1] ) );

						} else {

								$y['callback']();

						}
						?>
				</div>

						<?php
				endif;
				endforeach;
				endif;
			?>

		</div>

	</div>

</div>
