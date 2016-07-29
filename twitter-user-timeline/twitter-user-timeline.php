<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.nyros.com
 * @since             1.0.0
 * @package           Twitter_User_Timeline
 *
 * @wordpress-plugin
 * Plugin Name:       twitter-user-timeline
 * Plugin URI:        http://www.nyros.com
 * Description:       It is simple to show the twitts on the twitter user timeline. It just take user screen name. It displays user twitts.
 * Version:           1.0.0
 * Author:            Veera Prasad
 * Author URI:        http://www.nyros.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       twitter-user-timeline
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-twitter-user-timeline-activator.php
 */
function activate_twitter_user_timeline() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twitter-user-timeline-activator.php';
	Twitter_User_Timeline_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-twitter-user-timeline-deactivator.php
 */
function deactivate_twitter_user_timeline() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twitter-user-timeline-deactivator.php';
	Twitter_User_Timeline_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_twitter_user_timeline' );
register_deactivation_hook( __FILE__, 'deactivate_twitter_user_timeline' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-twitter-user-timeline.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_twitter_user_timeline() {

	$plugin = new Twitter_User_Timeline();
	$plugin->run();

}
run_twitter_user_timeline();
