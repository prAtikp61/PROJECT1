<?php
$message = ""; // Initialize an empty message variable

if (isset($_POST['name'], $_POST['email'], $_POST['contact'], $_POST['password'], $_POST['confirmpassword'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "patil";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO registration (name, email, contact, password, confirmpassword) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $email, $contact, $hashedPassword, $confirmpassword);
        $stmt->execute();
        $message = "Registration done"; // Set the message variable
        $stmt->close();
        $conn->close();
    }
}
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
        window.location.href = "login.php";
    }
</script>
</body>
</html>
