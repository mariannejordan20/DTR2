<?php
// AdminReportsDelete.php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming your primary key field is named 'ID'
    $idToDelete = $_POST['idToDelete'];

    // Validate or sanitize $idToDelete if needed

    // Perform the delete operation
    $deleteQuery = "DELETE FROM employee_log WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $idToDelete);
        mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if (mysqli_affected_rows($conn) > 0) {
            // Redirect or send a success response accordingly
            header("Location: AdminReportsDaily.php");
            exit();
        } else {
            // Handle deletion failure
            echo "Error: Unable to delete record.";
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle query preparation failure
        echo "Error: Unable to prepare delete statement.";
    }

    // Close database connection if needed
    mysqli_close($conn);
}
?>
