$(document).ready(function(event) {
    // Submit the form data using the ajax() function
    $("#myForm").submit(function(e) {
      
      e.preventDefault(); // Prevent the default form submit action
      // Serialize the form data
      var formData = $(this).serialize();
      $.ajax({
      url: "./login_process.php",
      method: "post",
      data: formData,
      success: function(response) {
        if (response === "Connection made") {
          alert("Connection made");
        }
        if (response === "200") {
          alert("Login successful!");
          window.location.href = "./user_dashboard.html";
        } else if (response === "0") {
          alert("Invalid password!");
        } else if (response === "404") {
          alert("User not found!");
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