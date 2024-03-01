<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_ip_id = $_POST['edit_ip_id'];
    $edit_ip_name = $_POST['edit_ip_name'];
    $edit_ip_location = $_POST['edit_ip_location'];

    $sql = "UPDATE allowed_ips SET ip_address = '$edit_ip_name',branch_loc = '$edit_ip_location' WHERE ID = '$edit_ip_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ipAddress.php");
        $_SESSION['status'] = "IP updated successfully";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['status_code'] = "error";
    }

    $conn->close();
    header("Location: ipAddress.php");
    exit();
} else {
    header("Location: ipAddress.php");
    exit();
}
?>
