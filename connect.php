<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=thuvien2', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger" role="alert">Sai tên tài khoản hoặc mật khẩu xampp</div>';
    die();
}
?>
