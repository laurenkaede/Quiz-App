<nav>
  <h3>Quiz</h3>
  <ul>
    <li><a href="index.php">Home</a></li>

    <?php if(isset($user) && $user -> role === "Guest") { ?>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="quiz.php">Quiz</a></li>
        <li><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="logout.php">Logout</a></li>   
    <?php } ?>
    
    <?php if (($user == false && $user -> role == !"Admin")) { ?>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
    <?php } ?>

    <?php if(($user -> role === "Admin")) { ?>
        <li><a href="admin.php">Admin</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="quiz.php">Quiz</a></li>
        <li><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="logout.php">Logout</a></li>

    <?php } ?>

  </ul>
</nav>

