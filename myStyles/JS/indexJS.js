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
// Save the time IN
$(document).ready(function () {
    $('#btnTimeIn').click(function () {
        //alert(2);
        $("#employeeStatus").val("In");

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
        }
        if (employeeCheck == "true") {
            //alert(employeeTime);
            $.ajax({
                url: "insertToEmployeeLogs.php",
                method: "POST",
                data: insertInfo,
                success: function (data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success!!',
                        text: 'Logged-In Captured!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        } else {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Oopss!!!',
                text: 'Employee ID is not registered!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.reload();
            });
        }
    });
});
// Save the time OUT
$(document).ready(function () {
    $('#btnTimeOut').click(function () {
        // alert(2);
        $("#employeeStatus").val("Out");
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
        }
        if (employeeCheck == "true") {
            //alert(employeeTime);
            $.ajax({
                url: "insertToEmployeeLogs.php",
                method: "POST",
                data: insertInfo,
                success: function (data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success!!',
                        text: 'Logged-Out Captured!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        } else {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Oopss!!!',
                text: 'Employee ID is not registered!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.reload();
            });
        }
    });
});