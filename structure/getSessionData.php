<?php
include 'session_start.php';

// Retrieve session variables
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$dob = $_SESSION['dob'];
$userId = $_SESSION['userId'];

// Create an array with session data
$sessionData = array(
    'username' => $username,
    'email' => $email,
    'password' => $password,
    'dob' => $dob,
    'userId' => $userId,
);

// Convert the array to JSON
$jsonData = json_encode($sessionData);

// Return the JSON response
header('Content-Type: application/json');
echo $jsonData;
?>
