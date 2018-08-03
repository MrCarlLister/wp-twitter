<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mrcarllister.co.uk
 * @since             1.0.0
 * @package           Wp_Twitter
 *
 * @wordpress-plugin
 * Plugin Name:       MRCL Twitter
 * Plugin URI:        https://github.com/MrCarlLister/wp-twitter.git
 * Description:       Plugin for creating bespoke twitter API without the css bloat and functionality restrictions.
 * Version:           1.0.0
 * Author:            Carl Lister
 * Author URI:        https://mrcarllister.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-twitter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MR_CL_TWITTER-CUST', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-twitter-activator.php
 */
function activate_wp_twitter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-twitter-activator.php';
	Wp_Twitter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-twitter-deactivator.php
 */
function deactivate_wp_twitter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-twitter-deactivator.php';
	Wp_Twitter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_twitter' );
register_deactivation_hook( __FILE__, 'deactivate_wp_twitter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-twitter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_twitter() {

	$plugin = new Wp_Twitter();
	$plugin->run();

}
run_wp_twitter();
