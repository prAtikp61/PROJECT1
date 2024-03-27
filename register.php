<?php
$message = ""; // Initialize an empty message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form submitted, process the data
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $PASSWORD = $_POST['password'];

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
        $message = "Username already exists. Please use a different username.";
    } else {
        $sql = "INSERT INTO regi (username, email, contact, pass) VALUES ('$name', '$email', '$contact', '$PASSWORD')";
        if (mysqli_query($conn, $sql)) {
            $message = "Record inserted successfully. Welcome $name";
        } else {
            $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
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
     <form action="" method="post" onsubmit="return validateForm()">
        <h2>Hi Stranger here's What we need</h2>
        <div class="inputBox">
            <input type="text" required="required" id="name" name="name">
            <span>Name</span> 
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

    // Display the alert message when registration is successful
var message = "<?php echo $message; ?>";
if (message !== "") {
    alert(message);
    // Redirect to login.php after alert
    window.location.href = "login12.php";
}



</script>
</body>
</html>
