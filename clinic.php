<?php
session_start();

// Check if the form for X-Ray report is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = $_SESSION['username']; // Assuming $_SESSION['username'] holds the username
    $notes = $_POST["clinicalNotes"];
      
    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'patil');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO clinic (name, notes) VALUES (?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $name, $notes);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('clinical data uploaded successfully'); window.location.href='final.php';</script>";
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
