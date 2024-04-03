<?php
$nameError = "";
$passwordError = "";

if(isset($_POST['submit'])){
    $username = $_POST['Username'];
    $password = $_POST['password'];

    if(empty($username)){
        $nameError = "Name is Required";
    }
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new mysqli('localhost', 'root', '', 'patil');
        if ($conn->connect_error) {
            throw new Exception('Connection Failed : ' . $conn->connect_error);
        }

        $input_username = $_POST['Username'];
        $input_password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM regi WHERE username = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt->bind_param("s", $input_username);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $stored_password = $row["pass"];

            if ($input_password == $stored_password) {
                $_SESSION['username'] = $input_username;
                $_SESSION['email'] = $row["email"];
                $_SESSION['contact'] = $row["contact"];
                echo "<script>alert('Welcome $name'); window.location.href='final.php';</script>";
                exit();
            } else {
                echo "<script>alert('Invalid password'); window.location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('Username not found');</script>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
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
                <span style="color: red;"><?php echo $nameError ?></span>
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
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>
