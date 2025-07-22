<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $bookstore_id = $_POST['bookstore_id'];
    $order_items = $_POST['order_items'];
    $total_amount = $_POST['total_amount'];

    // Insert the order into the orders table with status 'Pending'
    $stmt = $conn->prepare("INSERT INTO orders (user_id, bookstore_id, order_items, total_amount, status, created_at) VALUES (?, ?, ?, ?, 'Pending', NOW())");
    $stmt->bind_param("iisi", $user_id, $bookstore_id, $order_items, $total_amount);

    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error placing order: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
