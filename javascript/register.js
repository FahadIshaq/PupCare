$(document).ready(function() {
    $("#myFormRegister").submit(function(event) {
      
      event.preventDefault();
      // Submit the form data using the ajax() function
      $.ajax({
        url: "./register_process.php",
        method: "post",
        data: $(this).serialize(),
        success: function(response) {
          
          // Do something with the response from the PHP file
          if (response === "200") {
            alert("Account Created Successfully!");
            window.location.href = "./login.html";
          } else if (response === "404") {
            alert("Account already exists!");
          }
        },
        error: function() {
          alert("Error Occurred");
        }
      });
    });
  });