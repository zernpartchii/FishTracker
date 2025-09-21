<?php
include '../../db/config.php';

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $oldPassword = trim($_POST['oldPassword'] ?? '');
    $newPassword = trim($_POST['newPassword'] ?? '');

    if (empty($email) || empty($oldPassword) || empty($newPassword)) {
        echo "Missing fields";
        exit;
    }

    // ✅ Fetch user first
    $stmt = $conn->prepare("SELECT userID, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // 🔒 Verify old password (hashed)
        if (password_verify($oldPassword, $row['password'])) {

            // ✅ Hash new password before saving
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // ✅ Update with new password
            $update = $conn->prepare("UPDATE users SET password = ? WHERE userID = ?");
            $update->bind_param("si", $newPassword, $row['userID']);

            if ($update->execute()) {
                echo "success";
            } else {
                echo "Failed to update password";
            }

            $update->close();
        } else {
            echo "Incorrect current password";
        }
    } else {
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}