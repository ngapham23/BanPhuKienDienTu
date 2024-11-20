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
$sql_lietke = "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC";
$query_lietke = mysqli_query($mysqli, $sql_lietke);
?>
<div class="product-table">
    <h2>Danh Sách Sản Phẩm</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                
                <th>Thứ Tự</th>
            </tr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query_lietke)) {
                $i++;
            
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['tendanhmuc'] ?></td>
                <td><?php echo $row['thutu'] ?></td>
                <td>
                <a href="Modules/quanlydanhmucsp/xuly.php?iddanhmuc= <?php echo $row['id_danhmuc']?>" class="btn-action btn-delete">Xoá</a> | 
                <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc= <?php echo $row['id_danhmuc']?>" class="btn-action btn-edit">Sửa</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </thead>
    </table>
    </div>