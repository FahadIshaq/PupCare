$(document).ready(function() {
    $('#contactForm').submit(function(event) {
        event.preventDefault();

        // Serialize the form data
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: './contactForm.php',
            data: formData,
            success: function(response) {
                $('#successMessage').html(response);
                $('#contactForm')[0].reset();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});