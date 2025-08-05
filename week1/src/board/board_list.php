<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board</title>
</head>
<body>
    <h2>Board List</h2>
    <a href = "/board/board_write.php">Board Write (only register user)</a>

    <?php
        $conn = mysqli_connect(getenv("DB_HOST"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE"));
        if ($conn->connect_error) {
            echo "db error";
            exit();
        }
        $sql = "SELECT * FROM boards";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row_count = mysqli_num_rows($result);
        if ($row_count > 0):?>
        <h2>
        <table>
            <thead>
                <tr>
                    <th>Num</th>
                    <th>Title</th>
                    <th>Writer</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
        <?php
            while ($row_count):
                $row = mysqli_fetch_assoc($result);
                ?>
                <tr>
                    <th><?php echo htmlentities($row['id']); ?></th>
                    <th><?php echo htmlentities($row['title']);?></th>
                    <th><?php echo htmlentities($row['writer']);?></th>
                    <th><?php echo  "<a href=board_read.php?id=".$row['id']."> see </a>";?>
                </tr>
                <?php $row_count  = $row_count - 1;?>
            <?php endwhile;?>
            </tbody>
        </table>
            </h2>
        <?php else: ?>
           <p> No Board </p>
           <a href="/index.php">HOME</a>
           <?php exit();?>
        <?php endif; ?>
</body>
</html>