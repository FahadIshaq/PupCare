<?php
include 'session_start.php';
$serverName = 'localhost';
$usernameDB = "root";
$passwordDB = "";
$databaseName = "PupCare";
$user_id = $_SESSION["userId"];

// Connect to the MySQL database
$conn = mysqli_connect($serverName, $usernameDB, $passwordDB, $databaseName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$dogName = "";
$dogBreed = "";
$dogAge = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Check if the dogName, dogBreed, and dogAge fields are set
  if (isset($_POST['dogName']) && isset($_POST['dogBreed']) && isset($_POST['dogAge'])) {
    // Retrieve the user input from the form
    $dogName = $_POST['dogName'];
    $dogBreed = $_POST['dogBreed'];
    $dogAge = $_POST['dogAge'];

    $sql = "SELECT * FROM dogs WHERE dogName = '$dogName' AND breed = '$dogBreed' AND age = '$dogAge' AND owner_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      echo "0"; // Dog already exists for the owner
      exit();
    } else {
      $sqlDogAddQuery = "INSERT INTO dogs (dogName, breed, age, owner_id)
                           VALUES ('$dogName', '$dogBreed', '$dogAge', '$user_id')";
      if (mysqli_query($conn, $sqlDogAddQuery)) {
        echo "200"; // Dog registration successful
        exit();
      } else {
        echo "404"; // Error in executing the SQL query
        exit();
      }
    }
  }
}

mysqli_close($conn);
?>
