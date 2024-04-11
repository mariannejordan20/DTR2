<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <!-- Add your CSS styles or link to an external stylesheet here -->
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container-fluid {
            text-align: center;
        }

        .glitch {
            position: relative;
            font-size: 6rem;
            font-weight: bold;
            color: #e74a3b;
            animation: glitch 1s infinite linear;
        }

        .lead {
            font-size: 2rem;
            color: #4e73df;
            margin-bottom: 20px;
        }

        .text-gray-500 {
            color: #858796;
            margin-bottom: 40px;
        }

        .back-link {
            color: #1551b5;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @keyframes glitch {
            2%, 64% {
                transform: translate(2px, 0) skew(0deg);
            }
            4%, 60% {
                transform: translate(-2px, 0) skew(0deg);
            }
            62% {
                transform: translate(0, 0) skew(5deg);
            }
            63% {
                transform: translate(0, 0) skew(-5deg);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Glitchy 403 Error Text -->
        <div class="glitch" data-text="403">403</div>
        <p class="lead text-gray-800">Access Denied</p>
        <p class="text-gray-500">Sorry, you don't have permission to access this page.</p>
        <!-- Optionally, add a link back to the dashboard or another page -->
        <!-- <a href="index.html">&larr; Back to Dashboard</a> -->
        <p class="text-gray-500">If you believe this is an error, please contact the administrator.</p>
    </div>
</body>

</html>
