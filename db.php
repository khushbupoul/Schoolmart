<?php
$host = 'localhost';  // Server name
$db   = 'schoolmart'; // Database name
$user = 'root';       // Database username
$pass = '';           // Database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
