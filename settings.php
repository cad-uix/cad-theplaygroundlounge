<?php
if(!class_exists('CAD_The_Playground_Lounge_Settings'))
{
	class CAD_The_Playground_Lounge_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} // END public function __construct
		
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	// register your plugin's settings
        	register_setting('cad_the_playground_lounge_template-group', 'setting_a');
        	register_setting('cad_the_playground_lounge_template-group', 'setting_b');

        	// add your settings section
        	add_settings_section(
        	    'cad_the_playground_lounge_template-section', 
        	    'CAD: The Playground Lounge Settings', 
        	    array(&$this, 'settings_section_cad_the_playground_lounge_template'), 
        	    'cad_the_playground_lounge_template'
        	);
        	
        	// add your setting's fields
            add_settings_field(
                'cad_the_playground_lounge_template-setting_a', 
                'Number of Tables', 
                array(&$this, 'settings_field_input_text'), 
                'cad_the_playground_lounge_template', 
                'cad_the_playground_lounge_template-section',
                array(
                    'field' => 'setting_a'
                )
            );
            add_settings_field(
                'cad_the_playground_lounge_template-setting_b', 
                'Number of Chairs per Table', 
                array(&$this, 'settings_field_input_text'), 
                'cad_the_playground_lounge_template', 
                'cad_the_playground_lounge_template-section',
                array(
                    'field' => 'setting_b'
                )
            );
            // Possibly do additional admin_init tasks
        } // END public static function activate
        
        public function settings_section_cad_the_playground_lounge_template()
        {
            // Think of this as help text for the section.
            echo 'These settings do things for the CAD: The Playground Lounge.';
        }
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        } // END public function settings_field_input_text($args)
        
        /**
         * add a menu
         */		
        public function add_menu()
        {
            add_submenu_page(
                'edit.php?post_type='.$GLOBALS['post_type'] ,
                __('Settings','menu-test'), 
                __('Settings','menu-test'), 
                'manage_options', 
                'testsettings', 
                array(&$this, 'plugin_settings_page')
                );

        } // END public function add_menu()
    
        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class CAD_The_Playground_Lounge_Settings
} // END if(!class_exists('CAD_The_Playground_Lounge_Settings'))
