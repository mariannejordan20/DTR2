<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .name {
            flex: 1 0 10rem;
        }
        .email {
            flex: 1 0 10rem;
        }
        .button {
            flex: 1 0 5rem;
            background-color: #c0b9a5;
        }
        .borderForm {
            max-width: 50%;
            justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    margin: 0 auto; /* Optional: to center within a parent container */
        }
    </style>
</head>
<body>
    <div class="borderForm">
        <form action="" class="form">
            <input type="text" placeholder="Name" class="name">
            <input type="email" placeholder="Email" class="email">
            <button type="submit" class="button">Subscribe</button>
        </form>
    </div>
</body>
</html>