<?php
include '../../db/config.php';

$action = $_POST['action'] ?? '';
$year   = $_POST['year'] ?? date("Y"); // default current year if not provided
$userID = $_POST['userID'] ?? '';

if ($action === 'top_customers') {
    $sql = "
        SELECT 
            cusName AS name,
            SUM(grandTotal) AS amount
        FROM sales
        WHERE cusName IS NOT NULL 
          AND cusName <> ''
          AND YEAR(salesDate) = ? 
          AND userID = ?
        GROUP BY cusName
        ORDER BY amount DESC
        LIMIT 10
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $year, $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    $customers = [];
    while ($row = $result->fetch_assoc()) {
        $customers[] = [
            'name' => $row['name'],
            'amount' => (float)$row['amount']
        ];
    }
    echo json_encode($customers);
}

$conn->close();