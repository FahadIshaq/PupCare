$(document).ready(function() {





    $.ajax({
      url: "./getServices.php",
      type: "GET",
      dataType: "json",
      success: function(response) {
        var dropdown = $("#servicesDropdown");
        dropdown.empty();

        $.each(response, function(index, service) {
          dropdown.append(
            $("<option></option>")
              .val(service.service_id)
              .text(service.serviceName)
          );
        });
      },
      error: function() {
        alert("Error occurred while retrieving services.");
      }
    });


    $.ajax({
      url: "./userDogsForServices.php",
      type: "GET",
      dataType: "json",
      success: function(response) {
        var dropdown = $("#dogsDropdown");
        dropdown.empty();

        // Iterate over the dog data and create dropdown options
        $.each(response, function(index, dog) {
          dropdown.append(
            $("<option></option>")
              .val(dog.dogId)
              .text(dog.dogName)
          );
        });
      },
      error: function() {
        console.log("Error retrieving dog list.");
      }
    });




    $("#buyServiceDetails").submit(function(event) {
    event.preventDefault();

    var homeAddress = $("#homeAddress").val();
    var selectedService = $("#servicesDropdown").val();
    var startDate = $("#startDate").val();
    var endDate = $("#endDate").val();
    var selectedDog = $("#dogsDropdown").val();
    // alert(homeAddress+":"+selectedService+":"+startDate+":"+endDate+":"+selectedDog);
    // Validate the start date and end date
    var today = new Date();
    var startDateObj = new Date(startDate);
    var endDateObj = new Date(endDate);

    if (startDateObj < today) {
      alert("Start date cannot be a date before today.");
      return;
    }

    var minimumEndDate = new Date(startDateObj.getTime() + 4 * 24 * 60 * 60 * 1000); // Adding 4 days to the start date
    if (endDateObj < minimumEndDate) {
      alert("End date should be at least 4 days after the start date.");
      return;
    }

    // Submit the form data using the ajax() function
    $.ajax({
      url: "./serviceBought.php",
      method: "post",
      data: $(this).serialize(),
      success: function(response) {
        // Do something with the response from the PHP file
        if (response === "200") {
          alert("Service successfully bought!");
          window.location.href = "./my_Services.html";
        }
         else if(response === "400"){
          alert("Start date cannot be a date before today.");
         }
         else {
          alert("Error occurred while buying the service.");
        }
      },
      error: function() {
        alert("Error occurred");
      }
    });
  });





  

  });