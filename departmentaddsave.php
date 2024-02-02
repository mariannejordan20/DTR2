<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data and perform any other necessary checks

    // Convert the dept_name to uppercase
    $dept_name = $_POST['dept_name'];

    // Check if the department already exists
    $sqlCheckExist = "SELECT ID FROM departments WHERE Department = '$dept_name'";
    $resultExist = $conn->query($sqlCheckExist);

    if ($resultExist->num_rows > 0) {
        // Department already exists, handle accordingly (e.g., show an error message)
        $_SESSION['status'] = 'Department already exists';
        $_SESSION['status_code'] = 'error';
        header("Location: AdminDepartment.php");
        exit();
    } else {
        // Department does not exist, proceed with insertion

        // Insert the uppercase dept_name into the database
        $sqlInsert = "INSERT INTO departments (Department) VALUES ('$dept_name')";
        if ($conn->query($sqlInsert) === TRUE) {
            header("Location: AdminDepartment.php");
            $_SESSION['status'] = 'Department added successfully';
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
    header("Location: AdminDepartment.php");
    exit();
}
?>
