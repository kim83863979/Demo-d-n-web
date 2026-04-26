<?php
require 'connection.php';

// Kiểm tra xem có nhận được ID từ URL không
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // BƯỚC A: Xóa sản phẩm này khỏi giỏ hàng của tất cả người dùng (bảng users_items)
    $clear_cart_query = "DELETE FROM users_items WHERE item_id = '$id'";
    mysqli_query($con, $clear_cart_query);

    // BƯỚC B: Xóa sản phẩm gốc (bảng items)
    $delete_item_query = "DELETE FROM items WHERE id = '$id'";
    
    if(mysqli_query($con, $delete_item_query)){
        // Nếu xóa thành công, thông báo và quay lại trang danh sách
        echo "<script>alert('Đã xóa sản phẩm thành công!'); window.location='admin_products.php';</script>";
    } else {
        // Nếu có lỗi SQL
        echo "Lỗi khi xóa: " . mysqli_error($con);
    }
} else {
    // Nếu ai đó cố tình truy cập file này mà không truyền ID
    header('location: admin_products.php');
}
?>