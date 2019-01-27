<?php require_once 'layouts/app.php' ?>
<?php require_once 'layouts/header.php' ?>
<?php
    if(isset($_GET['category']) && $_GET['category'] !== '') {
        $cat_filter = ucwords(str_replace('-', ' ',$_GET['category']));
    } else {
        $cat_filter = '';
    }
    if(isset($_GET['brand']) && $_GET['brand'] !== '') {
        $brand_filter = ucwords(str_replace('-', ' ',$_GET['brand']));
    } else {
        $brand_filter = '';
    }
    if(isset($_GET['filter']) && $_GET['filter'] !== '') {
        $gender_filter = $_GET['filter'];
    } else {
        $gender_filter = '';
    }
?>
    <!-- Start Feature Product -->
    <section class="categories-slider-area bg__white">
        <div class="container">
            <div class="row">
                <!-- Start Left Feature -->
                <div class="col-12">
                    <!-- Start Slider Area -->
                    <div class="slider__container slider--one">
                        <div class="slider__activation__wrap owl-carousel owl-theme">
                            <!-- Start Single Slide -->
                            <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url(images/slider/bg/adidas.png) no-repeat scroll center center / cover ;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-10 col-lg-8 col-md-offset-2 col-lg-offset-4 col-sm-12 col-xs-12">
                                            <div class="slider__inner">
                                                <h1>New Product <span class="text--theme">Collection</span></h1>
                                                <div class="slider__btn">
                                                    <a class="htc__btn" href="cart.html">shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slide -->
                            <!-- Start Single Slide -->
                            <div class="slide slider__full--screen slider-height-inherit  slider-text-left" style="background: rgba(0, 0, 0, 0) url(images/slider/bg/nike.png) no-repeat scroll center center / cover ;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                                            <div class="slider__inner">
                                                <h1>New Product <span class="text--theme">Collection</span></h1>
                                                <div class="slider__btn">
                                                    <a class="htc__btn" href="cart.html">shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slide -->
                        </div>
                    </div>
                    <!-- Start Slider Area -->
                </div>

                <!-- End Left Feature -->
            </div>
        </div>
    </section>
    <!-- End Feature Product -->
    <div class="only-banner ptb--100 bg__white">
        <div class="container">
            <div class="only-banner-img new product parallax">
                <!--            <a href="shop-sidebar.html"><img src="images/bg/Adidas.jpg" alt="new product parallax"></a>-->
            </div>
        </div>
    </div>
    <!-- Start Our Product Area -->
<?php
foreach($brands as $brand) {
    if($brand->name == $brand_filter || $brand->id == $brand_filter || $brand_filter == '') {
        ?>
        <section class="htc__product__area bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="product-categories-all">
                            <div class="product-categories-title">
                                <h3><?php echo $brand->name; ?></h3>
                            </div>
                            <div class="product-categories-menu">
                                <ul>
                                    <li><a href="javascript:void(0);"></a></li>
                                    <?php
                                    foreach($categories as $category) {
                                        if($category->name == $cat_filter || $category->id == $cat_filter || $cat_filter == '') {
                                            ?>
                                            <?php
                                            if($gender_filter!='female' || $gender_filter=='') {
                                                ?>
                                                <li>
                                                    <a href="category.php?brand=<?php slug($brand->name) ?>&category=<?php slug($category->name); ?>&filter=male"><?php echo $brand->name . " " . $category->name . " (Male)"; ?></a>
                                                </li>
                                                <?php
                                            }
                                                ?>
                                            <?php
                                            if($gender_filter!='male' || $gender_filter=='') {
                                                ?>
                                            <li>
                                                <a href="category.php?brand=<?php slug($brand->name) ?>&category=<?php slug($category->name); ?>&filter=female"><?php echo $brand->name . " " . $category->name . " (Female)"; ?></a>
                                            </li>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="product-style-tab">
                            <div class="product-tab-list">
                                <!-- Nav tabs -->
                                <ul class="tab-style" role="tablist">
                                    <?php
                                    foreach($categories as $index=> $category) {
                                        if($category->name == $cat_filter || $category->id == $cat_filter || $cat_filter == '') {
                                            ?>
                                            <?php
                                            if($gender_filter!='female' || $gender_filter=='') {
                                                ?>
                                                <li role="presentation"
                                                    class="<?php if ($index == 0) echo 'active'; ?>">
                                                    <a href="#brand<?php echo $brand->id . '_cat' . $category->id . '_male' ?>"
                                                       data-toggle="tab">
                                                        <div class="tab-menu-text">
                                                            <h4><?php echo $category->name . " (Male)"; ?></h4>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                                ?>
                                            <?php
                                            if($gender_filter!='male' || $gender_filter=='') {
                                                ?>
                                                <li role="presentation">
                                                    <a href="#brand<?php echo $brand->id . '_cat' . $category->id . '_female' ?>"
                                                       data-toggle="tab">
                                                        <div class="tab-menu-text">
                                                            <h4><?php echo $category->name . " (Female)"; ?></h4>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                                ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="tab-content another-product-style jump">
                                <?php
                                foreach($categories as $index=>$category) {
                                    if($category->name == $cat_filter || $category->id == $cat_filter || $cat_filter == '') {
                                        if ($gender_filter != 'female' || $gender_filter == '')
                                            $male_products = data()->query("SELECT * FROM products WHERE brand_id =" . $brand->id . " AND category_id = " . $category->id . " AND gender = 'M';")->fetchAll(PDO::FETCH_CLASS, 'Product');
                                        if ($gender_filter != 'male' || $gender_filter == '')
                                            $female_products = data()->query("SELECT * FROM products WHERE brand_id =" . $brand->id . " AND category_id = " . $category->id . " AND gender = 'F';")->fetchAll(PDO::FETCH_CLASS, 'Product');
                                        ?>
                                        <?php
                                        if($gender_filter!='female' || $gender_filter=='') {
                                            ?>
                                            <div role="tabpanel"
                                                 class="tab-pane fade <?php if ($index == 0) echo 'in active'; ?>"
                                                 id="brand<?php echo $brand->id . '_cat' . $category->id . '_male' ?>">
                                                <div class="row">
                                                    <div class="product-slider-active owl-carousel">
                                                        <?php
                                                        foreach ($male_products as $product) {

                                                            ?>
                                                            <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                                                <div class="product">
                                                                    <div class="product__inner">
                                                                        <div class="pro__thumb">
                                                                            <a href="#">
                                                                                <img src="images/products/<?php echo $product->image; ?>"
                                                                                     alt="product images">
                                                                            </a>
                                                                        </div>
                                                                        <div class="product__hover__info">
                                                                            <ul class="product__action">
                                                                                <li><a data-toggle="modal"
                                                                                       data='<?php echo json($product); ?>'
                                                                                       data-target="#productModal"
                                                                                       title="Quick View"
                                                                                       class="quick-view modal-view detail-link"
                                                                                       href="#"><span
                                                                                                class="ti-plus"></span></a>
                                                                                </li>
                                                                                <li @click="addToCart(<?php echo $product->id; ?>)">
                                                                                    <a class="add_to_cart"
                                                                                       title="Add TO Cart"
                                                                                       href="javascript:void(0)"><span
                                                                                                class="ti-shopping-cart"></span></a>
                                                                                </li>
                                                                                <li><a title="Wishlist"
                                                                                       href="wishlist.html"><span
                                                                                                class="ti-heart"></span></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product__details">
                                                                        <h2>
                                                                            <a href="product.php?id=<?php echo $product->id; ?>"><?php echo $product->name; ?></a>
                                                                        </h2>
                                                                        <ul class="product__price">
                                                                            <li class="old__price">
                                                                                $<?php echo $product->price + 100; ?></li>
                                                                            <li class="new__price">
                                                                                $<?php echo $product->price; ?></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                            ?>
                                        <?php
                                        if($gender_filter!='male' || $gender_filter=='') {
                                            ?>
                                        <div role="tabpanel" class="tab-pane fade"
                                             id="brand<?php echo $brand->id . '_cat' . $category->id . '_female' ?>">
                                            <div class="row">
                                                <div class="product-slider-active owl-carousel">
                                                    <?php
                                                    foreach ($female_products as $product) {

                                                        ?>
                                                        <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                                            <div class="product">
                                                                <div class="product__inner">
                                                                    <div class="pro__thumb">
                                                                        <a href="#">
                                                                            <img src="images/products/<?php echo $product->image; ?>"
                                                                                 alt="product images">
                                                                        </a>
                                                                    </div>
                                                                    <div class="product__hover__info">
                                                                        <ul class="product__action">
                                                                            <li><a data-toggle="modal"
                                                                                   data='<?php echo json($product); ?>'
                                                                                   data-target="#productModal"
                                                                                   title="Quick View"
                                                                                   class="quick-view modal-view detail-link"
                                                                                   href="#"><span
                                                                                            class="ti-plus"></span></a>
                                                                            </li>
                                                                            <li @click="addToCart(<?php echo $product->id; ?>)">
                                                                                <a class="add_to_cart"
                                                                                   title="Add TO Cart"
                                                                                   href="javascript:void(0)"><span
                                                                                            class="ti-shopping-cart"></span></a>
                                                                            </li>
                                                                            <li><a title="Wishlist"
                                                                                   href="wishlist.html"><span
                                                                                            class="ti-heart"></span></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="product__details">
                                                                    <h2>
                                                                        <a href="product.php?id=<?php echo $product->id; ?>"><?php echo $product->name; ?></a>
                                                                    </h2>
                                                                    <ul class="product__price">
                                                                        <li class="old__price">
                                                                            $<?php echo $product->price + 100; ?></li>
                                                                        <li class="new__price">
                                                                            $<?php echo $product->price; ?></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
}
?>
    <!-- End Our Product Area -->
    <div class="only-banner bg__white">
        <div class="container">
            <div class="only-banner-img">
                <a href="shop-sidebar.html"><img src="images/new-product/7.jpg" alt="new product"></a>
            </div>
        </div>
    </div>
    <!-- End Blog Area -->

<?php require_once 'layouts/footer.php'; ?>