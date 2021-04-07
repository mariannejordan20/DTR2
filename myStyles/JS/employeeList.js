$(document).ready(function () {
    // data table attributes
    $('#employeeTable').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export as Excel',
                title: 'Employee_Account_Lists',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'Export as PDF',
                title: 'Employee_Account_Lists',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }
        ]
    });
    //show the data when clicked
    $(".editModalBtn").on('click', function () {
        $('#editModal').modal("show");

        $tr = $(this).closest("tr");

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#Table_ID').val(data[0]);
        $('#EmployeeEdit_ID').val(data[1]);
        $('#EmployeeEdit_FullName').val(data[2]);
        $('#EmployeeEdit_Department').val(data[3]);
        $('#EmployeeEdit_Position').val(data[4]);
        $('#EmployeeEdit_Sex').val(data[5]);
    });
    // edit modal prompt and show the info of target account to edit
    $('#submitEditAccount').click(function () {
        var Employee_ID = $('#EmployeeEdit_ID').val();
        var Employee_FullName = $('#EmployeeEdit_FullName').val();
        var Employee_Department = $('#EmployeeEdit_Department').val();
        var Employee_Position = $('#EmployeeEdit_Position').val();
        var Employee_Sex = $('#EmployeeEdit_Sex').val();

        // create object of the data
        var editEmployeeInfo = {
            Employee_ID: Employee_ID,
            Employee_FullName: Employee_FullName,
            Employee_Department: Employee_Department,
            Employee_Position: Employee_Position,
            Employee_Sex, Employee_Sex
        }
        // a alert show if input types are null
        if (Employee_ID.length === 0 || Employee_FullName.length === 0 || Employee_Department.length === 0 || Employee_Position.length === 0 || Employee_Sex.length === 0) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Oopss!!!',
                text: 'Fill out all the fields!',
                showConfirmButton: false,
                timer: 2000
            });
        }
        else {
            $.ajax({
                type: "POST",
                url: "AdminUpdateEmployeeAccount.php",
                data: editEmployeeInfo,
                success: function (data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success!!',
                        text: 'Employee Account Updated!',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }
    });
    // getting the value of the row selected
    $(".deleteModalBtn").on('click', function () {
        $('#deleteModal').modal("show");

        $tablerow = $(this).closest("tr");

        var data = $tablerow.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#TableDelete_ID').val(data[0]);
        $('#EmployeeDelete_ID').val(data[1]);
        $('#EmployeeDelete_FullName').val(data[2]);
        $('#EmployeeDelete_Department').val(data[3]);
        $('#EmployeeDelete_Position').val(data[4]);
        $('#EmployeeDelete_Sex').val(data[5]);
    });

    // when button delete confirm
    $("#deleteEmployeeButton").on('click', function () {
        //alert(2);
        var EmployeeDelete_ID = $("#EmployeeDelete_ID").val();

        deleteEmployeeInfo = {
            EmployeeDelete_ID: EmployeeDelete_ID
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d9534f',
            cancelButtonColor: '#5cb85c',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "AdminDeleteEmployeeAccount.php",
                    data: deleteEmployeeInfo,
                    success: function (data) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Success!!',
                            text: 'Employee Account has been deleted!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                })
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Notif!',
                    text: 'Employee Account is not deleted!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.reload();
                });
            }
        })
    });
});