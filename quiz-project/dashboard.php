<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    if (isset($_POST['edit'])) {
        $userName = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
        $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
        $stmt =  $pdo->prepare('UPDATE users SET username = ?, useremail = ? WHERE id = ?');
        $stmt->execute([$userName, $userEmail, $userId]);
    }
    $stmt = $pdo->prepare('SELECT * from users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
} else {
    header('Location: http://localhost:8888/quiz-project/index.php');
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
    <title>Dashboard</title>
</head>

<body>
    <div class="container mainImg">
        <div id="home" class="flex-center flex-direction flex-column content">
            <h1>Update Details </h1>

            <form action="dashboard.php" method="POST">

                <label class="text" for="userName">User Name:</label>
                </br>
                <input required type="text" name="userName" placeholder="Enter User Name" value="<?php echo $user->username ?>" />
                <br />
                <label class="text" for="userEmail">Email Address:</label>
                </br>
                <input required type="email" name="userEmail" placeholder="Enter Email Address" value="<?php echo $user->useremail ?>" />
                <br />
                <?php if (isset($emailTaken)) { ?>
                    <p><?php echo $emailTaken ?> </p>
                <?php } ?>

                <button class="btn" name="edit" type="submit">Edit</button>

            </form>
        </div>
    </div>
    <?php require('./inc/footer.php') ?>
</body>

</html>