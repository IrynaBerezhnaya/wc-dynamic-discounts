<?php
/**
 * Dynamic Discounts Settings
 *
 * Initializes the WooCommerce settings tab for dynamic discounts, including
 * adding the settings tab, displaying settings, and saving settings.
 *
 * @class   WCDD_Settings
 * @package wc-dynamic-discounts
 */

defined( 'ABSPATH' ) || exit;

/**
 * WCDD_Settings class.
 */

class WCDD_Settings {
	/**
	 * Constructor.
	 *
	 */
	public function __construct() {
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_tab' ), 50 );
		add_action( 'woocommerce_settings_tabs_dynamic_discounts', array( $this, 'settings_tab' ) );
		add_action( 'woocommerce_update_options_dynamic_discounts', array( $this, 'update_settings' ) );
	}

	/**
	 * Adds a new settings tab to the WooCommerce settings tabs array.
	 *
	 * @param array $settings_tabs Array of existing settings tabs.
	 * @return array Modified settings tabs array including the new tab.
	 */
	public function add_settings_tab( $settings_tabs ) {
		$settings_tabs['dynamic_discounts'] = __( 'Dynamic Discounts', 'woocommerce' );
		return $settings_tabs;
	}

	/**
	 * Displays settings fields for the dynamic discounts tab.
	 */
	public function settings_tab() {
		woocommerce_admin_fields( $this->get_settings() );
	}

	/**
	 * Saves the settings when the dynamic discounts tab is updated.
	 */
	public function update_settings() {
		woocommerce_update_options( $this->get_settings() );
	}

	/**
	 * Defines the settings for the dynamic discounts settings tab.
	 *
	 * @return array Array of settings for the tab.
	 */
	private function get_settings() {
		$settings = array(
			array(
				'title' => __('Discount rules', 'woocommerce'),
				'type'  => 'title',
				'id'    => 'wcdd_options'
			),
			// Toggle for enabling/disabling dynamic discounts
			array(
				'title'   => __('Enable Dynamic Discounts', 'woocommerce'),
				'desc'    => __('Switch to enable/disable the dynamic discounts functionality.', 'woocommerce'),
				'id'      => 'wcdd_enable_dynamic_discounts',
				'default' => 'no',
				'type'    => 'checkbox',
			),
			// Level 1 Product Count Threshold
			array(
				'title'   => __('Apply Discount (%) for Level 1', 'woocommerce'),
				'desc'    => __('The number of products in the cart, from which the 1st level of discount starts to work.', 'woocommerce'),
				'id'      => 'wcdd_level_1_count',
				'default' => '5',
				'type'    => 'number',
				'custom_attributes' => array(
					'min'  => 0,
					'step' => 1
				),
			),
			array(
				'desc'    => 'The size of the 1st level discount in %',
				'id'      => 'wcdd_level_1_discount',
				'default' => '5',
				'type'    => 'number',
				'custom_attributes' => array(
					'min' => 0,
					'step'=> 'any'
				),
			),
			// Level 2 Product Count Threshold
			array(
				'title'   => __('Apply Discount (%) for Level 2', 'woocommerce'),
				'desc'    => __('The number of products in the cart, from which the 2nd level of discount starts to work.', 'woocommerce'),
				'id'      => 'wcdd_level_2_count',
				'default' => '10',
				'type'    => 'number',
				'custom_attributes' => array(
					'min' => 0,
					'step'=> 1
				),
			),
			array(
				'desc'    => 'The size of the 2nd level discount in %',
				'id'      => 'wcdd_level_2_discount',
				'default' => '10',
				'type'    => 'number',
				'custom_attributes' => array(
					'min'  => 0,
					'step' => 'any'
				),
			),
			array(
				'type' => 'sectionend',
				'id'   => 'wcdd_options'
			),
		);

		return $settings;
	}
}