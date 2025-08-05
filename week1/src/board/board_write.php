<?php
require "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Write</title>
</head>
<body>
    <form name='article' action='board_write.php' method='POST'>
        <h2>Title: </h2>
        <input type='text' required autofocus name='title' maxlength='60' size='30' placeholder='title'>
        <h2>Content :</h2>
        <input type='text' required name='content' size='30' style="height:300px" width=300px placeholder='Content'><br>
        <input type='submit'>
    </form> 
    <?php $writer = $_SESSION['username'];
    if ($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        exit();
    }
        $title = $_POST['title'];
        $content = $_POST['content'];

        $conn = mysqli_connect(getenv("DB_HOST"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE"));
        $sql = "INSERT INTO boards (writer, title, content) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $writer, $title, $content);
        mysqli_stmt_execute($stmt);
        echo "<script>alert('Write success'); location.href='/board/board_list.php';</script>";
    ?>
</body>
</html>