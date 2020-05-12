<?php
session_start();

if (isset($_POST['login'])) {
    require('./config/db.php');

    $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $userPassword = filter_var($_POST["userPassword"], FILTER_SANITIZE_STRING);

    $stmt = $pdo->prepare('SELECT * from users WHERE useremail = ?');
    $stmt->execute([$userEmail]);
    $user = $stmt->fetch();

    if (isset($user)) {
        if (password_verify($userPassword, $user->userpassword)) {
            echo "The password is correct";
            $_SESSION['userId'] = $user->id;
            header('Location: http://localhost:8888/quiz-project/index.php');
        } else {
            $loginWrong = "The login email or password is incorrect";
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
    <title>Login</title>
</head>

<body>

    <div class="container mainImg">
        <div id="home" class="flex-center flex-column content">
            <h1>User Login</h1>
            <form action="login.php" method="POST">

                <label for="userEmail"></label>
                <input required type="email" name="userEmail" placeholder="Enter Email Address" />
                <br />

                <?php if (isset($loginWrong)) { ?>
                    <p><?php echo $loginWrong ?> </p>
                <?php } ?>

                <label for="userPassword"></label>
                <input required type="password" name="userPassword" placeholder="Enter Password" />

                <button class="btn" name="login" type="submit">Login</button>

            </form>
        </div>
    </div>

    <?php require('./inc/footer.php') ?>
</body>

</html>