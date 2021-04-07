<?php include 'connection.php'; 
 
$Employee_ID = $_POST['Employee_ID']; 
$Employee_FullName = $_POST['Employee_FullName'];  
$EmployeeFullNameCaps = strtoupper($Employee_FullName); 
$Employee_Department = $_POST['Employee_Department']; 
$Employee_Position = $_POST['Employee_Position']; 
$Employee_Sex = $_POST['Employee_Sex'];  

//echo $employeeNumber,$employeeFullNameCaps,$employeeDepartment,$employeePosition,$employeeSex;
// Querry to add the data to our database
$sql = "UPDATE `employee_information` SET 
`Employee_FullName`= '$EmployeeFullNameCaps',
`Employee_Department`= '$Employee_Department',
`Employee_Position`= '$Employee_Position',
`Employee_Sex`= '$Employee_Sex' WHERE 
`Employee_ID` = '$Employee_ID' ";

if (mysqli_query($conn, $sql)) {  
  header('Location: http://localhost/Employee_Attendance/AdminDashboardEmployeeAccounts.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 