<?php
    $brands = data()->query("SELECT * FROM brands;")->fetchAll(PDO::FETCH_CLASS, 'Brand');
    $categories = data()->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_CLASS, 'Category');
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tmart-Ecommerce Site</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/prios.css">
    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <?php
    if(isset($_CSS)) {
        foreach($CSS as $css) {
            $css = explode(',');
            if(end($css)==='cdn') {
                echo "<link rel='stylesheet' href='$css'>";
            } else {
                 echo "<link rel='stylesheet' href='css/$css'>";
            }
        }
    }
    ?>


</head>

<body>
<!-- Body main wrapper start -->
<div id="app" v-cloak class="wrapper fixed__footer">
    <!-- Start Header Style -->
    <header id="header" class="htc-header header--3 bg__white">
        <!-- Start Mainmenu Area -->
        <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                        <div class="logo">
                            <a href="index.html">
                                <img src="images/logo/logo.png" alt="logo">
                            </a>
                        </div>
                    </div>
                    <!-- Start MAinmenu Ares -->
                    <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                        <nav class="mainmenu__nav hidden-xs hidden-sm">
                            <ul class="main__menu">
                                <li class="drop"><a href="index.php">Home</a></li>
                                <?php
                                foreach ($brands as $brand) {?>
                                    <li class="drop"><a href="brand.php?name=<?php slug($brand->name); ?>"><?php echo $brand->name ?></a>
                                        <ul class="dropdown">
                                            <?php
                                            foreach($categories as $category) {
                                            ?>
                                                <li><a href="category.php?brand=<?php slug($brand->name); ?>&category=<?php slug($category->name); ?>"><?php echo $category->name ?><span><i class="zmdi zmdi-chevron-right"></i></span></a>
                                                    <ul class="lavel-dropdown">
                                                        <li><a href="category.php?brand=<?php slug($brand->name); ?>&category=<?php slug($category->name); ?>&filter=male">Male</a></li>
                                                        <li><a href="category.php?brand=<?php slug($brand->name); ?>&category=<?php slug($category->name); ?>&filter=female">Female</a></li>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <li><a href="about.php">About</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <?php
                                if(!auth()->check()) {
                                    echo "<li> <a href='register.php'>Login</a></li>";
                                    echo "<li> <a href='register.php?action=register'>Register</a></li>";
                                }
                                ?>
                            </ul>
                        </nav>
                        <div class="mobile-menu clearfix visible-xs visible-sm">
                            <nav id="mobile_dropdown">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <?php
                                    foreach ($brands as $brand) {?>
                                        <li><a href="brand.php?name=<?php slug($brand->name); ?>"><?php echo $brand->name ?></a>
                                            <ul>
                                                <?php
                                                foreach($categories as $category) {
                                                    ?>
                                                    <li><a href="category.php?brand=<?php slug($brand->name); ?>&category=<?php slug($category->name); ?>"><?php echo $category->name ?><span><i class="zmdi zmdi-chevron-right"></i></span></a>
                                                        <ul>
                                                            <li><a href="category.php?brand=<?php slug($brand->name); ?>&category=<?php slug($category->name); ?>&filter=male">Male</a></li>
                                                            <li><a href="category.php?brand=<?php slug($brand->name); ?>&category=<?php slug($category->name); ?>&filter=female">Female</a></li>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                    <?php
                                    if(!auth()->check()) {
                                        echo "<li> <a href='register.php'>Login</a></li>";
                                        echo "<li> <a href='register.php?action=register'>Register</a></li>";
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- End MAinmenu Ares -->
                    <div class="col-md-2 col-sm-4 col-xs-3">
                        <ul class="menu-extra">
                            <li class="search search__open hidden-xs"><span class="ti-search"></span></li>
                            <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)"><span class="ti-user"></span><?php echo auth()->user()->username; ?></a>
                                <ul class="dropdown-menu">
                                    <li><a href="checkout.php">Checkout</a></li>
                                    <li>
                                        <form method="POST">
                                            <?php csrf_field(); ?>
                                            <button name="logout" type="submit" class="btn btn-link">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="cart__menu"><span class="ti-shopping-cart">{{cart.length}}</span></li>
                            <li class="toggle__menu hidden-xs hidden-sm"><span class="ti-menu"></span></li>
                        </ul>
                    </div>
                </div>
                <div class="mobile-menu-area"></div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
    </header>
    <!-- End Header Style -->

    <div class="body__overlay"></div>
    <!-- Start Offset Wrapper -->
    <div class="offset__wrapper">
        <!-- Start Search Popap -->
        <div class="search__area">
            <div class="container" >
                <div class="row" >
                    <div class="col-md-12" >
                        <div class="search__inner">
                            <form action="#" method="get">
                                <input placeholder="Search here... " type="text">
                                <button type="submit"></button>
                            </form>
                            <div class="search__close__btn">
                                <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search Popap -->
        <!-- Start Offset MEnu -->
        <div class="offsetmenu">
            <div class="offsetmenu__inner">
                <div class="offsetmenu__close__btn">
                    <a href="#"><i class="zmdi zmdi-close"></i></a>
                </div>
                <div class="off__contact">
                    <div class="logo">
                        <a href="index.html">
                            <img src="images/logo/logo.png" alt="logo">
                        </a>
                    </div>
                    <p>T-Mart is the best place to find what you like!
                        <span style="color:green;font-style:italic">Check Our Latest Product</span>
                    </p>
                </div>
                <ul class="sidebar__thumd">
                    <li><a href="#"><img src="images/sidebar-img/1.jpg" alt="sidebar images"></a></li>
                    <li><a href="#"><img src="images/sidebar-img/2.jpg" alt="sidebar images"></a></li>
                    <li><a href="#"><img src="images/sidebar-img/3.jpg" alt="sidebar images"></a></li>
                    <li><a href="#"><img src="images/sidebar-img/4.jpg" alt="sidebar images"></a></li>
                    <li><a href="#"><img src="images/sidebar-img/5.jpg" alt="sidebar images"></a></li>
                    <li><a href="#"><img src="images/sidebar-img/6.jpg" alt="sidebar images"></a></li>
                    <li><a href="#"><img src="images/sidebar-img/7.jpg" alt="sidebar images"></a></li>
                    <li><a href="#"><img src="images/sidebar-img/8.jpg" alt="sidebar images"></a></li>
                </ul>
                <div class="offset__widget">
                    <div class="offset__single">
                        <h4 class="offset__title">Location</h4>
                        <ul>
                            <li><a href="javascript:void(0);"> Australia </a></li>
                        </ul>
                    </div>
                    <div class="offset__single">
                        <h4 class="offset__title">Currencies</h4>
                        <ul>
                            <li><a href="javascript:void(0);"> USD : Dollar </a></li>
                        </ul>
                    </div>
                </div>
                <div class="offset__sosial__share">
                    <h4 class="offset__title">Follow Us On Social</h4>
                    <ul class="off__soaial__link">
                        <li><a class="bg--twitter" href="javascript:void(0);"  title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>

                        <li><a class="bg--instagram" href="javascript:void(0);" title="Instagram"><i class="zmdi zmdi-instagram"></i></a></li>

                        <li><a class="bg--facebook" href="javascript:void(0);" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>

                        <li><a class="bg--googleplus" href="javascript:void(0);" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>

                        <li><a class="bg--google" href="javascript:void(0);" title="Google"><i class="zmdi zmdi-google"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Offset MEnu -->
        <!-- Start Cart Panel -->
        <div class="shopping__cart">
            <div class="shopping__cart__inner">
                <div class="offsetmenu__close__btn">
                    <a href="#"><i class="zmdi zmdi-close"></i></a>
                </div>
                <div class="shp__cart__wrap">
                    <div v-for="(item,key) in cart" class="shp__single__product">
                        <div class="shp__pro__thumb">
                            <a :href="'product.php?id='+item.id">
                                <img :src="'images/products/'+item.image" alt="product images">
                            </a>
                        </div>
                        <div class="shp__pro__details">
                            <h2><a :href="'product.php?id='+item.id">{{item.name}}</a></h2>
                            <span class="quantity">QTY: {{item.quantity}}</span>
                            <span class="shp__price">${{item.price}}</span>
                        </div>
                        <div class="remove__btn">
                            <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                </div>
                <ul class="shoping__total">
                    <li class="subtotal">Subtotal:</li>
                    <li class="total__price">${{totalPrice}}</li>
                </ul>
                <ul class="shopping__btn">
                    <li><a href="cart.php">View Cart</a></li>
                    <li class="shp__checkout"><a href="checkout.php">Checkout</a></li>
                </ul>
            </div>
        </div>
        <!-- End Cart Panel -->
    </div>
    <!-- End Offset Wrapper -->