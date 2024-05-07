<?php
namespace HubspotCrmIntegration\Admin;

if (!defined('WPINC')) {
    die;
}

class SettingsPage {
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct() {
        add_action('admin_menu', [$this, 'add_plugin_page']);
        add_action('admin_init', [$this, 'page_init']);
    }

    /**
     * Add options page
     */
    public function add_plugin_page() {
        // This page will be under "Settings"
        add_options_page(
            'HubSpot Integration Settings', 
            'HubSpot CRM', 
            'manage_options', 
            'hubspot-crm-integration-admin', 
            [$this, 'create_admin_page']
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        $this->options = get_option('hubspot_options');
        ?>
        <div class="wrap">
            <h1>HubSpot Integration Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields('hubspot_option_group');
                do_settings_sections('hubspot-crm-integration-admin');
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {        
        register_setting(
            'hubspot_option_group',
            'hubspot_options', 
            [$this, 'sanitize'] 
        );

        add_settings_section(
            'setting_section_id', 
            'HubSpot CRM Settings',
            [$this, 'print_section_info'],
            'hubspot-crm-integration-admin'
        );  

        add_settings_field(
            'api_key',
            'API Key',
            [$this, 'api_key_callback'],
            'hubspot-crm-integration-admin',
            'setting_section_id'          
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input) {
        $new_input = [];
        if (isset($input['api_key'])) {
            $new_input['api_key'] = sanitize_text_field($input['api_key']);
        }

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info() {
        print 'Enter your HubSpot API Key below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function api_key_callback() {
        printf(
            '<input type="text" id="api_key" name="hubspot_options[api_key]" value="%s" />',
            isset($this->options['api_key']) ? esc_attr($this->options['api_key']) : ''
        );
    }
}

// Initialize the settings page
if (is_admin()) {
    $hubspot_settings_page = new SettingsPage();
}
