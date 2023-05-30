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

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the current password and new password from the form data
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
  
    // Perform the necessary validation and update logic
    // Replace "users" with your actual table name and "password" with the corresponding column name in your table
    $userId = $_SESSION['userId']; // Assuming you have the user ID available
    
    $sqlCurrentPassCount = "SELECT pass FROM users WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $sqlCurrentPassCount);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if ($currentPassword != $row['pass']) {
            echo "current password invalid";
            exit();
        }
        else if ($currentPassword === $newPassword){
            echo "current password same new password";
            exit();
        }
        else{
            $sql = "UPDATE users SET pass = ? WHERE user_id = ? AND pass = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sis", $newPassword, $userId, $currentPassword);
        
            if (mysqli_stmt_execute($stmt)) {
                // Password update successful
                echo "200"; // Set the HTTP response code to 200 (OK)
                exit();
            } else {
                // Password update failed
                echo "404"; // Set the HTTP response code to 500 (Internal Server Error)
                exit();
            }
        }
    }
}
?>
