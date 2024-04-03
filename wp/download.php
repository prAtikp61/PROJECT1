<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'patil');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }

    // Retrieve username and password from POST data
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Prepare and execute SQL query using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM regi WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row["pass"];

        // Verify password using password_verify if passwords are hashed
        if ($input_password == $stored_password) {
            // Password is correct, set session variables
            $_SESSION['username'] = $input_username;
            $_SESSION['email'] = $row["email"];
            $_SESSION['contact'] = $row["contact"];

            // Redirect to final.html upon successful login
            echo "<script>alert('Welcome $name'); window.location.href='final_download.php';</script>";
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('invalid password'); window.location.href='download.php';</script>";
        }
    } else {
        // Username not found
        echo "<script>alert('Username not found');</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
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
            body {margin-top: 0px;margin-left: 0px;margin-right: 0px;margin-bottom: 0px;}             
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
            <h2>Verify Your Identity</h2>
            <form name="form" method="post" action="download.php" onsubmit="return validateForm()">
                <!-- <div class="form-group">
                    <label for="userid">USER ID</label>
                    <input type="text" name="userid" id="userid" class="uid" disabled>
                </div> -->
    
                <div class="form-group">
                    <label for="username">USER NAME</label>
                    <input type="text" name="username" id="username" >
                    <span id="usernameError" class="error"></span>
                </div>
    
                <!-- <div class="form-group">
                    <label for="useradd">DOCUMENT</label>
                    <select id="country" name="country">
                        <option value="mri">MRI Report</option>
                        <option value="ct">CT Scan</option>
                        <option value="xr">X-Ray Report</option>
                        <option value="br">Blood Report</option>
                    </select>
                </div> -->

                <div class="form-group">
                    <label for="pass">PASSWORD</label>
                    <input type="password" name="password" id="password">
                    <span id="passwordError" class="error"></span>
                </div>
                
                <input type="submit" value="Submit">
            </form>

            <script>
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
                </script>

        </div>
        <div>

        </div>
    
        <div id="map" style="bottom:25px;">

            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
            <script>
            var map = L.map('map').setView([51.505, -0.09], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            var marker;
            
            function onLocationFound(e) {
                var radius = e.accuracy / 2;
            
                if(marker) {
                    map.removeLayer(marker);
                }
            
                marker = L.marker(e.latlng).addTo(map)
                    .bindPopup("You are within " + radius + " meters from this point").openPopup();
            
                L.circle(e.latlng, radius).addTo(map);
            }
            
            function onLocationError(e) {
                alert(e.message);
            }
            
            map.on('locationfound', onLocationFound);
            map.on('locationerror', onLocationError);
            
            map.locate({setView: true, maxZoom: 16});
            </script>
        </div>



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
</html>