<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mysql";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn) {
        $name = $_POST["nm"];
        $mob = $_POST["mb"];
        $sql = "INSERT INTO regi (name, mobile) VALUES ('$name', '$mob')";
    }
else{
die(mysqli_error($conn));
}
?>