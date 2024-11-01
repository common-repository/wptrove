<?php
/**
 * Settings for testimonial features.
 *
 * @link       wptrove.com
 * @since      1.0.0
 *
 * @package    Wptrove
 * @subpackage Wptrove/admin
 */

?>

	<div class="wptrove-testimonial-source">
		<div data-key="REPLACEWITHKEY" class="wptrove-testimonial-item">
			<h3 class="wptrove-testimonial-item__title">REPLACEWITHTITLE</h3>
			<div class="wptrove-testimonial-item-content">

				REPLACEWITHMETA

				<h3 class="wptrove-testimonial-item-heading">REPLACEWITHHEADING</h3>

				<div class="wptrove-testimonial-item-actual">
					REPLACEWITHTESTIMONIAL
				</div>

				<div class="wptrove-testimonial-item-actions">
					<span style="REPLACEWITHAPPROVESTYLE" class="wptrove-testimonial-item-approve wptrove-button">
						<?php esc_html_e( 'Approve', 'wptrove' ); ?>
						<span class="wptrove-testimonial-item-approve__overlay wptrove-button-overlay"></span>
						<span class="wptrove-testimonial-item-approve__spinner wptrove-button-spinner"></span>
					</span>
					<span class="wptrove-testimonial-item-delete">
						<?php esc_html_e( 'Delete', 'wptrove' ); ?>
						<span class="wptrove-testimonial-item-delete__overlay wptrove-button-overlay"></span>
						<span class="wptrove-testimonial-item-delete__spinner wptrove-button-spinner"></span>
					</span>
					<span class="wptrove-testimonial-item-error"></span>
				</div>

			</div>
		</div>
	</div>

	<div class="wptrove-testimonials-pagination-source">
		<span class="wptrove-pagination-item" data-offset="REPLACEWITHOFFSET">REPLACEWITHOFFSETTEXT</span>
	</div>

	<div data-count="5" data-type="wptrove-testimonial" class="wptrove-container wptrove-testimonials-content">

		<div class="wptrove-testimonials-selector">

			<div class="wptrove-testimonials-selector-inner">

				<h3 class="wptrove-testimonials-selector-inner__message"><?php esc_html_e( 'Status', 'wptrove' ); ?></h3>
				<div class="wptrove-admin-select">
					<h3 data-status="" class="wptrove-admin-select__heading"><?php esc_html_e( 'Any', 'wptrove' ); ?></h3>
					<span class="wptrove-admin-select__icon"></span>
					<div class="wptrove-admin-select-options">
						<h3 data-key="all" class="wptrove-admin-select-options__item"><?php esc_html_e( 'Any', 'wptrove' ); ?></h3>
						<h3 data-key="pending" class="wptrove-admin-select-options__item"><?php esc_html_e( 'Pending', 'wptrove' ); ?></h3>
						<h3 data-key="approved" class="wptrove-admin-select-options__item"><?php esc_html_e( 'Approved', 'wptrove' ); ?></h3>
					</div>
				</div>

			</div>

		</div>

		<div class="wptrove-testimonials-empty">
			<p class="wptrove-testimonials-empty__message"><?php esc_html_e( 'No testimonials.', 'wptrove' ); ?></p>
		</div>

		<div class="wptrove-testimonials-list">

		</div>

		<div class="wptrove-pagination wptrove-testimonials-pagination">

		</div>

	</div>


