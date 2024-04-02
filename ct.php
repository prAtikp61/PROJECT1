<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['some'])) {
    $xray = $_FILES['some'];
    $username = $_SESSION['username']; 
    
  
    $conn = mysqli_connect('localhost', 'root', '', 'patil');


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $sql = "INSERT INTO ct (username, ct) VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

   
    mysqli_stmt_bind_param($stmt, "ss", $username, $xrayFileData);

    $xrayFileData = file_get_contents($xray['tmp_name']);

    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('ct-scan report uploaded successfully'); window.location.href='final.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

  
    mysqli_stmt_close($stmt);

  
    mysqli_close($conn);

    exit;
}


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
            width: 400px;
            height: 180px;
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
        .huge{
            padding-top: 7rem;
            padding-left: 3rem
        }
        .custom-file-label{
            margin-top: 2rem;
        }
        .ct{
            height: 400px;
            padding: 1rem;
        }
        .back-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    position: relative;
    left: 1350px;
    top: 30px;
 

}

.back-btn:hover {
    background-color: #0056b3;
}
    </style>
    </head>
    <body>  <a href="add.html" class="back-btn">Back</a> 
        <nav class="main-menu">
            <ul>
                <li class="has-subnav">
                    <a href="mri.php">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                           MRI Reports
                        </span>
                    </a>
                  
                </li>
                <li class="has-subnav">
                    <a href="ct.php">
                        <i class="fa fa-globe fa-2x"></i>
                        <span class="nav-text">
                            CT-Scan Reports
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="bpr.php">
                       <i class="fa fa-comments fa-2x"></i>
                        <span class="nav-text">
                            Blood Reports
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="xr.php">
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
            <div  class="ct do">
                <h1 class="wr anton-regular" align="center" >CT-SCAN REPORTS</h1>
                <p>At our health-related website, we provide advanced CT (Computed Tomography) scanning services to assist in accurate diagnosis and treatment planning for our patients. Our state-of-the-art CT scanners produce detailed cross-sectional images of the body, enabling healthcare providers to visualize internal structures with exceptional clarity.</p>
                <form enctype="multipart/form-data" action="ct.php" method="post">
                    <div class="in">
                    <ul>
                    <li>
                    <label for="fileUpload" class="custom-file-label"></label>
                    </li>
                    <li>
                    <input type="file" id="fileUpload" name="some" class="custom-file-input">
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