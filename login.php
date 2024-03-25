<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = $_POST['Username'];
    $password = $_POST['password'];
    $conn = mysqli_connect('localhost', 'root', '', 'project');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['username'] = $username;
            header("Location: final.html");
            exit();
        } else {
            echo "Invalid Username or Password.";
        }
    } else {
        echo "Invalid Username or Password.";
    }

    $conn->close();
}
?>
