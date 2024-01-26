<?php include 'connection.php';
session_start(); 
if(isset($_SESSION["username"])) {
  header("location: AdminDashboard.php");
}
?>
<html> 
<head> 
<!-- CSS only -->
<link rel="stylesheet" href="myStyles/CSS/AdminPortalcssFILE.css"> 
<link rel="stylesheet" href="myStyles/CSS/sb-admin-2.min.css"> 
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> 
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">  
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<!-- Ajax  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<!-- alert plugin sweetalert2  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<title>Admin_Portal</title>
</head> 
<body>    
    <div class="wrapper fadeInDown">
  <div id="formContent"> 
    <!-- Icon -->
      <p class="companyName mt-5"><h1>BIZMATECH</h1></p>
    <!-- Login Form -->  
      <input type="text" id="txtBoxUserName" name="txtBoxUserName" placeholder="Username">  
      <input type="password" id="txtBoxPassword" name="txtBoxPassword" placeholder="Password"> 
      <button type="button" id="btnLogin" name="btnLogin" class="col-lg-6 mt-3 mb-4 btn btn-success">Login</button> 
  </div>
</div> 
<script src="myStyles/JS/adminPortalJS.js"></script>
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
</body>
</html>