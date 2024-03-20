<?php

$servername="localhost";
$username="root";
$password="";
$database="pratik";

$conn=new mysqli($servername, $username, $password, $database);

if($conn)
{
    echo "you have submitted successfully your feedback kindly go back";
    $value=$_POST["huge1"];
    $sql= "INSERT INTO project (huge) VALUES ('$value')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else {
    echo "failed";
}





