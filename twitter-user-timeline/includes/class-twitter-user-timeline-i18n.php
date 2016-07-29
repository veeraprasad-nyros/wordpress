<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.nyros.com
 * @since      1.0.0
 *
 * @package    Twitter_User_Timeline
 * @subpackage Twitter_User_Timeline/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Twitter_User_Timeline
 * @subpackage Twitter_User_Timeline/includes
 * @author     Veera Prasad <veeraprasad_nyros@yahoo.com>
 */
class Twitter_User_Timeline_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'twitter-user-timeline',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
