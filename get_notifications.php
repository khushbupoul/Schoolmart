<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT message, created_at FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

$stmt->close();
$conn->close();

// Display notifications to the user
foreach ($notifications as $notification) {
    echo "<p>" . $notification['message'] . " - " . $notification['created_at'] . "</p>";
}
?>
