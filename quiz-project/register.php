<?php
session_start();

if (isset($_POST['register'])) {
    require('./config/db.php');

    $userName = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $userEmail = filter_var($_POST["useremail"], FILTER_SANITIZE_EMAIL);
    $userPassword = filter_var($_POST["userpassword"], FILTER_SANITIZE_STRING);
    $passwordHashed = password_hash($userPassword, PASSWORD_DEFAULT);

    if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo->prepare('SELECT * from users WHERE useremail = ?');
        $stmt->execute([$userEmail]);
        $totalUsers = $stmt->rowCount();

        if ($totalUsers > 0) {
            $emailTaken = "This email address already has an account. Please login.";
        } else {
            $stmt = $pdo->prepare('INSERT into users (username, useremail, userpassword, userrole, userdisneyscore, userdisneytime, useravengersscore, useravengerstime, userstarwarsscore, userstarwarstime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$userName, $userEmail, $passwordHashed, "Guest", 0, 0, 0, 0, 0, 0]);
            header('Location: http://localhost:8888/quiz-project/index.php');
        }
    }
}

?>

<?php require('./inc/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Register</title>
</head>

<body>
    <div class="container mainImg">
        <div id="home" class="flex-center flex-direction flex-column content">
            <h1>Register User</h1>

            <form action="register.php" method="POST">

                <label for="username"></label>
                <input required type="text" name="username" placeholder="Enter User Name" />
                <br />
                <label for="useremail"></label>
                <input required type="email" name="useremail" placeholder="Enter Email Address" />
                <br />
                <?php if (isset($emailTaken)) { ?>
                    <p><?php echo $emailTaken ?> </p>
                <?php } ?>

                <label for="userpassword"></label>
                <input required type="password" name="userpassword" placeholder="Enter Password" />
                <br />

                <button class="btn" name="register" type="submit">Register</button>

            </form>
        </div>
    </div>
    <?php require('./inc/footer.php') ?>
</body>

</html>