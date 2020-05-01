<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    $stmt = $pdo -> prepare ('SELECT * from users WHERE id = ?');
    $stmt -> execute([$userId]);
    $user = $stmt -> fetch();
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
    <link rel="stylesheet" href="./inc/navbar.css">
    <link rel="stylesheet" href="./css/scoreboard.css">
    <title>Scoreboard</title>
</head>

<body>
    <div class="container">
        <h3>Top 10 Scores</h3>
    </div>
    <script src="./js/scoreboard.js"></script>
</body>

</html>