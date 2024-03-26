<?php
$servername = "localhost";
$USERNAME = "root";
$password = "";
$database = "patil";

$conn = new mysqli($servername, $USERNAME, $password, $database);

if ($conn) {
    session_start(); // Start the session
    $_SESSION['username'] = $username;
    echo "You have submitted your feedback successfully. Kindly go back.";
    
    // Check if "huge1" is set in $_POST
    if (isset($_POST["huge1"])) {
        $value = $_POST["huge1"];
        $username1 = $_SESSION['username']; // Retrieve username from session
        
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO project (huge, username1) VALUES (?, ?)");
        $stmt->bind_param("ss", $value, $username1);
        if ($stmt->execute()) {
            // Insertion successful
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: 'huge1' is not set in the form submission.";
    }
} else {
    echo "Connection failed";
}
?>
