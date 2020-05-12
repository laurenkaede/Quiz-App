<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    if (isset($_POST['saveAvengersScore'])) {
      $hideBtn = $_POST['avengersScoreSaved'];
      $userAvengersScore = filter_var($_POST["userAvengersScore"], FILTER_SANITIZE_NUMBER_INT);
      $userAvengersTime = filter_var($_POST["userAvengersTime"], FILTER_SANITIZE_NUMBER_INT);
      $stmt =  $pdo->prepare('UPDATE users SET useravengersscore = ?, useravengerstime = ? WHERE id = ?');
      $stmt->execute([$userAvengersScore, $userAvengersTime, $userId]);
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
  <div class="container avengersImg">
    <div id="end" class="flex-center flex-column content">

      <form action="endGameAvengers.php" method="POST">

        <h1 class="avengerFont" id="username"><?php echo $user->username ?>'s Avengers Quiz Results</h1>

        <h3 class="hud-prefix avengerFont">Score: </h3>
        <h1 class="avengerFont" name="userAvengersScoreDisplay" id="userAvengersScoreDisplay" for="userAvengersScore"></h1>
        <input type="hidden" name="userAvengersScore" id="userAvengersScore" value="<?php echo $user->useravengersscore ?>" />

        <h3 class="hud-prefix avengerFont">Time: </h3>
        <h1 class="avengerFont" name="userAvengersTimeDisplay" id="userAvengersTimeDisplay" for="userAvengersTime"></h1>
        <input type="hidden" value="saved" name="avengersScoreSaved" />
        <input type="hidden" name="userAvengersTime" id="userAvengersTime" value="<?php echo $user->useravengerstime ?>" />

        <?php if(!$hideBtn ) { ?>
        <button type="submit" class="btn" name="saveAvengersScore" id="saveAvengersScoreBtn">Save Score</button>
        <?php } ?>

        <a type="hidden" class="btn" id="avengersScoreboard" href="avengersScoreboard.php">Scoreboard</a>
      </form>
    </div>
  </div>
  <?php require('./inc/footer.php') ?>
  <script src="./js/avengers/endGameAvengers.js"></script>
</body>

</html>