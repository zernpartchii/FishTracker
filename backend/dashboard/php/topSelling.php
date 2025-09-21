<?php
include '../../db/config.php';

$action = $_POST['action'] ?? '';
$year   = $_POST['year'] ?? date("Y"); // default current year if not provided

if ($action === 'top_fish') {
    $sql = "
        SELECT 
            f.fishName,
            f.fishType,
            COUNT(s.id) AS timesBought,
            SUM(s.qty) AS totalQty,
            SUM(s.pcs) AS totalPcs
        FROM sales_items s
        JOIN fish f ON s.fishId = f.id
        JOIN sales sa ON sa.id = s.saleId
        WHERE YEAR(sa.salesDate) = ?
        GROUP BY f.fishName, f.fishType
        ORDER BY timesBought DESC
        LIMIT 10
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $year);
    $stmt->execute();
    $result = $stmt->get_result();

    $fishes = [];
    while ($row = $result->fetch_assoc()) {
        $fishes[] = [
            'name' => $row['fishName'] . " (" . $row['fishType'] . ")",
            'timesBought' => (int)$row['timesBought'],
            'totalQty' => (int)$row['totalQty'],
            'totalPcs' => (int)$row['totalPcs']
        ];
    }
    echo json_encode($fishes);
} elseif ($action === 'get_total_sales') {
    $year = $_POST['year'] ?? date("Y");

    $stmt = $conn->prepare("
        SELECT SUM(grandTotal) as totalSales 
        FROM sales 
        WHERE YEAR(salesDate) = ?
    ");
    $stmt->bind_param("i", $year);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    echo json_encode([
        "year" => $year,
        "totalSales" => $result['totalSales'] ?? 0
    ]);
}


$conn->close();