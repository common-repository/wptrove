/* global wp, jQuery */
const { registerBlockCollection } = wp.blocks;
const { __ } = wp.i18n;


registerBlockCollection( 'wptrove', { title: __( 'WPtrove', 'wptrove' ) } );

import "./blocks/testimonials/add/add";
import "./blocks/testimonials/display/display";
