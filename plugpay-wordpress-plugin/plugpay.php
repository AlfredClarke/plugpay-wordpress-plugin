<?php
/*
Plugin Name: PlugPay
Plugin URI: https://www.example.com/plugpay
Description: A WordPress plugin for integrating PlugPay payment solutions.
Version: 1.0.0
Author: ALFRED CLARKE
Author URI: N/A
Text Domain: plugpay
Domain Path: /languages
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Define constants
define('PLUGPAY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PLUGPAY_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load translation files
/*add_action('plugins_loaded', 'plugpay_load_textdomain');
function plugpay_load_textdomain() {
    load_plugin_textdomain('plugpay', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}*/

// Include necessary files
require_once PLUGPAY_PLUGIN_DIR . 'includes/api/authentication.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/api/endpoints/merchant.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/api/endpoints/payment.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/api/endpoints/order.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/api/security.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/integration/woocommerce/plugin.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/integration/woocommerce/hooks.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/integration/app/communication.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/integration/app/sdk/initialization.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/integration/app/sdk/payment.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/integration/app/sdk/order_confirmation.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/management/transaction.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/ui/dashboard.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/ui/customization.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/security/encryption.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/security/authentication.php';
require_once PLUGPAY_PLUGIN_DIR . 'includes/documentation/index.php';

// Plugin initialization
function plugpay_init() {
    // Your initialization code here
}
add_action('init', 'plugpay_init');

// Plugin activation hook
function plug

// Define a unique function name for loading plugin text domain

add_action('plugins_loaded', 'plugpay_load_textdomain');
function plugpay_load_textdomain() {
    load_plugin_textdomain('plugpay', false, dirname(plugin_basename(__FILE__)) . '/language/');
}

// Include admin files
require_once plugin_dir_path(__FILE__) . 'includes/admin/settings-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin/plugin-options.php';

// Initialize admin panel
add_action('admin_menu', 'plugpay_add_admin_menu');
function plugpay_add_admin_menu() {
    add_menu_page('PlugPay Settings', 'PlugPay', 'manage_options', 'plugpay-settings', 'plugpay_settings_page');
}

// Enqueue CSS and JavaScript with versioning, minification, and concatenation
function plugpay_enqueue_assets() {
    // Get the plugin version
    $plugin_version = '1.0'; // Update with your actual plugin version

    // Enqueue minified and concatenated CSS
    wp_enqueue_style('plugpay-style', plugins_url('/public/assets/css/style.min.css', __FILE__), array(), $plugin_version);

    // Enqueue minified and concatenated JavaScript
    wp_enqueue_script('plugpay-script', plugins_url('/public/assets/js/script.min.js', __FILE__), array('jquery'), $plugin_version, true);

    // Localize script for translation
    wp_localize_script('plugpay-script', 'plugpay_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('plugpay_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'plugpay_enqueue_assets');
