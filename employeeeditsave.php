<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_employee_id = $_POST['edit_employee_id'];
    $edit_employee_name = $_POST['edit_employee_name'];
    $edit_employee_branch = $_POST['edit_employee_branch'];
    $edit_employee_department = $_POST['edit_employee_department'];
    $edit_employee_position = $_POST['edit_employee_position'];
    $edit_employee_sex = $_POST['edit_employee_sex'];

    $sql = "UPDATE employee_information 
            SET Employee_FullName = '$edit_employee_name', 
                Employee_Branch = '$edit_employee_branch',
                Employee_Department = '$edit_employee_department',
                Employee_Position = '$edit_employee_position',
                Employee_Sex = '$edit_employee_sex'
            WHERE Employee_ID = '$edit_employee_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = "Employee updated successfully";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['status_code'] = "error";
    }

    $conn->close();
    header("Location: try2.php");
    exit();
} else {
    header("Location: try2.php");
    exit();
}
?>
