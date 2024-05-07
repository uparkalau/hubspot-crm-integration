jQuery(document).ready(function($) {
    $('#hubspot-contact-form').submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('Contact successfully created.');
                } else {
                    alert('Failed to create contact: ' + response.data);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });
});
