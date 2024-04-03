<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'patil');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }

    // Retrieve username and password from POST data
     $input_username = $_SESSION['username'];
    // $input_password = $_POST['password'];
        $input_document = $_POST['report'];


    if($input_document == 'mri') 
    {
        // Prepare and execute SQL query using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT {$input_document} FROM doc WHERE username = ?");
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch image data
            $row = $result->fetch_assoc();
            $imageData = $row['mri'];
        
            // Set appropriate headers to specify that the content is an image
            header("Content-type: image/png"); // Adjust content-type based on the image type
        
            // Output the image data
            echo $imageData;
        } else {
            echo "Image not found.";
        }   
    }

    elseif($input_document == 'ct') 
    {
        // Prepare and execute SQL query using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT {$input_document} FROM ct WHERE username = ?");
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch image data
            $row = $result->fetch_assoc();
            $imageData = $row['ct'];
        
            // Set appropriate headers to specify that the content is an image
            header("Content-type: image/png"); // Adjust content-type based on the image type
        
            // Output the image data
            echo $imageData;
        } else {
            echo "Image not found.";
        }   
    }

    elseif($input_document == 'xr') 
    {
        // Prepare and execute SQL query using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT {$input_document} FROM xr WHERE username = ?");
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch image data
            $row = $result->fetch_assoc();
            $imageData = $row['xray'];
        
            // Set appropriate headers to specify that the content is an image
            header("Content-type: image/png"); // Adjust content-type based on the image type
        
            // Output the image data
            echo $imageData;
        } else {
            echo "Image not found.";
        }   
    }

    elseif($input_document == 'br') 
    {
        // Prepare and execute SQL query using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT {$input_document} FROM bpr WHERE username = ?");
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch image data
            $row = $result->fetch_assoc();
            $imageData = $row['bpr'];
        
            // Set appropriate headers to specify that the content is an image
            header("Content-type: image/png"); // Adjust content-type based on the image type
        
            // Output the image data
            echo $imageData;
        } else {
            echo "Image not found.";
        }   
    }


    // Close statement and connection
    $stmt->close();
    $conn->close();

    // if (isset($_GET['image_id'])) {
    //     $sql = "SELECT imageType,imageData FROM tbl_image WHERE imageId=?";
    //     $statement = $conn->prepare($sql);
    //     $statement->bind_param("i", $_GET['image_id']);
    //     $statement->execute() or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_connect_error());
    //     $result = $statement->get_result();
    
    //     $row = $result->fetch_assoc();
    //     header("Content-type: " . $row["imageType"]);
    //     echo $row["imageData"];
    // }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="navbar.css"> 
        <link rel="stylesheet" href="download.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <style>
            body {margin-left: 0px;margin-right: 0px;margin-bottom: 0px;}             
        </style>
        <title>Download Documents</title>
    </head>
    <body>

        <ul>
            <li href="landing.html"><img src="./logo.png"></li>
            <li><a class="active" href="landing.html" font="Raleway">Home</a></li>
            <li><a href="#compare">Compare Reports</a></li>
            <li><a href="#Why us">Why us</a></li>
            <li><a href="#Feedback">Feedback</a></li>
            <li><a href="#about">About Us</a></li>
        </ul>
            
        <div class="container" style="position: relative; bottom: 100px;">
            <h2>Download Document Form</h2>
            <form name="form" method="post" action="final_download.php" onsubmit="return validateForm()">
                <!-- <div class="form-group">
                    <label for="userid">USER ID</label>
                    <input type="text" name="userid" id="userid" class="uid" disabled>
                </div> -->
    
                <!-- <div class="form-group">
                    <label for="username">USER NAME</label>
                    <input type="text" name="username" id="username" >
                    <span id="usernameError" class="error"></span>
                </div> -->
    
                <div class="form-group">
                    <label for="useradd">DOCUMENT TYPE</label>
                    <select id="country" name="report">
                        <option value="mri">MRI Report</option>
                        <option value="ct">CT Scan</option>
                        <option value="xr">X-Ray Report</option>
                        <option value="br">Blood Report</option>
                    </select>
                </div>

                <!-- <div class="form-group">
                    <label for="pass">PASSWORD</label>
                    <input type="password" name="password" id="password">
                    <span id="passwordError" class="error"></span>
                </div> -->
                
                <input type="submit" value="Download">
            </form>

            <!-- <script>
                function validateForm() {
                    // Resetting previous error messages
                    document.getElementById("usernameError").textContent = "";
                    document.getElementById("passwordError").textContent = "";
                
                    var username = document.getElementById("username").value;
                    var password = document.getElementById("password").value;
                
                    var isValid = true;
                
                    if (username === "") {
                        
                        document.getElementById("usernameError").textContent = "Username is required";
                        isValid = false;
                    }
                
                    if (password === "") {
                        
                        document.getElementById("passwordError").textContent = "Password is required";
                        isValid = false;
                    }
                
                    // Additional validation logic can be added here
                
                    return isValid;
                }
                </script> -->

        </div>
        <div>
                
        <img src="display_image.php" >
        </div>

    <footer>
        <div class="footer">
            <div class="list">
              <div class="l1">
                  <p class="txt">Patient portal login</p>
                  <p>Online bill payment</p>
                  <p>Prescription refill request</p>
                  <p>MRI</p>
              </div>
              <div class="l2">
                  <p class="txt">Blogs</p>
                  <p>Testimonials</p>
                  <p>Services</p>
                  <p>Patent Products</p>
              </div>
              <div class="l3"><p></p>
                  <p class="txt">Disclaimer</p>
                  <p>Testimonials</p>
                  <p>Privacy Policy</p>
                  <p>Terms &amp; Services</p>
              </div>
              <div class="l4">
                  <p class="txt">Contact us</p>
                  <p>digiHealth@gmail.com</p>
                  <p>987654321</p>
                  <p>123456789</p>
              </div>
            </div>
          </div>
    </footer>

    <script>
            window.onload = function() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "getData.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById("output").innerHTML = response.data;
                }
            };
            xhr.send();
        };
    </script>

</body>
</html>