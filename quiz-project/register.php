<?php
session_start();

if (isset($_POST['register'])) {
    require('./config/db.php');

    $userName = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $userEmail = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $userPassword = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $passwordHashed = password_hash($userPassword, PASSWORD_DEFAULT);

    if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo->prepare('SELECT * from Users WHERE email = ?');
        $stmt->execute([$userEmail]);
        $totalUsers = $stmt->rowCount();

        if ($totalUsers > 0) {
            $emailTaken = "This email address already has an account. Please login.";
        } else {
            $stmt = $pdo->prepare('INSERT into Users (username, email, password, role, score, time) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$userName, $userEmail, $passwordHashed, "Guest", 0, 0]);
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
    <link rel="stylesheet" href="./inc/navbar.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <h1>Register User</h1>

        <form action="register.php" method="POST">

            <label for="username"></label>
            <input required type="text" name="username" placeholder="Enter User Name" />
            <br />
            <label for="email"></label>
            <input required type="email" name="email" placeholder="Enter Email Address" />
            <br />
            <?php if (isset($emailTaken)) { ?>
                <p><?php echo $emailTaken ?> </p>
            <?php } ?>
            
            <label for="password"></label>
            <input required type="password" name="password" placeholder="Enter Password" />
            <br />

            <button class="btn" name="register" type="submit">Register</button>

        </form>
    </div>
    <?php require('./inc/footer.php') ?>
    <script src="./js/register.js"></script>
</body>

</html>