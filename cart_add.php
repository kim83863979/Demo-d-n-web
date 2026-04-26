<?php
    require 'connection.php';
    require 'users_items_schema.php';
    //require 'header.php';
    session_start();

     if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
    }

    ensure_users_items_schema($con);

    $item_id = (int)$_GET['id']; // Ép kiểu số nguyên
    $user_id = (int)$_SESSION['id'];
    $size = mysqli_real_escape_string($con, $_GET['size']);

    $existing_item_query = "SELECT id FROM users_items 
                            WHERE user_id='$user_id' 
                            AND item_id='$item_id' 
                            AND size='$size' 
                            AND status='Added to cart' 
                            LIMIT 1";
    $existing_item_result = mysqli_query($con, $existing_item_query) or die(mysqli_error($con));

    if (mysqli_num_rows($existing_item_result) > 0) {
        // Nếu đã có Món đó + Size đó trong giỏ -> Tăng số lượng lên 1
        $cart_query = "UPDATE users_items 
                       SET quantity = quantity + 1 
                       WHERE user_id='$user_id' AND item_id='$item_id' AND size='$size' AND status='Added to cart'";
    } else {
        // Nếu chưa có -> Thêm mới hoàn toàn (Đã bổ sung biến $size vào đúng vị trí)
        $cart_query = "INSERT INTO users_items (user_id, item_id, size, status, quantity) 
                       VALUES ('$user_id', '$item_id', '$size', 'Added to cart', 1)";
    }

    mysqli_query($con, $cart_query) or die(mysqli_error($con));
    
    header('location: products.php');
    exit();
?>
