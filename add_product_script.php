<?php
require 'connection.php'; 

// 1. Bắt các dữ liệu từ Form
$name = mysqli_real_escape_string($con, $_POST['name']);
$price = (int)$_POST['price'];
$category = mysqli_real_escape_string($con, $_POST['category']); // Bắt thêm biến category
$image = $_FILES['image']['name'];
$target = "../img/" . basename($image);

// 2. Chèn biến $category vào câu lệnh SQL
$query = "INSERT INTO items (name, price, category, image) VALUES ('$name', '$price', '$category', '$image')";
mysqli_query($con, $query) or die("Lỗi SQL: " . mysqli_error($con));

if (!empty($_FILES['image']['tmp_name'])) {
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
}

echo "<script>alert('Thêm thành công!'); window.location='admin_products.php';</script>";
?>