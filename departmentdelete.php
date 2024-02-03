<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['deptId'])) {
        $deptId = $_POST['deptId'];

        // Delete department from database
        $sql = "DELETE FROM departments WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $deptId);

        if ($stmt->execute()) {
            // Success
            echo "Department deleted successfully";
        } else {
            // Error
            echo "Error deleting department: " . $conn->error;
        }

        $stmt->close();
    }
} else {
    // Request method is not POST
    echo "Invalid request";
}
?>
