<?php
session_start();

// Check if the form for X-Ray report is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = $_SESSION['username']; // Assuming $_SESSION['username'] holds the username
    $conditions = $_POST["condition"];
    $allergys = $_POST["allergy"];
    $familys = $_POST["family"];   
    $signs = $_POST["sign"]; 
    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'patil');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO medinfo (name, conditions, allergy, family, sign) VALUES (?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssss", $name, $conditions, $allergys ,$familys, $signs);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Insurance data uploaded successfully'); window.location.href='final.php';</script>";
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
