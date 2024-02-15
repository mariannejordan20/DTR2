<?php
// validate_password.php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $enteredPassword = $_POST['password'];

    // Fetch the stored password hash from the database based on the logged-in user's username
    $username = $_SESSION['username'];
    $query = "SELECT password FROM admin_accounts WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPasswordHash = $row['password'];

        // Verify the entered password against the stored hash
        if (password_verify($enteredPassword, $storedPasswordHash)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    } else {
        echo json_encode(['status' => 'error']);
    }
} else {
    echo json_encode(['status' => 'error']);
}
?>
