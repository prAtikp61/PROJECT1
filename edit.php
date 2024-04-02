<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'patil');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password =$_POST['password'];

    // Handle image upload
    $image = ''; // Placeholder for image filename
    if ($_FILES['profile-photo']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['profile-photo']['name'];
        move_uploaded_file($_FILES['profile-photo']['tmp_name'], 'upload/' . $image); // Move uploaded file to appropriate location
    }

    // Prepare and execute SQL query to update user profile
    $stmt = $conn->prepare("UPDATE regi SET username=?, email=?, pass=?, image=? WHERE username=?");
    $stmt->bind_param("sssss", $name, $email, $password, $image, $_SESSION['username']);
    if ($stmt->execute()) {
        echo "<script>alert('Edited Succesfully'); window.location.href='login.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, display the form
    // You can customize this part to display the current user information in the form for editing
    // For example, you can fetch the user's information from the session variables
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $_SESSION['username']; ?>"><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>"><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password"><br><br>
        <label for="profile-photo">Profile Photo:</label>
        <input type="file" name="profile-photo"><br><br>
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
<?php
}
?>
