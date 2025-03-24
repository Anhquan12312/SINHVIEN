<?php
session_start();
include 'db.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hocphan'])) {
    $hocphans = $_POST['hocphan'];

    // Tạo đăng ký mới
    $sql = "INSERT INTO dangky (NgayDK, MaSV) VALUES (NOW(), '$MaSV')";
    $conn->query($sql);
    $MaDK = $conn->insert_id;

    // Lưu các học phần đã chọn vào ChiTietDangKy
    foreach ($hocphans as $MaHP) {
        $sql = "INSERT INTO chitietdangky (MaDK, MaHP) VALUES ('$MaDK', '$MaHP')";
        $conn->query($sql);
    }

    // Chuyển hướng đến trang giỏ hàng
    header("Location: cart_view.php");
    exit();
} else {
    echo "Bạn chưa chọn học phần nào! <a href='hocphan.php'>Quay lại</a>";
}
?>