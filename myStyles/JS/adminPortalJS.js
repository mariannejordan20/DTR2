$(document).ready(function () {
    $('#btnLogin').click(function () {
        var username = $('#txtBoxUserName').val();
        var password = $('#txtBoxPassword').val();

        var loginObj = {
            username: username,
            password: password
        }
        if (username != "" && password != "") {
            $.ajax({
                url: "checkAdminValid.php",
                type: "POST",
                data: loginObj,
                cache: false,
                success: function (data) {
                    if (data) {
                        window.location.replace("http://localhost/AdminDashboard.php");
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Ooppss..!!',
                            text: 'Incorrect Username or Password!',
                            showConfirmButton: false,
                            timer: 3000
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
                title: 'Ooppss..!!',
                text: 'Enter your Username and Password',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.reload();
            });
        }
    })
});