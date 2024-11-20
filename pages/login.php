<?php
// Kết nối cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "banphukien");

if ($mysqli->connect_error) {
    echo "Lỗi kết nối: " . $mysqli->connect_error;
    exit();
}

session_start();

if (isset($_POST['submit'])) {
    $userName = $_POST["Username"];
    $password = $_POST["Password"];

    if (isset($userName) && isset($password)) {
        $sql_tkVsMk = "SELECT * FROM tbl_account WHERE taikhoan = ?";
        
        if ($stmt = $mysqli->prepare($sql_tkVsMk)) {
            $stmt->bind_param("s", $userName); // Truyền tham số username
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                // Kiểm tra mật khẩu đã mã hóa
                if (password_verify($password, $row['password'])) {
                    $_SESSION["Username"] = $userName;
                    header('Location: index.php');
                    exit();
                } else {
                    $error_message = "Mật khẩu không chính xác!";
                }
            } else {
                $error_message = "Tài khoản không tồn tại!";
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
    <title>Đăng nhập</title>
    <link rel="stylesheet" href=".././css/login.css"> 
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Đăng nhập</h2>

            <?php if (isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST" action="login.php?quanly=dangnhap">
                <div class="input-group">
                    <label for="Username">Tài khoản</label>
                    <input type="text" id="Username" name="Username" required placeholder="Nhập tài khoản">
                </div>

                <div class="input-group">
                    <label for="Password">Mật khẩu</label>
                    <input type="password" id="Password" name="Password" required placeholder="Nhập mật khẩu">
                </div>

                <button type="submit" name="submit" class="login-btn">Đăng nhập</button>

                <div class="register-link">
                    <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
                </div>
            </form>
            <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>
        </div>
    </div>
</body>
</html>
