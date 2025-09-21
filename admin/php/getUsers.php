<?php
include '../../backend/db/config.php'; // your DB connection

$result = $conn->query("SELECT userID, role, email, username, password FROM users");
$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);