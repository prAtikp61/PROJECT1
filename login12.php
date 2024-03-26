<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];
    $password = $_POST['password'];
    $conn = mysqli_connect('localhost', 'root', '', 'patil');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $loginQuery = "SELECT * FROM regi WHERE username = ? and pass = ?";
    $stmt = $conn->prepare($loginQuery);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $authRes = $stmt->get_result();

    $count = $authRes->num_rows;

    if ($count == 1) {
        // Fetch the row data
        $row = $authRes->fetch_assoc();
        $username = $row["username"]; // Replace 'username' with the actual column name
        $email = $row["email"];
        $contact = $row["contact"];
        $pass = $row["pass"];

        $_SESSION['username'] = $username;
        $_SESSION['pass'] = $pass;
        $_SESSION['email'] = $email;
        $_SESSION['contact'] = $contact;

        echo "<script>alert('Login successfully $username '); window.location.href='final.html';</script>";
        exit(); // Add exit() after redirection to stop further execution
    } else {
        echo "<script>alert('Password Invalid'); window.location.href='login.php';</script>";
        exit(); // Add exit() after redirection to stop further execution
    }

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
