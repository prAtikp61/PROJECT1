<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];
    $password = $_POST['password'];
    error_log("Form submitted with username: " . $username, 0);
   
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "patil";

    try {
        $conn = mysqli_connect($servername, $db_username, $db_password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $stmt = $conn->prepare("SELECT * FROM regi WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['pass'])) {
             
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $row['email'];
                $_SESSION['contact'] = $row['contact'];
                echo "<script>alert('Logged in successfully');</script>"; 
            
                header("Location: final.html");
                exit();
            } else {
               
                $message = "Invalid password. Please try again.";
                header("Location: login12.php");
                exit();
            }
        } else {
   
            $message = "User not found. Please check your username.";
            header("Location: login12.php");
            exit();
        }
    } catch (Exception $e) {
        echo "Error: Database not found " . $e->getMessage() . " ";
    } finally {
  
        if (isset($conn)) {
            $conn->close();
            $stmt->close();
        }
    }
} else {
 
    header("Location: login12.php");
    exit();
}
?>
