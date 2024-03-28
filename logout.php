<?php
session_start();

session_unset();
session_destroy();
echo "<script>alert('logged out successful'); window.location.href='login.php';</script>";
exit();
?>
