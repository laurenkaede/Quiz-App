<?php
session_start();

if (isset($_SESSION['userId'])) {
    session_destroy();
    header('Location: http://localhost:8888/quiz-project/index.php');
}

?>


<?php require('./inc/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./inc/navbar.css">
    <link rel="stylesheet" href="./css/logout.css">
    <title>Logout</title>
</head>

<body>
    <div class="container">
        <h3>Log Out</h3>



    </div>
    <script src="./js/logout.js"></script>
</body>

</html>