<?php
    session_start();
    require 'connection.php';
    
    // Kiểm tra đăng nhập
    if(!isset($_SESSION['email'])){
        header('location:index.php');
        exit();
    }
    
    $order_message = "Không có sản phẩm nào trong giỏ hàng để tạo đơn COD.";
    $user_id = (int)$_SESSION['id'];
    $payment_method = $_POST['payment_method'] ?? '';

    if ($payment_method === 'cod') {
        // BƯỚC 1: KIỂM TRA XEM TRONG GIỎ CÓ ĐỒ KHÔNG
        $cart_query = "SELECT ut.item_id, ut.size, ut.quantity, it.price 
                       FROM users_items ut 
                       INNER JOIN items it ON ut.item_id = it.id 
                       WHERE ut.user_id = '$user_id' AND ut.status = 'Added to cart'";
        $cart_result = mysqli_query($con, $cart_query) or die(mysqli_error($con));

        if (mysqli_num_rows($cart_result) > 0) {
            $total_amount = 0;

            // BƯỚC 2: TẠO HÓA ĐƠN TRỐNG (Vào bảng orders)
            $sql_create_order = "INSERT INTO orders (user_id, total_amount, payment_method, status) 
                                 VALUES ('$user_id', 0, 'COD', 'Ordered COD')";
            mysqli_query($con, $sql_create_order) or die(mysqli_error($con));
            
            // Lấy Mã đơn hàng vừa được sinh ra (Auto_Increment)
            $order_id = mysqli_insert_id($con);

            // BƯỚC 3: CHUYỂN TỪNG SẢN PHẨM VÀO CHI TIẾT HÓA ĐƠN (Vào bảng order_details)
            while ($item = mysqli_fetch_array($cart_result)) {
                $product_id = $item['item_id'];
                $size = $item['size'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                
                // Cộng dồn tổng tiền
                $total_amount += ($price * $quantity);

                $sql_details = "INSERT INTO order_details (order_id, product_id, size, quantity, price) 
                                VALUES ('$order_id', '$product_id', '$size', '$quantity', '$price')";
                mysqli_query($con, $sql_details) or die(mysqli_error($con));
            }

            // BƯỚC 4: CẬP NHẬT TỔNG TIỀN & DỌN SẠCH GIỎ HÀNG
            mysqli_query($con, "UPDATE orders SET total_amount = '$total_amount' WHERE id = '$order_id'") or die(mysqli_error($con));
            mysqli_query($con, "DELETE FROM users_items WHERE user_id = '$user_id' AND status = 'Added to cart'") or die(mysqli_error($con));

            // Đổi thông báo thành công
            $order_message = "Đơn hàng COD của bạn đã được chốt thành công! Mã hóa đơn: <strong>#$order_id</strong>. Cảm ơn bạn đã mua sắm tại VS Model.";
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <link rel="shortcut icon" href="img/VS_Model.jpg" />
        <title>VS Model - Đặt hàng thành công</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php require 'header.php'; ?>
            <br><br><br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center" style="font-size: 20px; font-weight: bold;">XÁC NHẬN ĐƠN HÀNG</h3>
                            </div>
                            <div class="panel-body text-center">
                                <p style="font-size: 16px; margin-bottom: 20px;"><?= $order_message ?></p>
                                <a href="products.php" class="btn btn-primary">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>