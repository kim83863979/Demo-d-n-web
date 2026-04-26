<?php
// ===============================
// File: config_momo.php
// ===============================

// 1️⃣ Xác định protocol
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

// 2️⃣ Lấy hostname hiện tại (localhost hoặc IP LAN)
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

// 3️⃣ Lấy đường dẫn thư mục project
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

// 4️⃣ Tạo redirect và IPN URL tự động
$redirectUrl = $protocol . $host . $basePath . '/thankyou.php';
$ipnUrl      = $protocol . $host . $basePath . '/ipn_momo.php';

return [
    // Endpoint test của MoMo
    'endpoint'    => 'https://test-payment.momo.vn/v2/gateway/api/create',

    // Thông tin kết nối
    'partnerCode' => 'MOMO4MUD20240115_TEST',
    'accessKey'   => 'Ekj9og2VnRfOuIys',
    'secretKey'   => 'PseUbm2s8QVJEbexsh8H3Jz2qa9tDqoa',

    // Đường dẫn thanh toán và callback
    'redirectUrl' => $redirectUrl,
    'ipnUrl'      => $ipnUrl
];
?>
