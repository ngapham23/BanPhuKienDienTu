<style>
    /* Reset và thiết lập cơ bản */



.container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  width: 80%;
  margin: 0 auto;
}

.product-detail {
  background-color: #fff;
  display: flex;
  justify-content: space-between;
  padding: 40px 0;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  margin: 11px;
}

.product-left {
  flex: 1;
  margin-right: 30px;
}

.product-right {
  flex: 2;
}

.main-image img {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.thumbnail-images {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.thumbnail-images img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 8px;
  cursor: pointer;
  transition: transform 0.3s;
}

.thumbnail-images img:hover {
  transform: scale(1.1);
}

.product-title {
  font-size: 2rem;
  margin-bottom: 10px;
}

.product-category {
  font-size: 1rem;
  margin-bottom: 20px;
  color: #666;
}

.product-price {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 20px;
  color: #ff1a1a;
}

.product-description {
  font-size: 1rem;
  line-height: 1.6;
  margin-bottom: 30px;
}

.product-options {
  margin-bottom: 30px;
}

.option {
  margin-bottom: 15px;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
  display: block;
}

select, input {
  width: 53%;
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
}

.product-actions {
  display: flex;
  justify-content: space-between;
}

button {
  padding: 15px 30px;
  font-size: 1rem;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s;
}

.themgiohang {
  background-color: #4CAF50;
  color: #fff;
}

.themgiohang:hover {
  background-color: #45a049;
}

.buy-now {
  background-color: #f57c00;
  color: #fff;
}

.buy-now:hover {
  background-color: #e65100;
}

/* Footer */
footer {
  text-align: center;
  padding: 20px;
  background-color: #333;
  color: #fff;
  margin-top: 40px;
}
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}    /* //ẩn nú tăngg giảm */



  </style>



<?php

$sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham = '$_GET[id]' LIMIT 1";
             $query_chitiet = mysqli_query($mysqli, $sql_chitiet);
             while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
            ?>
<section class="product-detail">
<form action="main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham']; ?>" method="POST">




    <div class="container">
      <div class="product-left">
        <!-- Hình ảnh sản phẩm -->
        <div class="main-image">
          <img src="/BanPhuKien/admin/Modules/quanlysp/uploads/<?php echo htmlspecialchars($row_chitiet['hinhanh']); ?>" alt="<?php echo $row['tensanpham'] ?>" alt="Tên sản phẩm">
        </div>
        <div class="thumbnail-images">
          <img src="/BanPhuKien/admin/Modules/quanlysp/uploads/<?php echo htmlspecialchars($row_chitiet['hinhanh']); ?>" alt="<?php echo $row['tensanpham'] ?>" alt="Tên sản phẩm" alt="Ảnh nhỏ 1">
          <img src="/BanPhuKien/admin/Modules/quanlysp/uploads/<?php echo htmlspecialchars($row_chitiet['hinhanh']); ?>" alt="<?php echo $row['tensanpham'] ?>" alt="Tên sản phẩm" alt="Ảnh nhỏ 2">
          <img src="/BanPhuKien/admin/Modules/quanlysp/uploads/<?php echo htmlspecialchars($row_chitiet['hinhanh']); ?>" alt="<?php echo $row['tensanpham'] ?>" alt="Tên sản phẩm" alt="Ảnh nhỏ 3">
        </div>
      </div>

      <div class="product-right">
        <!-- Thông tin sản phẩm -->
        <h1 class="product-title"><?php echo htmlspecialchars($row_chitiet['tensanpham']); ?></h1>
        <p class="product-category">Danh mục: <?php echo htmlspecialchars($row_chitiet['tendanhmuc']); ?> <span></span></p>
        <p class="product-category">Mã sản phẩm: <?php echo htmlspecialchars($row_chitiet['masp']); ?></p>
        <p class="product-price"><?php echo number_format($row_chitiet['giasp'], 0, ',', '.'); ?> đ</p>
        <p class="product-description"><?php echo htmlspecialchars($row_chitiet['noidung']); ?></p>

        
        <!-- Chọn màu sắc và số lượng -->
        <div class="product-options">
          <div class="option">
            <label for="color">Chọn màu:</label>
            <select id="color" name="color">
              <option value="black">Đen</option>
              <option value="white">Trắng</option>
            </select>
          </div>
          <div class="option">
    <label for="quantity">Số Lượng:</label>
        <input type="number" id="quantity" name="quantity" 
           value="1" 
           min="1" 
           max="<?php echo htmlspecialchars($row_chitiet['soluong']); ?>" 
           required>
         </div>
        </div>

        <!-- Thêm vào giỏ hàng và mua ngay -->
        <div class="product-actions" >
          <button  type="submit" class="themgiohang" name="themgiohang">Thêm vào giỏ hàng</button>
          <button class="buy-now"  name="themgiohang"> Mua ngay</button>
        </div>
      </div>
    </div>
    </form>
  </section>
    <?php
                 }
                 ?>