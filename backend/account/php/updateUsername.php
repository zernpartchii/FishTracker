<?php
include '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $newUsername = trim($_POST['newUsername'] ?? '');

    if (empty($email) || empty($newUsername)) {
        echo "Missing fields";
        exit;
    }

    // Check if username already exists
    $check = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    $check->bind_param("s", $newUsername);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult && $checkResult->num_rows > 0) {
        echo "Username already taken";
        $check->close();
        $conn->close();
        exit;
    }
    $check->close();

    // ✅ Update username
    $update = $conn->prepare("UPDATE users SET username = ? WHERE email = ?");
    $update->bind_param("ss", $newUsername, $email);

    if ($update->execute()) {
        echo "success";
    } else {
        echo "Failed to update username";
    }

    $update->close();
    $conn->close();
} else {
    echo "Invalid request";
}