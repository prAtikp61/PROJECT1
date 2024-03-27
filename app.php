<?php
<<<<<<< HEAD
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
=======
try {
    $conn = new mysqli("localhost", "root", "", "patil");
} catch (Exception $e) {
    echo "Server under maintenance";
   
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

  

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE regi SET email = '$email', pass = '$password' WHERE username = '$name'";


    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
>>>>>>> 4f11b53835d764e863c2510c58cc142d06b1143f
} else {
   
    header("Location: form.html");
    exit();
}
?>

