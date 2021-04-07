<?php
include 'connection.php';

if(isset($_POST["employeeId"])){ 

   $query = "SELECT * FROM `employee_information` WHERE `Employee_ID` = '".$_POST["employeeId"]."'";
   $result = mysqli_query($conn, $query); 

   if(mysqli_num_rows($result) > 0) 
      { 
         echo '<input type="text" id="valid" value="true">';
      }else{
         echo '<input type="text" id="valid" value="false">';
     }  
}
mysqli_close($conn);
?>