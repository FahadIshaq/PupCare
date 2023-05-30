
$(document).ready(function() {
    // Make an AJAX request to retrieve session data
    $.ajax({
      url: './getSessionData.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Update HTML elements with session data
        $('#usernameLogin').text('Welcome, ' + data.username + '!');
        $('#emailLogin').text('Email: ' + data.email);
        $('#dobLogin').text('DOB: ' + data.dob);
      },
      error: function() {
        console.log('Error retrieving session data.');
      }
    });
    
    
    
    
    $.ajax({
      url: './fetchDogsList.php', // PHP script to fetch the data
      method: 'GET',
      dataType: 'html',
      success: function(response) {
        $('#dogList').html(response); // Populate the response in the div with id "dogList"
      },
      error: function(xhr, status, error) {
        console.error(error); // Display any error messages
      }
    });



    
    $(document).on('click', '.deleteDogBtn', function(e) {
    var dogId = $(this).data('id');
    // Send AJAX request to delete the dog
    $.ajax({
      url: './deleteDog.php',
      method: 'POST',
      data: { dogId: dogId },
      success: function(response) {
        if (response === 'success') {
          alert('Dog deleted successfully.');
          // Refresh the dog list
          $.ajax({
            url: 'fetchDogsList.php',
            method: 'GET',
            dataType: 'html',
            success: function(response) {
              $('#dogList').html(response);
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
          });
        } else if (response === "failed") {
          alert('Failed to delete dog.');
        }
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });



    $("#addDogsId").submit(function(e) {
      e.preventDefault(); // Prevent the default form submit action
      // Serialize the form data
      var formData = $(this).serialize();
      $.ajax({
        url: "addDogs.php",
        type: "POST",
        data: formData,
        success: function(response) {
          if (response === "Connection made") {
            alert("Connection made");
          } else if (response === "200") {
            alert("Added successful!");
            window.location.href = "./user_dashboard.html";
          } else if (response === "0") {
            alert("Dog Already available");
          } else if (response === "404") {
            alert("Error Occurred!");
          } else {
            alert("Unexpected response: " + response);
          }
        },
        error: function(e) {
          alert("Error occurred during login: " + e.statusText);
        }
      });
    });


    
  });