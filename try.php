<?php
// Include your database connection file here
include 'connection.php';

// // Fetch allowed IP addresses from the database
// $sql = "SELECT ip_address FROM allowed_ips";
// $result = mysqli_query($conn, $sql);

// // Check if there are results
// if ($result) {
//     $allowedIpAddresses = array();

//     // Fetch IP addresses into an array
//     while ($row = mysqli_fetch_assoc($result)) {
//         $allowedIpAddresses[] = $row['ip_address'];
//     }

//     // Get the visitor's IP address
//     $visitorIpAddress = $_SERVER['REMOTE_ADDR'];

//     // Check if the visitor's IP address is in the allowed IP addresses array
//     if (!in_array($visitorIpAddress, $allowedIpAddresses)) {
//         http_response_code(403);
//         include 'denied.php';
//         exit;
//     }
// } else {
//     // Handle database query error
//     echo "Error fetching allowed IP addresses: " . mysqli_error($conn);
//     exit;
// }
session_start();

// Check if the user is already logged in
if (isset($_SESSION["username"])) {
    header("location: AdminDashboard.php");
    exit(); // It's good practice to exit after sending a location header
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="Images/logofinal.png" type="image/png">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <title>BizMaTechPortal</title>
   <style>
       body {
           font-family: Arial, sans-serif;
           background-color: #f2f2f2;
           display: flex;
           justify-content: center;
           align-items: center;
           height: 100vh;
           margin: 0;
       }
       .login-container {
           background-color: #ffffff;
           padding: 40px;
           border-radius: 8px;
           box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
           text-align: center;
           max-width: 400px;
           width: 100%;
       }
       h1 {
           margin-top: 0;
           color: #333333;
       }
       .google-login {
           background-color: #ffffff;
           color: #757575;
           border: 1px solid #dcdcdc;
           padding: 10px 20px;
           border-radius: 4px;
           text-decoration: none;
           display: inline-block;
           margin-bottom: 20px;
       }
       .google-login:hover {
           background-color: #f2f2f2;
       }
       input[type="email"],
       input[type="password"] {
           width: 100%;
           padding: 12px 20px;
           margin: 8px 0;
           display: inline-block;
           border: 1px solid #ccc;
           border-radius: 4px;
           box-sizing: border-box;
       }
       .form-group {
           text-align: left;
           margin-bottom: 20px;
       }
       .form-control {
           position: relative;
       }
       .form-control i {
           position: absolute;
           top: 50%;
           right: 10px;
           transform: translateY(-50%);
           color: #757575;
       }
       .remember-forgot {
           display: flex;
           justify-content: space-between;
           margin-bottom: 20px;
       }
       .remember-forgot label,
       .remember-forgot a {
           color: #757575;
           text-decoration: none;
       }
       .remember-forgot a:hover {
           color: #333333;
       }
       button[type="submit"] {
           background-color: #4285f4;
           color: #ffffff;
           border: none;
           padding: 12px 20px;
           border-radius: 4px;
           cursor: pointer;
           width: 100%;
       }
       button[type="submit"]:hover {
           background-color: #3367d6;
       }
       .signup-link {
           color: #757575;
           text-decoration: none;
           margin-top: 20px;
           display: inline-block;
       }
       .signup-link:hover {
           color: #333333;
       }
   </style>
</head>
<body>
   <div class="login-container">
       <h1>Login</h1>
       <p>Hi, Welcome back 👋</p>
       <a href="#" class="google-login">Login with Google</a>
       <p>or Login with Email</p>
       <form>
           <div class="form-group">
               <input type="text" placeholder="Username" id="txtBoxUserName" name="txtBoxUserName" value="john.doe@gmail.com">
           </div>
           <div class="form-group form-control">
               <input type="password" placeholder="Password" id="txtBoxPassword" name="txtBoxPassword">
               <i class="fas fa-eye"></i>
           </div>
           <div class="remember-forgot">
               <label>
                   <input type="checkbox"> Remember Me
               </label>
               <a href="#">Forget Password?</a>
           </div>
           <button type="button" id="btnLogin" name="btnLogin">Login</button>
       </form>
       <a href="#" class="signup-link">Not registered yet? Create an account</a>
   </div>
   <script type="text/javascript">
        $(document).ready(function() {
            $("#btnLogin").click(function() {
                var uname = $("#txtBoxUserName").val();
                var pword = $("#txtBoxPassword").val();

                if (uname == "" || pword == "") {
                    swal({
                        title: "Error",
                        text: "Please enter both username and password!",
                        icon: "error",
                        button: "OK!",
                    });
                    return false;
                }
                $.ajax({
                    url: "checkAdminValid.php",
                    method: "post",
                    data: {
                        "username": uname,
                        "password": pword
                    },
                    success: function(res) {
                        if (res == "1") {
                            window.location = "AdminDashboard.php";
                        } else {
                            swal({
                                title: "Error",
                                text: "Incorrect username or password!",
                                icon: "error",
                                button: "OK!",
                            });
                        }

                    }
                });
            });
        });
    </script>
</body>
<script src="myStyles/JS/jquery.easing.min.js"></script>
</html>