<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $stmt = $pdo->prepare('SELECT * from users');
    $stmt->execute();
    $user1 = $stmt->fetchAll();

    $stmt = $pdo->prepare('SELECT id, username FROM users order by id');
    $stmt->execute([$userId]);
    $users = $stmt->fetchAll();

    if (isset($_POST['search'])) {
        $_POST['userlist'];
        $getUserById = $_POST['userlist'];
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$getUserById]);
        $fetchedUser = $stmt->fetch();
    }

    if (isset($_POST['editUsers'])) {
        $userName = trim(filter_var($_POST["userName"], FILTER_SANITIZE_STRING));
        $userEmail = trim(filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL));
        $userScore = trim(filter_var($_POST["userScore"], FILTER_SANITIZE_NUMBER_INT));
        $userTime = trim(filter_var($_POST["userTime"], FILTER_SANITIZE_NUMBER_INT));
        $userRole = trim(filter_var($_POST["userRole"], FILTER_SANITIZE_STRING));
        $getUserById = trim(filter_var($_POST["getUserById"], FILTER_SANITIZE_STRING));
        $stmt =  $pdo->prepare('UPDATE users SET username = ?, useremail = ?, userscore = ?, usertime = ?, userrole = ? WHERE id = ?');
        $stmt->execute([$userName, $userEmail, $userScore, $userTime, $userRole, $getUserById]);
    }

    $stmt = $pdo->prepare('SELECT * from users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
} else {
    header('Location: http://localhost:8888/quiz-project/index.php');
} ?>

<?php require('./inc/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="./inc/navbar.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="container">
        <div id="home" class="flex-center flex-column content">
            <div class="dropdown">
                <form name="userlist" action="admin.php" method="POST">
                    <h1 class="padding">Admin Panel</h1>
                    <label class="text">User:</label><br>
                    <div class="custom-select" style="width:200px;">
                        <select class="btn" name="userlist" size="1">
                            <option class="btn">-- Select User --</option>
                            <?php foreach ($users as $user) { ?>
                                <?php echo "<option type=submit name=searched value=$user->id>$user->username</option>" ?><br><br><br>
                                <?php echo $user->id . " " . $user->username ?>
                            <?php } ?>
                        </select>
                    </div>
            
                    <input type="hidden" name="userNameSent" value="<?php echo $user->username ?>" /><br>
                    <button class="btn" type="submit" name="search">Search Users</button><br>

                </form>

                <hr size="2" width="100%" color="white">

                <form action="admin.php" method="POST"><br>
                    <label class="text" for="userName">User Name:</label><br>
                    <input required type="text" name="userName" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->username ?>
                    <?php } ?>" /><br>

                    <label class="text" for="userEmail">Email Address:</label><br>
                    <input required type="email" name="userEmail" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->useremail ?>
                    <?php } ?>" /><br>

                    <label class="text" for="userScore">User Score:</label><br>
                    <input type="text" name="userScore" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->userscore ?>
                    <?php } ?>" /><br>

                    <label class="text" for="userTime">User Time:</label><br>
                    <input type="text" name="userTime" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->usertime ?>
                    <?php } ?>" /><br>

                    <label class="text" for="userRole">Admin/Guest</label><br>
                    <input required type="text" name="userRole" value="<?php if ($fetchedUser) { ?> 
                        <?php echo $fetchedUser->userrole ?> 
                    <?php } ?>" /><br>

                    <?php if (isset($getUserById)) { ?>
                        <input name="getUserById" type="hidden" value="<?php echo $getUserById ?>">
                   <?php } ?>

                    <button class="btn" name="editUsers" type="submit">Edit</button>
                </form>

            </div>
            <?php require('./inc/footer.php') ?>
        </div>
    </div>
    <script src="./js/admin.js"></script>
</body>

</html>