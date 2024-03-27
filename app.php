<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        // Store form data in session variables
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "profile");

        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute SQL statement to insert data
        $sql = "INSERT INTO details (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
        } else {
            throw new Exception("Error: " . $sql . "<br>" . $conn->error);
        }

        // Close database connection
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect user back to the form if accessed directly
    header("Location: form.html");
    exit();
}
?>

