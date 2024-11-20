<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="/BanPhuKien/admin/css/admin.css">
</head>
<body>
    <h3  class="title_admin">TRANG QUẢN LÝ</h3>
    <div class="wrapper">
    <?php
    include "Sconfig/myconfig.php"; // có cái này dùng để gọi sql ,không cần dùng từng trang mà gọi 1 lần là xong
    include "Modules/header.php";
    include "Modules/menu.php";
    include "Modules/main.php";
    include "Modules/footer.php";
   ?>
   </div>
</body>
</html>