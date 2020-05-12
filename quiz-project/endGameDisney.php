<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    if (isset($_POST['saveDisneyScore'])) {
      $hideBtn = $_POST['disneyScoreSaved'];
      $userDisneyScore = filter_var($_POST["userDisneyScore"], FILTER_SANITIZE_NUMBER_INT);
      $userDisneyTime = filter_var($_POST["userDisneyTime"], FILTER_SANITIZE_NUMBER_INT);
      $stmt =  $pdo->prepare('UPDATE users SET userdisneyscore = ?, userdisneytime = ? WHERE id = ?');
      $stmt->execute([$userDisneyScore, $userDisneyTime, $userId]);
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
  <div class="container disneyImg">
    <div id="end" class="flex-center flex-column content">

      <form action="endGameDisney.php" method="POST">

        <h1 id="username"><?php echo $user->username ?>'s Disney Quiz Results</h1>

        <h3 class="hud-prefix">Score: </h3>
        <h1 name="userDisneyScoreDisplay" id="userDisneyScoreDisplay" for="userDisneyScore"></h1>
        <input type="hidden" name="userDisneyScore" id="userDisneyScore" value="<?php echo $user->userdisneyscore ?>" />

        <h3 class="hud-prefix">Time: </h3>
        <h1 name="userDisneyTimeDisplay" id="userDisneyTimeDisplay" for="userDisneyTime"></h1>
        <input type="hidden" value="saved" name="disneyScoreSaved" />
        <input type="hidden" name="userDisneyTime" id="userDisneyTime" value="<?php echo $user->userdisneytime ?>" />

        <?php if(!$hideBtn ) { ?>
        <button type="submit" class="btn" name="saveDisneyScore" id="saveDisneyScoreBtn">Save Score</button>
        <?php } ?>

        <a type="hidden" class="btn" id="disneyScoreboard" href="disneyScoreboard.php">Scoreboard</a>
      </form>
    </div>
  </div>
  <?php require('./inc/footer.php') ?>
  <script src="./js/disney/endGameDisney.js"></script>
</body>

</html>