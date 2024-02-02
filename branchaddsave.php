<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data and perform any other necessary checks

    // Convert the branch_name to uppercase
    $branch_name = $_POST['branch_name'];

    // Check if the branch already exists
    $sqlCheckExist = "SELECT ID FROM branches WHERE Branch = '$branch_name'";
    $resultExist = $conn->query($sqlCheckExist);

    if ($resultExist->num_rows > 0) {
        // Branch already exists, handle accordingly (e.g., show an error message)
        $_SESSION['status'] = 'Branch already exists';
        $_SESSION['status_code'] = 'error';
        header("Location: AdminBranch.php");
        exit();
    } else {
        // Branch does not exist, proceed with insertion

        // Insert the uppercase branch_name into the database
        $sqlInsert = "INSERT INTO branches (Branch) VALUES ('$branch_name')";
        if ($conn->query($sqlInsert) === TRUE) {
            header("Location: AdminBranch.php");
            $_SESSION['status'] = 'Branch added successfully';
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
    header("Location: AdminBranch.php");
    exit();
}
?>
