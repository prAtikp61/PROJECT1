<?php
session_start();
$username=$_SESSION["user_id"];
echo "welcome $username you have logged in successfully";
?>