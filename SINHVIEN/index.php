<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Test1"
;

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM SinhVien";
$result = $conn->query($sql);
?><?php
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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Test1</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Sinh Viên</a></li>
                    <li class="nav-item"><a class="nav-link" href="hocphan.php">Học Phần</a></li>
                    <li class="nav-item"><a class="nav-link" href="dangky.php">Đăng Ký</a></li>
                    <li class="nav-item"><a class="nav-link" href="dangnhap.php">Đăng Nhập</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">TRANG SINH VIÊN</h2>
        <a href="create.php" class="btn btn-primary mb-3">Thêm Sinh Viên</a>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Mã Ngành</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['MaSV']; ?></td>
                    <td><?php echo $row['HoTen']; ?></td>
                    <td><?php echo $row['GioiTinh']; ?></td>
                    <td><?php echo $row['NgaySinh']; ?></td>
                    <td><img src="<?php echo $row['Hinh']; ?>" alt="Hình sinh viên" class="img-fluid" style="width: 100px;"></td>
                    <td><?php echo $row['MaNganh']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="detail.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm">Details</a>
                        <a href="delete.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        img { width: 100px; height: auto; }
    </style>
</head>
<body>
    <h2>Danh Sách Sinh Viên</h2>
    <a href="create.php">Thêm Sinh Viên</a>
    <table>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Hình</th>
            <th>Mã Ngành</th>
            <th>Hành Động</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['MaSV']; ?></td>
            <td><?php echo $row['HoTen']; ?></td>
            <td><?php echo $row['GioiTinh']; ?></td>
            <td><?php echo $row['NgaySinh']; ?></td>
            <td><img src="<?php echo $row['Hinh']; ?>" alt="Hình sinh viên"></td>
            <td><?php echo $row['MaNganh']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['MaSV']; ?>">Edit</a> |
                <a href="detail.php?id=<?php echo $row['MaSV']; ?>">Detail</a> |
                <a href="delete.php?id=<?php echo $row['MaSV']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html
