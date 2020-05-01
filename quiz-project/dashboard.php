<?php
session_start();

if (isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    if (isset($_POST['edit'])) {
        $userName = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
        $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
        $stmt =  $pdo -> prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
        $stmt -> execute([$userName, $userEmail, $userId]);
        
    }
        $stmt = $pdo -> prepare ('SELECT * from users WHERE id = ?');
        $stmt -> execute([$userId]);
        $user = $stmt -> fetch();
        
}  else {
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
    <link rel="stylesheet" href="./css/dashboard.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <h1>Dashboard Portal</h1>
        <h3>Update Details</h3>

        <form action="dashboard.php" method="POST"> 
            <!-- Update this for PUT -->

            <label for="userName">User Name</label>
            <input required type="text" name="userName" placeholder="Enter User Name"  value = "<?php echo $user -> username ?>" />

            <label for="userEmail">Email Address</label>
            <input required type="email" name="userEmail" placeholder="Enter Email Address" value = "<?php echo $user -> email ?>" />
            <br />
            <?php if (isset($emailTaken)) { ?>
                <p><?php echo $emailTaken ?> </p>
            <?php } ?>

            <button name="edit" type="submit">Edit</button>

        </form>
    </div>
    <script src="./js/dashboard.js"></script>
</body>

</html>