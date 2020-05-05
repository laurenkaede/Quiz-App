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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Congrats!</title>
    <link rel="stylesheet" href="./inc/navbar.css">
    <link rel="stylesheet" href="./css/index.css">
  </head>
  <body>
    <div class="container">
      <div id="end" class="flex-center flex-column">
        <h1 id="finalScore"></h1>
        <form>
          <input
            type="text"
            name="username"
            id="username"
            placeholder="username"
          />
          <button
            type="submit"
            class="btn"
            id="saveScoreBtn"
            onclick="saveHighScore(event)"
            disabled
          >
            Save
          </button>
        </form>
        <a class="btn" href="quiz.php">Play Again</a>
        <a class="btn" href="index.php">Go Home</a>
      </div>
    </div>
    <?php require('./inc/footer.php') ?>
    <script src="./js/endGame.js"></script>
  </body>
</html>