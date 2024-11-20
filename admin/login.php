<?php


$mysqli = new mysqli("localhost","root","","banphukien");


if ($mysqli->connect_error) {
   echo"loi ket noi"   .$mysqli->connect_error;
   exit();
}
?>
=
<?php
    session_start();
    if(isset($_POST['submit'])){
        $userName = $_POST["Username"];
        $password = $_POST["Password"];

        if(isset($userName) && isset($password)){
            $sql_tkVsMk = "SELECT * from tbl_account WHERE taikhoan='$userName' AND password='$password' ";
            $query = mysqli_query($mysqli,$sql_tkVsMk); 
            $rows = mysqli_num_rows($query);
            if($rows > 0){
                $_SESSION["Username"]=$userName;
                $_SESSION["Password"]=$password;
                header('location: index.php');
            }else{
                echo '<center style="position: relative;padding: 0.75rem 1.25rem;transition: ease-in-out 0.2s;
                margin-bottom: 1rem;border: 1px solid transparent;border-radius: 0.25rem;color: #721c24;background-color: #f8d7da;border-color: #f5c6cb;">
                Tài khoản hoặc mật khẩu không chính xác. Vui lòng nhập lại!</center>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/css/login.css">
    <link rel="stylesheet" href="static/css/login/app.css">

    
    <title>Admin_login</title>
</head>
 
<body style="background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxW6YNluYITI6k3AqfNX9eHt6PACq0ucQw9A&s');background-size: cover;">
    <div id="wrapper">
       
        <form action="" method="POST" id="form-login">
            <h1 class="form-heading">Đăng nhập</h1>
            <div class="form-group">
                <input type="text" class="form-input" name="Username" placeholder="Tên đăng nhập">
            </div>
            <div class="form-group">
                <input type="password" name="Password"  class="form-input" placeholder="Mật khẩu">
            </div>
            <input type="submit" value="Đăng nhập" name="submit"  class="form-submit">
        </form>
    </div>
</body>
</html>