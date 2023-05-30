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

$query = "SELECT b.booking_id, d.dogName, d.breed, s.serviceName, b.date_booked_start, b.date_booked_end
        FROM bookings AS b
        JOIN dogs AS d ON b.dog_id = d.dog_id
        JOIN services AS s ON b.service_id = s.service_id
        WHERE b.user_id = '$userId'";

$result = mysqli_query($conn, $query);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
  // Start building the HTML table
  $output = "";

  // Fetch each row from the result set
  while ($row = mysqli_fetch_assoc($result)) {
    // Extract the values from the row
    $dogName = $row['dogName'] .' ('.$row['breed'].')';
    $serviceName = $row['serviceName'];
    $startDate = $row['date_booked_start'];
    $endDate = $row['date_booked_end'];
    $bookingId = $row['booking_id'];
    $dogname= $row['dogName'];
    // Append a table row with the booking data
    $output .= "<tr>";
    $output .= "<td>$dogName</td>";
    $output .= "<td>$serviceName</td>";
    $output .= "<td>$startDate</td>";
    $output .= "<td>$endDate</td>";



    $output .= "<td class='btn btn-danger text-center text-danger my-2 deleteBookingBtn' data-dogname='$dogname' data-booking_id='$bookingId'>Delete</td>";
    $output .= "</tr>";
  }

} else {
  // No results found
  $output = "No bookings found.";
}

// Close the database connection
mysqli_close($conn);

// Send the HTML response back to the AJAX request
echo $output;
?>
