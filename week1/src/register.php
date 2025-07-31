<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
</head>
<body>
    <h1>Register</h1>
    <form action="register.php" method="post">
        <h3>ID</h3>
        <input type="text" name="ID" placeholder="ID">
        <h3>Password</h3>
        <input type="password" name="pw" placeholder="Password">
        <input type="submit" value="Register">
    </form>
    <img src="img/13.png" width="40%" height="40%" alt="ohhae">

</body>
</html>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['ID'];
        $password = $_POST['pw'];
        if (empty($id) || empty($password)){
             echo "<script>alert('Enter Id and Password.');</script>";
        }
    }
    echo $id;
    echo $password;
    $conn = mysqli_connect(getenv("DB_HOST"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE"));

    if ($conn->connect_error) {
        echo "<script>alert('Not connected:') </script>";
        die("Not connected: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0){
        echo "<script>alert('ID already exists.');</script>";
        die();
    }
    else {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        $hashed_password = hash('sha256', $password);
        mysqli_stmt_bind_param($stmt, "ss", $id, $hashed_password);
        mysqli_stmt_execute($stmt);

        echo "<script>alert('Register success!'); window.location.href = 'index.php';</script>";
        exit;
    }
    //  일단 sql 연결, 아이디가 있는지 체크 비었는지 체크
?>