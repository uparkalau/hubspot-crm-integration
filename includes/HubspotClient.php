<?php
namespace HubspotCrmIntegration\Includes;

use HubSpot\Factory as HubSpotFactory;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;
use WP_Error;

class HubspotClient {
    private $client;

    public function __construct() {
        $api_key = get_option('hubspot_options')['api_key'] ?? '';
        if (empty($api_key)) {
            return new WP_Error('no_api_key', 'No API key provided for HubSpot.');
        }
        $this->client = HubSpotFactory::createWithApiKey($api_key);
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
}
