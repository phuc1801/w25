<!-- add -->
<?php
include('connect.php');

if(isset($_POST['them'])){
    $id = htmlspecialchars($_POST['id']);
    $khachhang_id = htmlspecialchars($_POST['khachhang_id']);
    $trangthai = htmlspecialchars($_POST['trangthai']);
    $khuyenmai = htmlspecialchars($_POST['khuyenmai']);
    $ngayban = htmlspecialchars($_POST['ngayban']);
    $ngaygiaohang = htmlspecialchars($_POST['ngaygiaohang']);
    $ghichu = htmlspecialchars($_POST['ghichu']);

    // Kiểm tra xem ID đã tồn tại chưa
    $checkSql = "SELECT COUNT(*) FROM donhang WHERE id = :id";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->execute([':id' => $id]);
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo '<div class="alert alert-danger" role="alert">ID đã tồn tại. Vui lòng nhập ID khác.</div>';
    } else {
        // Chèn bản ghi mới nếu ID chưa tồn tại
        $sql = "INSERT INTO donhang(id, khachhang_id, trangthai, khuyenmai, ngayban, ngaygiaohang, ghichu)
                VALUES(:id, :khachhang_id, :trangthai, :khuyenmai, :ngayban, :ngaygiaohang, :ghichu)";
        $stmt = $conn->prepare($sql);
        $params = [
            ':id' => $id,
            ':khachhang_id' => $khachhang_id,
            ':trangthai' => $trangthai,
            ':khuyenmai' => $khuyenmai,
            ':ngayban' => $ngayban,
            ':ngaygiaohang' => $ngaygiaohang,
            ':ghichu' => $ghichu
        ];
        $stmt->execute($params);
        header('location: index.php');
    }
}
?>
