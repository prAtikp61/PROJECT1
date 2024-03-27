<?php
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
} else {
   
    header("Location: form.html");
    exit();
}
?>
