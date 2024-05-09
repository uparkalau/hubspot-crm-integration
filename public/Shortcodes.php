<?php
namespace HubspotCrmIntegration\Public;

use HubspotCrmIntegration\Includes\FormHandler;

class Shortcodes {
    /**
     * Register the shortcode with WordPress.
     */
    public function run() {
        add_shortcode('hubspot_contact_form', [$this, 'display_contact_form']);
        add_action('wp_ajax_submit_hubspot_form', [$this, 'handle_form_submission']);
        add_action('wp_ajax_nopriv_submit_hubspot_form', [$this, 'handle_form_submission']);
    }

    /**
     * Display the contact form.
     */
    public function display_contact_form() {
        $nonce_field = wp_nonce_field('submit_hubspot_form', 'hubspot_form_nonce', true, false);

        $output = '<form id="hubspot-contact-form" method="post" action="' . admin_url('admin-ajax.php') . '">';
        $output .= $nonce_field;
        $output .= '<input type="hidden" name="action" value="submit_hubspot_form">';
        $output .= '<input type="email" name="email" required placeholder="Enter your email">';
        $output .= '<input type="submit" value="Submit">';
        $output .= '</form>';

        return $output;
    }

    /**
     * Handle form submission via AJAX.
     */
    public function handle_form_submission() {
        $nonce = $_POST['hubspot_form_nonce'] ?? '';
        if (!wp_verify_nonce($nonce, 'submit_hubspot_form')) {
            wp_send_json_error('Nonce verification failed.');
        }

        $form_handler = new FormHandler();
        $form_handler->handle_form_submission();

        wp_send_json_success('Form submitted successfully.');
        wp_die();
    }
}

$shortcodes = new Shortcodes();
$shortcodes->run();
