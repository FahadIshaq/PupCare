<?php
include 'session_start.php';
$serverName = 'localhost';
$usernameDB = "root";
$passwordDB = "";
$databaseName = "PupCare";
// Connect to the MySQL database
$conn = mysqli_connect($serverName, $usernameDB, $passwordDB, $databaseName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} else {
  // echo "Connection made";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Check if dogId is set
  if (isset($_POST['dogId'])) {
    $dogId = $_POST['dogId'];

    // Perform the delete operation
    $sql = "DELETE FROM dogs WHERE dog_id = '$dogId'";
    if (mysqli_query($conn, $sql)) {
      echo "success"; // Return success response
      exit();
    }
  }
  else{
    echo "failed";
  }
}
// echo "success";
mysqli_close($conn);
?>
