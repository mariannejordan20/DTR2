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
    $sql = "SELECT password FROM admin_accounts WHERE username = username";
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

// Continue with your existing code for processing log edits
// ...

// Redirect after processing edits
$_SESSION['status'] = 'Changes saved successfully!';
$_SESSION['status_code'] = 'success';
header("location: AdminReportsDaily.php");
exit();
?>
