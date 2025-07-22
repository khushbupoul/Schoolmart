<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status']; // 'Accepted' or 'Rejected'

    // Update the order status in the orders table
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        // Retrieve user_id for notification
        $stmt = $conn->prepare("SELECT user_id FROM orders WHERE id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        // Create a notification message for the user
        $message = ($status === 'Accepted') ? "Your order has been accepted by the bookstore." : "Your order has been rejected by the bookstore.";

        // Insert the notification into the notifications table
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $user_id, $message);
        $stmt->execute();
        $stmt->close();

        echo "Order status updated and user notified.";
    } else {
        echo "Error updating order status: " . $stmt->error;
    }

    $conn->close();
}
?>
