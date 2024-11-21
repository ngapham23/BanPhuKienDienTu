<style>
    .product-table {
    width: 100%;
    margin: 20px 0;
}

.product-table h2 {
    text-align: center;
    margin-bottom: 15px;
}

.product-table table {
    width: 100%;
    border-collapse: collapse;
}

.product-table table, th, td {
    border: 1px solid #ddd;
}

.product-table th, .product-table td {
    word-wrap: break-word;
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 12px;
    text-align: center;
}



.product-table th {
    background-color: #4CAF50;
    color: white;
}

.product-table img {
    width: 50px;
    height: auto;
    border-radius: 5px;
}

.edit-btn, .delete-btn, .view-btn {
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
    font-size: 12px;
}

.edit-btn {
    background-color: #ffa500;
}

.delete-btn {
    background-color: #f44336;
}

.view-btn {
    background-color: #4CAF50;
}

.edit-btn:hover, .delete-btn:hover, .view-btn:hover {
    opacity: 0.8;
}
.btn-action {
    padding: 5px 10px;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 14px;
    margin: 0 5px;
}

.btn-delete {
    background-color: #e74c3c;
}

.btn-edit {
    background-color: #3498db;
}

.btn-action:hover {
    opacity: 0.8;
}

</style>
<?php 
$sql_lietke_sp = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc ORDER BY id_sanpham ASC";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>
<div class="product-table">
    <h2>Danh Sách Sản Phẩm</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Hình Ảnh</th>
                <th>Tóm Tắt</th>
                <th>Danh Mục</th>
                <th>Trạng Thái</th>

            </tr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query_lietke_sp)) {
                $i++;
            
            ?>
            <tr>
                <td><?php echo $i ?></td>

                <td><?php echo $row['masp'] ?></td>
                <td><?php echo $row['tensanpham'] ?></td>
                <td><?php echo $row['giasp'] ?> </td>
                <td><?php echo $row['soluong'] ?> </td>
                <td><img src="Modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" alt=""></td>
                <td><?php echo $row['tomtat'] ?> </td>
                <td><?php echo $row['tendanhmuc'] ?> </td>
                <td><?php if($row['tinhtrang']==1){
                    echo 'Kích Hoạt';
                }else{  
                    echo 'Ẩn';
                }
                    ?></td>
             

                
                <td>
                <a href="Modules/quanlysp/xuly.php?idsanpham= <?php echo $row['id_sanpham']?>" class="btn-action btn-delete">Xoá</a> | 
                <a href="?action=quanlysanpham&query=sua&idsanpham= <?php echo $row['id_sanpham']?>" class="btn-action btn-edit">Sửa</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </thead>
    </table>
    </div>