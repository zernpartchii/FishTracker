<?php
$servername = "localhost";  // Database host
$username   = "root";       // Database username
$password   = "";           // Database password
$dbname     = "fish_tracker"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $servername = "sql107.infinityfree.com";  // Database host
// $username   = "if0_39992523";       // Database username
// $password   = "zernpartchii";           // Database password
// $dbname     = "if0_39992523_fishtracker"; // Database name

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }