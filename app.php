<?php
// Database connection
$host = '127.0.0.1:3306';
$username = 'root';
$password = '1234';
$database = 'app';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Hashing the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if a file was uploaded
    if(isset($_FILES['profile-photo'])) {
        $file_tmp = $_FILES['profile-photo']['tmp_name'];
        $file_name = $_FILES['profile-photo']['name'];
        $file_type = $_FILES['profile-photo']['type'];
        $file_size = $_FILES['profile-photo']['size'];
        
        // Read the file contents
        $fp = fopen($file_tmp, 'r');
        $photo_data = fread($fp, filesize($file_tmp));
        fclose($fp);

        // Insert data into the database
        $sql = "INSERT INTO users (name, email, password, photo) VALUES ('$name', '$email', '$hashed_password', '$photo_data')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: No file uploaded";
    }
}
$conn->close();
?>
