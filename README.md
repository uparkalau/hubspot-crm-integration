# HubSpot CRM Integration

The **HubSpot CRM Integration** WordPress plugin seamlessly connects your WordPress site with HubSpot CRM. It allows you to capture leads directly from contact forms on your website and add them to your HubSpot contacts.

## Description

The **HubSpot CRM Integration** plugin simplifies lead management by automatically syncing form submissions with your HubSpot account. When visitors submit contact forms, their information is instantly added to your HubSpot contacts, streamlining your workflow.

## Features

- **Contact Form Integration**: Place the `[hubspot_contact_form]` shortcode on any post or page to display a contact form. Submitted data is sent directly to HubSpot.
- **Admin Panel Contacts Display**: View all your HubSpot contacts within the WordPress admin panel. The plugin fetches the latest contact data from HubSpot.
- **Refresh Functionality**: Click the "Refresh" button to update the displayed contacts with the most recent information from HubSpot.

## Installation

1. **Upload the plugin files to your WordPress site:**
   - Log in to your WordPress admin area.
   - Navigate to `Plugins` > `Add New` > `Upload Plugin`.
   - Choose the `hubspot-crm-integration.zip` file and click `Install Now`.

2. **Activate the plugin:**
   - Once uploaded, click `Activate Plugin`.

3. **Configure the plugin:**
   - Go to `Settings` > `HubSpot CRM`.
   - Enter your HubSpot API Key and save the changes.

4. **Use the shortcode:**
   - Add the `[hubspot_contact_form]` shortcode to any post or page where you want the contact form to appear.
   - `<?php echo do_shortcode('[hubspot_contact_form]'); ?>`

## Displaying Contacts in Admin Panel

To view your HubSpot contacts within the WordPress admin panel:

1. Navigate to the plugin's admin page (created automatically during installation).
2. Click the "Refresh" button to fetch the latest contacts from HubSpot.
3. The contacts will be displayed in a table format, including relevant details such as email addresses, names, and more.

## Dependencies

- PHP version 8.0 or higher.
- Latest version of WordPress.
- HubSpot PHP client

## Composer (For Development)

If you're setting up the plugin for development, use Composer to install the required dependencies. After cloning the repository, navigate to the plugin directory and run the following command:

```bash
composer install
```
## License

This plugin is open-sourced software licensed under the MIT license.
