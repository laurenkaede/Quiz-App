<nav>
  <h3>Quiz</h3>
  <ul>
    <li><a href="index.php">Home</a></li>

    <?php if(isset($user)) { ?>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="quiz.php">Quiz</a></li>
        <li><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="logout.php">Logout</a></li>

    <?php } else { ?>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
    <?php } ?>

  </ul>
</nav>
