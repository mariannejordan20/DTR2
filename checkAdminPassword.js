// checkAdminPassword.js

function checkAdminPassword() {
    // Get the entered password
    var enteredPassword = document.getElementById("adminPassword").value;

    // Log the entered password
    console.log('Entered Password:', enteredPassword);

    // Perform an AJAX request to check the password
    $.ajax({
        type: 'POST',
        url: 'validate_password.php', // Replace with the actual path to your PHP file
        data: { password: enteredPassword },
        success: function(response) {
            // Response will be 'true' or 'false' based on password validation
            if (response === 'true') {
                // If the password is correct, submit the delete form
                document.getElementById("deleteForm").submit();
            } else {
                // If the password is incorrect, show an error message
                alert("Incorrect password. Please try again.");
            }
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error('AJAX Error:', error);
            alert("An error occurred while processing your request. Please try again later.");
        }
    });
}
