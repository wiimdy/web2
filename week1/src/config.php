<?php
    session_start();
    if (!isset($_SESSION['username']) && strtok($_SERVER['REQUEST_URI'], '/') !='login.php'){
        header("Location: /login.php");
        exit();
    }

?>