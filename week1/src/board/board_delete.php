<?php 
session_start();
if(!isset($_SESSION['username'])) {
    echo("<script>alert('No Delete Permission')</script>");
    echo("<script>location.href='/index.php';</script>");
    exit();
}

// get method 아닌 경우 exit
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    header("Location: index.php");
    exit();
}

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
    echo("<script>alert('No Delete Permission')</script>");
    echo("<script>location.href='/index.php';</script>");
    exit();
}

$sql = "DELETE FROM boards WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

// alert 띄우고 index로 redirect
echo("<script>alert('Success delete')</script>");
echo("<script>location.href='/index.php';</script>");
// $result = mysqli_stmt_get_result($stmt);
?>