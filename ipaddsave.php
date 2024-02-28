<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data and perform any other necessary checks

    // Convert the ip to uppercase
    $ip_name = $_POST['ip_name'];

    // Check if the ip already exists
    $sqlCheckExist = "SELECT ID FROM allowed_ips WHERE ip_address = '$ip_name'";
    $resultExist = $conn->query($sqlCheckExist);

    if ($resultExist->num_rows > 0) {
        // IP already exists, handle accordingly (e.g., show an error message)
        $_SESSION['status'] = 'IP already exists';
        $_SESSION['status_code'] = 'error';
        header("Location: ipAddress.php");
        exit();
    } else {
        // IP does not exist, proceed with insertion

        // Insert the uppercase IP into the database
        $sqlInsert = "INSERT INTO allowed_ips (ip_address) VALUES ('$ip_name')";
        if ($conn->query($sqlInsert) === TRUE) {
            header("Location: ipAddress.php");
            $_SESSION['status'] = 'IP added successfully';
            $_SESSION['status_code'] = 'success';
        } else {
            $_SESSION['status'] = 'Error: ' . $conn->error;
            $_SESSION['status_code'] = 'error';
        }

    }
} else {
    // Handle cases where the form wasn't submitted properly
    $_SESSION['status'] = 'Form submission error';
    $_SESSION['status_code'] = 'error';
    header("Location: ipAddress.php");
    exit();
}
?>
