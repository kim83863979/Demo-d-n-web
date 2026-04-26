<?php
    session_start();
    require 'connection.php';
    require 'users_items_schema.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
        exit();
    }else{
        ensure_users_items_schema($con);
        $order_message = "Khong co san pham nao trong gio hang de tao don COD.";

        $user_id = (int)$_SESSION['id'];
        $payment_method = $_POST['payment_method'] ?? '';

        if ($payment_method === 'cod') {
            $confirm_query="UPDATE users_items SET status='Ordered COD' WHERE user_id='$user_id' AND status='Added to cart'";
            mysqli_query($con,$confirm_query) or die(mysqli_error($con));

            if (mysqli_affected_rows($con) > 0) {
                $order_message = "Don hang COD cua ban da duoc tao thanh cong. Cam on ban da mua hang.";
            }
        }
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>VS Model</title>
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
            <?php
                require 'header.php';
            ?>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <p><?= htmlspecialchars($order_message) ?> <a href="products.php">Click here</a> to purchase any other item.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
               <div class="container">
               <center>
                   <p>Copyright &copy VS Model. All Rights Reserved. | Contact Us: +84 00000 00000</p>
                   <p>This website is developed by Nhom 6 Lap Trinh Web</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
