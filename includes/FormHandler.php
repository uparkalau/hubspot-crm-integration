<?php
namespace HubspotCrmIntegration\Includes;

use HubspotCrmIntegration\Includes\HubspotClient;

class FormHandler {
    /**
     * Handle form submission.
     */
    public function handle_form_submission() {
        
        // if (!isset($_POST['nonce_field']) || !wp_verify_nonce($_POST['nonce_field'], 'submit_form')) {
        //     $this->handle_error('Nonce verification failed. Please try again.');
        //     return;
        // }

        if (empty($_POST['email']) || !is_email($_POST['email'])) {
            $this->handle_error('Invalid email address. Please enter a valid email.');
            return;
        }

        $email = sanitize_email($_POST['email']);

        $hubspotClient = new HubspotClient();
        $result = $hubspotClient->create_contact($email);

        if (is_wp_error($result)) {
            $this->handle_error($result->get_error_message());
        } else {
            $this->handle_success('Contact successfully created in HubSpot.');
        }
    }

    /**
     * Handle errors by logging and providing user feedback.
     *
     * @param string $message The error message to log and display.
     */
    private function handle_error($message) {
        error_log($message);

        add_action('admin_notices', function() use ($message) {
            echo '<div class="notice notice-error is-dismissible"><p>' . esc_html($message) . '</p></div>';
        });
    }

    /**
     * Handle success by providing user feedback.
     *
     * @param string $message The success message to display.
     */
    private function handle_success($message) {
        add_action('admin_notices', function() use ($message) {
            echo '<div class="notice notice-success is-dismissible"><p>' . esc_html($message) . '</p></div>';
        });
    }
}
