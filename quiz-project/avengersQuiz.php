<?php
session_start();

if (isset($_SESSION['userId'])) {
  require('./config/db.php');

  $userId = $_SESSION['userId'];

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
  <link rel="stylesheet" href="./css/quiz.css">
  <title>Disney Quiz</title>
</head>

<body>
  <div class="container avengersImg">
    <div id="loader"></div>
    <div id="game" class="justify-center flex-direction flex-column content hidden">
      <div id="hud">
        <div id="hud-item">
          <h4 id="progressText" class="hud-prefix">Question</h4>
          <div id="progressBar">
            <div id="progressBarFull"></div>
          </div>
        </div>

        <div id="hud-item">
          <h4 class="hud-prefix">Score</h4>
          <h2 class="hud-main-text" id="score">0</h2>
        </div>
        <div id="hud-item">
          <h4 class="hud-prefix">Timer</h4>
          <h2 class="hud-main-text" id="timer">00 : 00</h2>
        </div>

      </div>
      <img id="image" src="">
      <h2 id="question"></h2>

      <div class="choice-container">
        <p class="choice-prefix">A</p>
        <p class="choice-text" data-number="1"></p>
      </div>

      <div class="choice-container">
        <p class="choice-prefix">B</p>
        <p class="choice-text" data-number="2"></p>
      </div>

      <div class="choice-container">
        <p class="choice-prefix">C</p>
        <p class="choice-text" data-number="3"></p>
      </div>

      <div class="choice-container">
        <p class="choice-prefix">D</p>
        <p class="choice-text" data-number="4"></p>
      </div>

    </div>
  </div>
  <?php require('./inc/footer.php') ?>
  <script src="./js/avengers/avengersQuiz.js"></script>
</body>

</html>