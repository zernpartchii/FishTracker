<?php
include '../../db/config.php';

$action = $_POST['action'] ?? '';
$userID = $_POST['userID'] ?? '';

if ($action === 'create') {
    $dateRegistered = $_POST['dateRegistered'];
    $fishName = $_POST['fishName'];
    $fishType = $_POST['fishType'];

    // ✅ Check if fish already exists
    $check = $conn->prepare("SELECT id FROM fish WHERE fishName=? AND fishType=? AND userID=?");
    $check->bind_param("ssi",  $fishName, $fishType, $userID);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "exists"; // ⚠️ Already exists
    } else {
        // ✅ Insert new record
        $stmt = $conn->prepare("INSERT INTO fish (userID, dateRegistered, fishName, fishType) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userID, $dateRegistered, $fishName, $fishType);

        echo $stmt->execute() ? "success" : "error";

        $stmt->close();
    }
    $check->close();
} elseif ($action === 'read') {
    $result = $conn->query("SELECT * FROM fish WHERE userID=$userID ORDER BY id DESC");
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} elseif ($action === 'update') {
    $id = $_POST['id'];
    $dateRegistered = $_POST['dateRegistered'];
    $fishName = $_POST['fishName'];
    $fishType = $_POST['fishType'];

    $stmt = $conn->prepare("UPDATE fish SET dateRegistered=?, fishName=?, fishType=? WHERE id=?");
    $stmt->bind_param("sssi", $dateRegistered, $fishName, $fishType, $id);

    echo $stmt->execute() ? "success" : "error";

    $stmt->close();
} elseif ($action === 'delete') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM fish WHERE id=?");
    $stmt->bind_param("i", $id);

    echo $stmt->execute() ? "success" : "error";

    $stmt->close();
}

$conn->close();