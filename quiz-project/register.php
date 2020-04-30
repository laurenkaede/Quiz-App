<?php

    if (isset($_POST['register'])) {
        require('./config/db.php');

        $userName = filter_var($_POST['userName'], FILTER_SANITIZE_STRING);
        $userEmail = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);
        $userPassword = filter_var($_POST['userPassword'], FILTER_SANITIZE_STRING);

        if (filter_var ($userEmail, FILTER_VALIDATE_EMAIL) ) {
            echo $userEmail . " " . $userName . " " . $userPassword;
        }
    }

?>

<?php require('./inc/navbar.html'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./inc/navbar.css">
    <link rel="stylesheet" href="./css/register.css">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <h3>Register</h3>

        <form action="register.php" method="POST">
            <label for="userName">User Name</label>
            <input required type="text" name="userName" placeholder="Enter User Name" />

            <label for="userEmail">Email Address</label>
            <input required type="email" name="userEmail" placeholder="Enter Email Address" />

            <label for="userPassword">Password</label>
            <input required type="password" name="userPassword" placeholder="Enter Password" />

            <button name="register" type="submit">Register</button>

        </form>
    </div>
    <script src="./js/register.js"></script>
</body>

</html>