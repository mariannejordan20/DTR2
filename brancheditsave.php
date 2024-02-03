<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_branch_id = $_POST['edit_branch_id'];
    $edit_branch_name = $_POST['edit_branch_name'];

    $sql = "UPDATE branches SET branch = '$edit_branch_name' WHERE ID = '$edit_branch_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: AdminBranch.php");
        $_SESSION['status'] = "Branch updated successfully";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['status_code'] = "error";
    }

    $conn->close();
    header("Location: AdminBranch.php");
    exit();
} else {
    header("Location: AdminBranch.php");
    exit();
}
?>
