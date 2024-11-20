<div class="sidebar">
         <ul class="list_sidebar">
            <h1><i class="fa-solid fa-list"></i>  Danh Mục Sản Phẩm</h1>
            <?php
             $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc ASC";
             $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
             while ($row = mysqli_fetch_array($query_danhmuc)) {
            ?>
            
            <li><a  href="index.php?quanly=danhmuc&id=<?php echo $row['id_danhmuc'] ?>"> <?php echo $row['tendanhmuc'] ?></a> </li>
            <?php
            }
            ?>
         
         </ul>
    </div>