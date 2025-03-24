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

$sql = "SELECT * FROM SinhVien";
$result = $conn->query($sql);

// Kiểm tra nếu 'id' tồn tại trong URL
if (!isset($_GET['id'])) {
    die("Lỗi: Không có mã học phần được truyền vào.");
}

$id = $_GET['id'];

// Truy vấn để lấy thông tin học phần
$sql = "SELECT * FROM HocPhan WHERE MaHocPhan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Lỗi: Không tìm thấy học phần.");
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Học Phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">ĐĂNG KÝ HỌC PHẦN</h2>
        <table class="table table-bordered">
            <tr>
                <th>Mã Học Phần</th>
                <td><?php echo htmlspecialchars($row['MaHocPhan']); ?></td>
            </tr>
            <tr>
                <th>Tên Học Phần</th>
                <td><?php echo htmlspecialchars($row['TenHocPhan']); ?></td>
            </tr>
            <tr>
                <th>Số Tín Chỉ</th>
                <td><?php echo htmlspecialchars($row['SoTinChi']); ?></td>
            </tr>
        </table>
        <a href="index.php" class="btn btn-primary">Quay Lại</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
