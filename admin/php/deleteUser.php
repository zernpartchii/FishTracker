<?php
include '../../backend/db/config.php'; // your DB connection

if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
    $sql = "DELETE FROM users WHERE userID = '$userID'";
    $conn->query($sql);
}

$conn->close();