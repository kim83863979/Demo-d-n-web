<?php
    require 'connection.php';
    require 'users_items_schema.php';
    session_start();
    $item_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $delete_query="delete from users_items where user_id='$user_id' and item_id='$item_id'";
    if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
    }

    ensure_users_items_schema($con);

    $item_id=(int)$_GET['id'];
    $user_id=(int)$_SESSION['id'];
    $delete_query="DELETE FROM users_items WHERE user_id='$user_id' AND item_id='$item_id' AND status='Added to cart'";
    $delete_query_result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
    header('location: cart.php');
?>