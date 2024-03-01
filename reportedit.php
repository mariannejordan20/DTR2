<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_employee_Id = $_POST['edit_employee_Id'];
    $edit_employee_log1 = $_POST['edit_employee_log1'];
    $edit_employee_log2 = $_POST['edit_employee_log2'];
    $edit_employee_log3 = $_POST['edit_employee_log3'];
    $edit_employee_log4 = $_POST['edit_employee_log4'];

    $sql = "UPDATE logs SET TimeLog1 = '$edit_employee_log1', TimeLog2 = '$edit_employee_log2', TimeLog3 = '$edit_employee_log3', TimeLog4 = '$edit_employee_log4' WHERE id = $edit_employee_Id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ipAddress.php");
        $_SESSION['status'] = "Log updated successfully";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['status_code'] = "error";
    }

    $conn->close();
    header("Location: try.php");
    exit();
} else {
    header("Location: try.php");
    exit();
}
?>
