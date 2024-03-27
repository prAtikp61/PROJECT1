<?php
$servername = "localhost";
$db_user = "root";
$password = "";
$database = "patil";

$conn = new mysqli($servername, $db_user, $password, $database);

if ($conn) {
    session_start(); // Start the session
    
    // Check if "huge1" is set in $_POST and not empty
    if (isset($_POST["huge1"]) && !empty($_POST["huge1"])) {
        $value = $_POST["huge1"];
        // Use $_SESSION['username'] directly
        $username1 = $_SESSION['username']; // Retrieve username from session
        
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO project (huge, username1) VALUES (?, ?)");
        $stmt->bind_param("ss", $value, $username1);
        if ($stmt->execute()) {
            echo "You have submitted your feedback successfully. Kindly go back.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: 'huge1' is not set or empty in the form submission.";
    }
} else {
    echo "Connection failed";
}
?>
