<?php
session_start();
require 'connection.php'; 

if(!isset($_SESSION['email']) || $_SESSION['role'] != 1){
    header('location: login.php');
    exit();
}

// Truy vấn lấy danh sách sản phẩm
$query = "SELECT * FROM items";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý Sản phẩm - Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
            color: #334155;
        }
        .container {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            margin-top: 40px;
            margin-bottom: 40px;
        }
        h2 { font-weight: 800; color: #1e293b; letter-spacing: -0.5px; }
        .table { border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0; margin-top: 20px; }
        .table > thead > tr > th {
            background-color: #f1f5f9; 
            color: #475569;
            border-bottom: 2px solid #cbd5e1 !important;
            font-weight: 700;
            padding: 18px;
            text-transform: uppercase;
            font-size: 13px;
        }
        .table > tbody > tr > td {
            vertical-align: middle; padding: 15px; border-color: #e2e8f0; color: #475569; font-weight: 500;
        }
        .table-hover tbody tr:hover { background-color: #f8fafc; }
        .btn { border-radius: 8px; font-weight: 600; border: none; transition: all 0.2s; padding: 8px 16px; }
        .btn-success { background-color: #10b981; }
        .btn-success:hover { background-color: #059669; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2); }
        .btn-default { background-color: #f1f5f9; color: #475569; }
        .btn-default:hover { background-color: #e2e8f0; transform: translateY(-2px); }
        .btn-warning { background-color: #f59e0b; color: white; }
        .btn-warning:hover { background-color: #d97706; color: white; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2);}
        .btn-danger { background-color: #ef4444; }
        .btn-danger:hover { background-color: #dc2626; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);}
        
        td img {
            border-radius: 6px;
            max-height: 50px; /* Chỉnh kích thước ảnh gọn gàng */
            object-fit: cover;
            background: #f1f5f9;
            padding: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center" style="margin-top: 30px; margin-bottom: 30px;">Quản lý Sản phẩm</h2>
        
        <a href="admin_dashboard.php" class="btn btn-default" style="margin-bottom: 20px; margin-right: 10px;">
            <span class="glyphicon glyphicon-arrow-left"></span> Về Trang chủ Admin
        </a>

        <a href="add_product.php" class="btn btn-success" style="margin-bottom: 20px;">
            <span class="glyphicon glyphicon-plus"></span> Thêm sản phẩm mới
        </a>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá (VNĐ)</th>
                    <th class="text-center">Thao tác</th> 
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        
                        // ID
                        echo "<td class='text-center'>" . $row['id'] . "</td>";
                        
                        // CỘT HÌNH ẢNH ĐÃ SỬA
                        echo "<td class='text-center'>";
                        if (!empty($row['image'])) {
                            // Đã sửa thành img/
                            echo "<img src='img/" . $row['image'] . "' alt='" . $row['name'] . "'>";
                        } else {
                            echo "<span style='color: #94a3b8; font-size: 12px; font-style: italic;'>Chưa có ảnh</span>";
                        }
                        echo "</td>";
                        
                        // Tên và Giá
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . number_format($row['price']) . " đ</td>";
                        
                        // Thao tác
                        echo "<td class='text-center'>";
                            echo "<a href='edit_price.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm' style='margin-right: 5px;'>Sửa giá</a>";
                            echo "<a href='delete_product_script.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có CHẮC CHẮN muốn xóa sản phẩm: " . $row['name'] . " không? Hành động này không thể hoàn tác!');\">Xóa</a>";
                        echo "</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Chưa có sản phẩm nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>