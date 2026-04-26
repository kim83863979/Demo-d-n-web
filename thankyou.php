<?php
// File: thankyou.php

require 'connection.php';
require 'users_items_schema.php';
ensure_users_items_schema($con);

// Lấy dữ liệu từ GET
$orderId    = $_GET['orderId'] ?? '';
$resultCode = $_GET['resultCode'] ?? '';
$message    = $_GET['message'] ?? '';
$amount     = $_GET['amount'] ?? '';
$extraData  = $_GET['extraData'] ?? '';

if ($resultCode === '0' && !empty($extraData)) {
    $decoded = json_decode(base64_decode($extraData), true);
    $user_id = isset($decoded['user_id']) ? (int)$decoded['user_id'] : 0;

    if ($user_id > 0) {
        $confirm_query = "UPDATE users_items SET status='Ordered MoMo' WHERE user_id='$user_id' AND status='Added to cart'";
        mysqli_query($con, $confirm_query) or die(mysqli_error($con));
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán - Ví MoMo</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center" style="margin-top: 100px;">
        <?php if ($resultCode == '0'): ?>
            <h2 class="text-success">🎉 Thanh toán thành công qua Ví MoMo!</h2>
        <?php else: ?>
            <h2 class="text-danger">❌ Thanh toán thất bại hoặc đã hết hạn</h2>
        <?php endif; ?>

        <p>Cảm ơn bạn đã mua hàng tại <strong>VS Model</strong>.</p>
        <?php if ($orderId): ?>
            <p>Mã đơn hàng: <b><?= htmlspecialchars($orderId) ?></b></p>
        <?php endif; ?>
        <?php if ($amount): ?>
            <p>Số tiền: <b><?= htmlspecialchars($amount) ?> VNĐ</b></p>
        <?php endif; ?>
        <?php if ($message): ?>
            <p>Thông báo: <?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <a href="index.php" class="btn btn-primary mt-3">Tiếp tục mua hàng</a>
    </div>
</body>
</html>
