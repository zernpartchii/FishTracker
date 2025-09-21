<?php
include '../../db/config.php';

$action = $_POST['action'] ?? '';
$year   = $_POST['year'] ?? date("Y"); // default current year if not provided
$userID = $_POST['userID'] ?? '';

if ($action === 'get_total_sales') {
    /* Get total sales */
    $year = $_POST['year'] ?? date("Y");

    $stmt = $conn->prepare("
        SELECT SUM(grandTotal) as totalSales 
        FROM sales 
        WHERE YEAR(salesDate) = ? AND userID = ?
    ");
    $stmt->bind_param("ii", $year, $userID);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    echo json_encode([
        "year" => $year,
        "totalSales" => $result['totalSales'] ?? 0
    ]);
} elseif ($action === 'get_total_items') {
    /* Get total items */
    $year = $_POST['year'] ?? date("Y");

    $stmt = $conn->prepare("
        SELECT SUM(s.qty * s.pcs) as totalItems
        FROM sales_items s
        JOIN sales sa ON s.saleId = sa.id
        WHERE YEAR(sa.salesDate) = ? AND userID = ?
    ");
    $stmt->bind_param("ii", $year, $userID);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    echo json_encode([
        "year" => $year,
        "totalItems" => $result['totalItems'] ?? 0
    ]);
} elseif ($action === 'get_fish_count') {
    /* Get total fish */
    $result = $conn->query("SELECT COUNT(*) as totalFish FROM fish WHERE userID = $userID");
    $row = $result->fetch_assoc();

    echo json_encode([
        "totalFish" => $row['totalFish'] ?? 0
    ]);
} elseif ($action === 'get_years') {
    /* Get years */
    $years = [];
    $result = $conn->query("SELECT DISTINCT YEAR(salesDate) as year FROM sales WHERE userID = $userID ORDER BY year DESC");
    while ($row = $result->fetch_assoc()) {
        $years[] = $row['year'];
    }
    echo json_encode($years);
} elseif ($action === 'get_monthly_profit') {
    /* Get monthly profit */
    $year = $_POST['year'] ?? date('Y');

    $sql = "
   SELECT MONTH(salesDate) as month, SUM(grandTotal) as profit FROM sales 
   WHERE YEAR(salesDate) = $year AND userID = $userID GROUP BY MONTH(salesDate) ORDER BY MONTH(salesDate);
    ";

    $result = $conn->query($sql);

    $monthlyProfit = array_fill(1, 12, 0); // 12 months, default 0

    while ($row = $result->fetch_assoc()) {
        $monthlyProfit[(int)$row['month']] = (float)$row['profit'];
    }

    echo json_encode([
        "year" => $year,
        "monthlyProfit" => array_values($monthlyProfit) // [Jan..Dec]
    ]);
}




$conn->close();