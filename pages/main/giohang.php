<?php
session_start();

?>

<?php
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo "<h2>Giỏ hàng của bạn</h2>";

    // Bắt đầu tạo bảng
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; border-collapse: collapse;'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Tên sản phẩm</th>";
    echo "<th>Hình ảnh</th>";
    echo "<th>Số lượng</th>";
    echo "<th>Giá</th>";
    echo "<th>Thành tiền</th>";
    echo "<th></th>";
    echo "</tr>";
    echo "</thead>";

    // Khởi tạo biến tổng tiền
    $total_amount = 0;

    echo "<tbody>";
    foreach ($_SESSION['cart'] as $index => $cart_item) {
        if (isset($cart_item['id'], $cart_item['tensanpham'], $cart_item['masp'], $cart_item['soluong'], $cart_item['giasp'], $cart_item['hinhanh'])) {
            // Tính thành tiền của mỗi sản phẩm
            $total_price = $cart_item['giasp'] * $cart_item['soluong'];
            $total_amount += $total_price;

            // Hiển thị thông tin sản phẩm trong bảng
            echo "<tr>";
            echo "<td>" . htmlspecialchars($cart_item['id']) . "</td>";
            echo "<td>" . htmlspecialchars($cart_item['tensanpham']) . "</td>";
            echo "<td><img src='/BanPhuKien/admin/Modules/quanlysp/uploads/" . htmlspecialchars($cart_item['hinhanh']) . "' alt='" . htmlspecialchars($cart_item['tensanpham']) . "' style='width: 80px;'></td>";
            
            // Ô số lượng với các nút tăng/giảm
            echo "<td>
                      <form action='main/themgiohang.php' method='POST'>
                        <input type='hidden' name='id' value='" . $cart_item['id'] . "'>
                        <button type='submit' name='action' value='decrease'>-</button>
                        <input type='text' name='quantity' value='" . $cart_item['soluong'] . "' size='2' readonly>
                        <button type='submit' name='action' value='increase'>+</button>
                    </form>
                  </td>";
            
            echo "<td>" . number_format($cart_item['giasp'], 0, ',', '.') . " VND</td>";
            echo "<td>" . number_format($total_price, 0, ',', '.') . " VND</td>";
            echo "<td><a href='main/themgiohang.php?action=delete&id=" . $cart_item['id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sản phẩm này?\")'>Xóa</a></td>";
            
            echo "</tr>";
        } else {
            echo "<tr><td colspan='7'>Thông tin sản phẩm không đầy đủ.</td></tr>";
        }
    }
    echo "</tbody>";

    // Hiển thị tổng tiền và nút xóa tất cả
    echo "<tfoot>";
    echo "<tr>";
    echo "<td colspan='5' style='text-align: right;'>
            <button type='submit'  ><a href='main/themgiohang.php?xoatatca=1' style='color: red; text-decoration: none;'>Xóa tất cả</a></button>



          </td>";
    echo "<td colspan='2'>" . number_format($total_amount, 0, ',', '.') . " VND</td>";
    
    echo "</tr>";
    echo "</tfoot>";

    echo "</table>";
} else {
    echo "Giỏ hàng của bạn hiện tại đang trống.";
}
?>
