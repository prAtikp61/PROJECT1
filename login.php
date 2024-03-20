<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername=$_POST['Localhost']; 
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $conn =mysqli_connect('3306', 'root', 'W7301@jqir#', 'patil');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT * FROM users WHERE Username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
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