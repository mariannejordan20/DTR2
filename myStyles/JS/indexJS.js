// Check if ID is on db or not
$(document).ready(function () {
    $('#textBoxUserID').blur(function () {
        var employeeId = $(this).val();
        $.ajax({
            url: "checkIfEmployee.php",
            method: "POST",
            data: { employeeId: employeeId },
            datatype: "text",
            success: function (html) {
                $('#availability').html(html);
            }
        });
    });
});

// Save the timestamp based on the button clicked
$(document).ready(function () {
    $('#btnTimeIn1').click(function () {
        saveTimestamp("Employee_TimeInAM");
    });

    $('#btnTimeOut1').click(function () {
        saveTimestamp("Employee_TimeOutAM");
    });

    $('#btnTimeIn2').click(function () {
        saveTimestamp("Employee_TimeInPM");
    });

    $('#btnTimeOut2').click(function () {
        saveTimestamp("Employee_TimeOutPM");
    });
});

// Function to save timestamp based on the column name
function saveTimestamp(columnName) {
    $("#employeeStatus").val(columnName);

    var employeeCheck = $('#valid').val();
    var employeeID = $('#textBoxUserID').val()
    var employeeDate = $('#dateNow').text();
    var employeeTime = $('#time').text();
    var employeeIsWorking = $("#employeeStatus").val();

    var insertInfo = {
        employeeCheck: employeeCheck,
        employeeID: employeeID,
        employeeDate: employeeDate,
        employeeTime: employeeTime,
        employeeIsWorking: employeeIsWorking,
    };

    if (employeeCheck == "true") {
        $.ajax({
            url: "insertToEmployeeLogs.php",
            method: "POST",
            data: insertInfo,
            success: function (data) {
                if (data.startsWith("Error")) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Oops!',
                        text: data,
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success!!',
                        text: (columnName.includes("TimeIn") ? 'Logged-In' : 'Logged-Out') + ' Captured!',
                        showConfirmButton: false,
                        timer: 500
                    }).then(() => {
                        window.location.reload();
                    });
                }
            }
        });
    } else {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Oops!!',
            text: 'Employee ID is not registered!',
            showConfirmButton: false,
            timer: 500
        }).then(() => {
            window.location.reload();
        });
    }
}
