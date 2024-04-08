<?php
/**
 * WooCommerce Dynamic Discounts Uninstall
 *
 * @package wc-dynamic-discounts
 * @version 1.0.0
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

$options_to_delete = array(
	'wcdd_enable_dynamic_discounts',
	'wcdd_level_1_count',
	'wcdd_level_1_discount',
	'wcdd_level_2_count',
	'wcdd_level_2_discount',
);

foreach ( $options_to_delete as $option_name ) {
	delete_option( $option_name );
}

if ( is_multisite() ) {
	$blog_ids = get_sites( array( 'fields' => 'ids' ) );
	foreach ( $blog_ids as $blog_id ) {
		switch_to_blog( $blog_id );
		foreach ( $options_to_delete as $option_name ) {
			delete_option( $option_name );
		}
		restore_current_blog();
	}
}
