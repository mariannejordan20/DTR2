$(document).ready(function () {
    // ... (existing code)

    // Function to apply date filter and update the table
    function applyDateFilter() {
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        // Check if both fromDate and toDate are provided
        if (fromDate && toDate) {
            // Send AJAX request to filterRecords.php with date range parameters
            $.ajax({
                type: 'GET',
                url: 'filterRecords.php',
                data: {
                    fromDate: fromDate,
                    toDate: toDate
                },
                success: function (response) {
                    // Update the table with filtered records
                    $('#myTable tbody').html(response);
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    console.error('AJAX Error:', error);
                    // Display a generic error message to the user
                    alert('An error occurred while processing your request. Please try again later.');
                }
            });
        } else {
            // Display a message if fromDate or toDate is not provided
            alert('Please select both From Date and To Date.');
        }
    }

    // Event listener for the Apply Filter button
    $('#applyFilterBtn').click(function () {
        applyDateFilter();
    });

    // Event listener for the Print Filtered Records button
    $('#printFilteredBtn').click(function () {
        applyDateFilter();

        // Open print dialog after updating the table
        window.print();
    });

    // ... (existing code)
});
