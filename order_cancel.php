<?php
session_start();
require 'connection.php';

// Kiểm tra bằng email giống hệt như bên file cart.php của bạn
if(!isset($_SESSION['email'])){
    header('location: login.php');
    exit();
}

$user_id = $_SESSION['id']; // Bắt đúng ID của User
$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Bắt ID đơn hàng

if ($order_id > 0) {
    mysqli_query(
        $con,
        "UPDATE users_items 
         SET status = 'Cancelled' 
         WHERE id = '$order_id' AND user_id = '$user_id' AND status IN ('Ordered COD','Ordered MoMo','Confirmed')"
    ) or die(mysqli_error($con));
}

// Chạy xong tự động quay về giỏ hàng
header('location: cart.php');
exit();
?>