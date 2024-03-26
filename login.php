<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];
    $password = $_POST['password'];
    error_log("Form submitted with username: " . $username, 0);
    // Database connection
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "patil";
    $conn = mysqli_connect($servername, $db_username, $db_password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the SQL statement to check the username and password
    $stmt = $conn->prepare("SELECT * FROM regi WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['pass'])) {
            // Password is correct, set session variables
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $row['email'];
            $_SESSION['contact'] = $row['contact'];
       
            // Redirect to the final page after successful login
            header("Location: final.html");
            exit();
        } else {
            // Incorrect password
            $message = "Invalid password. Please try again.";
            header("Location: login12.php");
            exit();
        }
    } else {
        // User not found
        $message = "User not found. Please check your username.";
        header("Location: login12.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle cases where form was not submitted
    header("Location: login12.php");
    exit();
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
        <form action="login12.php" method="post">
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
