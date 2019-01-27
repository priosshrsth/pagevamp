<?php require_once 'layouts/app.php' ?>
<?php require_once 'layouts/header.php' ?>
<?php
if(!(isset($_GET['id']) && $_GET['id'] !== '')) {
    header('Location: index.php');
}
    $id = $_GET['id'];
    $product = data()->query("SELECT products.*, categories.name as category,
    brands.name as brand FROM products INNER JOIN categories ON products.category_id = categories.id INNER JOIN brands ON brands.id = products.brand_id WHERE products.id = $id")->fetchObject();
?>
?>
<section class="htc__product__details pt--120 pb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="product__details__container">
                    <!-- Start Small images -->
                    <ul class="product__small__images" role="tablist">
                        <li role="presentation" class="pot-small-img active">
                            <a href="#img-tab-1" role="tab" data-toggle="tab">
                                <img src="images/product-details/small-img/1.jpg" alt="small-image">
                            </a>
                        </li>
                        <li role="presentation" class="pot-small-img">
                            <a href="#img-tab-2" role="tab" data-toggle="tab">
                                <img src="images/product-details/small-img/2.jpg" alt="small-image">
                            </a>
                        </li>
                        <li role="presentation" class="pot-small-img hidden-xs">
                            <a href="#img-tab-3" role="tab" data-toggle="tab">
                                <img src="images/product-details/small-img/3.jpg" alt="small-image">
                            </a>
                        </li>
                        <li role="presentation" class="pot-small-img hidden-xs hidden-sm">
                            <a href="#img-tab-4" role="tab" data-toggle="tab">
                                <img src="images/product-details/small-img/2.jpg" alt="small-image">
                            </a>
                        </li>
                    </ul>
                    <!-- End Small images -->
                    <div class="product__big__images">
                        <div class="portfolio-full-image tab-content">
                            <div role="tabpanel" class="tab-pane fade in active product-video-position" id="img-tab-1">
                                <img src="images/products/<?php echo $product->image;?>" alt="full-image">
                                <div class="product-video">
                                    <a class="video-popup" href="https://www.youtube.com/watch?v=cDDWvj_q-o8">
                                        <i class="zmdi zmdi-videocam"></i> View Video
                                    </a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade product-video-position" id="img-tab-2">
                                <img src="images/product-details/big-img/12.jpg" alt="full-image">
                                <div class="product-video">
                                    <a class="video-popup" href="https://www.youtube.com/watch?v=cDDWvj_q-o8">
                                        <i class="zmdi zmdi-videocam"></i> View Video
                                    </a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade product-video-position" id="img-tab-3">
                                <img src="images/product-details/big-img/11.jpg" alt="full-image">
                                <div class="product-video">
                                    <a class="video-popup" href="https://www.youtube.com/watch?v=cDDWvj_q-o8">
                                        <i class="zmdi zmdi-videocam"></i> View Video
                                    </a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade product-video-position" id="img-tab-4">
                                <img src="images/product-details/big-img/12.jpg" alt="full-image">
                                <div class="product-video">
                                    <a class="video-popup" href="https://www.youtube.com/watch?v=cDDWvj_q-o8">
                                        <i class="zmdi zmdi-videocam"></i> View Video
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                <div class="htc__product__details__inner">
                    <div class="pro__detl__title">
                        <h2><?php echo $product->name; ?></h2>
                    </div>
                    <div class="pro__dtl__rating">
                        <ul class="pro__rating">
                            <li><span class="ti-star"></span></li>
                            <li><span class="ti-star"></span></li>
                            <li><span class="ti-star"></span></li>
                            <li><span class="ti-star"></span></li>
                            <li><span class="ti-star"></span></li>
                        </ul>
                        <span class="rat__qun">(Based on 0 Ratings)</span>
                    </div>
                    <div class="pro__details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod temf incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostr exercitation ullamco laboris nisi ut aliquip ex ea. </p>
                    </div>
                    <ul class="pro__dtl__prize">
                        <li class="old__prize">$<?php echo $product->price + 500; ?></li>
                        <li>$<?php echo $product->price; ?></li>
                    </ul>
                    <div class="pro__dtl__color">
                        <h2 class="title__5">Choose Colour</h2>
                        <ul class="pro__choose__color">
                            <li class="red"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                            <li class="blue"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                            <li class="perpal"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                            <li class="yellow"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                        </ul>
                    </div>
                    <div class="pro__dtl__size">
                        <h2 class="title__5">Size</h2>
                        <ul class="pro__choose__size">
                            <li><a href="#">xl</a></li>
                            <li><a href="#">m</a></li>
                            <li><a href="#">ml</a></li>
                            <li><a href="#">lm</a></li>
                            <li><a href="#">xxl</a></li>
                        </ul>
                    </div>
                    <div class="product-action-wrap">
                        <div class="prodict-statas"><span>Quantity :</span></div>
                        <div class="product-quantity">
                            <form id='myform' method='POST' action='#'>
                                <div class="product-quantity">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <ul class="pro__dtl__btn">
                        <li @click="addToCart(<?php echo $product->id ?>)" class="buy__now__btn"><a href="#">Add To Cart</a></li>
                        <li><a href="#"><span class="ti-heart"></span></a></li>
                        <li><a href="#"><span class="ti-email"></span></a></li>
                    </ul>
                    <div class="pro__social__share">
                        <h2>Share :</h2>
                        <ul class="pro__soaial__link">
                            <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Details -->

<?php require_once 'layouts/footer.php'; ?>