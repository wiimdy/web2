<?php
    session_start();
    if (!isset($_SESSION['id']) && strtok($_SERVER['REQUEST_URI'], '/') !='login.php'){
        header("Location: /login.php");
        exit();
    }

?>