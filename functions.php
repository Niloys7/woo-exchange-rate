<?php

use WOOER\Main;
use WOOER\Exchange_Rate_Model;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Custom functions, utils, etc.
 */
function wooer_startup_error() {
    $class = 'notice notice-error';
    $message = 'WooCommerce Exchange Rate plugin error: ' . __('WooCommerce plugin is not activated!', 'woo-exchange-rate');

    printf('<div class="%1$s"><p>%2$s</p></div>', $class, $message);
}

/**
 * Installation function
 */
function wooer_install() {
    global $wpdb;
    require_once(ABSPATH . '/wp-admin/includes/plugin.php');
    
    $table_name = Exchange_Rate_Model::get_instance()->get_table_name();

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
	  `id` mediumint(9) AUTO_INCREMENT PRIMARY KEY,
	  `currency_code` varchar(3) NOT NULL,
      `currency_pos` varchar(32) NOT NULL DEFAULT 'left',
	  `currency_exchange_rate` decimal(16,4) NOT NULL
	);";
    $wpdb->query($sql);
    
    Main::save_plugin_db_version();
}



/**
 * Uninstall function
 */
function wooer_uninstall() {
   //TODO: add db cleanup code
    delete_option('wooer_plugin_version');
}



