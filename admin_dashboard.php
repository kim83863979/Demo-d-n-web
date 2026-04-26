<?php
session_start();
// Kiểm tra nếu chưa đăng nhập hoặc không phải Admin (role = 1) thì đá văng ra ngoài
if(!isset($_SESSION['email']) || $_SESSION['role'] != 1){
    header('location: login.php');
    exit();
}

require 'connection.php';

$query_products = "SELECT COUNT(id) AS total FROM items";
$result_products = mysqli_query($con, $query_products);
$total_products = mysqli_fetch_assoc($result_products)['total'] ?? 0;

$query_customers = "SELECT COUNT(id) AS total FROM users WHERE role = 0";
$result_customers = mysqli_query($con, $query_customers);
$total_customers = mysqli_fetch_assoc($result_customers)['total'] ?? 0;

$query_orders = "SELECT COUNT(id) AS total FROM users_items WHERE status IN ('Ordered COD', 'Ordered MoMo')";
$result_orders = mysqli_query($con, $query_orders);
$total_orders = mysqli_fetch_assoc($result_orders)['total'] ?? 0;

$query_revenue = "SELECT SUM(it.price * ut.quantity) AS total 
                  FROM users_items ut 
                  INNER JOIN items it ON ut.item_id = it.id 
                  WHERE ut.status IN ('Ordered COD', 'Ordered MoMo')";
$result_revenue = mysqli_query($con, $query_revenue);
$total_revenue = mysqli_fetch_assoc($result_revenue)['total'] ?? 0;

$formatted_revenue = number_format($total_revenue);
if ($total_revenue >= 1000000) {
    $formatted_revenue = round($total_revenue / 1000000, 1) . 'tr';
}

// lấy dữ liệu các đơn hàng mới nhất
$query_recent_orders = "SELECT ut.id, u.name as customer_name, it.name as item_name, ut.status 
                        FROM users_items ut 
                        INNER JOIN users u ON ut.user_id = u.id 
                        INNER JOIN items it ON ut.item_id = it.id 
                        WHERE u.role = 0 
                        ORDER BY ut.id DESC LIMIT 5";
$recent_orders_result = mysqli_query($con, $query_recent_orders);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/VS_Model.jpg" type="image/x-icon" />
    <title>Premium Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style-admin.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm px-4">
        <div class="container-fluid">
            <button class="navbar-toggler border-0 shadow-none" type="button" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars fs-3 text-secondary"></i>
            </button>
            <a class="navbar-brand fw-bold fs-4 ms-2 d-none d-lg-block" href="#"
                style="background: linear-gradient(45deg, #3b82f6, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                
            </a>

            <div class="d-flex align-items-center ms-auto">
                <div class="nav-right">
                    <span class="text-secondary fw-medium me-2">Admin 👤|</span>
                    <a href="login.php" class="text-danger text-decoration-none fw-medium">Đăng xuất ⏻</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <a href="admin_products.php" class="active"><i class="fa-solid fa-box-open"></i> Quản lý sản phẩm</a>
        <!-- <a href="#"><i class="fa-solid fa-cart-shopping"></i> Đơn hàng</a>
        <a href="#"><i class="fa-solid fa-users"></i> Khách hàng</a> -->
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="row g-4 mb-4">
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card-box bg-blue">
                    <div class="icon-wrapper"><i class="fa-solid fa-box"></i></div>
                    <div class="card-info">
                        <h4>Sản phẩm</h4>
                        <h2><?= $total_products ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card-box bg-green">
                    <div class="icon-wrapper"><i class="fa-solid fa-cart-arrow-down"></i></div>
                    <div class="card-info">
                        <h4>Đơn hàng</h4>
                        <h2><?= $total_orders ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card-box bg-orange">
                    <div class="icon-wrapper"><i class="fa-solid fa-users"></i></div>
                    <div class="card-info">
                        <h4>Khách hàng</h4>
                        <h2><?= $total_customers ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card-box bg-red">
                    <div class="icon-wrapper"><i class="fa-solid fa-wallet"></i></div>
                    <div class="card-info">
                        <h4>Doanh thu</h4>
                        <h2><?= $formatted_revenue ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 30px;">
            <div class="card shadow">
    <div class="card-header bg-white">
        <h3 class="mb-0 text-center" style="font-weight: bold; font-size: 20px;">Đơn hàng mới nhất</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Khách hàng</th>
                    <th>Sản phẩm</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php while($order = mysqli_fetch_assoc($recent_orders_result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                    <td><?= htmlspecialchars($order['item_name']) ?></td>
                    <td><span class="badge <?= ($order['status'] == 'Ordered COD' || $order['status'] == 'Ordered MoMo') ? 'bg-warning text-dark' : 'bg-secondary' ?>"><?= $order['status'] ?></span></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

            
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="px-4 text-center w-100">
            <p class="m-0">
                Copyright © VS Model. All Rights Reserved. |
                Contact Us: +91 90000 00000
            </p>
            <p class="m-0 mt-1 text-muted" style="font-size: 13px;">
                This website is developed Nhom 6 Lap Trinh Web
            </p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            if (window.innerWidth <= 768) {
                document.getElementById("sidebar").classList.toggle("show");
            }
        }
    </script>
</body>

</html>
