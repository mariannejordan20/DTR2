<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_dept_id = $_POST['edit_dept_id'];
    $edit_dept_name = $_POST['edit_dept_name'];

    $sql = "UPDATE departments SET Department = '$edit_dept_name' WHERE ID = '$edit_dept_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: AdminDepartment.php");
        $_SESSION['status'] = "Department updated successfully";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['status_code'] = "error";
    }

    $conn->close();
    header("Location: AdminDepartment.php");
    exit();
} else {
    header("Location: AdminDepartment.php");
    exit();
}
?>
