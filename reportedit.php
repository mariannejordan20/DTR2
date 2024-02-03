<?php
// Include the database connection file
require_once "connection.php";

// Check if the form data has been submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $employeeId = $_POST['employeeId'];
    $timeInAm = $_POST['timeInAm'];
    $timeOutAm = $_POST['timeOutAm'];
    $timeInPm = $_POST['timeInPm'];
    $timeOutPm = $_POST['timeOutPm'];

    // Perform validation if needed
    // You can add more validation logic here, such as checking if the input values are not empty or are in the correct format

    // Update the database
    $updateQuery = "UPDATE employee_log SET Employee_TimeInAm = '$timeInAm', Employee_TimeOutAm = '$timeOutAm', Employee_TimeInPm = '$timeInPm', Employee_TimeOutPm = '$timeOutPm' WHERE ID = $employeeId";

    if (mysqli_query($conn, $updateQuery)) {
        // If the update query was successful
        $response = array(
            'status' => 'success',
            'message' => 'Time records updated successfully.'
        );
        echo json_encode($response);
    } else {
        // If there was an error executing the query
        $response = array(
            'status' => 'error',
            'message' => 'Error updating time records: ' . mysqli_error($conn)
        );
        echo json_encode($response);
    }
} else {
    // If the request method is not POST
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method.'
    );
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
?>
