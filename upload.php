<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "patil";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the MRI file was uploaded
    if (isset($_FILES["mriUpload"]) && $_FILES["mriUpload"]["error"] == 0) {
        $mriData = file_get_contents($_FILES["mriUpload"]["tmp_name"]);
        $sql = "INSERT INTO data (name, mri) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("sb", $name, $mriData);
        $name = $_POST["name"];
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "MRI file uploaded successfully.";
        } else {
            echo "Error uploading MRI file: " . $stmt->error;
        }
        $stmt->close();
    }

    // Repeat the same process for other image types like X-ray, CT, and Blood

    $conn->close();
}
?>
