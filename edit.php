<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new mysqli('localhost', 'root', '', 'patil');
        if ($conn->connect_error) {
            throw new Exception('Connection Failed : ' . $conn->connect_error);
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($_FILES['profile-photo']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['profile-photo']['name'];
            move_uploaded_file($_FILES['profile-photo']['tmp_name'], 'upload/' . $image);
        }

        $stmt = $conn->prepare("UPDATE regi SET username=?, email=?, pass=?, image=? WHERE username=?");
        if (!$stmt) {
            throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("sssss", $name, $email, $password, $image, $_SESSION['username']);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        echo "<script>alert('Edited Successfully'); window.location.href='login.php';</script>";

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
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
