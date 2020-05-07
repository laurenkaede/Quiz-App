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

        <?php if (isset($user)) { ?>
            <div class="container">
                <div id="home" class="flex-center flex-column">
                    <h1>Welcome to the Disney quiz, <?php echo $user->username ?>!</h1>

                    <a class="btn" href="quiz.php">Play</a>
                    <a class="btn" href="scoreboard.php">Top 10 Scores</a>

                </div>
            </div>

        <?php } else { ?>
            <div class="container">
                <div id="home" class="flex-center flex-column">
                    <h1>Welcome, Guest!</h1>
                    <h3>Please Login or Register to access the quiz!</h3>
                </div>
            </div>
        <?php } ?>

    </div>
    <?php require('./inc/footer.php') ?>
    <script src="./js/index.js"></script>
</body>

</html>