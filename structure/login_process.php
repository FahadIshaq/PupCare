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
$username = "";
$password = "";
$email = "";
$dob = "";
$userId = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Check if the email and password fields are set
  if (isset($_POST['email']) && isset($_POST['password'])) {
    // Retrieve the user input from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      if ($password == $row['pass']) {
        $username = $row['username'];
        $dob = $row['dob'];
        $userId = $row['user_id'];
        echo "200"; // Login successful
      } else {
        echo "0"; // Invalid password
      }
    } else {
      echo "404"; // User not found
    }
  } else {
    echo "Missing email or password";
  }
  $_SESSION['userId'] = $userId;
  $_SESSION['username'] = $username;
  $_SESSION['password'] = $password;
  $_SESSION['email'] = $email;
  $_SESSION['dob'] = $dob;
  mysqli_close($conn);
}
?>
