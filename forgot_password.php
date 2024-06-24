<?php
    include('connect.php');
    session_start();
    if(isset($_POST['dangnhap'])){
        $username = htmlspecialchars($_POST['username']);
        $matkhau = htmlspecialchars($_POST['matkhau']);
        $confrimmatkhau = htmlspecialchars($_POST['confrimmatkhau']);
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row > 0){
           if($matkhau !== $confrimmatkhau){
                echo '<div class="alert alert-danger" role="alert">Mật khẩu không khớp</div>';
           }else{
                $sql = "UPDATE user SET matkhau = :matkhau WHERE username = :username";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':username' => $username, ':matkhau' => $matkhau]);
                echo '<div class="alert alert-success" role="alert">Đổi thành công</div>';
           }
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
    <h2 class="text-center text-primary mt-3">FORGOT PASSWORD</h2>
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
                <label for="">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" name="confrimmatkhau">
            </div>
            <div class="form-group mt-3">
                <button class="btn bg-primary text-white" name="dangnhap">Đổi mật khẩu</button>
                <a href="login.php" class="btn bg-warning text-white">Đăng nhập</a>
            </div>
        </form>
    </div>
</body>
</html>