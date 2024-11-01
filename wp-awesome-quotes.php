<?php
/*
  Plugin Name: WP Awesome Quotes
  Description: The plugin displays a random quote on the time of page loading.
  Tags: quotes, loading quotes,loader
  Author: Ankit Chugh
  License:           GPL-2.0+
  License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
  Version: 1.0.5
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Current plugin version.
define('WPAQ_VERSION', '1.0.5');

// Paths
define('WPAQ_PATH', plugin_dir_path( __FILE__ ));
define('WPAQ_DIRNAME', basename( plugin_basename( WPAQ_PATH ) ));
define('WPAQ_PLUGIN_URL', plugins_url() . '/' . WPAQ_DIRNAME);

// Includes
require_once(WPAQ_PATH . '/inc/admin.php');
require_once(WPAQ_PATH . '/inc/general_functions.php');
require_once(WPAQ_PATH . '/inc/cpt.php');

//plugin activation hook
register_activation_hook( __FILE__, 'wpaq_plugin_activate' );
function wpaq_plugin_activate(){
	  update_option('wpaq_enabled',1);
}
