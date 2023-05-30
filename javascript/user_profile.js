$(document).ready(function() {
    // Make an AJAX request to retrieve session data
    $.ajax({
      url: './getSessionData.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Update HTML elements with session data
        $('#usernameLogin').text('Name: ' + data.username + '!');
        $('#emailLogin').text('Email: ' + data.email);
        $('#dobLogin').text('DOB: ' + data.dob);
      },
      error: function() {
        console.log('Error retrieving session data.');
      }
    });


    $(document).ready(function() {
      // Handle form submission
      $('#passwordForm').submit(function(e) {
        e.preventDefault();
        // Create a new FormData object
        var formData = new FormData(this);
        $.ajax({
            url: './updatePassword.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              if (response === "current password invalid") {
                // Password updated successfully
                alert('Current Password is Invalid');
                // Optionally, you can reset the form fields
                
              } else if(response === "current password same new password"){
                // Password update failed
                alert("New Password can't be same as current password");
              }
              else if(response === "200"){
                alert("Updated Successfully");
                $('#passwordForm')[0].reset();
              }
              else{
                alert ("Error Occured");
              }
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
          });



      });
    });





  });