<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['ipId'])) {
        $ipId = $_POST['ipId'];

        // Delete ip from database
        $sql = "DELETE FROM allowed_ips WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ipId);

        if ($stmt->execute()) {
            // Success
            echo "IP deleted successfully";
        } else {
            // Error
            echo "Error deleting IP: " . $conn->error;
        }

        $stmt->close();
    }
} else {
    // Request method is not POST
    echo "Invalid request";
}
?>
