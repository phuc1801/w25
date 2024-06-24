<?php
    include('connect.php');
    session_start();
    if(isset($_POST['dangnhap'])){
        $username = htmlspecialchars($_POST['username']);
        $matkhau = htmlspecialchars($_POST['matkhau']);
        $sql = "SELECT * FROM user WHERE username = :username AND matkhau = :matkhau";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':username' => $username, ':matkhau' => $matkhau]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row > 0){
            $_SESSION['username'] = $username;
            header('location: index.php');
            exit();
        }else{
            echo '<div class="alert alert-danger" role="alert">Tài khoản hoặc mật khẩu sai</div>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <h2 class="text-center text-primary mt-3">LOGIN</h2>
    <div class="container">
        <form action="" method="post">
            <div class="form-group mt-3">
                <label for="">Tài khoản</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group mt-3">
                <label for="">Mật khẩu</label>
                <input type="password" class="form-control" name="matkhau">
            </div>
            <div class="form-group mt-3">
                <button class="form-control bg-primary text-white" name="dangnhap">Đăng nhập</button>
                <a href="forgot_password.php" class="btn bg-warning text-white mt-3">Quên mật khẩu</a>
            </div>
        </form>
    </div>
</body>
</html>