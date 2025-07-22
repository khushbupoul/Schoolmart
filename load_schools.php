<?php
include 'db.php';

$sql = "SELECT * FROM schools";
$result = $conn->query($sql);

$schools = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schools[] = $row;
    }
}

echo json_encode($schools);

$conn->close();
?>
