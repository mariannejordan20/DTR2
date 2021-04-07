<?php include 'connection.php'; 
 
$employeeNumber = $_POST['employeeNumber']; 
$employeeFullName = $_POST['employeeFullName']; 
$employeeFullNameCaps = strtoupper($employeeFullName); 
$employeeDepartment = $_POST['employeeDepartment']; 
$employeePosition = $_POST['employeePosition']; 
$employeeSex = $_POST['employeeSex'];  
$userType = $_POST['userType'];

//echo $employeeNumber,$employeeFullNameCaps,$employeeDepartment,$employeePosition,$employeeSex;
// Querry to add the data to our database
$sql = "INSERT INTO `employee_information`(`Employee_ID`, `Employee_FullName`, `Employee_Department`, `Employee_Position`, `Employee_Sex`,`user_type`) VALUES 
('$employeeNumber','$employeeFullNameCaps','$employeeDepartment','$employeePosition','$employeeSex','$userType')";

if (mysqli_query($conn, $sql)) {  
  header('Location: http://localhost/Employee_Attendance/AdminCreateAccountEmployee.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 