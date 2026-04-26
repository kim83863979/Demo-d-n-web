<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/VS_Model.jpg" />
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
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
    <div class="setting-card">
        <h2 class="text-center" style="font-weight: 700; color: #2c3e50; margin-bottom: 30px;">Change Password</h2>
        
        <form method="post" action="setting_script.php">
            <div class="form-group">
                <label>Old Password</label>
                <input type="password" class="form-control custom-input" name="oldPassword" placeholder="Enter old password" required>
            </div>
            
            <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control custom-input" name="newPassword" placeholder="Enter new password" required>
            </div>
            
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" class="form-control custom-input" name="retype" placeholder="Re-type new password" required>
            </div>
            
            <div class="form-group" style="margin-top: 30px;">
                <button type="submit" class="btn btn-danger btn-block custom-btn">Update Password</button>
            </div>
        </form>
    </div>
</div>
                </div>
            </div>
    </body>
</html>
