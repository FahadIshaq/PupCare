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
} else {
  // echo "Connection made";
}
$sql = "SELECT * FROM dogs where owner_id = '$userId'";
$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    // Create an array to hold the dog data
    $dogs = array();

    // Fetch each row from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract the values from the row
        $dogId = $row['dog_id'];
        $dogName = $row['dogName'];
        $dogBreed = $row['breed'];

        // Create an associative array for each dog
        $dog = array(
            "dogId" => $dogId,
            "dogName" => "$dogName  ($dogBreed)",
            "dogBreed" => $dogBreed
        );

        // Add the dog to the array
        $dogs[] = $dog;
    }
} else {
    // No dogs found
    $dogs = array();
}

// Close the database connection
mysqli_close($conn);

// Send the JSON response back to the AJAX request
header('Content-Type: application/json');
echo json_encode($dogs);
?>
