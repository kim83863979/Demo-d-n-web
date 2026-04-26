<?php
session_start();
require 'connection.php';
require 'users_items_schema.php';

if (!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
}

ensure_users_items_schema($con);

$user_id = (int)$_SESSION['id'];
$item_id = isset($_POST['item_id']) ? (int)$_POST['item_id'] : 0;
$size = isset($_POST['size']) ? mysqli_real_escape_string($con, $_POST['size']) : '';
$action = $_POST['action'] ?? 'set';
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

if ($item_id <= 0 || $size === '') {
    header('location: cart.php');
    exit();
}

if ($action === 'increase') {
    mysqli_query(
        $con,
        "UPDATE users_items SET quantity = quantity + 1 WHERE user_id = '$user_id' AND item_id = '$item_id' AND size = '$size' AND status = 'Added to cart'"
    ) or die(mysqli_error($con));
} elseif ($action === 'decrease') {
    mysqli_query(
        $con,
        "UPDATE users_items SET quantity = GREATEST(quantity - 1, 1) WHERE user_id = '$user_id' AND item_id = '$item_id' AND size = '$size' AND status = 'Added to cart'"
    ) or die(mysqli_error($con));
} else {
    $quantity = max(1, min($quantity, 99));
    mysqli_query(
        $con,
        "UPDATE users_items SET quantity = '$quantity' WHERE user_id = '$user_id' AND item_id = '$item_id' AND size = '$size' AND status = 'Added to cart'"
    ) or die(mysqli_error($con));
}

header('location: cart.php');
exit();
?>