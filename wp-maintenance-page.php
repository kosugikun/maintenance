<?php

/**
 * Wp Maintenance page
 *
 * Plugin Name: WP Maintenance page
 * Plugin URI: https://mcpenano.net
 * Description: あなたのページを簡単にメンテナンスモードににする事ができます。カスタマイズができ、あなたのお好みのメンテナンスページを作ることもできます。
 * Version: 1.2.3
 * Author: Kosugi_kun
 * Author URI: https://mcpenano.net
 * Twitter: kosugi_kun
 * GitHub Plugin URI: https://github.com/kosugikun/wp-maintenance-page/
 * GitHub Branch: master
 * Text Domain: wp-maintenance-page
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
/*  Copyright 2017 Kosugi_kun (email : info@mcpenano.net)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
     published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/kosugikun/wp-maintenance-page/',
	__FILE__,
	'wp-maintenance-page'
);
//Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master', 'teat');


// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * DEFINE PATHS
 */
define('WPMP_PATH', plugin_dir_path(__FILE__));
define('WPMP_CLASSES_PATH', WPMP_PATH . 'includes/classes/');
define('WPMP_FUNCTIONS_PATH', WPMP_PATH . 'includes/functions/');
define('WPMP_LANGUAGES_PATH', basename(WPMP_PATH) . '/languages/');
define('WPMP_VIEWS_PATH', WPMP_PATH . 'views/');
define('WPMP_CSS_PATH', WPMP_PATH . 'assets/css/');

/**
 * DEFINE URLS
 */
define('WPMP_URL', plugin_dir_url(__FILE__));
define('WPMP_JS_URL', WPMP_URL . 'assets/js/');
define('WPMP_CSS_URL', WPMP_URL . 'assets/css/');
define('WPMP_IMAGES_URL', WPMP_URL . 'assets/images/');
define('WPMP_AUTHOR_UTM', '?utm_source=wpplugin&utm_medium=wpmaintenance');

/**
 * OTHER DEFINES
 */
define('WPMP_ASSETS_SUFFIX', (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min');

/**
 * FUNCTIONS
 */
require_once(WPMP_FUNCTIONS_PATH . 'helpers.php');
if (is_multisite() && !function_exists('is_plugin_active_for_network')) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

/**
 * FRONTEND
 */
require_once(WPMP_CLASSES_PATH . 'wp-maintenance-shortcodes.php');
require_once(WPMP_CLASSES_PATH . 'wp-maintenance-page.php');
register_activation_hook(__FILE__, array('WP_Maintenance_page', 'activate'));
register_deactivation_hook(__FILE__, array('WP_Maintenance_page', 'deactivate'));

add_action('plugins_loaded', array('WP_Maintenance_page', 'get_instance'));

/**
 * DASHBOARD
 */
if (is_admin()) {
    require_once(WPMP_CLASSES_PATH . 'wp-maintenance-page-admin.php');
    add_action('plugins_loaded', array('WP_Maintenance_page_Admin', 'get_instance'));
}
