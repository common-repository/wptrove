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
class Wptrove_Post_Types {

	/**
	 * Create testimonial post type
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function create_wptrove_testimonial_post_type() {

		$labels = array(
			'name'                  => esc_html_x( 'Testimonials', 'Post type general name', 'wptrove' ),
			'singular_name'         => esc_html_x( 'Testimonial', 'Post type singular name', 'wptrove' ),
			'menu_name'             => esc_html_x( 'Testimonials', 'Admin Menu text', 'wptrove' ),
			'name_admin_bar'        => esc_html_x( 'Testimonial', 'Add New on Toolbar', 'wptrove' ),
			'add_new'               => esc_html__( 'Add New Testimonial', 'wptrove' ),
			'add_new_item'          => esc_html__( 'Add New Testimonial', 'wptrove' ),
			'new_item'              => esc_html__( 'New Testimonial', 'wptrove' ),
			'edit_item'             => esc_html__( 'Edit Testimonial', 'wptrove' ),
			'view_item'             => esc_html__( 'View Testimonial', 'wptrove' ),
			'all_items'             => esc_html__( 'All Testimonials', 'wptrove' ),
			'search_items'          => esc_html__( 'Search Testimonials', 'wptrove' ),
			'parent_item_colon'     => esc_html__( 'Parent Testimonial:', 'wptrove' ),
			'not_found'             => esc_html__( 'No Testimonials found.', 'wptrove' ),
			'not_found_in_trash'    => esc_html__( 'No Testimonials found in Trash.', 'wptrove' ),
			'featured_image'        => esc_html_x( 'Testimonial Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'wptrove' ),
			'set_featured_image'    => esc_html_x( 'Set Testimonial image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'wptrove' ),
			'remove_featured_image' => esc_html_x( 'Remove Testimonial image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'wptrove' ),
			'use_featured_image'    => esc_html_x( 'Use as Testimonial image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'wptrove' ),
			'archives'              => esc_html_x( 'Testimonial archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'wptrove' ),
			'insert_into_item'      => esc_html_x( 'Insert into Testimonial', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'wptrove' ),
			'uploaded_to_this_item' => esc_html_x( 'Uploaded to this Testimonial', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'wptrove' ),
			'filter_items_list'     => esc_html_x( 'Filter Testimonials', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'wptrove' ),
			'items_list_navigation' => esc_html_x( 'Testimonial navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Testimonials navigation”. Added in 4.4', 'wptrove' ),
			'items_list'            => esc_html_x( 'Testimonials', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'wptrove' ),
		);

		$args = array(

			'labels'              => $labels,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'query_var'           => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => array( 'slug' => 'wptrove-testimonial' ),
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => true,
			'menu_position'       => null,
			'supports'            => array( 'title' ),
			'show_in_rest'        => true,
			'capabilities'        => array(
				'create_posts' => false,
			),
			'map_meta_cap'        => true,
		);

		register_post_type( 'wptrove-testimonial', $args );

	}

}
