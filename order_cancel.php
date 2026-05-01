<?php
    session_start();
    require 'connection.php';
    if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
    }

    $user_id = (int)$_SESSION['id'];

    if (isset($_GET['id'])) {
        $order_id = (int)$_GET['id'];

        $cancel_query = "UPDATE orders SET status = 'Cancelled' WHERE id = '$order_id' AND user_id = '$user_id'";
        mysqli_query($con, $cancel_query) or die(mysqli_error($con));
    }

    header('location: cart.php'); 
    exit();
?>