<?php
// Database connection settings
$host = 'localhost';
$db   = 'schoolmart';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    // Insert based on the role
    if ($role == 'User') {
        // Insert into the 'users' table with the role 'User'
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, 'User')");
        if ($stmt) {
            $stmt->bind_param("sssss", $name, $email, $password, $phone, $address);
            if ($stmt->execute()) {
                echo "User registration successful! <a href='login.html'>Go to Login Page</a>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($role == 'Bookstore') {
        // Insert into the 'bookstores' table
        $stmt = $conn->prepare("INSERT INTO bookstores (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssss", $name, $email, $password, $phone, $address);
            if ($stmt->execute()) {
                echo "Bookstore registration successful! <a href='login.html'>Go to Login Page</a>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($role == 'School') {
        // Insert into the 'schools' table
        $stmt = $conn->prepare("INSERT INTO schools (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssss", $name, $email, $password, $phone, $address);
            if ($stmt->execute()) {
                echo "School registration successful! <a href='login.html'>Go to Login Page</a>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid role selected.";
    }
}

$conn->close();
?>
