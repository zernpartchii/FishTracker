<?php
include '../../db/config.php';

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    $salesDate = $_POST['salesDate'];
    $cusName = $_POST['cusName'];
    $grandTotal = $_POST['grandTotal'];
    $payAmount = $_POST['payAmount'];
    $changeAmount = $_POST['changeAmount'];
    $cart = json_decode($_POST['cart'], true); // cart items sent as JSON

    // Insert into sales table
    $stmt = $conn->prepare("INSERT INTO sales (salesDate, cusName, grandTotal, payAmount, changeAmount) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddd", $salesDate, $cusName, $grandTotal, $payAmount, $changeAmount);

    if ($stmt->execute()) {
        $saleId = $stmt->insert_id;

        // Insert cart items
        $itemStmt = $conn->prepare("INSERT INTO sales_items (saleId, fishId, qty, pcs, price) VALUES (?, ?, ?, ?, ?)");
        foreach ($cart as $item) {
            $itemStmt->bind_param("iiiid", $saleId, $item['fishId'], $item['qty'], $item['pcs'], $item['price']);
            $itemStmt->execute();
        }
        $itemStmt->close();

        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
} elseif ($action === 'read') {
    $result = $conn->query("SELECT * FROM sales ORDER BY id DESC");
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} elseif ($action === 'update') {
    $id = $_POST['id'];
    $salesDate = $_POST['salesDate'];
    $cusName = $_POST['cusName'];
    $grandTotal = $_POST['grandTotal'];
    $payAmount = $_POST['payAmount'];
    $changeAmount = $_POST['changeAmount'];
    $cart = json_decode($_POST['cart'], true);

    // 1. Update sale main table
    $stmt = $conn->prepare("UPDATE sales SET salesDate=?, cusName=?, grandTotal=?, payAmount=?, changeAmount=? WHERE id=?");
    $stmt->bind_param("ssdddi", $salesDate, $cusName, $grandTotal, $payAmount, $changeAmount, $id);
    $success = $stmt->execute();
    $stmt->close();

    if ($success) {
        // 2. Delete old cart items for this sale
        $conn->query("DELETE FROM sales_items WHERE saleId=$id");

        // 3. Insert new cart items
        $itemStmt = $conn->prepare("INSERT INTO sales_items (saleId, fishId, qty, pcs, price) VALUES (?, ?, ?, ?, ?)");
        foreach ($cart as $item) {
            $itemStmt->bind_param("iiiid", $id, $item['fishId'], $item['qty'], $item['pcs'], $item['price']);
            $itemStmt->execute();
        }
        $itemStmt->close();

        echo "success";
    } else {
        echo "error";
    }
} elseif ($action === 'delete') {
    $id = $_POST['id'];

    // Delete items first
    $conn->query("DELETE FROM sales_items WHERE saleId=$id");

    // Delete sale
    $stmt = $conn->prepare("DELETE FROM sales WHERE id=?");
    $stmt->bind_param("i", $id);

    echo $stmt->execute() ? "success" : "error";
    $stmt->close();
}

$conn->close();