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
        if ($row_count > 0){
            while ($row_count)
            {    
                $row = mysqli_fetch_assoc($result);
                echo "id: " . $row['id'] . " user: " . $row['username'] . " title: " . $row['title'] . "<a href=read.php?id=".$row['id']."> see </a>";
                $row_count = $row_count - 1;
            }
        }

        else {
            echo "No board!";
        }

    ?>
</body>
</html>