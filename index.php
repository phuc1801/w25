<?php
    include('connect.php');
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
        exit();
    }
    if(isset($_POST['timkiem'])){
        $keyword = htmlspecialchars($_POST['keyword']);
        $sql = "SELECT * FROM sach WHERE tensach LIKE :keyword OR tacgia LIKE :keyword";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':keyword' => '%' . $keyword . '%']);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $sql = "SELECT * FROM sach";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <header class="text-center text-primary mt-3">
        <h2>QUẢN LÝ THƯ VIỆN</h2>
        <img src="./assets/img/vmu.jpg" alt="" style="width: 120px;">
    </header>
    <content>
        <div class="container">
            <ul class="nav bg-primary mt-3 mb-3">
                <li class="nav-item"><a href="" class="nav-link text-primary text-white">Danh sách sách</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-primary text-white">Đăng xuất</a></li>
            </ul>
            <form action="" method="post">
                <label for="">Tìm kiếm</label>
                <input type="text" class="form-control ms-3" style="width: 420px; display: inline-block;" name="keyword">
                <button class="ms-3 btn bg-primary text-white" name="timkiem">Tìm kiếm</button>
                <a href="add.php" class="btn bg-warning text-white">Thêm</a>
            </form>
            <table class="table">
               <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sách</th>
                        <th>Tóm tắt</th>
                        <th>Tác giả</th>
                        <th>Năm xuất bản</th>
                        <th>Loại sách</th>
                        <th>Thao tác</th>
                    </tr>
               </thead>
               <tbody>
                <?php foreach($rows as $row):?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']);?></td>
                    <td><?php echo htmlspecialchars($row['tensach']);?></td>
                    <td><?php echo htmlspecialchars($row['tomtat']);?></td>
                    <td><?php echo htmlspecialchars($row['tacgia']);?></td>
                    <td><?php echo htmlspecialchars($row['namxb']);?></td>
                    <td><?php echo htmlspecialchars($row['loaisach']);?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']?>" class="btn bg-danger text-white">Sửa</a>
                    </td>
                </tr>
                <?php endforeach;?>
               </tbody>
            </table>
        </div>
    </content>
    <footer class="text-center text-primary mt-3">Nguyen Duy Phuc</footer>
</body>
</html>