<?php

/**
 * Maintenance
 *
 * Plugin Name: WP Maintenance page
 * Plugin URI: https://mcpenano.net
 * Description: あなたのページがメンテナンス中であることを簡単に教えてください。
 * Version: 1.0.0
 * Author: Kosugi_kun
 * Author URI: https://mcpenano.net
 * Twitter: kosugi_kun
 * GitHub Plugin URI: https://github.com/kosugikun/wp-maintenance/
 * GitHub Branch: master
 * Text Domain: wp-maintenance-page
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/kosugikun/wp-maintenance-page/',
	__FILE__,
	'wp-maintenance-page'
);
//Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');


// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * DEFINE PATHS
 */
define('WPMM_PATH', plugin_dir_path(__FILE__));
define('WPMM_CLASSES_PATH', WPMM_PATH . 'includes/classes/');
define('WPMM_FUNCTIONS_PATH', WPMM_PATH . 'includes/functions/');
define('WPMM_LANGUAGES_PATH', basename(WPMM_PATH) . '/languages/');
define('WPMM_VIEWS_PATH', WPMM_PATH . 'views/');
define('WPMM_CSS_PATH', WPMM_PATH . 'assets/css/');

/**
 * DEFINE URLS
 */
define('WPMM_URL', plugin_dir_url(__FILE__));
define('WPMM_JS_URL', WPMM_URL . 'assets/js/');
define('WPMM_CSS_URL', WPMM_URL . 'assets/css/');
define('WPMM_IMAGES_URL', WPMM_URL . 'assets/images/');
define('WPMM_AUTHOR_UTM', '?utm_source=wpplugin&utm_medium=wpmaintenance');

/**
 * OTHER DEFINES
 */
define('WPMM_ASSETS_SUFFIX', (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min');

/**
 * FUNCTIONS
 */
require_once(WPMM_FUNCTIONS_PATH . 'helpers.php');
if (is_multisite() && !function_exists('is_plugin_active_for_network')) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

/**
 * FRONTEND
 */
require_once(WPMM_CLASSES_PATH . 'wp-maintenance-shortcodes.php');
require_once(WPMM_CLASSES_PATH . 'wp-maintenance-page.php');
register_activation_hook(__FILE__, array('WP_Maintenance_page', 'activate'));
register_deactivation_hook(__FILE__, array('WP_Maintenance_page', 'deactivate'));

add_action('plugins_loaded', array('WP_Maintenance_page', 'get_instance'));

/**
 * DASHBOARD
 */
if (is_admin()) {
    require_once(WPMM_CLASSES_PATH . 'wp-maintenance-page-admin.php');
    add_action('plugins_loaded', array('WP_Maintenance_page_Admin', 'get_instance'));
}