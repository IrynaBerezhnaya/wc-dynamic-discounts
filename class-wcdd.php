<?php
/**
 * Main Class
 *
 * @class WCDD
 * @package wc-dynamic-discounts
 * @author Iryna Berezhna
 */

defined( 'ABSPATH' ) || exit;

class WCDD {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'initialize_plugin' ) );
	}

	/**
	 * Initializes the plugin.
	 */
	public function initialize_plugin() {
		require_once WCDD_PLUGIN_PATH . 'includes/class-wcdd-handler.php';
		require_once WCDD_PLUGIN_PATH . 'includes/class-wcdd-settings.php';

		// Initialize classes.
		new WCDD_Settings();
		new WCDD_Handler();
	}
}

new WCDD();