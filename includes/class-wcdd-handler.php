<?php
/**
 * Dynamic Discounts Handler
 *
 * Hooks into the cart calculation process to apply dynamic
 * discounts based on the total number of items in the cart.
 *
 * @class   WCDD_Handler
 * @package wc-dynamic-discounts
 */

defined( 'ABSPATH' ) || exit;

/**
 * WCDD_Handler class.
 */
class WCDD_Handler {
	/**
	 * Constructor function to add action hook for applying discounts.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'woocommerce_cart_calculate_fees', array( $this, 'apply_discounts' ), 10, 1 );
	}

	/**
	 * Applies dynamic discounts to the cart based on the total number of items and settings.
	 *
	 * @param WC_Cart $cart The WooCommerce cart object.
	 */
	public function apply_discounts( $cart ) {
		if ( is_admin() && !defined( 'DOING_AJAX' ) ) {
			return;
		}

		if ( $cart->get_cart_contents_count() == 0 || 'yes' !== get_option( 'wcdd_enable_dynamic_discounts', 'no' ) ) {
			return;
		}

		$level_1_threshold = get_option('wcdd_level_1_count', 0);
		$level_1_discount = get_option('wcdd_level_1_discount', 0);
		$level_2_threshold = get_option('wcdd_level_2_count', 0);
		$level_2_discount = get_option('wcdd_level_2_discount', 0);

		$total_items = $cart->get_cart_contents_count();

		$discount = 0;
		$applied_discount_percentage = 0;

		if ($total_items >= $level_2_threshold) {
			$applied_discount_percentage = $level_2_discount;
			$discount = $cart->cart_contents_total * ($level_2_discount / 100);
		} elseif ($total_items >= $level_1_threshold) {
			$applied_discount_percentage = $level_1_discount;
			$discount = $cart->cart_contents_total * ($level_1_discount / 100);
		}

		if ($discount > 0) {
			$label = sprintf(__('%s%% Discount', 'woocommerce'), $applied_discount_percentage);
			$cart->add_fee($label, -$discount, true);
		}
	}
}