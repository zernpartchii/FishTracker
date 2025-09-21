<?php
include '../../backend/db/config.php'; // your DB connection  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_password = $_POST['new_password'];

    if (!empty($user_id) && !empty($new_password)) {
        // Hash password
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
        $stmt->bind_param("si", $hashedPassword, $user_id);

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