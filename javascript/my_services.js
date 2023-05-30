$(document).ready(function(){

        fetchBookings();

        $(document).on('click', '.deleteBookingBtn', function() {
        // Get the dog name and start date from the data attributes
        var dogName = $(this).data('dogname');
        var bookingId = $(this).data('booking_id');
        alert(bookingId);
        // Confirm the deletion with a dialog box
        if (confirm('Are you sure you want to delete the booking for ' + dogName + ' Booking ID' + bookingId)) {
          // Perform the AJAX delete request
          $.ajax({
            url: './deleteBooking.php', // Replace with the actual PHP file name
            method: 'POST',
            data: { dogName: dogName, bookingId: bookingId },
            success: function(response) {
              // Check the response for success or error
              if (response === '200') {
                // Refresh the bookings table after successful deletion
                fetchBookings();
              } else {
                // Handle the error case
                alert('Error occurred while deleting the booking.');
              }
            },
            error: function() {
              // Handle the error case
              alert('Error occurred while deleting the booking.');
            }
          });
        }
        });
        });
        function fetchBookings() {
        $.ajax({
          url: './getAllMyBoughtServices.php', // Replace with the actual PHP file name
          method: 'GET',
          success: function(response) {
            // Update the HTML table with the fetched data
            $('#bookingsTable').html(response);
          },
          error: function() {
            // Handle the error case
            alert('Error occurred while fetching bookings.');
          }
        });
    }