<?php
session_start();

session_unset();
session_destroy();
echo "<script>alert('Logged out successfully');</script>"; // Alert before redirection
header('Location: login.php');
exit();
?>
