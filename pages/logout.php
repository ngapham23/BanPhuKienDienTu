<?php
session_start();

// Xóa tất cả session
session_unset();

// Hủy session
session_destroy();

// Chuyển hướng người dùng về trang chủ hoặc trang login
header('Location: index.php');
exit();
?>
