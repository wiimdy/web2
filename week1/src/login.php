<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $pw = $_POST['pw'];
        if (empty($id) or empty($pw)) {
            echo("<script>alert('Enter id and pw')</script>");
            exit();
        }
        // $conn = mysqli_connect(getenv())
        $conn = mysqli_connect(getenv("DB_HOST"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE"));
        if ($conn->connect_error) {
            echo "<script>alert('Not connected:') </script>";
            die("Not connected: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $hashed_password = hash('sha256', $pw);

        if ($row = mysqli_fetch_assoc($result)) {

            if ($row['password'] !== $hashed_password ) {
                echo("<script>alert('login fail')</script>");
                echo("<script>location.href='/index.php';</script>");
                exit();
            }
            else {
                $_SESSION['username'] = $id;
                header('Location: index.php');
                exit();
            }
        }
        else {
            echo("<script>alert('login fail')</script>");
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
    <title>Login page</title>
</head>
<body>
    <h1>Login</h1>
    <form action='login.php' method='POST'>
        <h3>ID</h3>
        <input type='text' name='id' placeholder='ID'>
        <h3>Password</h3>
        <input type='password' name='pw' placeholder='password'> 
        <input type='submit'>
    </form>  
    <h3><a href="index.php">Home </a></h3>

    <img src="img/14.png" width="60%" height="60%" alt="ohhae">
</body>
</html>

