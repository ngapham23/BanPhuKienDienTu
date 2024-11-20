<style>
      .form-container{
        width: 383px;
             background-color: #ffffff;
             padding: 39px;
              border: 1px solid #ddd;
             box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
             border-radius: 8px;
             margin: 8px 10px;
      }
        
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
           
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            color: #555;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], 
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            
        }
        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus {
            border-color: #0c5454;
            outline: none;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #0c5454;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }
        .submit-btn:hover {
            background-color: #084848;
        }
</style>

<?php 
$sql_sua_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' LIMIT 1";
$query_sua_sp = mysqli_query($mysqli, $sql_sua_sp);

?>

<div class="form-container">
        <h2>Sửa  Sản Phẩm</h2>
        <?php
            while ($row = mysqli_fetch_array($query_sua_sp)) {
            ?>


        <form action="Modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>" method="POST" enctype="multipart/form-data">
         
            <div class="form-group">
                <label for="categoryName">Tên Sản Phẩm</label>
                <input type="text" id="categoryName" name="tensanpham" required placeholder="Nhập tên sản phẩm" value="<?php echo trim($row['tensanpham']); ?>">    
            </div>
            <div class="form-group">
                <label for="categoryOrder">Mã Sản Phẩm</label>
                <input type="text" id="categoryOrder" name="masp" min="1" required placeholder="Nhập mã sản phẩm"  value="<?php echo trim($row['masp']); ?>">
            </div>
            <div class="form-group">
                <label for="categoryOrder">Giá</label>
                <input type="text" id="categoryOrder" name="giasp" min="1" required placeholder="Nhập giá bán"  value="<?php echo trim($row['giasp']); ?>">
            </div>
            <div class="form-group">
                <label for="categoryOrder">Số Lượng</label>
                <input type="number" id="categoryOrder" name="soluongsp" min="1" required placeholder="Nhập số lượng" value="<?php echo trim($row['soluong']); ?>">
            </div>
            <div class="form-group">
                <label for="categoryOrder">Tóm Tắt</label>
                <textarea row="5" name="tomtat" id="" style="width: 400px; height: 118px; resize:none;" > <?php echo trim($row['tomtat']); ?></textarea >
            </div>
            <div class="form-group">
                <label for="categoryOrder">Nội Dung</label>
                <textarea row="5" name="noidung" id="" style="width: 399px; height: 139px; resize:none;" ><?php echo trim($row['noidung']); ?></textarea  >
            </div>
            <div class="form-group">
    <label for="categoryOrder">Hình Ảnh</label>
    <input type="file" id="categoryOrder" name="hinhanh">
    
    <?php if (!empty($row['hinhanh'])): ?>
        <!-- Nếu có ảnh cũ, hiển thị ảnh cũ -->
        <img src="Modules/quanlysp/uploads/<?php echo htmlspecialchars($row['hinhanh']); ?>" alt="Ảnh cũ" style="width:150px">
    <?php endif; ?>
</div>
<div class="form-group">
                <label for="categoryOrder">Danh Mục Sản Phẩm</label>
                <select name="danhmuc" id="">
                    <?php 
                    $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc ASC";
                    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                    while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                       if($row['id_danhmuc']==$row_danhmuc['id_danhmuc']){
                    ?>
                    <option selected value=" <?php echo $row_danhmuc['id_danhmuc']?>"> <?php echo $row_danhmuc['tendanhmuc']?>  </option>
                    <?php
                       }else{
                    ?>
                    <option  value=" <?php echo $row_danhmuc['id_danhmuc']?>"> <?php echo $row_danhmuc['tendanhmuc']?>  </option>
                    <?php

                       }
                    } 
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="categoryOrder">Tình Trạng</label>
                <select name="tinhtrang" id="" >
                    <?php
                    if($row['tinhtrang']==1){
                    ?>
                    <option value="1" selected>Kích Hoạt</option>
                    <option value="0">Ẩn</option>
                    <?php
                    }else{
                    ?>
                       <option value="1">Kích Hoạt</option>
                       <option value="0" selected>Ẩn</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            
            <button type="submit" name="suasanpham" class="submit-btn">Sửa Sản Phẩm</button>


         


        </form>
        <?php
            }
            ?>
    </div>