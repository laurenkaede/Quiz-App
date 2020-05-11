<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    $stmt = $pdo->prepare('SELECT * from users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
}

?>

<?php require('./inc/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="./inc/navbar.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Quiz</title>
</head>

<body>

    <div class="container">
        <div id="home" class="flex-center flex-column content">

            <?php if (isset($user)) { ?>     
                        <h1>Welcome Disney quizzes, <?php echo $user->username ?>!</h1>

                        <a class="btn" href="quizzes.php">Play</a>
                        <a class="btn" href="scoreboard.php">Top 10 Scores</a>
            <?php } else { ?>
                        <h1>Welcome, Guest!</h1>
                        <h3>Please Login or Register to access the quiz!</h3>  
            <?php } ?>
        </div>
    </div>
    <?php require('./inc/footer.php') ?>
</body>

</html>