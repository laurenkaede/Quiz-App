<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    if (isset($_POST['saveScore'])) {
      $hideBtn = $_POST['scoreSaved'];
      $userScore = filter_var($_POST["userScore"], FILTER_SANITIZE_NUMBER_INT);
      $userTime = filter_var($_POST["userTime"], FILTER_SANITIZE_NUMBER_INT);
      $stmt =  $pdo->prepare('UPDATE users SET userscore = ?, usertime = ? WHERE id = ?');
      $stmt->execute([$userScore, $userTime, $userId]);
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Quiz Results</title>
  <link rel="stylesheet" href="./inc/navbar.css">
  <link rel="stylesheet" href="./css/index.css">
</head>

<body>
  <div class="container">
    <div id="end" class="flex-center flex-column">

      <form action="endGame.php" method="POST">

        <h1 id="username"><?php echo $user->username ?>'s Disney Quiz Results</h1>

        <h3 class="hud-prefix">Score: </h3>
        <h1 name="userScoreDisplay" id="userScoreDisplay" for="userScore"></h1>
        <input type="hidden" name="userScore" id="userScore" value="<?php echo $user->userscore ?>" />

        <h3 class="hud-prefix">Time: </h3>
        <h1 name="userTimeDisplay" id="userTimeDisplay" for="userTime"></h1>
        <input type="hidden" value="saved" name="scoreSaved" />
        <input type="hidden" name="userTime" id="userTime" value="<?php echo $user->usertime ?>" />

        <?php if(!$hideBtn ) { ?>
        <button type="submit" class="btn" name="saveScore" id="saveScoreBtn">Save Score</button>
        <?php } ?>

        <a type="hidden" class="btn" id="scoreboard" href="scoreboard.php">Scoreboard</a>
      </form>
    </div>
  </div>
  <?php require('./inc/footer.php') ?>
  <script src="./js/endGame.js"></script>
</body>

</html>