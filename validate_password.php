<?php
// validate_password.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the entered password from the AJAX request
    $enteredPassword = $_POST['password'];

    // Define the static password (replace with your desired password)
    $staticPassword = 'admin123';

    // Check if the entered password matches the static password
    $passwordMatches = ($enteredPassword === $staticPassword);

    // Send the result back to the client
    echo json_encode($passwordMatches ? 'true' : 'false');
} else {
    // Handle invalid request method
    echo json_encode('false - Invalid request method');
}
?>
