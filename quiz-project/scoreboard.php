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
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Scoreboards</title>
</head>

<body>

    <div class="container mainImg">
        <div id="home" class="flex-center flex-direction flex-column content">

            <h1>Choose a scoreboard, <?php echo $user->username ?>!</h1>

            <a class="btn" href="disneyScoreboard.php">Disney Top 10</a>
            <a class="btn" href="avengersScoreboard.php">Avengers Top 10</a>
            <a class="btn" href="starwarsScoreboard.php">Star Wars Top 10</a>

        </div>
    </div>
    <?php require('./inc/footer.php') ?>
</body>

</html>