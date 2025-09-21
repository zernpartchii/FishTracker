<?php
include '../../backend/db/config.php'; // your DB connection  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $new_password = $_POST['new_password'];

    if (!empty($userID) && !empty($new_password)) {
        // Hash password
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE userID = ?");
        $stmt->bind_param("si", $hashedPassword, $userID);

        if ($stmt->execute()) {
            echo "✅ Password updated successfully!";
        } else {
            echo "❌ Error updating password.";
        }

        $stmt->close();
    } else {
        echo "❌ Missing data.";
    }
    $conn->close();
}