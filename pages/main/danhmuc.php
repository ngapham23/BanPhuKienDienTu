<?php 
// Lấy giá trị ID từ URL và xử lý để tránh SQL Injection
$id_danhmuc = isset($_GET['id']) ? mysqli_real_escape_string($mysqli, $_GET['id']) : null;

// Nếu có id danh mục, thực hiện truy vấn
if ($id_danhmuc) {
    $sql_pro = "SELECT tbl_sanpham.*, tbl_danhmuc.tendanhmuc
                FROM tbl_sanpham 
                JOIN tbl_danhmuc ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
                WHERE tbl_sanpham.id_danhmuc = '$id_danhmuc' 
                ORDER BY tbl_sanpham.id_sanpham ASC";

    $query_pro = mysqli_query($mysqli, $sql_pro);

    if (mysqli_num_rows($query_pro) > 0) {
        // Lấy tên danh mục
        $row_title = mysqli_fetch_array($query_pro);
        $category_name = $row_title['tendanhmuc'];

        // Duyệt qua các sản phẩm và hiển thị
        echo "<h3>Danh Mục Sản Phẩm: " . htmlspecialchars($category_name) . "</h3>";
        echo "<ul class='list_product'>";
        
        // Di chuyển con trỏ về đầu dòng
        mysqli_data_seek($query_pro, 0);
        
        // Lặp qua các sản phẩm
        while ($row_pro = mysqli_fetch_array($query_pro)) {
            echo "<li>";
            echo "<a href='index.php?quanly=sanpham&id=" . $row_pro['id_sanpham'] . "'>";
            echo "<img src='/BanPhuKien/admin/Modules/quanlysp/uploads/" . htmlspecialchars($row_pro['hinhanh']) . "' alt='" . htmlspecialchars($row_pro['tensanpham']) . "'>";
            echo "<p class='title_product'>" . htmlspecialchars($row_pro['tensanpham']) . "</p>";
            echo "<p class='price_product'>" . number_format($row_pro['giasp'], 0, ',', '.') . " đ</p>";
            echo "</a>";
            echo "</li>";
        }
        
        echo "</ul>";
    } else {
        echo "<h3>Không tìm thấy sản phẩm trong danh mục này.</h3>";
    }
} else {
    echo "<h3>Danh mục không hợp lệ.</h3>";
}
?>
