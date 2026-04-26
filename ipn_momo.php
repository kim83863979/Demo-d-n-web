<?php
// File: ipn_momo.php

$config = include('config_momo.php');
$secretKey = $config['secretKey'];
$accessKey = $config['accessKey'];

// 1️⃣ Nhận dữ liệu từ Momo
$data = json_decode(file_get_contents("php://input"), true);

// 2️⃣ Log dữ liệu để debug sandbox
file_put_contents('ipn_log.txt', date('Y-m-d H:i:s') . " - " . print_r($data, true) . "\n", FILE_APPEND);

if (!$data || !isset($data['resultCode'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid data']);
    exit;
}

// 3️⃣ Validate signature
$rawHash = "partnerCode={$data['partnerCode']}&accessKey={$accessKey}&requestId={$data['requestId']}&amount={$data['amount']}&orderId={$data['orderId']}&orderInfo={$data['orderInfo']}&orderType={$data['orderType']}&transId={$data['transId']}&resultCode={$data['resultCode']}&message={$data['message']}&payType={$data['payType']}&responseTime={$data['responseTime']}&extraData={$data['extraData']}";
$checkSignature = hash_hmac("sha256", $rawHash, $secretKey);

if ($checkSignature !== $data['signature']) {
    http_response_code(400);
    echo json_encode(['message'=>'Invalid signature']);
    exit;
}

// 4️⃣ Kiểm tra kết quả thanh toán
if ($data['resultCode'] == 0) {
    // ✅ Thanh toán thành công
    $orderId = $data['orderId'];

    // 5️⃣ Cập nhật trạng thái đơn hàng trong database (mẫu PDO)
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=your_db_name;charset=utf8", "db_user", "db_pass");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE orders SET status='paid', momo_transId=:transId WHERE order_id=:orderId");
        $stmt->execute([
            ':transId' => $data['transId'],
            ':orderId' => $orderId
        ]);

    } catch (PDOException $e) {
        file_put_contents('ipn_error_log.txt', date('Y-m-d H:i:s') . " - " . $e->getMessage() . "\n", FILE_APPEND);
    }

    http_response_code(200);
    echo json_encode(['message' => 'Payment success']);
} else {
    // ❌ Thanh toán thất bại
    http_response_code(400);
    echo json_encode(['message' => 'Payment failed']);
}
?>
