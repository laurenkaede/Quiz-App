<nav>
  <h3><?php echo $user->username ?></h3>
  <ul>
    <li><a href="index.php">Home</a></li>

    <?php if (isset($user) && $user->userrole === "Guest") { ?>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="quizzes.php">Quizzes</a></li>
      <li><a href="scoreboard.php">Scoreboards</a></li>
      <li><a href="logout.php">Logout</a></li>
    <?php } ?>

    <?php if (($user == false && $user->userrole == !"Admin")) { ?>
      <li><a href="register.php">Register</a></li>
      <li><a href="login.php">Login</a></li>
    <?php } ?>

    <?php if (($user->userrole === "Admin")) { ?>
      <li><a href="admin.php">Admin</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="quizzes.php">Quizzes</a></li>
      <li><a href="scoreboard.php">Scoreboards</a></li>
      <li><a href="logout.php">Logout</a></li>

    <?php } ?>

  </ul>
</nav>