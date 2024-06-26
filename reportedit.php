<?php
include 'connection.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("location: AdminPortal.php");
}
    
// Check if the password is submitted
if (isset($_POST['passwordlog'])) {
    $enteredPassword = $_POST['passwordlog'];

    // Fetch the admin password from the database
    $sql = "SELECT password FROM admin_accounts WHERE username = '" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $adminPassword = $row['password'];

        // Validate the password
        if ($enteredPassword !== $adminPassword) {
            $_SESSION['status'] = 'Incorrect admin password!';
            $_SESSION['status_code'] = 'error';
            header("location: AdminReportsDaily.php"); // Redirect back to the admin page
            exit();
        }
    } else {
        // Handle the case when the admin account is not found
        $_SESSION['status'] = 'Admin account not found!';
        $_SESSION['status_code'] = 'error';
        header("location: AdminReportsDaily.php");
        exit();
    }
}

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
    header("Location: AdminReportsDaily.php");
    exit();
} else {
    header("Location: AdminReportsDaily.php");
    exit();
}
?>
