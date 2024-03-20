<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];

    $errors = array();

    // Server-side validation
    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    // Numeric input validation for age
    if (!is_numeric($age)) {
        $errors["age"] = "Age must be a number";
    }

    // Password strength validation
    if (strlen($password) < 8) {
        $errors["password"] = "Password must be at least 8 characters long";
    }

    // Date format validation
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $birthdate)) {
        $errors["birthdate"] = "Invalid date format. Use YYYY-MM-DD";
    }

    if (count($errors) > 0) {
        // Handle errors, display error messages or redirect back to the form with error messages
        // For simplicity, we'll just print the errors here
        echo "<h2>Form submission failed:</h2>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } else {
        // Process the form data (e.g., save to database, send email)
        // For simplicity, we'll just print a success message here
        echo "<h2>Form submitted successfully!</h2>";
    }
}
?>
