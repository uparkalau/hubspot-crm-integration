# HubSpot CRM Integration

This WordPress plugin integrates your WordPress site with HubSpot CRM to capture leads directly from your contact forms into your HubSpot contacts.

## Description

HubSpot CRM Integration allows you to create a WordPress plugin that integrates with HubSpot to capture leads from a contact form on your WordPress site and add them to your HubSpot contacts.

## Installation

1. **Upload the plugin files to your WordPress site:**
   - Navigate to the WordPress admin area.
   - Go to `Plugins` > `Add New` > `Upload Plugin`.
   - Choose the `hubspot-crm-integration.zip` file and click `Install Now`.

2. **Activate the plugin:**
   - Once uploaded, click `Activate Plugin`.

3. **Configure the plugin:**
   - Go to `Settings` > `HubSpot CRM`.
   - Enter your HubSpot API Key and save the changes.

4. **Use the shortcode:**
   - Add the `[hubspot_contact_form]` shortcode to any post or page where you want the contact form to appear.

## Usage

After installation and activation, simply place the `[hubspot_contact_form]` shortcode into the content area of any page or post where you want the HubSpot contact form to appear.

## Enqueue Scripts and Styles

The plugin automatically enqueues the necessary JavaScript and CSS files for the AJAX form submission and styling. Ensure that your theme allows `wp_head()` and `wp_footer()` functions to run, as these are required for the scripts and styles to load correctly.

## Customization

You can customize the form's appearance by editing the `assets/css/hubspot-style.css` file. If you need to modify the JavaScript functionality, you can edit the `assets/js/hubspot-form.js` file.

## Dependencies

- PHP version 8.0 or higher.
- Latest version of WordPress.
- HubSpot PHP client(https://github.com/HubSpot/hubspot-api-php)

## Composer

If you are setting up the plugin for development, you can use Composer to install the required dependencies. After cloning the repository, navigate to the plugin directory and run the following command:

```bash
composer install
```
## License

This plugin is open-sourced software licensed under the MIT license.
