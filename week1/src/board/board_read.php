<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
</head>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'GET'):
    if (!isset($_GET['id'])) {
        echo "Input: ?id={your_id}";
        exit();
    }
    $id = $_GET['id'];
    $conn = mysqli_connect(getenv("DB_HOST"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE"));
    if ($conn->connect_error)
    {
        echo "Connection Fail!";
        exit();
    }
    $sql = "SELECT * FROM boards WHERE id = ? ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)):
?>

<body>
    <h2>Board List</h2>
    <h2> <a href='/index.php'> Home </a></h2>
    
    <h3>Num: <?php echo htmlentities($row['id']); ?></h3>
    <h3>Title: <?php echo htmlentities($row['title']); ?></h3>
    <h3>Writer: <?php echo htmlentities($row['writer']); ?></h3>



    <h3>Content</h3>
    <p><?php echo htmlentities($row['content']); ?></p>
    <?php else: ?>
        <p>No Id</p>
        <a href="/index.php">HOME</a>

        <?php exit();?>
    <?php endif; ?>
    <?php endif; ?>
    <h2> <a href='/board/board_list.php'> Back </a></h2>
    <?php
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        if ($username == $row['writer']) {
            echo  "<h2><a href=board_update.php?id=".$row['id']."> Update </a></h2>";
            echo  "<h2><a href=board_delete.php?id=".$row['id']."> Delete </a></h2>";
        }
    }
    ?>
    
</body>
</html>