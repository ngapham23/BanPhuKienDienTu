<?php



?>
<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
    <h2 class="cart-title">
    Giỏ hàng  
    <?php if (isset($_SESSION['dangnhap'])): ?>
        - Xin chào, <?= htmlspecialchars($_SESSION['tenkhachhang']) ?>
    <?php endif; ?>
    </h2>

    <!-- Bắt đầu tạo bảng -->
    <table class="cart-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total_amount = 0; // Khởi tạo tổng tiền
            foreach ($_SESSION['cart'] as $index => $cart_item): 
                if (isset($cart_item['id'], $cart_item['tensanpham'], $cart_item['masp'], $cart_item['soluong'], $cart_item['giasp'], $cart_item['hinhanh'])):
                    $total_price = $cart_item['giasp'] * $cart_item['soluong'];
                    $total_amount += $total_price;
            ?>
                <tr>
                    <td><?= htmlspecialchars($cart_item['id']) ?></td>
                    <td><?= htmlspecialchars($cart_item['tensanpham']) ?></td>
                    <td>
                        <img src="/BanPhuKien/admin/Modules/quanlysp/uploads/<?= htmlspecialchars($cart_item['hinhanh']) ?>" 
                             alt="<?= htmlspecialchars($cart_item['tensanpham']) ?>" 
                             class="cart-item-image">
                    </td>
                    <td>
                        <form action="main/themgiohang.php" method="POST" class="quantity-form">
                            <input type="hidden" name="id" value="<?= $cart_item['id'] ?>">
                            <button type="submit" name="action" value="decrease">-</button>
                            <input type="text" name="quantity" value="<?= $cart_item['soluong'] ?>" size="2" readonly>
                            <button type="submit" name="action" value="increase">+</button>
                        </form>
                    </td>
                    <td><?= number_format($cart_item['giasp'], 0, ',', '.') ?> VND</td>
                    <td><?= number_format($total_price, 0, ',', '.') ?> VND</td>
                    <td>
                        <a href="main/themgiohang.php?action=delete&id=<?= $cart_item['id'] ?>" 
                           class="remove-item" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                    </td>
                </tr>
            <?php 
                else: 
            ?>
                <tr>
                    <td colspan="7">Thông tin sản phẩm không đầy đủ.</td>
                </tr>
            <?php 
                endif;
            endforeach; 
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="actions">
                    <a href="main/themgiohang.php?xoatatca=1" class="clear-all">Xóa tất cả</a>
                    
                    <!-- Kiểm tra nếu người dùng đã đăng nhập để hiển thị nút Đặt hàng hoặc Đăng nhập -->
                    <?php if (isset($_SESSION['dangnhap'])): ?>
                        <a href="index.php?quanly=thanhtoan" class="place-order">Đặt hàng</a>
                    <?php else: ?>
                        <a href="index.php?quanly=dangnhap" class="place-order">Bạn Cần Đăng Nhập Để Đặt Hàng</a>
                    <?php endif; ?>
                </td>
                <td colspan="2" class="total-amount"><?= number_format($total_amount, 0, ',', '.') ?> VND</td>
            </tr>
        </tfoot>
    </table>

<?php else: ?>
    
    <p>Giỏ hàng của bạn hiện tại đang trống.</p>
<?php endif; ?>


<style>
/* Tạo kiểu dáng cho tiêu đề giỏ hàng */
.cart-title {
    font-family: 'Arial', sans-serif;
    font-size: 24px;
    font-weight: bold;
    color: #333;
    text-align: center;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Thêm style cho phần chào mừng người dùng */
.cart-title strong {
    color: #007bff;
}

.cart-title:hover {
    background-color: #e2e6ea;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

/* Tạo kiểu dáng cho bảng giỏ hàng */
.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.cart-table th, .cart-table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}

.cart-table th {
    background-color: #007bff;
    color: white;
}

.cart-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Thêm hiệu ứng hover cho hàng trong bảng */
.cart-table tr:hover {
    background-color: #e9ecef;
}

/* Hình ảnh sản phẩm */
.cart-item-image {
    width: 80px;
    height: auto;
    border-radius: 5px;
}

/* Kiểu dáng cho các nút hành động */
.quantity-form button {
    padding: 5px 10px;
    background-color: #007bff;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
}

.quantity-form button:hover {
    background-color: #0056b3;
}

.quantity-form input {
    width: 40px;
    text-align: center;
}

/* Kiểu dáng cho các liên kết xóa và đặt hàng */
.remove-item, .clear-all, .place-order {
    color: #dc3545;
    text-decoration: none;
    font-weight: bold;
    padding: 8px 16px;
    background-color: #fff;
    border-radius: 5px;
    border: 1px solid #dc3545;
}

.remove-item:hover, .clear-all:hover, .place-order:hover {
    background-color: #dc3545;
    color: #fff;
}

/* Kiểu dáng cho phần tổng tiền */
.total-amount {
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

.actions {
    text-align: right;
}

/* Cải thiện kiểu dáng cho nút xóa tất cả và các hành động */
.clear-all {
    color: #dc3545;
    text-decoration: none;
    font-weight: bold;
    padding: 8px 16px;
    border-radius: 5px;
    border: 1px solid #dc3545;
}

.clear-all:hover {
    background-color: #dc3545;
    color: #fff;
}
</style>
