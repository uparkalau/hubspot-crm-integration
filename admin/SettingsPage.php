<?php
namespace HubspotCrmIntegration\Admin;

use HubspotCrmIntegration\Includes\HubspotClient;

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
        add_action('admin_enqueue_scripts', [$this, 'load_custom_wp_admin_style']);
        add_action('wp_ajax_refresh_contacts', [$this, 'handle_refresh_contacts']);
    }

    /**
     * Load custom styles for the admin page
     */
    public function load_custom_wp_admin_style($hook) {
        wp_enqueue_style('custom_wp_admin_css', plugins_url('admin-style.css', __FILE__));
        wp_enqueue_script('jquery');
        wp_enqueue_script('refresh-contacts-script', plugins_url('refresh-contacts.js', __FILE__), array('jquery'), null, true);
        wp_localize_script('refresh-contacts-script', 'ajaxurl', admin_url('admin-ajax.php'));
    }

    /**
     * Add options page
     */
    public function add_plugin_page() {
        global $menu;
        $menu_slug = 'hubspot-crm-integration-admin';
        $menu_exists = false;
    
        foreach ($menu as $item) {
            if ($menu_slug == $item[2]) {
                $menu_exists = true;
                break;
            }
        }
    
        if (!$menu_exists) {
            add_options_page(
                'HubSpot Integration Settings', 
                'HubSpot CRM', 
                'manage_options', 
                $menu_slug, 
                [$this, 'create_admin_page']
            );
        }
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
                settings_fields('hubspot_option_group');
                do_settings_sections('hubspot-crm-integration-admin');
                submit_button();
            ?>
            </form>
            
            <?php $this->display_contacts(); ?>
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

    /**
     * Display contacts retrieved from HubSpot
     */
    public function display_contacts() {
        $hubspotClient = new HubspotClient();

        if (is_wp_error($hubspotClient)) {
            echo '<p>Error initializing HubSpot client: ' . esc_html($hubspotClient->get_error_message()) . '</p>';
            return;
        }
    
        try {
            $apiResponse = $hubspotClient->get_contacts();
            require_once plugin_dir_path(__FILE__) . 'contacts-template.php';
        } catch (\Exception $e) {
            echo '<p>Exception when calling HubSpot API: ' . esc_html($e->getMessage()) . '</p>';
        }
    }

    /**
     * Handle AJAX request to refresh contacts
     */
    public function handle_refresh_contacts() {
        $hubspotClient = new HubspotClient();

        if (is_wp_error($hubspotClient)) {
            wp_send_json_error('Error initializing HubSpot client: ' . $hubspotClient->get_error_message());
            wp_die();
        }

        try {
            $apiResponse = $hubspotClient->get_contacts();
            wp_send_json_success($apiResponse);
        } catch (\Exception $e) {
            wp_send_json_error('Exception when calling HubSpot API: ' . $e->getMessage());
        }

        wp_die();
    }
    
}

// Initialize the settings page
if (is_admin()) {
    $hubspot_settings_page = new SettingsPage();
}
