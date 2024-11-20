<?php
 $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc ASC";
 $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
 $hideLogin = true;
 $hideRegister = false;
    
?>
<div class="menu">
         <ul class="list_menu">
         <li><a href="/BanPhuKien/pages/index.php"title="Trang Chủ" ><i class="fas fa-home"></i> </a></li>
         <li><a href="index.php?quanly=giohang" title="Giỏ Hàng"><i class="fa-solid fa-cart-plus"></i></a></li>
         <?php
          while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
         ?>
            <li><a href="index.php?quanly=danhmuc&id=<?php echo $row_danhmuc['id_danhmuc'] ?>" 
            title="Danh Mục"><?php echo $row_danhmuc['tendanhmuc'] ?></a></li>
            <?php
            }
            ?>
        <li><a href="index.php?quanly=tintuc" title="Tin Tức">Tin Tức</a></li>
        <li><a href="index.php?quanly=lienhe" title="Liên Hệ">Liên Hệ</a></li>
        <div class="lgrg">
        <?php if (isset($_SESSION['Username'])) { ?>
            <li><a href="index.php?quanly=profile" title="Trang cá nhân">Chào, <?php echo $_SESSION['Username']; ?></a></li>
            <li><a href="logout.php?quanly=dangxuat" title="Đăng xuất">Đăng xuất</a></li>
        <?php } else { ?>
            <li><a class="login <?php echo $hideLogin ? 'hidden' : ''; ?>" href="login.php?quanly=dangnhap" title="Đăng Nhập">Đăng Nhập</a></li>
            <li><a class="regis <?php echo $hideRegister ? 'hidden' : ''; ?>" href="register.php?quanly=dangky" title="Đăng Ký">Đăng Ký</a></li>
        <?php } ?>
        </div>





         </ul>
        
    </div>
    <div class="menu1">
    <div class="slideshow-container">
        <div class="slide fade">
        <img src="https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:quality(100)/H1_1440x242_004d520442.png" alt="Tai Nghe 1" >


        </div>

        <div class="slide fade">
        <img src="https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:quality(100)/H1_1440x242_1_21f6fbd02d.png" alt="Tai Nghe 1">
        </div>
        <div class="slide fade">
        <img src="https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:quality(100)/H1_1440x242_004d520442.png" alt="Tai Nghe 1" >
        </div>
    </div>

    </div>
  <style>
    .lgrg {
    margin: 0 181px;
    display: flex
;
}
.hidden {
    display: none;
}
  </style>