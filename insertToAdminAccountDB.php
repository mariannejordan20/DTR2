<?php include 'connection.php'; 
 
$adminUserName = $_POST['adminUserName']; 
$adminPassword = $_POST['adminPassword']; 
$adminFullName = $_POST['adminFullName']; 
$adminFullNameCaps = strtoupper($adminFullName); 
$userType = $_POST['userType'];  

//echo $employeeNumber,$employeeFullNameCaps,$employeeDepartment,$employeePosition,$employeeSex;
// Querry to add the data to our database
$sql = "INSERT INTO `admin_accounts`(`username`, `password`, `fullname`,`user_type`) VALUES 
('$adminUserName','$adminPassword','$adminFullNameCaps','$userType')";

if (mysqli_query($conn, $sql)) {  
  header('Location: http://localhost/Employee_Attendance/AdminCreateAccountAdmin.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 