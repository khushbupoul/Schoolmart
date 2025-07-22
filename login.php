<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$host = 'localhost';
$db = 'schoolmart';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['password'], $_POST['role'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Determine the table to query based on the selected role
    switch ($role) {
        case 'User':
            $table = 'users';
            break;
        case 'Bookstore':
            $table = 'bookstores';
            break;
        case 'School':
            $table = 'schools';
            break;
        default:
            echo "<p>Invalid role selected. Please try again.</p>";
            exit();
    }

    // Use a prepared statement to safely fetch user data
    $stmt = $conn->prepare("SELECT id, password FROM $table WHERE email = ?");
    if (!$stmt) {
        echo "<p>Error preparing query: " . $conn->error . "</p>";
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify the provided password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            // Redirect based on role
            switch ($role) {
                case 'User':
                    header("Location: /schoolmart2/user/user.html");
                    break;
                case 'Bookstore':
                    header("Location: /schoolmart2/bookstore/bookstore.html");
                    break;
                case 'School':
                    header("Location: /schoolmart2/school/school.html");
                    break;
            }
            exit();
        } else {
            echo "<p>Invalid password. Please try again.</p>";
        }
    } else {
        echo "<p>No account found with that email address.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Please enter email, password, and role.</p>";
}

$conn->close();
?>
