<?php

    session_start();

    if (isset($_SESSION['userId'])) {
        require('./config/db.php');

        $userId = $_SESSION['userId'];

        $stmt = $pdo -> prepare('SELECT * from Users WHERE id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch();

        if($user->userrole == "Admin") {
            $admin = true;

            $stmt = $pdo -> prepare('SELECT username from Users');
            $stmt->execute();
            $users = $stmt->fetchAll();

        } else {
            header('Location: http://localhost:8888/quiz-project/index.php');
        }

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
    <link rel="stylesheet" href="./inc/navbar.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Admin Dashboard</title>
</head>

<body>

    <?php if ($admin) { ?>
        <?php foreach($users as $user) { ?>
            <h1><?php echo $user->username ?></h1>
        <?php } ?>
    <?php } ?>

    <?php require('./inc/footer.php') ?>
    <script src="./js/admin.js"></script>
</body>

</html>