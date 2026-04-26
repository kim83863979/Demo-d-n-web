<?php
require 'connection.php';

$id = $_POST['id'];
$new_price = $_POST['new_price'];

// Câu lệnh SQL Update
$query = "UPDATE items SET price = '$new_price' WHERE id = '$id'";

if(mysqli_query($con, $query)){
    echo "<script>alert('Cập nhật giá thành công!'); window.location='admin_products.php';</script>";
} else {
    echo "Lỗi cập nhật: " . mysqli_error($con);
}
?>