<?php
session_start();

if (isset($_SESSION['userId'])) {
    session_destroy();
    header('Location: http://localhost:8888/quiz-project/index.php');
}

?>