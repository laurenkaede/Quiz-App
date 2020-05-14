<?php
session_start();
if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    $stmt = $pdo->prepare('SELECT username, useravengersscore, useravengerstime FROM users ORDER by useravengersscore DESC, useravengerstime ASC LIMIT 10');
    $stmt->execute();
    $users = $stmt->fetchAll();

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
    <link rel="stylesheet" href="./css/scoreboard.css">
    <title>Avengers Scoreboard</title>
</head>

<body>
    <div class="container avengersImg">
        <div id="highScores" class="flex-center flex-column">
            <h1 class="avengerFont" id="finalScore">Avengers High Scores</h1>
            <table>
                <thead>

                    <tr>
                        <th>User Name</th>
                        <th>Score</th>
                        <th>Time (s)</th>
                    </tr>

                    <?php foreach ($users as $score) { ?>
                        <tr>
                            <td> <?php echo $score->username; ?></td>
                            <td> <?php echo $score->useravengersscore; ?></td>
                            <td> <?php echo $score->useravengerstime; ?></td>
                        </tr>
                    <?php } ?>

                <tbody>
            </table>
            </br>
            </br>
            </br>
            <?php if($user->useravengersscore > 0 ) { ?>
                <a class="btn" href="avengersQuiz.php">Play Again</a>
        <?php } ?>
        </div>
    </div>
    <?php require('./inc/footer.php') ?>
</body>

</html>