<?php
session_start();
include "../../admin/Sconfig/myconfig.php";


// Kiểm tra nếu có hành động (action) được gửi lên từ form
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    // Trừ số lượng sản phẩm
    if ($action == 'decrease' && $id) {
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id) {
                if ($cart_item['soluong'] > 1) {
                    $cart_item['soluong']--; // Giảm số lượng
                } else {
                    // Nếu số lượng là 1, không giảm nữa
                    echo "<script>alert('Số lượng không thể giảm xuống dưới 1');</script>";
                }
                break;
            }
        }
    }

    // Tăng số lượng sản phẩm
    if ($action == 'increase' && $id) {
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id) {
                $cart_item['soluong']++; // Tăng số lượng
                break;
            }
        }
    }

    // Sau khi thực hiện hành động, quay lại trang giỏ hàng
    header('Location: .././index.php?quanly=giohang');
    exit;
}

// Kiểm tra hành động (action) được gửi lên
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Kiểm tra nếu action là 'delete' (xóa sản phẩm)
    if ($action == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];

        // Duyệt qua giỏ hàng để tìm sản phẩm cần xóa
        foreach ($_SESSION['cart'] as $key => $cart_item) {
            if ($cart_item['id'] == $id) {
                unset($_SESSION['cart'][$key]);  // Xóa sản phẩm khỏi giỏ hàng
                $_SESSION['cart'] = array_values($_SESSION['cart']);  // Reindex lại mảng
                break;
            }
        }
    }
    // Quay lại trang giỏ hàng sau khi thực hiện hành động
    header('Location: .././index.php?quanly=giohang');
    exit;
}

if(isset($_GET['xoatatca'])&& $_GET['xoatatca']==1){ 
    unset($_SESSION['cart']);
    header('Location: .././index.php?quanly=giohang');
    exit;
}



// Thêm sản phẩm vào giỏ hàng
if (isset($_POST['themgiohang'])) {
//  session_destroy();
   // Lấy ID sản phẩm từ URL
   $id = isset($_GET['idsanpham']) ? $_GET['idsanpham'] : null;

   if ($id) {
    $soluong = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

       // Truy vấn sản phẩm từ cơ sở dữ liệu
       $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$id' LIMIT 1";
       $query = mysqli_query($mysqli, $sql);
       $row = mysqli_fetch_array($query);

       // Kiểm tra nếu sản phẩm tồn tại trong cơ sở dữ liệu
       if ($row) {
           // Dữ liệu sản phẩm mới
           $new_product = array(
               'tensanpham' => $row['tensanpham'],
               'id' => $id,
               'soluong' => $soluong,
               'giasp' => $row['giasp'],
               'hinhanh' => $row['hinhanh'],
               'masp' => $row['masp']
           );

           // Kiểm tra nếu giỏ hàng đã tồn tại trong session
           if (isset($_SESSION['cart'])) {
               $found = false;

               // Duyệt qua giỏ hàng để kiểm tra xem sản phẩm đã có chưa
               foreach ($_SESSION['cart'] as &$cart_item) {
                   if (isset($cart_item['id']) && $cart_item['id'] == $id) {
                       // Cập nhật số lượng sản phẩm nếu đã có trong giỏ hàng
                       $cart_item['soluong'] += $soluong;
                       $found = true;
                       break;
                   }
               }

               // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới vào giỏ
               if (!$found) {
                   $_SESSION['cart'][] = $new_product;
               }
           } else {
               // Nếu giỏ hàng chưa tồn tại, khởi tạo giỏ hàng và thêm sản phẩm vào giỏ
               $_SESSION['cart'] = array($new_product);
           }
       } else {
           echo "Sản phẩm không tồn tại.";
       }
   } else {
       echo "ID sản phẩm không hợp lệ.";
   }
}

// Điều hướng tới trang giỏ hàng sau khi thêm sản phẩm
header('Location: .././index.php?quanly=giohang');
exit;
?>
