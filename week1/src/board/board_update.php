<?php 
session_start();
if(!isset($_SESSION['username'])) {
    echo("<script>alert('No Update Permission')</script>");
    echo("<script>location.href='/index.php';</script>");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // id 인자가 없으면 exit
    if (!isset($_GET['id'])) {
        echo("<script>alert('Wrong Access')</script>");
        echo("<script>location.href='/index.php';</script>");
        exit();
    }

    $username = $_SESSION['username'];
    $conn = mysqli_connect(getenv("DB_HOST"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE"));
    if ($conn->connect_error) {
        echo "db error";
        exit();
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM boards WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    // id에 해당하는 글이 없으면 exit
    if ($row_count != 1){
        echo("<script>alert('Wrong ID')</script>");
        echo("<script>location.href='/index.php';</script>");
        exit();
    }

    // id에 해당하는 writer와 session 소유자가 다른 경우 exit
    if ($row['writer'] != $username) {
        echo("<script>alert('No Update Permission')</script>");
        echo("<script>location.href='/index.php';</script>");
        exit();
    }
}
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update</title>
    </head>
    <body>
    <form name='article' action='board_update.php' method='POST'>
        <h2>Title: </h2>
        <input type='text' required autofocus name='title' maxlength='60' size='30' placeholder='title'>
        <h2>Content :</h2>
        <input type='text' required name='content' size='30' style="height:300px" width=300px placeholder='Content'><br>
        <input type='submit'>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

    </form> 
    </body>
    </html>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_POST['id'];
    $conn = mysqli_connect(getenv("DB_HOST"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE"));
    if ($conn->connect_error) {
        echo "db error";
        exit();
    }

    // session check
    $sql = "SELECT * FROM boards WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    // id에 해당하는 글이 없으면 exit
    if ($row_count != 1){
        echo("<script>alert('Wrong ID')</script>");
        echo("<script>location.href='/index.php';</script>");
        exit();
    }

    $username = $_SESSION['username'];
    // id에 해당하는 writer와 session 소유자가 다른 경우 exit
    if ($row['writer'] != $username) {
        echo("<script>alert('No Update Permission')</script>");
        echo("<script>location.href='/index.php';</script>");
        exit();
    }

    $sql = "UPDATE boards SET title = ?, content = ? WHERE id = ?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi",$title, $content, $id);
    mysqli_stmt_execute($stmt);

    // alert 띄우고 index로 redirect
    echo("<script>alert('Success Update')</script>");
    echo("<script>location.href='/board/board_read.php?id=". $id ."';</script>");
}
    else {
        # code..
        exit();
    }
// $result = mysqli_stmt_get_result($stmt);
?>