<?php include 'connection.php';
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
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<!-- Ajax  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- alert plugin sweetalert2  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<title>Employee_Daily_Record</title>
</head> 
<body>
  <div class="containerIndex container border border-secondary mt-5">  
    <p class="companyPosition text-center mt-5 mb-5">COMPANY</p>
    <div class="container">
      <div class="row text-center"> 
        <div class="col-xl-12">   
            <h3><u>Date Today</u></h3> 
            <span class="realDate" id="dateNow" name="dateNow"></span>  
        </div>
        <div class="col-Xl-12">  
        <h3><u>Time</u></h3>   
          <span class="realTime" id="time" name="time"></span>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">  
          <input type="number" id="textBoxUserID" name="textBoxUserID" class="userInputText" placeholder="Enter Employee ID Here" active>
          <input type="text" id="availability" hidden>  
          <input type="text" id="employeeStatus" value="none" hidden>  
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-12">
          <button type="button" id="btnTimeIn" name="btnTimeIn" class="btn-In btn btn-info">TIME-IN</button>
          <button type="button" id="btnTimeOut" name="btnTimeOut" class="btn-Out btn btn-info">TIME-OUT</button> 
    </div>  
  </div>  
  </div> 
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
</body>
</html>