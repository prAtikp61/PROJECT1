<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = $_POST['Username'];
    $password = $_POST['password'];
    $conn = mysqli_connect('localhost', 'root', '', 'patil');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM registration WHERE name='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password']; // Get the hashed password from the database

        if (password_verify($password, $hashedPassword)) { // Use password_verify to check the hashed password
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="box">
        <span class="borderLine"></span>
        <form action="./login.php" method="post">
            <h2>Sign in</h2>
            <div class="inputBox">
                <input name="Username" type="text" required="required">
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input name="password" type="password" required="required">
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="./forgot.html">Forgot Password</a>
                <a href="registration.html">Signup</a>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
