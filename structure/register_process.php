<?php
$serverName = 'localhost';
$usernameDB = "root";
$passwordDB = "";
$databaseName = "PupCare";
$conn = mysqli_connect($serverName, $usernameDB, $passwordDB, $databaseName);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // echo "<script>alert('this is alert');</script>";
  // Retrieve the user input from the form
  $name = $_POST['fname'] . ' ' . $_POST['lname'];
  $email = $_POST['email'];
  $passwordUser = $_POST['password'];
  $dobUser = $_POST['dob'];

  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    // Error occurred during query execution
    echo "500";
    exit();
  }

  if (mysqli_num_rows($result) > 0) {
    // Account already exists
    echo "404";
    exit();
  } else {
    $sqlRegisterQuery = "INSERT INTO users (username, pass, email, dob, is_admin)
    VALUES ('$name', '$passwordUser', '$email', '$dobUser', 0)";

    if (mysqli_query($conn, $sqlRegisterQuery)) {
      // Account created successfully
      echo "200";
      exit();
    } else {
      // Error occurred during registration
      echo "500";
      exit();
    }
  }
}

mysqli_close($conn);
?>
