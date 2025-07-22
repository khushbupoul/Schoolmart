<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $school_id = $_POST['school_id'];
    $total_cost = $_POST['total_cost'];

    // Create a new order
    $sql = "INSERT INTO orders (user_id, school_id, total_amount) VALUES ('$user_id', '$school_id', '$total_cost')";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;

        // Insert order items
        foreach ($_POST['books'] as $book_id => $quantity) {
            $price = $_POST['prices'][$book_id];
            $sql_item = "INSERT INTO order_items (order_id, book_id, quantity, price) VALUES ('$order_id', '$book_id', '$quantity', '$price')";
            $conn->query($sql_item);
        }
        echo "Order placed successfully!";
    } else {
        echo "Error placing order: " . $conn->error;
    }
}
$conn->close();
?>
