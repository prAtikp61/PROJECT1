<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "project";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $username =$_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please enter your username and password.";
    } else {
    
        $sql = "SELECT * FROM login WHERE username = '$username' ";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc(); 

          
            if ($password === $user['password']) {
     
                session_start(); 
                $_SESSION['user_id'] = $user['username'];  
                echo "Login successful!";
                $loc = " ../project/demoo.php";
                header("Location:" . $loc);
            
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .hii{
            border: 5px solid #db9991;
            display: inline-block;
            padding: 10px;
            position: relative;
            left: 30%;
            top: 100px;
            font-size: 20px;
        }

        button{
            font-size: 20px;
        }

        .helo{
            width: 100px;
            height: 50px;
            border-radius: 10px;
            background-image: linear-gradient(80deg, red,purple);
        }
        
    </style>
</head>
<body>
 
   
    <div class="hii">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post"> 
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input class="helo" type="submit" value="Login">
    </form>
    </div>
</body>
</html>
