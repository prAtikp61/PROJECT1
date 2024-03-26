<?php
session_start();

// Check if the form for MRI report is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['some'])) {
    $mri = $_FILES['some'];
    $username = $_SESSION['username']; // Assuming you have stored the username in the session
    
    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'patil');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement with a placeholder for the binary data
    $sql = "INSERT INTO doc  (username, mri, ct, blood, xray) VALUES (?, ?, NULL, NULL, NULL)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $username, $mriFileData);

    // Get binary data from the uploaded file
    $mriFileData = file_get_contents($mri['tmp_name']);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('MRI report uploaded successfully'); window.location.href='final.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);

    exit; // Terminate script execution
}

// Repeat similar code blocks for other document types (CT-Scan, Blood Report, X-Ray Report)
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="add.css" rel="stylesheet">
    <title>Add Documents</title>
    <style>
         body {
         height: 100vh;
         background-image: linear-gradient(0deg, #9DBC98, #EBD9B4);
         background-position: center;
         background-repeat: no-repeat;
         background-size: contain;
         margin: 0;
         padding: 0;
        }

        .anton-regular {
        font-family: "Anton", sans-serif;
        font-weight: 400;
        font-style: normal;
        color: #294B29;
        }


        .huge{  
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-around;
            gap: 10px;
        
        }

        p{
            font-family: Arial, Helvetica, sans-serif;
            color: #294B29;
        }

        .mri{ 
            position: relative;
            top: 30px;
            left: 10px;
            background:rgba(0, 181, 204,0.3);
            border:7px solid #294B29;
            border-radius: 10px;
            width: 420px;
            height: 350px;
            padding: 1rem;
        }
        
       
        .ct{
            position: relative;
            top: 30px;
            background:rgba(0, 181, 204,0.3);  
            width: 400px;
            height: 180px;
            border: 7px solid #294B29;
            border-radius: 10px;            
        }
           

        .bp{
            position: relative;
            top: 30px;
            height: 180px;
            width: 400px;
            background:rgba(0, 181, 204,0.3);
            border: 7px solid #294B29;
            border-radius: 10px;
            right: 10px;
        }
        .xr{
            height: 180px;
            width: 400px;
            background:rgba(0, 181, 204,0.3);
            position: relative;
            top: 30px;
            left: 10px;
            border: 7px solid #294B29;
            border-radius: 10px;
        }
        .history{
            position: relative;
            top: 30px;
            height: 180px;
            width: 400px;
            background:rgba(0, 181, 204,0.3);
            border: 7px solid #294B29;
            border-radius: 10px;
           

        }

        .wr{
            padding: 10px;   
        }
      
        .x1::-webkit-file-upload-button{
            visibility: hidden;
        }

        .custom-file-label,.custom-file-input ,.x1{
          
            position: relative;
            left: 100px;
            background-color: #6eb364;
            width: 200px;
            height:30px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        .patient{
            height: 180px;
            width: 400px;
            background:rgba(0, 181, 204,0.3);
            position: relative;
            top: 30px;
            border: 7px solid #294B29;
            border-radius: 10px;
            right: 10px;

        }

        .do1{
            height: 180px;
            width: 400px;
            background:rgba(0, 181, 204,0.3);
            position: relative;
            top: 30px;
            border: 7px solid #294B29;
            left: 10px;
        }

        button{
            background-color: #6eb364;
            color: #204b20;
            border: none;
            padding: 10px 20px;
            left: 145px;
            border-radius: 3px;
            cursor: pointer;
            position: relative;
        }

        .button1{
            background-color: #6eb364;
            color: #204b20;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            position: relative;
            left: 167px;
            
        }

        button:hover{
            background-color: #45a049;
        }

        .do2 {
            height: 180px;
            width: 400px;
            background:rgba(0, 181, 204,0.3);
            position: relative;
            top: 30px;
            border: 7px solid #294B29;
            border-radius: 10px;
            left: 1px;

        }
        .custom-file-input {
            visibility: hidden;
            width: 0;
            height: 0;
        }
        .custom-file-label {
            display: inline-block;
            background-color: #6eb364;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font: arial;
          
        }
        
        .custom-file-label:hover{
            background-color: #45a049;
        }

        .custom-file-label::after {
            content: 'Select File';
            color: #294B29;
        }

        li{
            list-style-type: none; 
        }
        .in{
            position: relative;
            left: -50px;
            bottom: 25px;
        }
        .custom-file-label{
            margin-top: 2rem;
        }
        .huge{
            padding-top: 7rem;
            padding-left: 3rem;
        }
    </style>
    </head>
    <body>
        <nav class="main-menu">
            <ul>
                <li class="has-subnav">
                    <a href="mri.html">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                           MRI Reports
                        </span>
                    </a>
                  
                </li>
                <li class="has-subnav">
                    <a href="ct.html">
                        <i class="fa fa-globe fa-2x"></i>
                        <span class="nav-text">
                            CT-Scan Reports
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="bpr.html">
                       <i class="fa fa-comments fa-2x"></i>
                        <span class="nav-text">
                            Blood Reports
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="xr.html">
                       <i class="fa fa-camera-retro fa-2x"></i>
                        <span class="nav-text">
                            X-Ray Reports
                        </span>
                    </a>
                   
                </li>
                <li>
                   <a href="addinsurance.html">
                       <i class="fa fa-cogs fa-2x"></i>
                        <span class="nav-text">
                            Insurance Information
                        </span>
                    </a>
                </li>
                <li>
                   <a href="medinfo.html">
                        <i class="fa fa-map-marker fa-2x"></i>
                        <span class="nav-text">
                            Patient Information Form
                        </span>
                    </a>
                </li>
                <li>
                    <a href="medinfo.html">
                       <i class="fa fa-info fa-2x"></i>
                        <span class="nav-text">
                            Medical History Form
                        </span>
                    </a>
                </li>
                <li>
                    <a href="clinic.html">
                       <i class="fa fa-info fa-2x"></i>
                        <span class="nav-text">
                            Clinical Notes
                        </span>
                    </a>
                </li>
                <li>
                    <a href="hospital.html">
                       <i class="fa fa-info fa-2x"></i>
                        <span class="nav-text">
                            Hospital Treatment Information
                        </span>
                    </a>
                </li>                        
            </ul>
    
            <ul class="logout">
                <li>
                   <a href="#">
                         <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>  
            </ul>
        </nav>
        
        <section class="huge">
            <div  class="mri do">
                <h1 class="wr anton-regular" align="center" >MRI REPORTS</h1>
                <p>MRI, or Magnetic Resonance Imaging, is a non-invasive medical imaging technique used to produce detailed images of the body's internal structures. At our health-related website, we offer MRI services to our patients, providing them with accurate diagnostic information to aid in their treatment and care.</p>
            
                <form enctype="multipart/form-data" action="mri.php" method="post">
                    <div class="in">
                    <ul>
                    <li>
                    <label for="fileUpload" class="custom-file-label"></label>
                    </li>
                    <li>
                    <input type="file" name="some" id="fileUpload" class="custom-file-input">
                    </li>
                    <li>
                    <button class="button1" type="submit">Upload</button>
                    </li>
                    </ul>
                    </div>
                </form>
            </div>
        </section>

    </body>
    <script>
          document.getElementById('fileUpload').addEventListener('change', function () {
                var fileName = this.files[0].name;
                var label = document.querySelector('.custom-file-label');
                label.innerHTML = fileName;
            });
    </script>
    </html> 