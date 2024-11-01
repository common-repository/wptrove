<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       wptrove.com
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
 * @author     wptrove <hello@wptrove.com>
 */
class Wptrove_Testimonial_Blocks {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

	}

	/**
	 * Render testimonials block
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param string $data The version of this plugin.
	 */
	public function display_rgba( $data ) {

		return 'rgba(' . $data['r'] . ',' . $data['g'] . ',' . $data['b'] . ',' . $data['a'] . ')';

	}

	/**
	 * Render Add testimonial block
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param array $args Attributes for the block.
	 */
	public function add_testimonials_render( $args ) {

		$filter_content   = array(
			'class'   => '',
			'message' => '',
		);
		$filtered_content = apply_filters( 'wptrove_testimonial_form_message', $filter_content );

		$container_css = '';
		$field_css     = '';
		$text_css      = '';
		$heading_css   = '';
		$submit_css    = '';

		$text_size_unit = 'px';
		if ( $args['fontUnits'] ) {
			$text_size_unit = $args['fontUnits'];
		}

		$container_padding_unit = 'px';

		if ( $args['containerBgColor'] || $args['containerBgGradient'] ) {

			if ( $args['containerBgColor'] ) {
				$container_css .= 'background-color:' . $this->display_rgba( $args['containerBgColor'] ) . ';';
			}

			if ( $args['containerBgGradient'] ) {
				$container_css .= 'background-image:' . $args['containerBgGradient'] . ';';
			}
		}

		if ( $args['containerPaddingUnits'] ) {
			if ( 'pc' === $args['containerPaddingUnits'] ) {
				$container_padding_unit = '%';
			} else {
				$container_padding_unit = $args['containerPaddingUnits'];
			}
		}

		if ( $args['containerPaddingTop'] ) {
			$container_css .= 'padding-top:' . $args['containerPaddingTop'] . $container_padding_unit . ';';
		}
		if ( $args['containerPaddingRight'] ) {
			$container_css .= 'padding-right:' . $args['containerPaddingRight'] . $container_padding_unit . ';';
		}
		if ( $args['containerPaddingBottom'] ) {
			$container_css .= 'padding-bottom:' . $args['containerPaddingBottom'] . $container_padding_unit . ';';
		}
		if ( $args['containerPaddingLeft'] ) {
			$container_css .= 'padding-left:' . $args['containerPaddingLeft'] . $container_padding_unit . ';';
		}

		if ( $args['containerBorderSize'] && $args['containerBorderColor'] ) {
			$container_css .= 'border:' . $args['containerBorderSize'] . 'px solid ' . $this->display_rgba( $args['containerBorderColor'] ) . ';';
		}

		if ( $args['containerBorderRadius'] ) {
			$container_css .= 'border-radius:' . $args['containerBorderRadius'] . 'px;';
		}

		if ( $args['headingColor'] ) {
			$heading_css .= 'color:' . $this->display_rgba( $args['headingColor'] ) . ';';
		}
		if ( $args['headingSize'] ) {
			$heading_css .= 'font-size:' . $args['headingSize'] . $text_size_unit . ';';
		}

		if ( $args['fieldBgColor'] ) {
			$field_css .= 'background-color:' . $this->display_rgba( $args['fieldBgColor'] ) . ';';
		}

		if ( $args['fieldTextColor'] ) {
			$field_css .= 'color:' . $this->display_rgba( $args['fieldTextColor'] ) . ';';
		}

		if ( $args['fieldBorderColor'] ) {
			$field_css .= 'border:1px solid ' . $this->display_rgba( $args['fieldBorderColor'] ) . ';';
		}

		if ( $args['fieldTextSize'] ) {
			$field_css .= 'font-size:' . $args['fieldTextSize'] . $text_size_unit . ';';
		}

		if ( $args['textColor'] ) {
			$text_css .= 'color:' . $this->display_rgba( $args['textColor'] ) . ';';
		}
		if ( $args['textSize'] ) {
			$text_css .= 'font-size:' . $args['textSize'] . $text_size_unit . ';';
		}

		if ( $args['submitBgColor'] ) {
			$submit_css .= 'background-color:' . $this->display_rgba( $args['submitBgColor'] ) . ';';
		}

		if ( $args['submitTextColor'] ) {
			$submit_css .= 'color:' . $this->display_rgba( $args['submitTextColor'] ) . ';';
		}
		if ( $args['submitTextSize'] ) {
			$submit_css .= 'font-size:' . $args['submitTextSize'] . $text_size_unit . ';';
		}

		$block_content = '';

		$block_content .= '<div style="' . esc_attr( $container_css ) . '" class="wptrove-testimonials-form">';

		$block_content .= '<div class="wptrove-testimonials-form-overlay">';
		$block_content .= '<div class="wptrove-testimonials-form-overlay-content">';
		$block_content .= '<p class="wptrove-spinner"><span class="wptrove-spinner__span"></span></p>';
		$block_content .= '<p class="wptrove-message">' . esc_html__( 'Please wait...', 'wptrove' ) . '</p>';
		$block_content .= '</div>';
		$block_content .= '</div>';

		$block_content .= '<p class="wptrove-testimonials-form-message">';

		$block_content .= '</p>';

		$block_content .= '<div class="wptrove-testimonials-form-content">';

		$block_content .= '<div data-wptrove-key="name" class="wptrove-testimonials-form-item">';
		$block_content .= '<span style="' . esc_attr( $heading_css ) . '" class="wptrove-testimonials-form-item__label">' . esc_html__( 'Name', 'wptrove' ) . '<sup>*</sup></span>';
		$block_content .= '<input style="' . esc_attr( $field_css ) . '" class="wptrove-testimonials-form-item__input" type="text" name="" value="" />';
		$block_content .= '<span style="' . esc_attr( $text_css ) . '" class="wptrove-testimonials-form-item__message">' . esc_html__( 'Please enter your name.', 'wptrove' ) . '</span>';
		$block_content .= '</div>';

		$block_content .= '<div data-wptrove-key="email" class="wptrove-testimonials-form-item">';
		$block_content .= '<span style="' . esc_attr( $heading_css ) . '" class="wptrove-testimonials-form-item__label">' . esc_html__( 'Email', 'wptrove' ) . '<sup>*</sup></span>';
		$block_content .= '<input style="' . esc_attr( $field_css ) . '" class="wptrove-testimonials-form-item__input" type="text" name="" value="" />';
		$block_content .= '<span style="' . esc_attr( $text_css ) . '" class="wptrove-testimonials-form-item__message">' . esc_html__( 'Please enter your email.', 'wptrove' ) . '</span>';
		$block_content .= '</div>';

		$block_content .= '<div data-wptrove-key="company" class="wptrove-testimonials-form-item">';
		$block_content .= '<span style="' . esc_attr( $heading_css ) . '" class="wptrove-testimonials-form-item__label">' . esc_html__( 'Your Company Name', 'wptrove' ) . '</span>';
		$block_content .= '<input style="' . esc_attr( $field_css ) . '" class="wptrove-testimonials-form-item__input" type="text" name="" value="" />';
		$block_content .= '<span style="' . esc_attr( $text_css ) . '" class="wptrove-testimonials-form-item__message">' . esc_html__( 'Please enter your company.', 'wptrove' ) . '</span>';
		$block_content .= '</div>';

		$block_content .= '<div data-wptrove-key="designation" class="wptrove-testimonials-form-item">';
		$block_content .= '<span style="' . esc_attr( $heading_css ) . '" class="wptrove-testimonials-form-item__label">' . esc_html__( 'Designation', 'wptrove' ) . '</span>';
		$block_content .= '<input style="' . esc_attr( $field_css ) . '" class="wptrove-testimonials-form-item__input" type="text" name="" value="" />';
		$block_content .= '<span style="' . esc_attr( $text_css ) . '" class="wptrove-testimonials-form-item__message">' . esc_html__( 'Please enter your designation.', 'wptrove' ) . '</span>';
		$block_content .= '</div>';

		$block_content .= '<div data-wptrove-key="photo" class="wptrove-testimonials-form-item">';
		$block_content .= '<span style="' . esc_attr( $heading_css ) . '" class="wptrove-testimonials-form-item__label">' . esc_html__( 'Photo', 'wptrove' ) . '</span>';
		$block_content .= '<input style="' . esc_attr( $field_css ) . '" class="wptrove-testimonials-form-item__input--upload" type="file" name="" value="" />';
		$block_content .= '<span style="' . esc_attr( $text_css ) . '" class="wptrove-testimonials-form-item__message">' . esc_html__( 'Max size : 100kb.', 'wptrove' ) . '</span>';
		$block_content .= '</div>';

		$block_content .= '<div data-wptrove-key="heading" class="wptrove-testimonials-form-item">';
		$block_content .= '<span style="' . esc_attr( $heading_css ) . '" class="wptrove-testimonials-form-item__label">' . esc_html__( 'Heading', 'wptrove' ) . '</span>';
		$block_content .= '<input style="' . esc_attr( $field_css ) . '" class="wptrove-testimonials-form-item__input" type="text" name="" value="" />';
		$block_content .= '<span style="' . esc_attr( $text_css ) . '" class="wptrove-testimonials-form-item__message">' . esc_html__( 'Testimonial heading.', 'wptrove' ) . '</span>';
		$block_content .= '</div>';

		$block_content .= '<div data-wptrove-key="testimonial" class="wptrove-testimonials-form-item">';
		$block_content .= '<span style="' . esc_attr( $heading_css ) . '" class="wptrove-testimonials-form-item__label">' . esc_html__( 'Testimonial', 'wptrove' ) . '<sup>*</sup></span>';
		$block_content .= '<textarea style="' . esc_attr( $field_css ) . '" class="wptrove-testimonials-form-item__input" rows=10></textarea>';
		$block_content .= '<span style="' . esc_attr( $text_css ) . '" class="wptrove-testimonials-form-item__message">' . esc_html__( 'Please enter your testimonial.', 'wptrove' ) . '</span>';
		$block_content .= '</div>';

		$block_content .= '<div class="' . esc_attr( $filtered_content['class'] ) . '">';
		$block_content .= '<p>' . esc_html( $filtered_content['message'] ) . '</p>';
		$block_content .= '</div>';

		$block_content .= '<div data-wptrove-key="submit" class="wptrove-testimonials-form-submit">';
		$block_content .= '<span style="' . esc_attr( $submit_css ) . '" class="wptrove-testimonials-form-submit__button">' . esc_html__( 'Submit', 'wptrove' ) . '</span>';
		$block_content .= '</div>';

		$block_content .= '</div>';

		$block_content .= '</div>';

		return $block_content;

	}

	/**
	 * Render testimonials block
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param array $args Attributes for the block.
	 */
	public function testimonials_render( $args ) {

		$container_css    = '';
		$heading_css      = '';
		$text_css         = '';
		$avatar_name_css  = '';
		$avatar_desig_css = '';
		$testimonial_css  = '';

		$units = array(
			'px' => 'px',
			'pc' => '%',
			'em' => 'em',
		);

		$container_padding_unit = 'px';
		if ( $args['containerPaddingUnits'] ) {
			if ( 'pc' === $args['containerPaddingUnits'] ) {
				$container_padding_unit = '%';
			} else {
				$container_padding_unit = $args['containerPaddingUnits'];
			}
		}

		$text_size_unit = 'px';
		if ( $args['textFontSizeType'] ) {
			$text_size_unit = $args['textFontSizeType'];
		}

		if ( $args['containerBgColor'] || $args['containerBgGradient'] ) {

			if ( $args['containerBgColor'] ) {
				$container_css .= 'background-color:' . $this->display_rgba( $args['containerBgColor'] ) . ';';
			}

			if ( $args['containerBgGradient'] ) {
				$container_css .= 'background-image:' . $args['containerBgGradient'] . ';';
			}
		}

		if ( $args['containerPaddingTop'] ) {
			$container_css .= 'padding-top:' . $args['containerPaddingTop'] . $container_padding_unit . ';';
		}
		if ( $args['containerPaddingRight'] ) {
			$container_css .= 'padding-right:' . $args['containerPaddingRight'] . $container_padding_unit . ';';
		}
		if ( $args['containerPaddingBottom'] ) {
			$container_css .= 'padding-bottom:' . $args['containerPaddingBottom'] . $container_padding_unit . ';';
		}
		if ( $args['containerPaddingLeft'] ) {
			$container_css .= 'padding-left:' . $args['containerPaddingLeft'] . $container_padding_unit . ';';
		}

		if ( $args['containerBorderSize'] && $args['containerBorderColor'] ) {
			$container_css .= 'border:' . $args['containerBorderSize'] . 'px solid ' . $this->display_rgba( $args['containerBorderColor'] ) . ';';
		}

		if ( $args['containerBorderRadius'] ) {
			$container_css .= 'border-radius:' . $args['containerBorderRadius'] . 'px;';
		}

		if ( $args['headingSize'] || $args['textColor'] ) {

			if ( $args['headingSize'] ) {
				$heading_css .= 'font-size:' . $args['headingSize'] . $text_size_unit . ';';
			}

			if ( $args['textColor'] ) {
				$heading_css .= 'color:' . $this->display_rgba( $args['textColor'] ) . ';';
			}
		}

		if ( $args['textSize'] || $args['textColor'] ) {

			if ( $args['textSize'] ) {
				$text_css .= 'font-size:' . $args['textSize'] . $text_size_unit . ';';
			}
			if ( $args['textColor'] ) {
				$text_css .= 'color:' . $this->display_rgba( $args['textColor'] ) . ';';
			}
		}

		if ( $args['customerNameSize'] || $args['textColor'] ) {

			if ( $args['customerNameSize'] ) {
				$avatar_name_css .= 'font-size:' . $args['customerNameSize'] . $text_size_unit . ';';
			}
			if ( $args['textColor'] ) {
				$avatar_name_css .= 'color:' . $this->display_rgba( $args['textColor'] ) . ';';
			}
		}

		if ( $args['customerDesigSize'] || $args['textColor'] ) {

			if ( $args['customerDesigSize'] ) {
				$avatar_desig_css .= 'font-size:' . $args['customerDesigSize'] . $text_size_unit . ';';
			}
			if ( $args['textColor'] ) {
				$avatar_desig_css .= 'color:' . $this->display_rgba( $args['textColor'] ) . ';';
			}
		}

		if ( 'layoutTwo' === $args['layout'] ) {

			if ( $args['testimonialBgColor'] ) {

				$testimonial_css .= 'background-color:' . $this->display_rgba( $args['testimonialBgColor'] ) . ';';

			}

			if ( $args['testimonialBorderSize'] && $args['testimonialBorderColor'] ) {
				$testimonial_css .= 'border:' . $args['testimonialBorderSize'] . 'px solid ' . $this->display_rgba( $args['testimonialBorderColor'] ) . ';';
			}

			if ( $args['testimonialBorderRadius'] ) {
				$testimonial_css .= 'border-radius:' . $args['testimonialBorderRadius'] . 'px;';
			}
		}

		$get_testimonials_args = array(

			'post_type'      => 'wptrove-testimonial',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'order'          => 'DESC',
			'orderby'        => 'date',
			'meta_query' => array(

				array(
					'key'     => 'wptrove-status',
					'value'   => 'approved',
					'compare' => '=',
				),

			),

		);

		$get_testimonials = get_posts( $get_testimonials_args );

		$block_content = '';

		if ( 'layoutTwo' === $args['layout'] ) {
			$block_content .= '<div style="' . esc_attr( $container_css ) . '" class="wptrove-testimonials-two-display owl-carousel owl-theme test">';
		} else {
			$block_content .= '<div style="' . esc_attr( $container_css ) . '" class="wptrove-testimonials-display owl-carousel owl-theme test">';
		}

		if ( ! empty( $get_testimonials ) && is_array( $get_testimonials ) ) {

			foreach ( $get_testimonials as $i ) {

				$heading     = get_post_meta( $i, 'wptrove-heading', true );
				$testimonial = get_post_meta( $i, 'wptrove-testimonial', true );
				$name        = get_post_meta( $i, 'wptrove-name', true );
				$designation = get_post_meta( $i, 'wptrove-designation', true );
				$photo       = get_post_meta( $i, 'wptrove-photo', true );
				$company     = get_post_meta( $i, 'wptrove-company', true );
				if ( $company && $designation ) {
					$company = ', ' . $company;
				} else {
					$company = $company;
				}

				if ( $photo ) {
					$photo = wp_get_attachment_url( get_post_meta( $i, 'wptrove-photo', true ) );
				} else {
					$photo = WPTROVE_PLUGIN_URL . '/public/images/100.jpg';
				}

				$block_content .= '<div style="' . esc_attr( $testimonial_css ) . '" class="wptrove-testimonial">';
				$block_content .= '<h2 style="' . esc_attr( $heading_css ) . '" class="wptrove-testimonial-heading">' . esc_html( $heading ) . '</h2>';
				$block_content .= '<p style="' . esc_attr( $text_css ) . '" class="wptrove-testimonial-content">' . esc_html( $testimonial ) . '</p>';
				$block_content .= '<div class="wptrove-testimonial-avatar">';
				$block_content .= '<img class="wptrove-testimonial-avatar__image" src="' . esc_url( $photo ) . '" />';
				$block_content .= '<h4 style="' . esc_attr( $avatar_name_css ) . ' !important" class="wptrove-testimonial-avatar__name">' . esc_html( $name ) . '</h4>';
				$block_content .= '<p style="' . esc_attr( $avatar_desig_css ) . ' !important" class="wptrove-testimonial-avatar__designation">' . esc_html( $designation ) . esc_html( $company ) . '</p>';
				$block_content .= '</div>';
				$block_content .= '</div>';

			}
		}

		$block_content .= '</div>';

		return $block_content;

	}

}
