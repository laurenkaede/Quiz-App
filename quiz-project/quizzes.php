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
  
                        <h1>Welcome to the quiz page, <?php echo $user->username ?>!</h1>

                        <a class="btn" href="disneyQuiz.php">Disney Quiz</a>
                        <a class="btn" href="avengersQuiz.php">Avengers Quiz</a>
                        <a class="btn" href="starwarsQuiz.php">Star Wars Quiz</a>
          
        </div>
    </div>
    <?php require('./inc/footer.php') ?>
</body>

</html>