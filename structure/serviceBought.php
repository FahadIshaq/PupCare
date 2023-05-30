<?php
include 'session_start.php';
$serverName = 'localhost';
$usernameDB = "root";
$passwordDB = "";
$databaseName = "PupCare";
$userId = $_SESSION['userId'];

// Connect to the MySQL database
$conn = mysqli_connect($serverName, $usernameDB, $passwordDB, $databaseName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data
  $homeAddress = $_POST['homeAddress'];
  $selectedService = $_POST['selectedService'];
  $startDate = $_POST['startDate'];
  $endDate = $_POST['endDate'];
  $selectedDog = $_POST['selectedDog'];

  // Perform necessary database operations to insert the data into the bookings table
  // Make sure to establish a database connection first

  // Create the INSERT query
  $query = "INSERT INTO bookings (user_id, service_id, dog_id, home_address, date_booked_start, date_booked_end) VALUES (?, ?, ?, ?, ?, ?)";

  // Prepare the statement
  $stmt = mysqli_prepare($conn, $query);

  // Bind the parameters to the statement
  mysqli_stmt_bind_param($stmt, "iiisss", $userId, $selectedService, $selectedDog, $homeAddress, $startDate, $endDate);

  // Execute the statement
  if (mysqli_stmt_execute($stmt)) {
    // Return a success response
    echo "200";
  } else {
    // Return an error response
    echo "400";
  }

  // Close the statement
  mysqli_stmt_close($stmt);
} else {
  // Return an error response if the request method is not POST
  echo "Method Not Allowed";
}

// Close the database connection
mysqli_close($conn);
?>
