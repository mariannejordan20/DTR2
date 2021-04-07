<?php include 'connection.php'; 
 
$AdminUser = $_POST['AdminUser']; 
$AdminPassword = $_POST['AdminPassword'];   
$AdminFullname = $_POST['AdminFullname'];  

//echo $employeeNumber,$employeeFullNameCaps,$employeeDepartment,$employeePosition,$employeeSex;
// Querry to add the data to our database
$sql = "UPDATE `admin_accounts` SET 
`password`='$AdminPassword',
`fullname`='$AdminFullname' WHERE
`username`= '$AdminUser' ";

if (mysqli_query($conn, $sql)) {  
  header('Location: http://localhost/Employee_Attendance/AdminDashboardAdminAccounts.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 