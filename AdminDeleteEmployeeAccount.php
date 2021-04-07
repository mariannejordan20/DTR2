<?php include 'connection.php'; 
 
$EmployeeDelete_ID = $_POST['EmployeeDelete_ID'];  

//echo $employeeNumber,$employeeFullNameCaps,$employeeDepartment,$employeePosition,$employeeSex;
// Querry to add the data to our database
$sql = "DELETE FROM `employee_information` WHERE `Employee_ID` = '$EmployeeDelete_ID' "; 

if (mysqli_query($conn, $sql)) {  
  header('Location: http://localhost/Employee_Attendance/AdminDashboardEmployeeAccounts.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 