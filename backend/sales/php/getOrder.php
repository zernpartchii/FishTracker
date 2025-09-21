<?php
include '../../db/config.php';

if ($_GET['action'] == 'getOrder') {
    $saleId = $_GET['id'];

    $stmt = $conn->prepare("SELECT s.fishId, CONCAT(f.fishName, ' (', f.fishType, ')') AS fishName, s.qty, s.pcs, s.price FROM sales_items s JOIN fish f ON s.fishId = f.id WHERE s.saleId = ?");
    $stmt->bind_param("s", $saleId);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    echo json_encode($orders);
    exit;
}

if ($_GET['action'] == 'getSale') {
    $saleId = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM `sales` WHERE id = ?;");
    $stmt->bind_param("s", $saleId);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    echo json_encode($orders);
    exit;
}