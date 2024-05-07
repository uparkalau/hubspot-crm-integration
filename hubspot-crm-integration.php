<?php
/**
 * Plugin Name: HubSpot CRM Integration
 * Description: Integrates WordPress with HubSpot CRM to capture leads.
 * Version: 1.0
 * Author: Vlad
 * Author URI: https://github.com/uparkalau
 */

if (!defined('WPINC')) {
    die;
}

// Autoload dependencies.
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Include class files.
require_once plugin_dir_path(__FILE__) . 'admin/SettingsPage.php';
require_once plugin_dir_path(__FILE__) . 'includes/FormHandler.php';
require_once plugin_dir_path(__FILE__) . 'includes/HubspotClient.php';
require_once plugin_dir_path(__FILE__) . 'public/Shortcodes.php';

// Enqueue scripts and styles.
function hubspot_crm_integration_enqueue_scripts() {
    wp_enqueue_style('hubspot-bootstrap-style', plugins_url('assets/css/hubspot-style.css', __FILE__));
    wp_enqueue_script('hubspot-form-script', plugins_url('assets/js/hubspot-form.js', __FILE__), array('jquery'), null, true);
    wp_localize_script('hubspot-form-script', 'hubspotAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'hubspot_crm_integration_enqueue_scripts');

// Run the plugin.
function run_hubspot_crm_integration() {
    $SettingsPage = new HubspotCrmIntegration\Admin\SettingsPage();
    $FormHandler = new HubspotCrmIntegration\Includes\FormHandler();
    $HubspotClient = new HubspotCrmIntegration\Includes\HubspotClient();
    $shortcodes = new HubspotCrmIntegration\Public\Shortcodes();
    $shortcodes->run();
}

run_hubspot_crm_integration();
