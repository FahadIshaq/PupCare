<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Your database connection code
$serverName = 'localhost';
$usernameDB = "root";
$passwordDB = "";
$databaseName = "PupCare";

// Connect to the MySQL database
$conn = mysqli_connect($serverName, $usernameDB, $passwordDB, $databaseName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve services from the database
$sql = "SELECT service_id, name FROM services";
$result = mysqli_query($conn, $sql);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

$services = array();

// Fetch services and store them in an array
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $service = array(
      'service_id' => $row['service_id'],
      'serviceName' => $row['name']
    );
    
    array_push($services, $service);
  }
}
else{
  die("Nothing here.");

}

// Return services as JSON response
header('Content-Type: application/json');
echo json_encode($services);

// Close the database connection
mysqli_close($conn);
?>
