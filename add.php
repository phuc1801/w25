<?php
    include('connect.php');
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
        exit();
    }
    if(isset($_POST['them'])){
        $tensach = htmlspecialchars($_POST['tensach']);
        $tomtat = htmlspecialchars($_POST['tomtat']);
        $tacgia = htmlspecialchars($_POST['tacgia']);
        $namxb = htmlspecialchars($_POST['namxb']);
        $loaisach = htmlspecialchars($_POST['loaisach']);
        $sql = "INSERT sach(tensach, tomtat, tacgia, namxb, loaisach) VALUES(:tensach, :tomtat, :tacgia, :namxb, :loaisach)";
        $stmt = $conn->prepare($sql);
        $parans = [
            ':tensach' => $tensach,
            ':tomtat' => $tomtat,
            ':tacgia' => $tacgia,
            ':namxb' => $namxb,
            ':loaisach' => $loaisach
        ];
        $stmt->execute($parans);
        header('location:index.php');
        exit();
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
    <h2 class="text-center text-primary mt-3">THÊM SÁCH</h2>
    <div class="container">
        <form action="" method="post">
            <div class="form-group mt-3">
                <label for="">Tên sách</label>
                <input type="text" class="form-control" name="tensach">
            </div>
            <div class="form-group mt-3">
                <label for="">Tóm tắt</label>
                <input type="text" class="form-control" name="tomtat">
            </div>
            <div class="form-group mt-3">
                <label for="">Tác giả</label>
                <input type="text" class="form-control" name="tacgia">
            </div>
            <div class="form-group mt-3">
                <label for="">Năm xuất bản</label>
                <input type="text" class="form-control" name="namxb">
            </div>
            <div class="form-group mt-3">
                <label for="">Loại sách</label>
                <input type="text" class="form-control" name="loaisach">
            </div>
            <button class="btn bg-primary text-white mt-3" name="them">Thêm</button>
        </form>
    </div>
</body>
</html>