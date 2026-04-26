<?php
session_start();
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
           <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000" style="margin-bottom: 50px; margin-top: 0;">
    
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
        <div class="item active">
            <img src="img/banner1.jpg" alt="Banner 1" class="custom-banner-img">
            <div class="carousel-caption">
                <h1 style="font-weight: 800; text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">Mùa Hè Sôi Động</h1>
                <p style="font-size: 18px; text-shadow: 1px 1px 5px rgba(0,0,0,0.8);">Giảm giá cực sốc lên đến 50%</p>
            </div>
        </div>

        <div class="item">
            <img src="img/banner2.jpg" alt="Banner 2" class="custom-banner-img">
        </div>

         <div class="item">
            <img src="img/banner3.jpg" alt="Banner 3" class="custom-banner-img">
        </div>
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
           <div class="container">
               <div class="row">
                   <div class="col-xs-4">
                     <div class="thumbnail">
                         <a href="products.php?cat=Jacket">
                             <img src="img/1.jpg" alt="Jackets">
                         </a>
                         <center>
                             <div class="caption">
                                 <p id="autoResize">Áo Khoác</p>
                                 <p>Các mẫu áo phao, hoodie và jacket mới nhất.</p>
                             </div>
                        </center>
                     </div>
                 </div>
                   <div class="col-xs-4">
                     <div class="thumbnail">
                         <a href="products.php?cat=Pants">
                             <img src="img/17.jpg" alt="Pants">
                         </a>
                         <center>
                             <div class="caption">
                                 <p id="autoResize">Quần Nam/Nữ</p>
                                 <p>Quần Tây, Jean và Short thời trang.</p>
                             </div>
                         </center>
                     </div>
                </div>
                   <div class="col-xs-4">
                       <div class="thumbnail">
                         <a href="products.php?cat=T-Shirt">
                             <img src="img/23.jpg" alt="T-Shirts">
                         </a>
                         <center>
                             <div class="caption">
                                 <p id="autoResize">Áo Thun</p>
                                 <p>Áo thun basic và áo Polo năng động.</p>
                             </div>
                         </center>
                     </div>
                 </div>
               </div>
           </div>

           <div class="container promo-section">
    <div class="promo-banner">
        <div class="promo-content">
            <h3>Mừng Đại Lễ 30/4 - 1/5</h3>
            <h2>SALE SẬP SÀN ĐẾN 50%</h2>
            <p>Săn ngay những bộ outfit cực chất đón kỳ nghỉ dài. Số lượng có hạn, chốt đơn liền tay!</p>
            <a href="products.php" class="btn btn-promo">Săn Sale Ngay</a>
        </div>
    </div>
</div>
           
            <br><br> <br><br><br><br>
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
