<?php
$nameError = $emailError = $contactError = $passwordError = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form submitted, process the data
    
    // Server-side validation
    $name = $_POST['name'];
    if (!preg_match("/^[a-zA-Z]+$/", $name)) {
        $nameError = "Name should contain only alphabetic characters.";
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format.";
        } else {
            $contact = $_POST['contact'];
            if (!preg_match("/^[0-9]{10}$/", $contact)) {
                $contactError = "Contact number should be exactly 10 digits long.";
            } else {
                $PASSWORD = $_POST['password'];
                if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $PASSWORD)) {
                    $passwordError = "Password should contain at least one letter, one number, and be at least 8 characters long.";
                } else {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "patil";
                    $conn = mysqli_connect($servername, $username, $password, $database);
                    if ($conn->connect_error) {
                        die('Connection Failed : ' . $conn->connect_error);
                    } 

                    $sql_check_username = "SELECT * FROM regi WHERE username = '$name'";
                    $result_check_username = mysqli_query($conn, $sql_check_username);

                    if (mysqli_num_rows($result_check_username) > 0) {
                        $nameError = "Username already exists. Please use a different username.";
                    } else {
                        $sql = "INSERT INTO regi (username, email, contact, pass) VALUES ('$name', '$email', '$contact', '$PASSWORD')";
                        if (mysqli_query($conn, $sql)) {
                            echo "<script>alert('Record inserted successfully. Welcome $name'); window.location.href='login.php';</script>";

                        } else {
                            $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }

                    mysqli_close($conn);
                }
            }
        }
    }
} else {
    // Form not submitted, do nothing or handle as needed
}

// Rest of your PHP code...
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="box">
     <span class="borderLine"></span> 
     <form action="new11.php" method="post" onsubmit="return validateForm()">
        <h2>Hi Stranger here's What we need</h2>
        <div class="inputBox">
            <input type="text" required="required" id="name" name="name">
            <span>Name</span> 
            <?php if ($nameError !== ""): ?>
                <span style="color: red;"><?php echo $nameError ?></span>
            <?php endif; ?>
            <i></i>
        </div>
        <div class="inputBox">
            <input type="text" required="required" id="email" name="email">
            <span>Email.id</span> 
            <i></i>
        </div>
        <div class="inputBox">
            <input type="text" required="required" id="contact" name="contact">
            <span>Contact no.</span> 
            <i></i>
        </div>
        <div class="inputBox">
            <input type="text" required="required" id="password" name="password">
            <span>Password</span> 
            <i></i>
        </div>
        <div class="inputBox">
            <input type="password" required="required" id="confirmpassword" name="confirmpassword">
            <span>Confirm Password</span> 
            <i></i>
        </div>
        <input type="submit" value="Register">
        <input type="button" value="Back" onclick="history.back()">
     
    </form>
   
</div>

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmpassword").value;

        if (password !== confirmPassword) {
            alert("Passwords do not match");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
</body>
</html>