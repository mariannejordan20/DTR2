<?php 
<<<<<<< HEAD
$servername = "127.0.0.1";
=======
$servername = "localhost";
>>>>>>> parent of 374c217 (Merge branch 'main' of https://github.com/mariannejordan20/DTR2)
$username = "root";
$password = "";
$dbname = "employee_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  }
//   else {
//     echo'Databse Connected!';
//   } 
?>