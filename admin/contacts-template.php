<?php if (isset($apiResponse) && is_array($apiResponse)) : ?>
    <h2>Contacts from HubSpot</h2>
   
    <table id="contacts-table" class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Website</th>
                <th>Life Stage</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($apiResponse as $contact) : ?>
                <tr>
                    <td><?php echo esc_html($contact['email']); ?></td>
                    <td><?php echo esc_html($contact['firstname']); ?></td>
                    <td><?php echo esc_html($contact['lastname']); ?></td>
                    <td><?php echo esc_html($contact['phone']); ?></td>
                    <td><?php echo esc_html($contact['company']); ?></td>
                    <td><?php echo esc_html($contact['website']); ?></td>
                    <td><?php echo esc_html($contact['lifecyclestage']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="loading-indicator" style="display: none;">Loading...</div>

    <div id="error-message" style="display: none;"></div>

    <button id="refresh-contacts" class="button button-secondary">Refresh Contacts</button>
<?php endif; ?>
