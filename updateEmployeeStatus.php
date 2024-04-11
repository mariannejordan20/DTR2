<?php
// Check if the status value and employee ID are set and not empty
if (isset($_POST['status']) && isset($_POST['employeeId'])) {
    // Sanitize the status and employee ID values to prevent SQL injection
    $status = intval($_POST['status']); // Convert to integer for safety
    $employeeId = intval($_POST['employeeId']); // Convert to integer for safety

    // Database connection
    include('connection.php'); // Adjust the path as needed

    // SQL query to update the Employee_Status column for a specific employee
    $sql = "UPDATE employee_information SET Employee_Status = ? WHERE Employee_ID = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the status and employee ID parameters
        $stmt->bind_param("ii", $status, $employeeId);

        // Execute the statement
        if ($stmt->execute()) {
            // Update successful
            echo "Employee status updated successfully.";
        } else {
            // Update failed
            echo "Error updating employee status: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // Statement preparation failed
        echo "Error preparing statement: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // Status value or employee ID not set or empty
    echo "Error: Status value or employee ID not provided.";
}
?>
