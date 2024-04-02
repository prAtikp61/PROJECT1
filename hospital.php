<?php
session_start();

// Check if the form for X-Ray report is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = $_SESSION['username']; // Assuming $_SESSION['username'] holds the username
    $date = date('Y-m-d', strtotime($_POST['date']));
    $ddate = date('Y-m-d', strtotime($_POST['ddate']));
    $Hname = $_POST["Hname"];   
    $treatment = $_POST["treatment"]; 
    $medications = $_POST["medications"]; 
    $dinstructions = $_POST["dinstructions"]; 
    $follow = $_POST["follow"]; 
    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'patil');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO hospital (name, date, ddate, Hname, treatment, medications, dinstructions, follow) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $date, $ddate ,$Hname, $treatment, $medications, $dinstructions, $follow);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Hospital data uploaded successfully'); window.location.href='final.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);

    exit; // Terminate script execution
}

// HTML and CSS code for the X-Ray report upload form
?>
