<?php
$servername = "localhost";
$db_user = "root";
$password = "";
$database = "patil";

// Create connection
$conn = new mysqli($servername, $db_user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Start the session

// Check if "huge1" is set in $_POST and not empty
if (isset($_POST["huge1"]) && !empty($_POST["huge1"])) {
    $value = $_POST["huge1"];
    // Use $_SESSION['username'] directly
    $username1 = $_SESSION['username']; // Retrieve username from session

    // Check if the feedback already exists for the user
    $check_stmt = $conn->prepare("SELECT * FROM project WHERE huge = ? AND username1 = ?");
    $check_stmt->bind_param("ss", $value, $username1);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "Feedback already submitted. Thank you for your input.";
    } else {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO project (huge, username1) VALUES (?, ?)");
        $stmt->bind_param("ss", $value, $username1);
        try {
            $stmt->execute();
            echo "You have submitted your feedback successfully. Kindly go back.";
            header("Location: feedback.html");
            exit(); // Terminate script execution after redirection
        } catch (mysqli_sql_exception $exception) {
            if ($exception->getCode() === '23000') { // MySQL error code for duplicate entry
                echo "Feedback already submitted. Thank you for your input.";
            } else {
                echo "Error: " . $exception->getMessage();
            }
        }
        $stmt->close();
    }

    $check_stmt->close();
} else {
    echo "Feedback field is empty.";
}

$conn->close();
?>
