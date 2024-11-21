<?php
// Kết nối với cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "banphukien");

if ($mysqli->connect_error) {
    echo "Lỗi kết nối: " . $mysqli->connect_error;
    exit();
}



if (isset($_POST['dangky'])) {
    // Lấy dữ liệu từ form đăng ký
    $tenKhachHang = $_POST["tenkhachhang"];
    $email = $_POST["email"];
    $diaChi = $_POST["diachi"];
    $dienThoai = $_POST["dienthoai"];
    $matKhau = $_POST["matkhau"];
    $xacNhanMatKhau = $_POST["xacnhanmatkhau"];

    // Kiểm tra các trường dữ liệu có rỗng không
    if (empty($tenKhachHang) || empty($email) || empty($diaChi) || empty($dienThoai) || empty($matKhau) || empty($xacNhanMatKhau)) {
        $error_message = "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Kiểm tra nếu mật khẩu và xác nhận mật khẩu giống nhau
        if ($matKhau != $xacNhanMatKhau) {
            $error_message = "Mật khẩu và xác nhận mật khẩu không khớp!";
        } else {
            // Kiểm tra email đã tồn tại hay chưa
            $sql_check_email = "SELECT * FROM tbl_dangky WHERE email = ?";
            if ($stmt = $mysqli->prepare($sql_check_email)) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $error_message = "Email đã được sử dụng!";
                } else {
                    // Mã hóa mật khẩu
                    $hashed_password = password_hash($matKhau, PASSWORD_DEFAULT);

                    // Thực hiện chèn thông tin khách hàng vào cơ sở dữ liệu
                    $sql_insert = "INSERT INTO tbl_dangky (tenkhachhang, email, diachi, matkhau, dienthoai) VALUES (?, ?, ?, ?, ?)";
                    if ($stmt_insert = $mysqli->prepare($sql_insert)) {
                        $stmt_insert->bind_param("sssss", $tenKhachHang, $email, $diaChi, $hashed_password, $dienThoai);
                        $stmt_insert->execute();
                         // Sau khi đăng ký thành công, chèn dữ liệu vào bảng tbl_dangnhap
                         $sql_insert_login = "INSERT INTO tbl_dangnhap (email, matkhau) VALUES (?, ?)";
                         if ($stmt_insert_login = $mysqli->prepare($sql_insert_login)) {
                             $stmt_insert_login->bind_param("ss", $email, $hashed_password);
                             $stmt_insert_login->execute();
                            }
                            header("Location: index.php?quanly=dangnhap"); // Quay lại trang đăng nhập
                       
                       
                    } else {
                        $error_message = "Lỗi khi đăng ký, vui lòng thử lại!";
                    }
                }
                $stmt->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href=".././css/register.css"> <!-- Liên kết đến file CSS -->
</head>
<body>
    <div class="register-container">
        <div class="register-form">
            <h2>Đăng ký tài khoản</h2>

            <?php if (isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?quanly=dangky">
                <div class="input-group">
                    <label for="tenkhachhang">Tên khách hàng</label>
                    <input type="text" id="tenkhachhang" name="tenkhachhang" required placeholder="Nhập tên khách hàng">
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Nhập email">
                </div>

                <div class="input-group">
                    <label for="diachi">Địa chỉ</label>
                    <input type="text" id="diachi" name="diachi" required placeholder="Nhập địa chỉ">
                </div>

                <div class="input-group">
                    <label for="dienthoai">Điện thoại</label>
                    <input type="text" id="dienthoai" name="dienthoai" required placeholder="Nhập số điện thoại">
                </div>

                <div class="input-group">
                    <label for="matkhau">Mật khẩu</label>
                    <input type="password" id="matkhau" name="matkhau" required placeholder="Nhập mật khẩu">
                </div>

                <div class="input-group">
                    <label for="xacnhanmatkhau">Xác nhận mật khẩu</label>
                    <input type="password" id="xacnhanmatkhau" name="xacnhanmatkhau" required placeholder="Xác nhận mật khẩu">
                </div>

                <button type="submit" name="dangky" class="register-btn">Đăng ký</button>

                <div class="login-link">
                    <p>Đã có tài khoản? <a href="index.php?quanly=dangnhap">Đăng nhập ngay</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
