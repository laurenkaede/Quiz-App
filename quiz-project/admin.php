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
        $userDisneyScore = trim(filter_var($_POST["userDisneyScore"], FILTER_SANITIZE_NUMBER_INT));
        $userDisneyTime = trim(filter_var($_POST["userDisneyTime"], FILTER_SANITIZE_NUMBER_INT));
        $userAvengersScore = trim(filter_var($_POST["userAvengersScore"], FILTER_SANITIZE_NUMBER_INT));
        $userAvengersTime = trim(filter_var($_POST["userAvengersTime"], FILTER_SANITIZE_NUMBER_INT));
        $userStarwarsScore = trim(filter_var($_POST["userStarwarsScore"], FILTER_SANITIZE_NUMBER_INT));
        $userStarwarsTime = trim(filter_var($_POST["userStarwarsTime"], FILTER_SANITIZE_NUMBER_INT));
        $userRole = trim(filter_var($_POST["userRole"], FILTER_SANITIZE_STRING));
        $getUserById = trim(filter_var($_POST["getUserById"], FILTER_SANITIZE_STRING));

        $stmt =  $pdo->prepare('UPDATE users SET username = ?, useremail = ?, userdisneyscore = ?, userdisneytime = ?, useravengersscore = ?, useravengerstime = ?, userstarwarsscore = ?, userstarwarstime = ?, userrole = ? WHERE id = ?');
        $stmt->execute([$userName, $userEmail, $userDisneyScore, $userDisneyTime, $userAvengersScore, $userAvengersTime, $userStarwarsScore, $userStarwarsTime, $userRole, $getUserById]);
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
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./inc/navbar.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="containerAdmin">
        <div id="home" class="flex-center flex-columnAdmin content">
            <div class="dropdown">
                <form name="userlist" action="admin.php" method="POST">
                    <h1 class="padding">Admin Panel</h1>
                    <label class="text">User:</label><br>
                    <div class="custom-select" style="width:200px;">
                        <select class="btn" name="userlist" size="1">
                            <option class="btn">-- Select User --</option>
                            <?php foreach ($users as $user) { ?>
                                <?php echo "<option type=submit name=searched value=$user->id>$user->username</option>" ?><br><br><br>
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

                    <label class="text" for="userDisneyScore">Disney Score:</label><br>
                    <input type="text" name="userDisneyScore" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->userdisneyscore ?>
                    <?php } ?>" /><br>

                    <label class="text" for="userDisneyTime">Disney Time:</label><br>
                    <input type="text" name="userDisneyTime" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->userdisneytime ?>
                    <?php } ?>" /><br>

                    <label class="text" for="userAvengersScore">Avengers Score:</label><br>
                    <input type="text" name="userAvengersScore" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->useravengersscore ?>
                    <?php } ?>" /><br>

                    <label class="text" for="userAvengersTime">Avengers Time:</label><br>
                    <input type="text" name="userAvengersTime" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->useravengerstime ?>
                    <?php } ?>" /><br>

                      <label class="text" for="userStarwarsScore">Star Wars Score:</label><br>
                    <input type="text" name="userStarwarsScore" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->userstarwarsscore ?>
                    <?php } ?>" /><br>

                    <label class="text" for="userStarwarsTime">Star Wars Time:</label><br>
                    <input type="text" name="userStarwarsTime" value="<?php if ($fetchedUser) { ?>
                        <?php echo $fetchedUser->userstarwarstime ?>
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