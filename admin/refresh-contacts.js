jQuery(document).ready(function($) {
    $('#refresh-contacts').on('click', function() {        
        $('#loading-indicator').show();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'refresh_contacts'
            },
            success: function(response) {
                $('#loading-indicator').hide();
                if (response.success) {
                    var contacts = response.data;
                    var tableBody = $('.wp-list-table tbody');
                    tableBody.empty(); 

                    $.each(contacts, function(index, contact) {
                        var row = $('<tr>').append(
                            $('<td>').text(contact.email),
                            $('<td>').text(contact.firstname),
                            $('<td>').text(contact.lastname),
                            $('<td>').text(contact.phone),
                            $('<td>').text(contact.company),
                            $('<td>').text(contact.website),
                            $('<td>').text(contact.lifecyclestage)
                        );
                        tableBody.append(row);
                    });
                } else {
                    $('#error-message').text('Error: ' + response.data).show();
                }
            },
            error: function(xhr, status, error) {
                $('#loading-indicator').hide();
                $('#error-message').text('Request failed: ' + error).show();
            }
        });
    });
});
