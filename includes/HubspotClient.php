<?php
namespace HubspotCrmIntegration\Includes;

use HubSpot\Factory as HubSpotFactory;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;
use WP_Error;

class HubspotClient {
    private $client;
    private $api_key;

    public function __construct() {
        $this->initialize_client();
    }

    private function initialize_client() {
        $options = get_option('hubspot_options');
        $this->api_key = $options['api_key'] ?? '';

        if (empty($this->api_key)) {
            add_action('admin_notices', function() {
                echo '<div class="notice notice-error"><p>No API key provided for HubSpot.</p></div>';
            });
            return;
        }

        $this->client = HubSpotFactory::createWithAccessToken($this->api_key);
    }

    public function create_contact($email) {
        
        if (!$this->client) {
            return new WP_Error('invalid_client', 'HubSpot client is not initialized properly.');
        }
        $contactInput = new SimplePublicObjectInput();
        $contactInput->setProperties([
            'email' => $email
        ]);
        try {
            $response = $this->client->crm()->contacts()->basicApi()->create($contactInput);
            return $response;
        } catch (\Exception $e) {
            return new WP_Error('hubspot_error', $e->getMessage());
        }
    }

    public function get_contacts() {
        if (!$this->client) {
            return new WP_Error('invalid_client', 'HubSpot client is not initialized properly.');
        }
    
        try {
            $apiResponse = $this->client->crm()->contacts()->basicApi()->getPage(10);
            $contacts = [];
            foreach ($apiResponse->getResults() as $contact) {
                $properties = $contact->getProperties();
                $contacts[] = [
                    'email' => $properties['email'],
                    'firstname' => $properties['firstname'] ?? '',
                    'lastname' => $properties['lastname'] ?? '',
                    'phone' => $properties['phone'] ?? '',
                    'company' => $properties['company'] ?? '',
                    'website' => $properties['website'] ?? '',
                    'lifecyclestage' => $properties['lifecyclestage'] ?? ''
                ];
            }
            return $contacts;
        } catch (\Exception $e) {
            return new WP_Error('hubspot_error', $e->getMessage());
        }
    }
    
}
