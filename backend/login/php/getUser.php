<?php
include '../../db/config.php';

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        echo "Missing email or password!";
        exit;
    }

    // ✅ Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT userID, role, username, email, password FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // 🔒 If password is hashed in DB
        if (password_verify($password, $row['password'])) {
            $response = [
                'userID' => $row['userID'],
                'role' => $row['role'],
                'username' => $row['username'],
                'email' => $row['email'],
                'status' => 'success'
            ];
            echo json_encode($response);
        } else {
            echo "Wrong password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request!";
}