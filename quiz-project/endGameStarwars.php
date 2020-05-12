<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    if (isset($_POST['saveStarwarsScore'])) {
      $hideBtn = $_POST['starwarsScoreSaved'];
      $userStarwarsScore = filter_var($_POST["userStarwarsScore"], FILTER_SANITIZE_NUMBER_INT);
      $userStarwarsTime = filter_var($_POST["userStarwarsTime"], FILTER_SANITIZE_NUMBER_INT);
      $stmt =  $pdo->prepare('UPDATE users SET userstarwarsscore = ?, userstarwarstime = ? WHERE id = ?');
      $stmt->execute([$userStarwarsScore, $userStarwarsTime, $userId]);
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
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/index.css">
</head>

<body>
  <div class="container starwarsImg">
    <div id="end" class="flex-center flex-column content">

      <form action="endGameStarwars.php" method="POST">

        <h1 id="username" class="starwarsFont"><?php echo $user->username ?>'s Starwars Quiz Results</h1>

        <h3 class="starwarsFont" class="hud-prefix">Score: </h3><br>
        <h1 class="starwarsFont" name="userStarwarsScoreDisplay" id="userStarwarsScoreDisplay" for="userStarwarsScore"></h1>
        <input type="hidden" name="userStarwarsScore" id="userStarwarsScore" value="<?php echo $user->userstarwarsscore ?>" />

        <h3 class="starwarsFont" class="hud-prefix">Time: </h3>
        <h1 class="starwarsFont" name="userStarwarsTimeDisplay" id="userStarwarsTimeDisplay" for="userStarwarsTime"></h1>
        <input type="hidden" value="saved" name="starwarsScoreSaved" />
        <input type="hidden" name="userStarwarsTime" id="userStarwarsTime" value="<?php echo $user->userstarwarstime ?>" />

        <?php if(!$hideBtn ) { ?>
        <button type="submit" class="btn" name="saveStarwarsScore" id="saveStarwarsScoreBtn">Save Score</button>
        <?php } ?>

        <a type="hidden" class="btn" id="starwarsScoreboard" href="starwarsScoreboard.php">Scoreboard</a>
      </form>
    </div>
  </div>
  <?php require('./inc/footer.php') ?>
  <script src="./js/starwars/endGameStarwars.js"></script>
</body>

</html>