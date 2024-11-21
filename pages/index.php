<!DOCTYPE html>
<html lang="en"></html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="stylesheet" type="text/css" href="../../BanPhuKien/css/style.css">

<link rel="stylesheet" type="text/css" href="../../BanPhuKien/css/slideimg.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<title>Phụ Kiện Online</title>

</style>
<meta name="description"
    content="Chuyên bán phụ kiện uy tín nhất">
</head>
<body>
    <div class="wrapper">
   <?php
   
   session_start();
//    unset($_SESSION['dangnhap']);
    include "../admin/Sconfig/myconfig.php";
    include "formcon/header.php";

    include "formcon/menu.php";
    include "formcon/main.php";
    include "formcon/footer.php";
   ?>
   
   <!-- yêu cầu chức năng: yêu cầu nghiệp vụ chức năng
   yêu cầu phi chức năng: yêu cầu chức năng
   yêu cầu hệ thống: 
   phiếu nhập kho
   phiếu xuất kho
   cân đối kho
   hoá đơn giá trị gia tăng
   
     --> 
     <script src=".././js/slide.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>
</html>