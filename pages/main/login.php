<?php


// Kết nối với cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "banphukien");

if ($mysqli->connect_error) {
    die("Lỗi kết nối: " . $mysqli->connect_error);
}

if (isset($_POST['dangnhap'])) {
    // Lấy dữ liệu từ form đăng nhập
    $email = $_POST["email"];
    $matKhau = $_POST["matkhau"];

    // Kiểm tra các trường dữ liệu có rỗng không
    if (empty($email) || empty($matKhau)) {
        $error_message = "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Truy vấn để kiểm tra email trong bảng tbl_dangnhap
        $sql_check_email = "SELECT * FROM tbl_dangnhap WHERE email = ?";
        if ($stmt = $mysqli->prepare($sql_check_email)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Kiểm tra mật khẩu có đúng không
                if (password_verify($matKhau, $row['matkhau'])) {
                    // Mật khẩu chính xác, lưu thông tin vào session và chuyển hướng
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["dangnhap"] = true;

                    // Lấy thông tin tên khách hàng từ bảng tbl_dangky
                    $sql_khachhang = "SELECT tenkhachhang FROM tbl_dangky WHERE email = ?";
                    if ($stmt_khachhang = $mysqli->prepare($sql_khachhang)) {
                        $stmt_khachhang->bind_param("s", $email);
                        $stmt_khachhang->execute();
                        $result_khachhang = $stmt_khachhang->get_result();

                        if ($result_khachhang->num_rows > 0) {
                            $row_khachhang = $result_khachhang->fetch_assoc();
                            $_SESSION['tenkhachhang'] = $row_khachhang['tenkhachhang']; // Lưu tên khách hàng vào session
                        }
                    }

                    // Chuyển hướng đến trang chủ hoặc trang muốn
                    if (isset($_SESSION['from_cart']) && $_SESSION['from_cart'] == true) {
                         unset($_SESSION['from_cart']); // Xóa session 'from_cart' sau khi chuyển hướng
                         header("Location: index.php?quanly=giohang"); // Quay lại giỏ hàng
                    } else {
                         header("Location: index.php"); // Quay lại trang chủ
                    }
                    exit();
                } else {
                    $error_message = "Mật khẩu không chính xác!";
                }
            } else {
                $error_message = "Email không tồn tại!";
            }

            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản</title>
    <link rel="stylesheet" href="../css/login.css"> <!-- Liên kết đến file CSS -->
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Đăng nhập tài khoản</h2>

            <?php if (isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?quanly=dangnhap">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Nhập email">
                </div>

                <div class="input-group">
                    <label for="matkhau">Mật khẩu</label>
                    <input type="password" id="matkhau" name="matkhau" required placeholder="Nhập mật khẩu">
                </div>

                <button type="submit" name="dangnhap" class="login-btn">Đăng nhập</button>

                <div class="register-link">
                    <p>Chưa có tài khoản? <a href="index.php?quanly=dangky">Đăng ký ngay</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
