<?php include 'connection.php';  

$employeeID = $_POST['employeeID']; 
$employeeDate = $_POST['employeeDate'];
$employeeTime = $_POST['employeeTime']; 
$employeeIsWorking = $_POST['employeeIsWorking'];  

// echo $employeeID,$employeeTime,$employeeStatus;
// Querry to add the data to our database
$sql = "INSERT INTO `employee_log`(`Employee_ID`, `Employee_Date`, `Employee_Time`, `Employee_Status`) VALUES
 ('$employeeID','$employeeDate','$employeeTime','$employeeIsWorking')";

if (mysqli_query($conn, $sql)) {  
  header('Location: http://localhost/Employee_Attendance/'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 