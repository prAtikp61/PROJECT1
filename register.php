<?php
if (isset($_POST['name'], $_POST['email'], $_POST['contact'], $_POST['password'], $_POST['confirmpassword'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $conn = new mysqli('localhost', 'root', '', 'project0');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO registration (name, email, contact, password, confirmpassword) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $email, $contact, $password, $confirmpassword);
        $stmt->execute();
        echo "Registration Done Successfully....";
        $stmt->close();
        $conn->close();
    }
}
?>
