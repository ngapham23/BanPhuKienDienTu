<style>
     .form-container {
            width: 400px;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 50px auto;
            
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

<div class="form-container">
        <h2>Thêm Sản Phẩm</h2>
        <form action="Modules/quanlysp/xuly.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="categoryName">Tên Sản Phẩm</label>
                <input type="text" id="categoryName" name="tensanpham" required placeholder="Nhập tên sản phẩm">
            </div>
            <div class="form-group">
                <label for="categoryOrder">Mã Sản Phẩm</label>
                <input type="number" id="categoryOrder" name="masp" min="1" required placeholder="Nhập mã sản phẩm">
            </div>
            <div class="form-group">
                <label for="categoryOrder">Giá</label>
                <input type="number" id="categoryOrder" name="giasp" min="1" required placeholder="Nhập giá bán">
            </div>
            <div class="form-group">
                <label for="categoryOrder">Số Lượng</label>
                <input type="number" id="categoryOrder" name="soluongsp" min="1" required placeholder="Nhập số lượng">
            </div>
            <div class="form-group">
                <label for="categoryOrder">Tóm Tắt</label>
                <textarea row="5" name="tomtat" id="" style="width: 400px; height: 118px; resize:none;" ></textarea>
            </div>
            <div class="form-group">
                <label for="categoryOrder">Nội Dung</label>
                <textarea row="5" name="noidung" id="" style="width: 399px; height: 139px; resize:none;" ></textarea>
            </div>
            <div class="form-group">
                <label for="categoryOrder">Hình Ảnh</label>
                <input  type="file" id="categoryOrder" name="hinhanh" min="1" >
            </div>
            <div class="form-group">
                <label for="categoryOrder">Danh Mục Sản Phẩm</label>
                <select name="danhmuc" id="">
                    <?php 
                    $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc ASC";
                    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                    while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                       
                    ?>
                    <option value=" <?php echo $row_danhmuc['id_danhmuc']?>"> <?php echo $row_danhmuc['tendanhmuc']?>  </option>
                    <?php
                    } 
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="categoryOrder">Tình Trạng</label>
                <select name="tinhtrang" id="">
                    <option value="1">Kích Hoạt</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            
            <button type="submit" name="themsanpahm" class="submit-btn">Thêm Sản Phẩm</button>
        </form>
    </div>