<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Test1";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra nếu có yêu cầu xóa sinh viên
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $MaSV = $_POST['id'];
    $sql = "DELETE FROM SinhVien WHERE MaSV='$MaSV'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Hiển thị thông tin chi tiết sinh viên
$detail = null;
if (isset($_GET['id'])) {
    $MaSV = $_GET['id'];
    $sql = "SELECT * FROM SinhVien WHERE MaSV='$MaSV'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $detail = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">XÓA THÔNG TIN</h2>
        <p>Bạn có chắc chắn muốn xóa sinh viên này không?</p>
        <?php if ($detail) { ?>
        <table class="table table-bordered">
            <tr>
                <th>Họ Tên</th>
                <td><?php echo $detail['HoTen']; ?></td>
            </tr>
            <tr>
                <th>Giới Tính</th>
                <td><?php echo $detail['GioiTinh']; ?></td>
            </tr>
            <tr>
                <th>Ngày Sinh</th>
                <td><?php echo $detail['NgaySinh']; ?></td>
            </tr>
            <tr>
                <th>Hình</th>
                <td><img src="<?php echo $detail['Hinh']; ?>" width="150" height="150"></td>
            </tr>
            <tr>
                <th>Mã Ngành</th>
                <td><?php echo $detail['MaNganh']; ?></td>
            </tr>
        </table>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $MaSV; ?>">
            <button type="submit" name="delete" class="btn btn-danger">Xóa</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
        </form>
        <?php } else { echo "Không tìm thấy thông tin sinh viên."; } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
