<?php
session_start();
include 'connection.php';

if(isset($_POST['username']) && isset($_POST['password'])){ 

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $sql = "SELECT * FROM `admin_accounts` WHERE 
   `username` = '$username' AND `password` = '$password' ";
   $result = mysqli_query($conn, $sql); 
   $row = mysqli_num_rows($result);

   if($row > 0) 
   { 
      $_SESSION["username"] = $username;
      echo "1";
   } 
}
?>
