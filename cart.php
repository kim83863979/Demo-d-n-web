<?php
session_start();
require 'connection.php';
require 'users_items_schema.php'; 

if(!isset($_SESSION['email'])){
    header('location: login.php');
    exit();
}

ensure_users_items_schema($con);

$user_id = $_SESSION['id'];


$user_products_query = "SELECT it.id, it.name, it.price, ut.size, ut.quantity 
                        FROM users_items ut 
                        INNER JOIN items it ON it.id = ut.item_id 
                        WHERE ut.user_id = '$user_id' AND ut.status = 'Added to cart'";

$user_products_result = mysqli_query($con, $user_products_query) or die(mysqli_error($con));

$no_of_user_products = mysqli_num_rows($user_products_result);
$sum = 0;
$products = [];

if($no_of_user_products == 0){
    echo "<script>window.alert('Giỏ hàng đang trống!');</script>";
} else {
    while($row = mysqli_fetch_array($user_products_result)){
        $line_total = ((int)$row['price']) * ((int)$row['quantity']);
        $sum += $line_total;
        $row['line_total'] = $line_total; 
        $products[] = $row;
    }
}

$ordered_products_query = "SELECT ut.id AS order_id, it.id AS item_id, it.name, it.price, ut.quantity, ut.status
                          FROM users_items ut
                          INNER JOIN items it ON it.id = ut.item_id
                          WHERE ut.user_id = '$user_id' AND ut.status IN ('Ordered COD','Ordered MoMo','Confirmed', 'Cancelled')
                          ORDER BY ut.id DESC";
$ordered_products_result = mysqli_query($con, $ordered_products_query) or die(mysqli_error($con));
$ordered_products = [];
while ($ordered_row = mysqli_fetch_array($ordered_products_result)) {
    $ordered_row['line_total'] = ((int)$ordered_row['price']) * ((int)$ordered_row['quantity']);
    $ordered_products[] = $ordered_row;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="shortcut icon" href="img/VS_Model.jpg" />
    <title>VS Model</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div>
    <?php require 'header.php'; ?>
    <br>

    <div class="container">
        <h2 class="text-center">Giỏ hàng của bạn</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-info">
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Size</th>
                    <th>Đơn giá (VNĐ)</th>
                    <th>Số lượng</th>
                    <th>Thành tiền (VNĐ)</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $counter = 1;
                foreach($products as $row){
                ?>
                <tr>
                    <td><?= $counter ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['size']) ?></td>
                    <td><?= number_format($row['price']) ?></td>
                    <td style="width: 220px;">
                        <form action="cart_update.php" method="POST" class="form-inline" style="margin-bottom: 5px;">
                            <input type="hidden" name="item_id" value="<?= (int)$row['id'] ?>">
                            <input type="hidden" name="action" value="decrease">
                            <input type="hidden" name="size" value="<?= htmlspecialchars($row['size']) ?>">
                            <button type="submit" class="btn btn-default btn-sm">-</button>
                        </form>
                        <form action="cart_update.php" method="POST" class="form-inline" style="display: inline-block; margin: 0 5px;">
                            <input type="hidden" name="item_id" value="<?= (int)$row['id'] ?>">
                            <input type="hidden" name="action" value="set">
                            <input type="number" name="quantity" value="<?= (int)$row['quantity'] ?>" min="1" max="99" class="form-control input-sm" style="width: 70px;">
                            <input type="hidden" name="size" value="<?= htmlspecialchars($row['size']) ?>">
                            <button type="submit" class="btn btn-default btn-sm">Cập nhật</button>
                        </form>
                        <form action="cart_update.php" method="POST" class="form-inline" style="display: inline-block;">
                            <input type="hidden" name="item_id" value="<?= (int)$row['id'] ?>">
                            <input type="hidden" name="action" value="increase">
                            <input type="hidden" name="size" value="<?= htmlspecialchars($row['size']) ?>">
                            <button type="submit" class="btn btn-default btn-sm">+</button>
                        </form>
                    </td>
                    <td><strong><?= number_format((int)$row['line_total']) ?></strong></td>
                    <td>
                        <a href="cart_remove.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                <?php $counter++; } ?>
                <tr class="bg-light">
                    <td colspan="3"></td>
                    <td><strong>Tổng cộng</strong></td>
                    <td><strong><?= number_format((int)$sum) ?> VNĐ</strong></td>
                    <td colspan="2">
                        <form action="momo_payment.php" method="POST" style="display:inline;">
                            <input type="hidden" name="amount" value="<?= (int)$sum ?>">
                            <button type="submit" class="btn btn-primary">
                                Thanh toán bằng Ví MoMo
                            </button>
                        </form>

                        <form action="success.php" method="POST" style="display:inline; margin-left: 6px;">
                            <input type="hidden" name="payment_method" value="cod">
                            <button type="submit" class="btn btn-success">Thanh toán COD</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Đơn hàng đã đặt</h3>
        <?php if (empty($ordered_products)) { ?>
            <div class="alert alert-info">Bạn chưa có đơn hàng nào đang xử lý.</div>
        <?php } else { ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-warning">
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá (VNĐ)</th>
                        <th>Số lượng</th>
                        <th>Thành tiền (VNĐ)</th>
                        <th>Phương thức</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $ordered_counter = 1; ?>
                    <?php foreach ($ordered_products as $ordered_row) { ?>
                        <tr>
                            <td><?= $ordered_counter ?></td>
                            <td><?= htmlspecialchars($ordered_row['name']) ?></td>
                            <td><?= number_format((int)$ordered_row['price']) ?></td>
                            <td><?= (int)$ordered_row['quantity'] ?></td>
                            <td><strong><?= number_format((int)$ordered_row['line_total']) ?></strong></td>
                            <td><?= htmlspecialchars($ordered_row['status']) ?></td>
                            <td>
                                <?php if ($ordered_row['status'] == 'Cancelled') { ?>
                                    <button class="btn btn-default btn-sm" disabled style="color: #999;">Đã hủy</button>
                                <?php } else { ?>
                                    <a href="order_cancel.php?id=<?= (int)$ordered_row['order_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?');">Hủy đơn</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php $ordered_counter++; ?>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>

    </div>

    <footer class="footer" style="margin-top: 280px;">
        <div class="container text-center">
            <p>Copyright &copy VS Model. All Rights Reserved. | Contact Us: +84 00000 00000</p>
                   <p>This website is developed by Nhom 6 Lap Trinh Web</p>
        </div>
    </footer>
</div>
</body>
</html>