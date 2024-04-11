<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_employee_Id'])) {
        $edit_employee_Id = $_POST['edit_employee_Id'];

        // Delete log from database
        $sql = "DELETE FROM logs WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $edit_employee_Id);

        if ($stmt->execute()) {
            // Success
            echo "Log report deleted successfully";

            // You can add an alert here
            echo "<script>alert('Log report deleted successfully');</script>";
        } else {
            // Error
            echo "Error deleting log report: " . $conn->error;

            // You can add an alert here
            echo "<script>alert('Error deleting log report: " . $conn->error . "');</script>";
        }

        $stmt->close();
    }
} else {
    // Request method is not POST
    echo "Invalid request";
}
?>
