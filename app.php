<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $conn = new mysqli("localhost", "root", "", "profile");

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO details (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
        } else {
            throw new Exception("Error: " . $sql . "<br>" . $conn->error);
        }

        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
   
    header("Location: form.html");
    exit();
}
?>

