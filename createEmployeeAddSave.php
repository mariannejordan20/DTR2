<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data and perform any other necessary checks

    $employeeNumber = $_POST['employeeNumber'];
    $employeeFullName = strtoupper($_POST['employeeFullName']);
    $employeeDepartment = $_POST['employeeDepartment'];
    $employeeBranch = $_POST['employeeBranch'];
    $employeePosition = $_POST['employeePosition'];
    $employeeSex = $_POST['employeeSex'];
    $userType = $_POST['userType'];

    // Check if the employee number already exists
    $checkSql = "SELECT * FROM `employee_information` WHERE `Employee_ID` = '$employeeNumber'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // Employee number already exists, set an error message
        $_SESSION['status'] = 'Error: Employee number already exists';
        $_SESSION['status_code'] = 'error';
        header("Location: AdminCreateAccountEmployee.php");
        exit();
    }

    // Employee number doesn't exist, proceed with the insertion
    $sql = "INSERT INTO `employee_information` (`Employee_ID`, `Employee_FullName`, `Employee_Branch`, `Employee_Department`, `Employee_Position`, `Employee_Sex`, `user_type`) VALUES 
    ('$employeeNumber', '$employeeFullName', '$employeeBranch', '$employeeDepartment', '$employeePosition', '$employeeSex', '$userType')";

    if ($conn->query($sql) === TRUE) {
        // Employee account added successfully
        $_SESSION['status'] = 'Employee Account Added successfully';
        $_SESSION['status_code'] = 'success';
        header("Location: AdminCreateAccountEmployee.php");
        exit();
    } else {
        // Error occurred during insertion
        $_SESSION['status'] = 'Error: ' . $conn->error;
        $_SESSION['status_code'] = 'error';
        header("Location: AdminCreateAccountEmployee.php");
        exit();
    }
} else {
    // Handle cases where the form wasn't submitted properly
    $_SESSION['status'] = 'Form submission error';
    $_SESSION['status_code'] = 'error';
    header("Location: AdminCreateAccountEmployee.php");
    exit();
}
?>
