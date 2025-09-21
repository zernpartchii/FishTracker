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

// $servername = "sql207.byethost17.com";  // Database host
// $username   = "b17_38405973";       // Database username
// $password   = "Geszer25";           // Database password
// $dbname     = "b17_38405973_fishtracker"; // Database name

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }