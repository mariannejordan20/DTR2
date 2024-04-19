<?php
// Include your database connection file here
include 'connection.php';
?>




<html> 
<head> 
<!-- CSS only -->
<link rel="stylesheet" href="myStyles/CSS/indexCSSFile.css"> 
<link rel="stylesheet" href="myStyles/CSS/sb-admin-2.min.css"> 
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="myStyles/CSS/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="myStyles/CSS/index_reviseCSS.css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">  
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<!-- Ajax  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- alert plugin sweetalert2  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Add this script in the head of your HTML document -->
<link rel="icon" href="Images/logofinal.png" type="image/png">
<title>BizMaTechDTR</title>
<style>
    .btn {
        text-align: left;
    }
    @media (max-width: 768px) {
        /* Adjust font size for smaller screens */
        .buttons,
        .buttons2 {
            font-size: 7px;
        }

        /* You can customize the font size as needed */
    }
</style>
</head> 
<body onload="focusInput()">
    <?php
    if (isset($_SESSION['status'])) {
        echo "Swal.fire({
                            icon: '" . ($_SESSION['status_code'] == 'success' ? 'success' : 'error') . "',
                            title: '" . ($_SESSION['status_code'] == 'success' ? 'Success' : ($_SESSION['status_code'] == 'inactive' ? 'Inactive' : 'Suspended')) . "',
                            text: '" . $_SESSION['status'] . "',
                            showConfirmButton: false,
                            timer: 1000
                        });";
        unset($_SESSION['status']); // Clear the session variable
        unset($_SESSION['status_code']); // Clear the session variable
    }
    ?>
    <div class="containerIndex container mt-5 container mx-auto text-center">
        <div class="compLogo text-center mt-5 mb-5">
            <img src="Images/logofinal.png" alt="BIZMATECH Logo" style="width: 20%;">
        </div>
        <div class="container">
            <div class="row text-center">
                <div class="col-xl-6 mx-auto">
                    <span class="realDate" id="dateNow" style="font-size: 20px; color: #000000;"></span>
                    <hr>
                    <span class="realTime" id="time" style="font-size: 30px; color: #000000;"></span>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-xl-6 mx-auto">
                    <input type="number" id="textBoxUserID" class="userInputText" placeholder="Enter Employee ID Here" active>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <div class="row text-center mb-1" style="margin-left: 32%;">
            <div class="col-sm-3">
            <button type="button" id="btnTimeIn1" name="" class="btn buttons btn-block">[ Q ] First In</button>
            </div>
            <div class="col-sm-3">
            <button type="button" id="btnTimeOut1" name="" class="btn buttons2 btn-block">[ W ] First Out</button>
            </div>
        </div>
        <div class="row text-center" style="margin-left: 32%;">
            <div class="col-sm-3">
            <button type="button" id="btnTimeIn2" name="" class="btn buttons btn-block">[ E ] Second In</button>
            </div>
            <div class="col-sm-3">
            <button type="button" id="btnTimeOut2" name="" class="btn buttons2 btn-block">[ R ] Second Out</button>
            </div>
            <?php 
            //echo $visitorIpAddress; 
            ?>
        </div>
    </div>
    <script>
    document.addEventListener('keydown', function(event) {
        // Check if the event key matches the desired hotkey
        switch(event.key) {
            case 'Q':
                document.getElementById("btnTimeIn1").click(); // Trigger button click
                break;
            case 'W':
                document.getElementById("btnTimeOut1").click(); // Trigger button click
                break;
            case 'E':
                document.getElementById("btnTimeIn2").click(); // Trigger button click
                break;
            case 'R':
                document.getElementById("btnTimeOut2").click(); // Trigger button click
                break;
            default:
                // Ignore other keys
                break;
        }
    });
    </script>

    <script>
    function focusInput() {
        document.getElementById("textBoxUserID").focus();
    }
    </script>

    <script>
    function updateTime() {
            var dateNowElement = document.getElementById('dateNow');
            var timeElement = document.getElementById('time');

            var currentDate = new Date();
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            dateNowElement.innerText = currentDate.toLocaleDateString('en-US', options);

            var hours = currentDate.getHours();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12; // Convert 24-hour time to 12-hour time

            var minutes = currentDate.getMinutes();
            var seconds = currentDate.getSeconds();

            var formattedTime = `${padZero(hours)}:${padZero(minutes)}:${padZero(seconds)} ${ampm}`;
            timeElement.innerText = formattedTime;
        }

        function padZero(number) {
            return number < 10 ? '0' + number : number;
        }

        // Update the time every second
        setInterval(updateTime, 1000);


        function submitData(btnId) {
    var employeeID = document.getElementById("textBoxUserID").value;
    var xhr = new XMLHttpRequest();
    var url = "submit_data.php";
    var params = "textBoxUserID=" + employeeID + "&btnId=" + btnId; // Include btnId in the params

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Parse JSON response
                var response = JSON.parse(xhr.responseText);

                // Inside the Swal.fire() success callback
                Swal.fire({
                    text: response.message,
                    icon: response.status === 'success' ? 'success' : 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Refresh the page
                        location.reload();
                    }
                });

            } else {
                // Error: Use SweetAlert for an error popup
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while processing your request.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
    };

    xhr.send(params);
}


document.getElementById("btnTimeIn1").addEventListener("click", function () {
    submitData("btnTimeIn1");
});

document.getElementById("btnTimeOut1").addEventListener("click", function () {
    submitData("btnTimeOut1");
});

document.getElementById("btnTimeIn2").addEventListener("click", function () {
    submitData("btnTimeIn2");
});

document.getElementById("btnTimeOut2").addEventListener("click", function () {
    submitData("btnTimeOut2");
});



</script>


  <!-- Bootstrap core JavaScript-->
  <script src="myStyles/JS/jquery.min.js"></script>
    <script src="myStyles/JS/bootstrap.bundle.min.js"></script>  
    <!-- Core plugin JavaScript-->
    <script src="myStyles/JS/jquery.easing.min.js"></script> 
    <!-- Custom scripts for all pages-->
    <script src="myStyles/JS/sb-admin-2.min.js"></script> 
    <!-- Page level plugins -->
    <!-- Page level custom scripts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  
    
</body>
</html>


