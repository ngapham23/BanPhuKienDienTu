<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/BanPhuKien/admin/Sconfig/myconfig.php";
      $sql_pro = "SELECT * FROM tbl_danhmuc, tbl_sanpham 
      WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
      ORDER BY tbl_sanpham.id_sanpham ASC LIMIT 20";
      $query_pro = mysqli_query($mysqli, $sql_pro);

?>
<h3>Sản Phẩm Mới Nhất</h3>

<ul class="list_product">
            <?php
            while ($row = mysqli_fetch_array($query_pro)) {
            ?>
            <li>
             <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
             <img src="/BanPhuKien/admin/Modules/quanlysp/uploads/<?php echo htmlspecialchars($row['hinhanh']); ?>" alt="<?php echo $row['tensanpham'] ?>">
             <p class="title_product"><?php echo $row['tensanpham']   ?></p>
             <p class="price_product"><?php echo number_format($row['giasp'],0,',','.'). ' đ'   ?></p>
             </a>
            </li>
               
            <?php
            }
            ?>
         </ul>