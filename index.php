<?php 
  include 'connection.php';
?>
<html> 
<head> 
<!-- CSS only -->
<link rel="stylesheet" href="myStyles/CSS/indexCSSFile.css"> 
<link rel="stylesheet" href="myStyles/CSS/sb-admin-2.min.css"> 
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="myStyles/CSS/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">  
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<!-- Ajax  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- alert plugin sweetalert2  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>
    body {
      background-color:#eeeeee;
      background-repeat: no-repeat; /* Prevents the image from repeating */
      background-attachment: fixed; /* Fixes the background when scrolling */
      font-family: 'Nunito', sans-serif; /* Use a suitable font-family for your text */
      display: flex;
      align-items: center;
      min-height: 100vh;
    }
    .compName{
        color: #ff3c00;
    }
    h3{
        color: aliceblue;
    }
    .realDate{
        color: aliceblue;
    }
    .realTime{
        color: aliceblue;
    }
    .userInputText {
      width: 80%;
      padding: 8px; /* Adjust padding for a smaller size */
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
      font-size: 14px; /* Adjust font size for a smaller size */
      transition: border-color 0.3s ease-in-out;
      box-sizing: border-box; /* Include padding and border in the total width/height */
    }
    .custom-container {
      background-color: rgba(0, 0, 0, 0.5); /* White background with 0.8 opacity */
      border: 1px solid #dc3545; /* Red border color */
      border-radius: 10px; /* Rounded corners */
      padding: 20px; /* Padding around the container */
      margin-top: 20px; /* Adjust as needed */
    }
    .buttons {
      background-color: #09a121 !important; /* Background color */
      color: white; /* Text color */
      padding: 10px 15px; /* Adjust padding for a smaller size */
      font-size: 14px; /* Adjust font size for a smaller size */
      border: none; /* Remove border */
      border-radius: 5px; /* Rounded corners */
      cursor: pointer;
      transition: background-color 0.2s ease-in-out, color 0.3s ease-in-out;
    }
  .buttons:hover {
    background-color: whitesmoke !important; /* Hover background color */
    color: black !important; /* Hover text color */
  }.buttons2 {
      background-color: #ff3c00 !important; /* Background color */
      color: white; /* Text color */
      padding: 10px 15px; /* Adjust padding for a smaller size */
      font-size: 14px; /* Adjust font size for a smaller size */
      border: none; /* Remove border */
      border-radius: 5px; /* Rounded corners */
      cursor: pointer;
      transition: background-color 0.2s ease-in-out, color 0.3s ease-in-out;
    }
  .buttons2:hover {
    background-color: whitesmoke !important; /* Hover background color */
    color: black !important; /* Hover text color */
  }
  

  </style>
<title>Employee_Daily_Record</title>
</head> 
<body>
    <div class="containerIndex container mt-5 container mx-auto text-center">
        <div class="compLogo text-center mt-5 mb-5">
            <img src="Images/circlelogo.png" alt="BIZMATECH Logo" style="width: 20%;">
        </div>
        <div class="container">
        <div class="row text-center">
            <div class="col-xl-6 mx-auto">
                <span class="realDate" id="dateNow" name="dateNow" style="font-size: 30px; color: #000000;"></span>
                <hr>
                <span class="realTime" id="time" name="time" style="font-size: 30px; color: #000000;"></span>
            </div>
        </div>

            <div class="row text-center">
                <div class="col-xl-6 mx-auto">
                    <input type="number" id="textBoxUserID" name="textBoxUserID" class="userInputText" placeholder="Enter Employee ID Here" active>
                    <input type="text" id="availability" hidden>
                    <input type="text" id="employeeStatus" value="none" hidden>
                </div>
            </div>
           
            <!-- <div class="row text-center mb-3">
                <div class="col-lg-3 mx-auto">
                    <button type="button" id="btnTimeIn1" name="btnTimeIn1" class="btn btn-In buttons btn-sm">Morning In</button>
                
                    <button type="button" id="btnTimeOut1" name="btnTimeOut1" class="btn btn-Out buttons btn-sm">Morning Out</button>
                
                    <button type="button" id="btnTimeIn2" name="btnTimeIn2" class="btn btn-In buttons btn-sm">Afternoon In</button>
                
                    <button type="button" id="btnTimeOut2" name="btnTimeOut2" class="btn btn-Out buttons btn-sm">Afternoon Out</button>
                </div>
            </div> -->
        </div>
    </div>
    <div class="container mx-auto">
        <div class="row text-center mb-1" style="margin-left: 32%;">
            <div class="col-sm-3">
            <button type="button" id="btnTimeIn1" name="btnTimeIn1" class="btn buttons btn-block">Morning (IN)</button>
            </div>
            <div class="col-sm-3">
            <button type="button" id="btnTimeOut1" name="btnTimeOut1" class="btn buttons2 btn-block">Morning (OUT)</button>
            </div>
        </div>
        <div class="row text-center" style="margin-left: 32%;">
            <div class="col-sm-3">
            <button type="button" id="btnTimeIn2" name="btnTimeIn2" class="btn buttons btn-block">Afternoon (IN)</button>
            </div>
            <div class="col-sm-3">
            <button type="button" id="btnTimeOut2" name="btnTimeOut2" class="btn buttons2 btn-block">Afternoon (OUT)</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get current time
            var currentTime = new Date();
            var currentHour = currentTime.getHours();
            
            // Disable Morning In and Morning Out buttons if current time is between 12:00 AM and 12:00 PM
            if (currentHour >= 0 && currentHour < 12) {
                document.getElementById("btnTimeIn2").disabled = true;
                document.getElementById("btnTimeOut2").disabled = true;
            } else {
                document.getElementById("btnTimeIn2").disabled = false;
                document.getElementById("btnTimeOut2").disabled = false;
            }
        });
    </script>

  <script src="myStyles/JS/indexJS.js"></script>
  <script src="myStyles/JS/dntJS.js"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="myStyles/JS/jquery.min.js"></script>
    <script src="myStyles/JS/bootstrap.bundle.min.js"></script>  
    <!-- Core plugin JavaScript-->
    <script src="myStyles/JS/jquery.easing.min.js"></script> 
    <!-- Custom scripts for all pages-->
    <script src="myStyles/JS/sb-admin-2.min.js"></script> 
    <!-- Page level plugins -->
    <script src="myStyles/JS/Chart.min.js"></script>
    <script src="myStyles/JS/all.min.js"></script> 
    <!-- Page level custom scripts -->
    <script src="myStyles/JS/chart-area-demo.js"></script>
    <script src="myStyles/JS/chart-pie-demo.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  
    
</body>
</html>


