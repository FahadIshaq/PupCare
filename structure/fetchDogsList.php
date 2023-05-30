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
    // Start building the HTML table
    $output = "<table class='table'>";
    $output .= "<tr><th>ID</th><th>Name</th><th>Breed</th><th>Age</th><th>Delete</th></tr>";

    // Fetch each row from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract the values from the row
        $dogName = $row['dogName'];
        $dogBreed = $row['breed'];
        $dogAge = $row['age'];
        $dogId = $row['dog_id'];

        // Append a table row with the dog data
        $output .= "<tr>";
        $output .= "<td>$dogId</td>";
        $output .= "<td>$dogName</td>";
        $output .= "<td>$dogBreed</td>";
        $output .= "<td>$dogAge</td>";
        $output .= "<td class='btn btn-danger text-center text-danger my-2 deleteDogBtn' data-id='$dogId'>Delete</td>";
        $output .= "</tr>";
    }

    // Close the HTML table
    $output .= "</table>";
} else {
    // No results found
    $output = "No dogs found.";
}

// Close the database connection
mysqli_close($conn);

// Send the HTML response back to the AJAX request
echo $output;
?>