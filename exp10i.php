<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set session save path and start session
session_save_path('/path/to/session/directory'); // Replace with actual path
session_start();

// Debugging output
var_dump($_SESSION); // Check the entire session array

// Access session variables
$username = $_SESSION['username'] ?? 'Not set';
$email = $_SESSION['email'] ?? 'Not set';

// Use the session variables
echo "Username: $username <br>";
echo "Email: $email <br>";

// Regenerate session ID if there is an active session
if (session_status() === PHP_SESSION_ACTIVE) {
    session_regenerate_id(true);
}
?>
