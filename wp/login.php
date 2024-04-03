<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'patil');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }

    // Retrieve username and password from POST data
    $input_username = $_POST['Username'];
    $input_password = $_POST['password'];

    // Prepare and execute SQL query using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM regi WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row["pass"];

        // Verify password using password_verify if passwords are hashed
        if ($input_password == $stored_password) {
            // Password is correct, set session variables
            $_SESSION['username'] = $input_username;
            $_SESSION['email'] = $row["email"];
            $_SESSION['contact'] = $row["contact"];

            // Redirect to final.html upon successful login
            echo "<script>alert('Welcome $name'); window.location.href='final.html';</script>";
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('invalid password'); window.location.href='login.php';</script>";
        }
    } else {
        // Username not found
        echo "<script>alert('Username not found');</script>";
    }

    // Close statement and connection
    $stmt->close();
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
        <form action="login.php" method="post">
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
                <a href="register.php">Signup</a>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>