<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeID = $_POST['employeeID'];
    $employeeDate = $_POST['employeeDate'];

    $sql_check_time_in = "SELECT * FROM employee_log WHERE Employee_ID = ? AND Employee_Date = ? AND (Employee_TimeInAM IS NOT NULL OR Employee_TimeInPM IS NOT NULL)";
    $stmt_check_time_in = $conn->prepare($sql_check_time_in);
    $stmt_check_time_in->bind_param("ss", $employeeID, $employeeDate);
    $stmt_check_time_in->execute();
    $result_check_time_in = $stmt_check_time_in->get_result();

    if ($result_check_time_in->num_rows > 0) {
        echo 'timeInExists';
    } else {
        echo 'noTimeIn';
    }

    $stmt_check_time_in->close();
    $conn->close();
}
?>
