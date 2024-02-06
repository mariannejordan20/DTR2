<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['employeeId'])) {
        $employeeId = $_POST['employeeId'];

        // Delete branch from database
        $sql = "DELETE FROM employee_information WHERE Employee_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $employeeId);

        if ($stmt->execute()) {
            // Success
            echo "Branch deleted successfully";
        } else {
            // Error
            echo "Error deleting branch: " . $conn->error;
        }

        $stmt->close();
    }
} else {
    // Request method is not POST
    echo "Invalid request";
}
?>
