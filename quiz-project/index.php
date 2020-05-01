<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    $stmt = $pdo->prepare('SELECT * from users WHERE id = ?');
    $stmt->execute([$userId]);

    $user = $stmt->fetch();

    if ($user->role === 'Guest') {
        $message = "Your role is a guest";
    }
}

?>

<?php require('./inc/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <link rel="stylesheet" href="./inc/navbar.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Quiz</title>
</head>

<body>

    <div class="container">
    
        <?php if (isset($user)) { ?>
            <h3>Welcome to the quiz, <?php echo $user -> username ?>!</h3>
        <?php } else { ?>
        <h3>Welcome Guest!</h3> 
        <h5>Please login or Register to access the quiz!</h5>
        <?php } ?>

    </div>
    <script src="./js/index.js"></script>
</body>

</html>