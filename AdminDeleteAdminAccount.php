<?php include 'connection.php'; 
 
$AdminUser = $_POST['AdminUser'];  

//echo $employeeNumber,$employeeFullNameCaps,$employeeDepartment,$employeePosition,$employeeSex;
// Querry to add the data to our database
$sql = "DELETE FROM `admin_accounts` WHERE `username` = '$AdminUser' "; 

if (mysqli_query($conn, $sql)) {  
  header('Location: http://localhost/Employee_Attendance/AdminDashboardAdminAccounts.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 