<?php
// Kết nối với cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "banphukien");

if ($mysqli->connect_error) {
    echo "Lỗi kết nối: " . $mysqli->connect_error;
    exit();
}

session_start();

if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ form đăng ký
    $userName = $_POST["Username"];
    $password = $_POST["Password"];
    $confirmPassword = $_POST["ConfirmPassword"];

    // Kiểm tra các trường dữ liệu có rỗng không
    if (empty($userName) || empty($password) || empty($confirmPassword)) {
        $error_message = "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Kiểm tra nếu mật khẩu và xác nhận mật khẩu giống nhau
        if ($password != $confirmPassword) {
            $error_message = "Mật khẩu và xác nhận mật khẩu không khớp!";
        } else {
            // Kiểm tra tài khoản đã tồn tại hay chưa
            $sql_check_user = "SELECT * FROM tbl_account WHERE taikhoan = ?";
            if ($stmt = $mysqli->prepare($sql_check_user)) {
                $stmt->bind_param("s", $userName);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $error_message = "Tài khoản đã tồn tại!";
                } else {
                    // Mã hóa mật khẩu
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Thực hiện chèn tài khoản vào cơ sở dữ liệu
                    $sql_insert = "INSERT INTO tbl_account (taikhoan, password) VALUES (?, ?)";
                    if ($stmt_insert = $mysqli->prepare($sql_insert)) {
                        $stmt_insert->bind_param("ss", $userName, $hashed_password);
                        $stmt_insert->execute();

                        // Sau khi đăng ký thành công, chuyển hướng tới trang đăng nhập
                        $_SESSION["Username"] = $userName;
                        header("Location: login.php");
                        exit();
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

            <form method="POST" action="register.php">
                <div class="input-group">
                    <label for="Username">Tài khoản</label>
                    <input type="text" id="Username" name="Username" required placeholder="Nhập tài khoản">
                </div>

                <div class="input-group">
                    <label for="Password">Mật khẩu</label>
                    <input type="password" id="Password" name="Password" required placeholder="Nhập mật khẩu">
                </div>

                <div class="input-group">
                    <label for="ConfirmPassword">Xác nhận mật khẩu</label>
                    <input type="password" id="ConfirmPassword" name="ConfirmPassword" required placeholder="Xác nhận mật khẩu">
                </div>

                <button type="submit" name="submit" class="register-btn">Đăng ký</button>

                <div class="login-link">
                    <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
