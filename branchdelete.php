<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['branchId'])) {
        $branchId = $_POST['branchId'];

        // Delete branch from database
        $sql = "DELETE FROM branches WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $branchId);

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
