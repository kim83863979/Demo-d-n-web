<?php
// File: momo_payment.php

session_start();
require 'connection.php';
require 'users_items_schema.php';

if (!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
}

ensure_users_items_schema($con);

// 1️⃣ Load config
$config = include('config_momo.php');

$endpoint    = $config['endpoint'];
$partnerCode = $config['partnerCode'];
$accessKey   = $config['accessKey'];
$secretKey   = $config['secretKey'];
$redirectUrl = $config['redirectUrl'];
$ipnUrl      = $config['ipnUrl'];

// 2️⃣ Lấy số tiền từ form (cart.php gửi lên)
$amount = $_POST['amount'] ?? 0;
if($amount <= 0) {
    die("Số tiền thanh toán không hợp lệ.");
}

// 3️⃣ Tạo orderId và requestId duy nhất
$orderId = 'ORDER' . time() . rand(1000,9999);
$requestId = 'REQ' . time() . rand(1000,9999);
$orderInfo = "Thanh toán đơn hàng #" . $orderId;
$requestType = "captureWallet";
$extraData = base64_encode(json_encode([
    'user_id' => (int)$_SESSION['id']
]));

// 4️⃣ Tạo signature
$rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
$signature = hash_hmac("sha256", $rawHash, $secretKey);

// 5️⃣ Chuẩn bị dữ liệu gửi lên Momo
$data = [
    'partnerCode' => $partnerCode,
    'partnerName' => "MoMo Payment",
    'storeId'     => "MomoTestStore",
    'requestId'   => $requestId,
    'amount'      => $amount,
    'orderId'     => $orderId,
    'orderInfo'   => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl'      => $ipnUrl,
    'lang'        => 'vi',
    'extraData'   => $extraData,
    'requestType' => $requestType,
    'signature'   => $signature
];

$data_string = json_encode($data);

// 6️⃣ Gửi request tới Momo
$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result, true);

// 7️⃣ Kiểm tra payUrl và redirect
if(isset($response['payUrl']) && !empty($response['payUrl'])) {
    header('Location: ' . $response['payUrl']);
    exit();
} else {
    echo "Lỗi tạo đơn thanh toán: <br>";
    echo "<pre>";
    print_r($response);
    echo "</pre>";
}
?>
