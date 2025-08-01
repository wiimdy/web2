<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Home Page</h1>
     <h2><a href="login.php">Login</a></h2>
     <h2><a href="register.php">Register</a></h2>
     <h2> <a href='board.php'> board </a></h2>
    
    <?php

    if (isset($_SESSION['id'])) {
        echo "Hello user: ". $_SESSION['id'];
        echo "<h2> Only Player Menu</h2>";
        echo "<h3> <a href='logout.php'> logout </a></h3>";

    }
    else {
    echo "Hello World";

    }
    ?>
    
    <br>
    
    <img src="img/12.jpg" width="80%" height="80%" alt="ohhae">

</body>
</html>



<!-- 로그인, 로그 아웃, 회원 가입 
 첫 페이지 hello world 출력  로그인 , 회원 가입 페이지 -->