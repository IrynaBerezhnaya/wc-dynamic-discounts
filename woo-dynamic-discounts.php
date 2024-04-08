<?php
/**
 * Plugin Name: WooCommerce Dynamic Discounts
 * Plugin URI:
 * Description: Manage WooCommerce discounts and apply a dynamic discount depending on the total number of cart items.
 *
 * Version: 1.0.0
 *
 * Author: Iryna Berezhna
 * Author URI:
 * WC tested up to: 8.7
 *
 * @package     wc-dynamic-discounts
 * @author      Iryna Berezhna
 * @Category    Plugin
 */

defined( 'ABSPATH' ) || exit;

// Define Constants
define('WCDD_PLUGIN_KEY', 'wc-dynamic-discounts');
define('WCDD_PLUGIN_PUBLIC_PREFIX', 'wcdd_');
define('WCDD_PLUGIN_PRIVATE_PREFIX', 'wcdd_');
define('WCDD_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WCDD_PLUGIN_URL', plugins_url(basename(plugin_dir_path(__FILE__)), basename(__FILE__)));
define('WCDD_SUPPORT_PHP', '8.3');
define('WCDD_VERSION', '1.0.0');

// Load main class
require_once 'class-wcdd.php';
