<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">

        <!-- LOGO -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="index.php" style="display: flex; align-items: center;">
    <span style="font-weight: 900; font-size: 26px; fon color: #111;">VS Model</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">

            <form class="navbar-form navbar-left" action="products.php" method="GET" style="margin-left:20px;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm..." required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-danger" style="background-color:#c2606f">Tìm</button>
                    </span>
                </div>
            </form>

            <!-- MENU -->
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['email'])){ ?>
                    <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                    <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                <?php } else { ?>
                    <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php } ?>
            </ul>

        </div>
    </div>

    <script>
    let lastScrollTop = 0;
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > lastScrollTop) {
            navbar.style.top = "-80px"; 
        } else {
            navbar.style.top = "0";
        }
        
        lastScrollTop = scrollTop;
    });
    </script>
</nav>