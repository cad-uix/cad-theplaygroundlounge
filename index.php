<?php
/*
Plugin Name: CAD: The Playground Lounge
Plugin URI: https://github.com/cad-uix/cad-plugin-kickstarter
Description: A simple wordpress plugin template kickstarter
Version: 1.0
Author: CAD UIX
Author URI: customadesign.com
License: GPL2
*/
/*
Copyright 2015  Marcel badua  (email : marcel@customadesign.com)

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

$GLOBALS['post_type'] = 'event';


if(!class_exists('CAD_The_Playground_Lounge'))
{
	class CAD_The_Playground_Lounge
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// Initialize Settings
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$CAD_The_Playground_Lounge_Settings = new CAD_The_Playground_Lounge_Settings();

			// Register custom post types
			require_once(sprintf("%s/post-types/post_type_template.php", dirname(__FILE__)));
			$Post_Type_Template = new Post_Type_Template();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate

		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=cad_the_playground_lounge_template">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}


	} // END class CAD_The_Playground_Lounge
} // END if(!class_exists('CAD_The_Playground_Lounge'))

if(class_exists('CAD_The_Playground_Lounge'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('CAD_The_Playground_Lounge', 'activate'));
	register_deactivation_hook(__FILE__, array('CAD_The_Playground_Lounge', 'deactivate'));

	// instantiate the plugin class
	$cad_the_playground_lounge_template = new CAD_The_Playground_Lounge();

}
