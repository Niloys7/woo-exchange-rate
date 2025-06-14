<?php
/*
 * Plugin Name: Multi Currency, Currency Switcher, Exchange Rates for WooCommerce - Mudra
 * Description: Allows to add exchange rates for WooCommerce 
 * Plugin URI: https://wordpress.org/plugins/woo-exchange-rate/
 * Version: 17.4
 * Author: Codeixer
 * Text Domain: woo-exchange-rate
 * Author URI: https://codeixer.com
 * License: GPLv2 or later
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//Help handle assets
define('WOOER_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Includes autoloader
 */
require_once __DIR__ . '/vendor/autoload.php';

add_action(
	'before_woocommerce_init',
	function () {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', __FILE__, true );
		}
	}
);
/**
 * Check if woocommerce plugin is enabled
 */
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_action('admin_notices', 'wooer_startup_error');
    return false;
}

/**
 * Plugin setup hooks
 */
register_activation_hook(__FILE__, 'wooer_install');
register_uninstall_hook(__FILE__, 'wooer_uninstall');


use WOOER\Main;
return new Main();